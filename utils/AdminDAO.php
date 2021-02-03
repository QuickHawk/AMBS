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
    }

?>