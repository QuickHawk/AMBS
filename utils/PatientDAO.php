<?php

    require_once "DBConnection.php";
    require_once "TransportDAO.php";
    require_once "PatientDAO.php";
    require_once "PersonDAO.php";

    class PatientDAO{

        function login($email, $pass)
        {
            $q = "select * from `Person` p, `Patient` pa where pa.`PID` = p.`PID` and `email` = '$email' and `password` = '$pass' and `Status` = 1";
            $conn = DBConnection::get_instance()->get_connection();
            $result = $conn->query($q);
            return json_encode($result->fetch_all(MYSQLI_ASSOC));
        }

        function is_activated($email, $pass)
        {
            $q = "select * from `Person` p, `Patient` pa where pa.`PID` = p.`PID` and `email` = '$email' and `password` = '$pass' and `Status` = 0";
            $conn = DBConnection::get_instance()->get_connection();
            $result = $conn->query($q);
            return json_encode($result->fetch_all(MYSQLI_ASSOC));
        }

        function insert($details)
        {
            $p = new PersonDAO();
            
            $conn = DBCOnnection::get_instance()->get_connection();

            $p->insert($details);
            $pid = json_decode($p->get_details_email($details['email']), true)[0]['PID'];

            $q = "insert into `Patient`(`PID`) values($pid)";
            $result = $conn->query($q);

            return $result === TRUE;
        }

        function update($details)
        {
            $p = new PatientDAO();
            return $p->update($details);
        }

        function delete($patient_id)
        {
            $conn = DBConnection::get_instance()->get_connection();
            $q = "delete from `Patient` where `Patient_ID` = $patient_id";

            return $conn->query($q);
        }

        public function get_history($patient_id)
        {
            $q = "

            select p.`name` as `Driver`, h.`name` as `Hospital`, b.`Illness`, b.`Date`, b.`PickUpTime`, b.`LocationFromLat`, b.`LocationFromLong`, b.`LocationToLat`, b.`LocationToLong`
            from `Booking` b, `Person` p, `Transport` t, `Driver` d, `Hospital` h
            where 
            b.`Transport_ID` = t.`Transport_ID` 
            and
            t.`Driver_ID` = d.`Driver_ID`
            and 
            d.`PID` = p.`PID`
            and
            h.`Hospital_ID` = b.`Hospital_ID`
            and
            b.`Status` = 2
            and
            b.`Patient_ID` = $patient_id
            ";
            // $q = "select * from booking where Patient_ID = " . $patient_id . " and `Status` = 2";
            // echo $q;
            $conn = DBConnection::get_instance()->get_connection();

            $result = $conn->query($q);
            return json_encode($result->fetch_all(MYSQLI_ASSOC));
        }
        
        public function has_booked($patient_id)
        {
            $q = "select * from `Booking` where `Patient_ID` = $patient_id and ( `Status` = 0 or `Status` = 1)";
            $conn = DBConnection::get_instance()->get_connection();

            $result = $conn->query($q);
            return count($result->fetch_all(MYSQLI_ASSOC)) > 0;
        }

        public function book($patient_id, $illness, $aid, $lat, $long)
        {
            $conn = DBConnection::get_instance()->get_connection();

            // Check shortest distance from Patient to Transport    
            $q = "select * from `Transport` where `Status` = 0 and `AID` = $aid";
            $result = $conn->query($q);

            $tid = NULL;
            $distance = 999999999;
            $T_LAT = 0;
            $T_LONG = 0;
            while($row = $result->fetch_assoc())
                {
                    $t_lat = $row['Latitude'];
                    $t_long = $row['Longitude'];

                    // echo $long . ' ' . $lat . '<br/>';
                    // echo $h_long . ' ' . $h_lat . '<br/>';

                    $url = 'https://api.mapbox.com/directions/v5/mapbox/driving/' . 
                            $lat . '%2C' . $long . '%3B' . $t_lat . '%2C' . $t_long . 
                            '?alternatives=false&geometries=geojson&steps=false&access_token=pk.eyJ1IjoicXVpY2toYXdrIiwiYSI6ImNrazVidTBreTAzenQyc29hZzVzaGhhYm0ifQ.EW4dmHaAG41a4jgYlSMjHg';

                    $content = file_get_contents($url);
                    $content = json_decode($content, true);


                    $d = $content['routes'][0]['distance'];                    

                    if($d < $distance)
                        {
                            $distance = $d;
                            $tid = $row['Transport_ID'];
                            $T_LAT = $t_lat;
                            $T_LONG = $t_long;
                        }
                }

            
            // Check shortest distance from Patient to Hospital
            $q = "select * from `Hospital`";
            $result = $conn->query($q);
            
            $hid = NULL;
            $distance = 999999999;
            $H_LAT = 0;
            $H_LONG = 0;

            while($row = $result->fetch_assoc())
            {
                $h_lat = $row['Latitude'];
                $h_long = $row['Longitude'];

                // echo $long . ' ' . $lat . '<br/>';
                // echo $h_long . ' ' . $h_lat . '<br/>';
                
                    $url = 'https://api.mapbox.com/directions/v5/mapbox/driving/' . 
                    $lat . '%2C' . $long . '%3B' . $h_lat . '%2C' . $h_long . 
                            '?alternatives=false&geometries=geojson&steps=false&access_token=pk.eyJ1IjoicXVpY2toYXdrIiwiYSI6ImNrazVidTBreTAzenQyc29hZzVzaGhhYm0ifQ.EW4dmHaAG41a4jgYlSMjHg';
                            
                            $content = file_get_contents($url);
                    $content = json_decode($content, true);
                    
                    
                    $d = $content['routes'][0]['distance'];                    

                    if($d < $distance)
                    {
                        $distance = $d;
                        $hid = $row['Hospital_ID'];
                        $H_LAT = $h_lat;
                        $H_LONG = $h_long;
                    }
            }

            // Change Status of Transport
            (new TransportDAO())->set_status($tid, 1);

            // Add Booking
            $q = "insert into `Booking`(`Transport_ID`, `Patient_ID`, `Hospital_ID`, `illness`, `LocationFromLat`, `LocationFromLong`, `LocationToLat`, `LocationToLong`, `Date`, `PickUpTime`, `Status`) " . 
                    " values (" . $tid . ", " . $patient_id . ", " . $hid . ", '" . $illness . "', " .
                            $lat . ", " . $long . ", " . $H_LAT . ", " . $H_LONG . ", Date(now()), time(now()), 0)";

            $result = $conn->query($q);
            
            return $result === TRUE;
        }
   }
