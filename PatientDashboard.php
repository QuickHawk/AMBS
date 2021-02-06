<?php

session_start();
require_once "utils//PatientDAO.php";
require_once "utils//TransportDAO.php";

if (!isset($_SESSION['Patient_ID']))
    header("Location: Login.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="scripts.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <style>
        /*
    DEMO STYLE
*/

        @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

        @media (min-width: 770px) {
            body {
                font-family: 'Poppins', sans-serif;
                background: #fafafa;
            }

            p {
                font-family: 'Poppins', sans-serif;
                font-size: 1.1em;
                font-weight: 300;
                line-height: 1.7em;
                color: #999;
            }

            a,
            a:hover,
            a:focus {
                color: inherit;
                text-decoration: none;
                transition: all 0.3s;
            }

            .navbar {
                padding: 15px 10px;
                background: #fff;
                border: none;
                border-radius: 0;
                margin-bottom: 40px;
                box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
            }

            .navbar-btn {
                box-shadow: none;
                outline: none !important;
                border: none;
            }

            .line {
                width: 100%;
                height: 1px;
                border-bottom: 1px dashed #ddd;
                margin: 40px 0;
            }

            /* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */

            .wrapper {
                display: flex;
                width: 100%;
            }

            #sidebar {
                width: 250px;
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 999;
                /* background: black; */
                color: #fff;
                transition: all 0.3s;
            }

            #sidebar.active {
                margin-left: -250px;
            }

            #sidebar .sidebar-header {
                padding: 13px;
                background: red;
            }

            #sidebar ul.components {
                padding: 20px 0;
            }

            #sidebar ul p {
                color: #fff;
                padding: 10px;
            }

            #sidebar ul li a {
                padding: 10px;
                font-size: 1.1em;
                display: block;
            }

            #sidebar ul li a:hover {
                color: red;
                background: #fff;
            }

            #sidebar ul li.active>a,
            a[aria-expanded="true"] {
                color: #fff;
                background: red;
            }



            /* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */

            #content {
                width: calc(100% - 250px);
                /* padding: 40px; */
                min-height: 100vh;
                transition: all 0.3s;
                position: absolute;
                top: 0;
                right: 0;
            }

            #content.active {
                width: 100%;
            }

            .card:hover {
                background-color: orangered;
                color: white;
                transition: 0.5s ease-in-out;
                cursor: pointer;
            }
        }

        /* ---------------------------------------------------
    MEDIAQUERIES
----------------------------------------------------- */

        @media (max-width: 769px) {

            body {
                font-family: 'Poppins', sans-serif;
                background: #fafafa;
            }

            p {
                font-family: 'Poppins', sans-serif;
                font-size: 1.1em;
                font-weight: 300;
                line-height: 1.7em;
                color: #999;
            }

            a,
            a:hover,
            a:focus {
                color: inherit;
                text-decoration: none;
                transition: all 0.3s;
            }

            .navbar {
                padding: 15px 10px;
                background: #fff;
                border: none;
                border-radius: 0;
                margin-bottom: 40px;
                box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
            }




            /* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */

            #sidebar {
                width: 250px;
                position: fixed;
                top: 0;
                left: -250px;
                height: 100vh;
                z-index: 999;
                color: #fff;
                transition: all 0.3s;
                overflow-y: scroll;
                box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
            }

            #sidebar.active {
                left: 0;
            }

            #dismiss {
                width: 35px;
                height: 35px;
                line-height: 35px;
                text-align: center;
                background: red;
                position: absolute;
                top: 10px;
                right: 10px;
                cursor: pointer;
                -webkit-transition: all 0.3s;
                -o-transition: all 0.3s;
                transition: all 0.3s;
            }

            #dismiss:hover {
                background: #fff;
                color: red;
            }



            #sidebar .sidebar-header {
                padding: 20px;
                background: red;
            }

            #sidebar ul.components {
                padding: 20px 0;
                border-bottom: 1px solid #47748b;
            }

            #sidebar ul p {
                color: #fff;
                padding: 10px;
            }

            #sidebar ul li a {
                padding: 10px;
                font-size: 1.1em;
                display: block;
            }

            #sidebar ul li a:hover {
                color: red;
                background: #fff;
            }

            #sidebar ul li.active>a,
            a[aria-expanded="true"] {
                color: #fff;
                background: red;
            }

            a[data-toggle="collapse"] {
                position: relative;
            }


            /* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */

            #content {
                width: 100%;
                min-height: 100vh;
                transition: all 0.3s;
                position: absolute;
                top: 0;
                right: 0;
            }

            #content nav {
                z-index: 100;
            }

            .main-nav {
                flex-direction: unset;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="bg-dark ">
            <div id="dismiss" class=" d-block d-lg-none">
                <i class="fas fa-arrow-left"></i>
            </div>
            <div class="sidebar-header">
                <h3>Raksha Customerize</h3>
            </div>
            <ul class="list-unstyled components">

                <li class="active">
                    <a href="#">Book now</a>
                </li>
                <li>
                    <a href="View_Patient_History.php">View History</a>
                </li>
            </ul>

        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand sticky-top bg-dark navbar-dark">
                <button type="button" id="sidebarCollapse" class="btn btn-info  d-block d-lg-none ">
                    <i class="fas fa-align-left"></i>

                </button>

                <!-- Links -->
                <ul class="navbar-nav ml-auto p-3">

                    <li class="nav-item">
                        <a class="nav-link active ml-5" href="index.html">HOME</a>
                    </li>
                    <li class="nav-item ml-5">
                        <a class="btn btn-primary" type="button" href="controller.php?action=logout">LOGOUT</a>
                    </li>
                </ul>
            </nav>

            <div class="container ">

                <?php

                $t = new TransportDAO();
                // echo $_SESSION['Patient_ID'];
                
                if ((new PatientDAO())->has_booked($_SESSION['Patient_ID']) == TRUE) {
                    
                    $a = $t->find_driver($t->get_transport_id_from_patient($_SESSION['Patient_ID']));
                    $a = json_decode($a, true);
                    if (!is_null($a)) {


                        // print_r($a);
                ?>
                        <h3 class="text-center mb-3">Driver Details</h3>
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <iframe src="map.php" width="100%" height="300px"></iframe>
                                <h4 style="color: orange;"><?php echo $a[0]['name']; ?></h4>
                                <div class="row mt-2">
                                <div class="col-sm">
                                    <span class="text-info font-weight-bold">Number Plate :</span> <?php echo $a[0]['NumberPlate'];?>
                                </div>
                                <div class="col-sm">
                                    <span class="text-info font-weight-bold">Drop Location:</span> <?php echo $a[0]['Hospital_name'];?>
                                </div>
                            </div>
                                <div class="row mt-3">
                                    <div class="col-sm">
                                        <span class="text-info font-weight-bold"> PhoneNo:</span> <?php echo $a[0]['phone']; ?>
                                    </div>
                                    <div class="col-sm">
                                        <span class="text-info font-weight-bold">Problem/Issue:</span> <?php echo $a[0]['Illness']; ?>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary btn-block ">CALL NOW</button>
                                </div>
                            </div>
                        </div>

                    <?php

                    }
                } else {
                    ?>
                    <h1 class="text-center">Book Your Ambulance</h1>
                    <div class="container">
                        <div class="row mt-5">
                            <div class="col-sm-2 mt-2 text-lg-center">Problem/Issue:</div>
                            <div class="col-sm-9"><input type="text" id="illness" class="form-control"></div>
                        </div>
                        <!-- <div class="row mt-3">
                        <div class="col-sm-2 mt-2 text-lg-center">Location:</div>
                        <div class="col-sm-9"><input type="text" class="form-control"></div>
                    </div> -->
                        <div class="row mt-3 px-4">
                            <div class="col-sm-3 mt-2 ">

                                <div class="card shadow">
                                    <div class="card-body">
                                        General Purpose Ambulance
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-3 mt-2 ">

                                <div class="card shadow">
                                    <div class="card-body">
                                        Covid Purpose Ambulance
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-3 mt-2 ">

                                <div class="card shadow">
                                    <div class="card-body">
                                        Blood Donation Ambulance
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-3 mt-2 ">

                                <div class="card shadow">
                                    <div class="card-body">
                                        Veterinary Purpose Ambulance
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="d-flex justify-content-center mt-5">
                            <button class="btn btn-info btn-lg" onclick="book_ambulance()">BOOK NOW</button>
                        </div>

                    </div>
                <?php
                }
                ?>
            </div>





        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script>
        function book_ambulance() {

            var illness = document.getElementById("illness");

            var lat = 0,
                long = 0;

            navigator.geolocation.getCurrentPosition((pos) => {

                lat = pos.coords.latitude;
                long = pos.coords.longitude;

                console.log(lat + " " + long);

                var details = new FormData();
                details.append("illness", illness.value);
                details.append("latitude", lat);
                details.append("longitude", long);

                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(xhr.responseText);
                        // Put the Map card
                        setTimeout(() => {location.reload();}, 250);
                    }
                };

                xhr.open('post', 'controller.php?action=book');
                xhr.send(details);
            });
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss').on('click', function() {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>


</body>

</html>