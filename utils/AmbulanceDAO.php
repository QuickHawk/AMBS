<?php

    require_once "DBConnection.php";

    class AmbulanceDAO{

        function insert($details)
        {
            $conn = DBConnection::get_instance()->get_connection();

            $name = $details['name'];
            $bill = $details['bill'];
            $image = $details['image'];
            $desc = $details['desc'];

            $q = "insert into `Ambulance`(`Name`, `Bill`, `Image`, `Description`) values " .
                "('$name', $bill, '$image', '$desc')";

            return $conn->query($q) === TRUE;
        }

        function update($details)
        {
            $conn = DBConnection::get_instance()->get_connection();

            $aid = $details['aid'];
            $name = $details['name'];
            $bill = $details['bill'];
            $image = $details['image'];
            $desc = $details['desc'];

            $q = "update `Ambulance` set " .
                "`name` = '$name', `bill` = $bill, `image` = '$image', `description` = '$desc' where `AID` = $aid";

            $r = $conn->query($q);
            echo mysqli_error($conn);
            return $r === TRUE;
        }

        function delete($aid)
        {
            $q = "delete from `Ambulance` where `AID` = $aid";
            $conn = DBConnection::get_instance()->get_connection();
            $result = $conn->query($q);
            return $result;
        }

        function get_ambulances()
        {
            $q = "select * from `Ambulance`";
            $conn = DBConnection::get_instance()->get_connection();

            return json_encode($conn->query($q)->fetch_all(MYSQLI_ASSOC));
        }

    }

?>