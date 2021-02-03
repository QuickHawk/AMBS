<?php

require_once "utils\\PatientDAO.php";
require_once "utils\\DriverDAO.php";
require_once "utils\\AmbulanceDAO.php";
require_once "utils\\TransportDAO.php";

session_start();

$action = $_REQUEST['action'];

switch ($action) {
    case "login":
        $email = $_REQUEST['email'];
        $pass = $_REQUEST['pass'];

        switch ($_REQUEST['user']) {
            case "patient":

                $patient = new PatientDAO();
                $details = json_decode($patient->login($email, $pass), true);

                // print_r($details);

                $flag = 0;

                if (count($details) != 0) {


                    $_SESSION['PID'] = $details[0]['PID'];
                    $_SESSION['Patient_ID'] = $details[0]['Patient_ID'];
                    $_SESSION['name'] = $details[0]['name'];

                    header("Location: PatientDashboard.php");

                    $flag = 1;
                }


                if ($flag == 0) {

                    $details = json_decode($patient->is_activated($email, $pass), true);
                    // print_r($details);
                    if (count($details) != 0) {

                        $_SESSION['PID'] = $details[0]['PID'];
                        $_SESSION['Patient_ID'] = $details[0]['Patient_ID'];
                        header("Location: otpverification.html");
                    } else {
                        header("Location: Login.php");
                    }
                }

                break;

            case "admin":

                if ((new AdminDAO())->login($email, $pass) === TRUE) {


                    $_SESSION['user'] = $email;

                    header("Location: AdminDashboard.php");
                } else
                    header("Location: Login.php");

                break;

            case "driver":

                $driver = new DriverDAO();

                $details = $driver->login($email, $pass);
                $details = json_decode($driver->login($email, $pass), true);

                $flag = 0;

                if (count($details) != 0) {


                    $_SESSION['PID'] = $details[0]['PID'];
                    $_SESSION['Driver_ID'] = $details[0]['Driver_ID'];
                    $_SESSION['name'] = $details[0]['name'];
                    $_SESSION['Transport_ID'] = (new TransportDAO())->get_transport_id($_SESSION['Driver_ID']);

                    header("Location: DriverDashboard.php");

                    $flag = 1;
                }


                if ($flag == 0) {

                    $details = json_decode($driver->is_activated($email, $pass), true);
                    if (count($details) != 0) {

                        $_SESSION['PID'] = $details[0]['PID'];
                        $_SESSION['Driver_ID'] = $details[0]['Driver_ID'];
                        $_SESSION['Transport_ID'] = (new TransportDAO())->get_transport_id($_SESSION['Driver_ID']);
                        header("Location: otpverification.html");
                    } else {
                        header("Location: Login.php");
                    }
                }

                break;
        }
        break;

    case "verify_otp":

        $pid = $_SESSION['PID'];
        $otp = $_REQUEST['otp'];

        if ((new PersonDAO())->verify_otp($pid, $otp) == TRUE) {
            header("Location: welcome.html");
            session_destroy();
        } else {
            header("Location: otpverification.html");
            echo $_SESSION['PID'];
            echo $_REQUEST['OTP'];
        }

        break;

    case "logout":


        session_unset();
        session_destroy();

        header("Location: index.html");

        break;

    case "book":

        $patient_id = $_SESSION['Patient_ID'];
        $illness = $_REQUEST['illness'];
        $lat = $_REQUEST['latitude'];
        $long = $_REQUEST['longitude'];

        echo (new PatientDAO())->book($patient_id, $illness, 1, $long, $lat);

        break;

    case "signup":

        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['pass'];
        $phone = $_REQUEST['phone'];
        $blood_type = $_REQUEST['blood_type'];
        $address = $_REQUEST['address'];
        $dob = $_REQUEST['dob'];
        $otp = rand(1000, 9999);

        if (count(json_decode((new PersonDAO())->get_details_email($email), true)) > 0)
            header("Location: Login.php");

        else {

            $details = array(
                "name" => $name,
                "email" => $email,
                "password" => $password,
                "phone" => $phone,
                "blood_type" => $blood_type,
                "address" => $address,
                "dob" => $dob,
                "otp" => $otp
            );

            $result = (new PatientDAO())->insert($details);
            if ($result === TRUE) {
                session_unset();
                $_SESSION['PID'] = json_decode((new PersonDAO())->get_details_email($details['email']), true)[0]['PID'];

                header("Location: otpverification.html");
            } else {
                header("Location: signupform.html");
            }
        }
        break;


    case "change_status": 

        $status = $_REQUEST['status'];
        (new TransportDAO())->set_status($_SESSION['Transport_ID'], $status);
        break;

    case "pick_up":
        (new TransportDAO())->picked_up($_SESSION['Transport_ID']);
        break;

    case "end_trip":
        (new TransportDAO())->end_trip($_SESSION['Transport_ID']);
        break;
}
