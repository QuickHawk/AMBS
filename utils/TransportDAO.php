<?php

    require_once "DBConnection.php";

    class TransportDAO{

        public function insert($details)
        {
            $conn = DBConnection::get_instance()->get_connection();
            
            $aid = $details['aid'];
            $did = $details['did'];
            $numberplate = $details['numberplate'];
            
            $q = "insert into `Transport`(`AID`, `Driver_ID`, `NumberPlate`, `Status`, `Latitude`, `Longitude`) values " . 
                    "($aid, $did, $numberplate, 0, 0, 0)";

            $result = $conn->query($q);

            return $result === TRUE;
        }

        public function update($details)
        {
            $conn = DBConnection::get_instance()->get_connection();

            $tid = $details['tid'];
            $aid = $details['aid'];
            $did = $details['did'];
            $numberplate = $details['numberplate'];
            $status = $details['status'];
            $latitude = $details['latitude'];
            $longitude = $details['longitude'];

            $q = "update `Tranport` set `AID` = $aid, `Driver_ID` = $did, `NumberPlate` = $numberplate, `Status` = $status, `Latitude` = $latitude, `Longitude` = $longitude where `Transport_ID` = $tid";
            
            $result = $conn->query($q);
            return $result === TRUE;
        }

        public function delete($tid)
        {
            $q = "delete from `Transport` where `Transport_ID` = $tid";
            $conn = DBConnection::get_instance()->get_connection();
            $result = $conn->query($q);
            return $result === TRUE;
        }

        public function get_transport_id($did)
        {
            $q = "select `Transport_ID` from `Transport` where `Driver_ID` = $did";
            $conn = DBConnection::get_instance()->get_connection();
            $result = $conn->query($q);
            return $result->fetch_all(MYSQLI_ASSOC)[0]['Transport_ID'];
        }

        public function get_transport_id_from_patient($pid)
        {
            $q = "select `Transport_ID` from `Booking` where `Patient_ID` = $pid";
            $conn = DBConnection::get_instance()->get_connection();
            $result = $conn->query($q);
            return $result->fetch_all(MYSQLI_ASSOC)[0]['Transport_ID'];
        }

        public function set_lat_long($details)
        {
            $conn = DBConnection::get_instance()->get_connection();
            
            $tid = $details['tid'];
            $latitude = $details['Latitude'];
            $longitude = $details['Longitude'];

            $q = "update `Transport` set `Latitude` = $latitude, `Longitude` = $longitude where `Tranport_ID` = $tid";

            $result = $conn->query($q);
            return $result === TRUE;
        }

        public function get_unplaced_drivers()
        {
            $q = "select d.* from `Drivers` d where d.`Driver_ID` not in (select t.`Driver_ID` from `Tranport`)";

            $conn = DBConnection::get_instance()->get_connection();
            $result = $conn->query($q);

            return $result === TRUE;
        }

        public function get_status($tid)
        {
            $q = "select `Status` from `Transport` where `Transport_ID` = " . $tid;

            $conn = DBConnection::get_instance()->get_connection();
            $result = $conn->query($q);

            $row = $result->fetch_assoc();

            return $row['Status'];
        }

        public function set_status($tid, $to)
        {
            $q = "update `Transport` set `Status` = " . $to . ' where `Transport_ID` = ' . $tid;

            $conn = DBConnection::get_instance()->get_connection();
            $result = $conn->query($q);

            return $result === TRUE;
        }

        public function find_patient($tid)
        {
            $conn = DBConnection::get_instance()->get_connection();
            $q = "select * from `Person` p, `Patient` pa, `Booking` b where p.`pid` = pa.`pid` and pa.`patient_id` = b.`patient_id` and (b.`Status` = 0 or b.`Status` = 1) and b.`Transport_ID` = " . $tid;
            $result = $conn->query($q);

            $row = $result->fetch_all(MYSQLI_ASSOC);

            return json_encode($row);
        }

        public function find_driver($tid)
        {
            $conn = DBConnection::get_instance()->get_connection();
            $q = "select p.*, t.*, h.`name` as `Hospital_name`, b.* from `Person` p, `Driver` pa, `Booking` b, `Transport` t, `Hospital` h where h.`Hospital_ID` = b.`Hospital_ID` and p.`pid` = pa.`pid` and pa.`driver_id` = t.`driver_id` and t.`transport_id` = b.`transport_id` and (b.`Status` = 0 or b.`Status` = 1) and b.`Transport_ID` = " . $tid;
            $result = $conn->query($q);
            // echo $q;

            $row = $result->fetch_all(MYSQLI_ASSOC);

            return json_encode($row);
        }

        public function picked_up($tid)
        {
            $conn = DBConnection::get_instance()->get_connection();
            $q = "update `Booking` set `Status` = 1 where `Transport_ID` = " . $tid . " and `Status` = 0";
            
            $result = $conn->query($q);
            return $result === TRUE;
        }
        
        public function end_trip($tid)
        {
            $conn = DBConnection::get_instance()->get_connection();
            $q = "update `Booking` set `Status` = 2 where `Transport_ID` = " . $tid . " and `Status` = 1";

            $conn->query($q);
            $this->set_status($tid, 0);
        }

        public function get_hospital_coord($tid)
        {
            $conn = DBConnection::get_instance()->get_connection();
            $q = "select LocationToLat, LocationToLong from `Booking` where `Transport_ID` = " . $tid . " and (`Status` = 1 or `Status` = 0)";
            
            $result = $conn->query($q);
            return json_encode($result->fetch_all(MYSQLI_ASSOC));
        }
        
        public function get_patient_coord($tid)
        {
            $conn = DBConnection::get_instance()->get_connection();
            $q = "select LocationFromLat, LocationFromLong from `Booking` where `Transport_ID` = " . $tid . " and (`Status` = 1 or `Status` = 0)";
            
            $result = $conn->query($q);
            return json_encode($result->fetch_all(MYSQLI_ASSOC));
        }

        public function route_coord($slat, $slong, $elat, $elong)
        {
            $url = 'https://api.mapbox.com/directions/v5/mapbox/driving/' . 
                    $slat . '%2C' . $slong . '%3B' . $elat . '%2C' . $elong . 
                    '?alternatives=false&geometries=geojson&steps=false&access_token=pk.eyJ1IjoicXVpY2toYXdrIiwiYSI6ImNrazVidTBreTAzenQyc29hZzVzaGhhYm0ifQ.EW4dmHaAG41a4jgYlSMjHg';

            $content = file_get_contents($url);
            $content = json_decode($content, true);


            $a = $content['routes'][0]['geometry']['coordinates'];  

            return json_encode($a);
        }

        function get_transports()
        {
            $q = "select * from `Transport`";
            $conn = DBConnection::get_instance()->get_connection();

            $result = $conn->query($q);
            return json_encode($result->fetch_all(MYSQLI_ASSOC));

        }

    }
