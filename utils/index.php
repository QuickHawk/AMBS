<?php



    // $content = file_get_contents("https://api.mapbox.com/directions/v5/mapbox/driving/-73.996%2C40.732%3B-73.991%2C40.735?alternatives=false&geometries=geojson&steps=false&access_token=pk.eyJ1IjoicXVpY2toYXdrIiwiYSI6ImNrazVidTBreTAzenQyc29hZzVzaGhhYm0ifQ.EW4dmHaAG41a4jgYlSMjHg");
    // $content = json_decode($content, true);

    // echo $content['routes'][0]['distance'];

    // require_once "utils\\DBConnection.php";
    // require_once "utils\\TransportDAO.php";
    // require_once "utils\\PatientDAO.php";
    // require_once "utils\\AmbulanceDAO.php";
    // require_once "utils\\DriverDAO.php";

    $details = array(

        "name" => "Boya",
        "email" => "boyaaarya@gmail.com",
        "password" => "aarya",
        "phone" => "19823",
        "blood_type" => "O-ve",
        "address" => "some new place",
        "dob" => "1999-04-29",
        "otp" => "3892"
    //     "License" => "BIHD13983",
    //     "image" => "new image",
    //     "status" => 0,
    //     "did" => 2

    );

    require_once "AdminDAO.php";
    require_once "PatientDAO.php";
    require_once "PersonDAO.php";
    require_once "TransportDAO.php";


    // echo (new PatientDAO())->insert($details);
    // echo (new PersonDAO())->verify_otp(3, 3892);
    // echo (new TransportDAO())->get_transport_id_from_patient(1);
    // echo (new TransportDAO())->get_hospital_coord(1);
    // echo (new TransportDAO())->get_patient_coord(1);

    echo (new PatientDAO())->get_history(1);

    // echo (new TransportDAO())->find_driver(2);
    // echo (new TransportDAO())->end_trip(1);
    // echo ((new TransportDAO())->route_coord(78.5777,17.3375,78.4999,17.3746));

    // echo (new PatientDAO())->login('d@gmail.com', 'devarla');

    // echo (new DriverDAO())->update($details);
    // echo (new DriverDAO())->get_driver_details(2);

    // $details = array(
    //                 "aid" => 2,
    //                 "name" => "COVID",
    //                 "bill" => 200,
    //                 "image" => "something else",
    //                 "desc" => "For more covid services"
    //                 );

    // echo (new AmbulanceDAO())->update($details);
    // echo (new AmbulanceDAO())->get_ambulances();
    
    // (new TransportDAO())->set_status(1, 1);
    // echo (new TransportDAO())->get_status(1);
    // (new TransportDAO())->set_status(1, 0);
    // (new PatientDAO())->book(1, "Fever", 78.5147217,17.4300774);

    // $result = (new TransportDAO())->find_patient(1);
    // print_r(json_encode($result));
    
    
    // (new TransportDAO())->picked_up(1);
    // (new TransportDAO())->end_trip(1);

    // $content = file_get_contents("test.json");
    // $content = json_decode($content, true);


    // for($i = 0; $i < count($content); $i++)
    //     {
    //         echo ($i + 1) . ',' . explode(",", $content[$i]['display_name'])[0] . ',' . $content[$i]['lat'] . ',' . $content[$i]['lon'] . '<br/>';
    //     }

    

?>