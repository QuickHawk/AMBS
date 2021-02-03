<?php

require_once "DBConnection.php";
require_once "Mailing.php";

class PersonDAO
{

    function insert($details)
    {
        $name = $details['name'];
        $email = $details['email'];
        $password = $details['password'];
        $phone = $details['phone'];
        $blood_type = $details['blood_type'];
        $address = $details['address'];
        $dob = $details['dob'];

        $otp = $details['otp'];

        $q = "insert into `Person`(`name`, `email`, `password`, `phone`, `blood_type`, `Address`, `DOB`, `Status`, `OTP`) values " .
            "('{$name}', '{$email}', '{$password}', '{$phone}', '{$blood_type}', '{$address}', '{$dob}', 0, {$otp})";
        $conn = DBConnection::get_instance()->get_connection();

        $result = $conn->query($q);

        $mail = new Mailing();
        $subject = 'OTP for Raksha.com';
        $body    = 'This is your otp:<b>' . $otp . '</b>';
        $ack = $mail->sendMail($email, $subject, $body);

        return $result === TRUE;
    }

    function update($details)
    {
        $pid = $details['pid'];
        $name = $details['name'];
        $email = $details['email'];
        $password = $details['password'];
        $phone = $details['phone'];
        $blood_type = $details['blood_type'];
        $address = $details['address'];
        $dob = $details['dob'];
        $otp = $details['otp'];
        $status = $details['status'];

        $q = "update `Person` set " .
            "`name` = '{$name}', `email` = '{$email}', `password` = '{$password}', `phone` = '{$phone}', `blood_type` = '{$blood_type}', `address` = '{$address}', `dob` = '{$dob}', `status` = $status, `otp` =  $otp where `PID` = $pid";
        $conn = DBConnection::get_instance()->get_connection();

        $result = $conn->query($q);
        return $result === TRUE;
    }

    function get_details($pid)
    {
        $conn = DBConnection::get_instance()->get_connection();
        $q = "select * from `Person` where `PID` = $pid";

        $result = $conn->query($q);
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }

    function verify_otp($pid, $otp)
    {
        $conn = DBConnection::get_instance()->get_connection();
        $q = "update `Person` set `Status` = 1 where `PID` = $pid and `OTP` = $otp";

        $result = $conn->query($q);
        return $conn->affected_rows > 0;
    }

    function get_details_email($email)
    {
        $conn = DBConnection::get_instance()->get_connection();
        $q = "select * from `Person` where email = '$email'";

        $result = $conn->query($q);
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }
}
