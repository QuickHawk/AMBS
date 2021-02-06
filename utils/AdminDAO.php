<?php

    require_once "DBConnection.php";

    class AdminDAO{
        
        function login($user, $pass)
        {
            $conn = DBConnection::get_instance()->get_connection();
            $q = "select * from `Admin` where `user` = '$user' and `pass` = '$pass'";

            $result = $conn->query($q);
            echo mysqli_error($conn);
            if(count($result->fetch_all(MYSQLI_ASSOC)) > 0)
                return TRUE;

            else
                return FALSE;
        }

    function get_full_history()
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
            ";
            // $q = "select * from booking where Patient_ID = " . $patient_id . " and `Status` = 2";
            // echo $q;
            $conn = DBConnection::get_instance()->get_connection();

            $result = $conn->query($q);
            return json_encode($result->fetch_all(MYSQLI_ASSOC));
        }

    }

?>