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
        
        function get_full_history($status)
        {
            $q = "select 
            b.`Booking_ID`,
        
            (select p.`name` from `Person` p, `Driver` d, `Transport` t where p.`PID` = d.`PID` and t.`Driver_ID` = d.`Driver_ID` and b.`Transport_ID` = t.`Transport_ID`) as `Driver_Name` ,
            (select p.`name` from `Person` p, `Patient` pa, `Transport` t where p.`PID` = pa.`PID` and pa.`Patient_ID` = b.`Patient_ID` and b.`Transport_ID` = t.`Transport_ID`) as `Patient_Name` ,
            (select h.`name` from `Hospital` h where h.`Hospital_ID` = b.`Hospital_ID`) as `Hospital_Name`,
        
            b.`Illness`,
            b.`LocationFromLat`, b.`LocationFromLong`, b.`LocationToLat`, b.`LocationToLong`,
            b.`Date`, b.`PickUpTime`,
            case 
                when b.`Status` = 0 then 'Active'
                when b.`Status` = 1 then 'On Trip'
                when b.`Status` = 2 then 'Completed'
            end as `Status`
            from `Booking` b";

            if($status != -1)
                $q = $q . " where `Status` = $status";

            $conn = DBCOnnection::get_instance()->get_connection();
            $result = $conn->query($q);

            if($result == TRUE)
                return json_encode($result->fetch_all(MYSQLI_ASSOC));

            return "[]";
        }

    }
