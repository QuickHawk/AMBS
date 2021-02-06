<?php

    require_once "PersonDAO.php";
    require_once "DBConnection.php";

    class DriverDAO{

        function login($email, $pass)
        {
            $q = "select * from `Person` p, `Driver` d where d.`PID` = p.`PID` and `email` = '$email' and `password` = '$pass' and `Status` = 1";
            $conn = DBConnection::get_instance()->get_connection();
            $result = $conn->query($q);
            return json_encode($result->fetch_all(MYSQLI_ASSOC));
        }

        function is_activated($email, $pass)
        {
            $q = "select * from `Driver` d, `Person` pa where pa.`PID` = d.`PID` and `email` = '$email' and `password` = '$pass' and `Status` = 0";
            $conn = DBConnection::get_instance()->get_connection();
            $result = $conn->query($q);
            return json_encode($result->fetch_all(MYSQLI_ASSOC));
        }

        function insert($details)
        {
            $conn = DBConnection::get_instance()->get_connection();
            (new PersonDAO())->insert($details);

            // Get Latest Updated PID
            $r = (new PersonDAO())->get_details_email($details['email']);
            $pid = json_decode($r, true)[0]['PID'];

            $license = $details['License'];
            $image = $details['image'];

            // Insert into Driver Table
            $q = "insert into `Driver`(`PID`, `LicenseNumber`, `Image`) values ($pid, '$license', '$image')";
            $result = $conn->query($q);

            return $result === TRUE;
        }

        function update($details)
        {
            $conn = DBConnection::get_instance()->get_connection();
            
            $did = $details['did'];
            
            $r = (new PersonDAO())->get_details_email($details['email']);
            $pid = json_decode($r, true)[0]['PID'];
            
            $license = $details['License'];
            
            $details['pid'] = $pid;
            

            (new PersonDAO())->update($details);

            // Insert into Driver Table
            $q = "update `Driver` set `LicenseNumber` = '$license' where `Driver_ID` = $did";
            $result = $conn->query($q);

            return $result === TRUE;
        }

        function delete($did)
        {
            $conn = DBConnection::get_instance()->get_connection();
            $q = "delete from `Driver` where `Driver_ID` = $did";

            $r = $conn->query($q);
            return $r === TRUE;
        }

        function get_driver_details($did)
        {
            $conn = DBConnection::get_instance()->get_connection();
            $q = "select * from `Driver` d, `Person` p where p.pid = d.pid and d.`Driver_ID` = $did";
            
            $result = $conn->query($q);
            return json_encode($result->fetch_all(MYSQLI_ASSOC));
        }
        
        function get_drivers()
        {
            $conn = DBConnection::get_instance()->get_connection();
            $q = "select * from `Driver` d, `Person` p where p.pid = d.pid";

            $result = $conn->query($q);
            return json_encode($result->fetch_all(MYSQLI_ASSOC));
        }

    }

?>