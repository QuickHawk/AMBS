<?php
    session_start();

    if(!isset($_SESSION['email']))
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
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <style>
        /*
    DEMO STYLE
*/

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
                padding: 20px;
                background: orangered;
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
                color: orangered;
                background: #fff;
            }

            #sidebar ul li.active>a,
            a[aria-expanded="true"] {
                color: #fff;
                background: orangered;
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
                background: orangered;
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
                color: orangered;
            }



            #sidebar .sidebar-header {
                padding: 20px;
                background: orangered;
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
                color: orangered;
                background: #fff;
            }

            #sidebar ul li.active>a,
            a[aria-expanded="true"] {
                color: #fff;
                background: orangered;
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

<body onload="getDrivers()">
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="bg-dark">
            <div id="dismiss" class=" d-block d-lg-none">
                <i class="fas fa-arrow-left"></i>
            </div>
            <div class="sidebar-header">
                <h3>Raksha Admin</h3>
            </div>

            <ul class="list-unstyled components">

                <li class="active">
                    <a href="#">Driver</a>
                </li>
                <li>
                    <a href="#">Ambulance</a>
                </li>
                <li>
                    <a href="#">Transport</a>
                </li>
                <li>
                    <a href="#">Bookings</a>
                </li>
            </ul>

        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-dark  sticky-top">
                <div class="container-fluid">


                    <button type="button" id="sidebarCollapse" class="btn btn-info  d-block d-lg-none ">
                        <i class="fas fa-align-left"></i>

                    </button>

                    <ul class="navbar-nav ml-auto p-2 main-nav">
                        <li class="nav-item pl-4">
                            <a class="nav-link active text-white" href="index.html">HOME</a>
                        </li>
                        <li class="nav-item pl-4">
                            <a class="btn btn-primary" type="button" href="index.html">LOGOUT</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="p-5">
                <form>
                    <div class="row">
                        <div class="col-sm">
                            Name of Driver: <input type="text" name="dname" id="dname" class="form-control"><br>
                            Driver Email is: <input type="text" name="deid" id="demail" class="form-control"><br>
                            Driver Ph No: <input type="text" name="dphno" id="dphno" class="form-control"><br>
                            Driver img: <input type="file" name="driver_img" id="dimg"><br><br>
                        </div>
                        <div class="col-sm">
                            Ambulance No: <input type="text" name="amno" id="ambno" class="form-control"><br>
                            <select name="typeofamb" id="type" class="form-control">
                                <option value="general">General Purpose</option>
                                <option value="covid">Covid Ambulance</option>
                                <option value="blood">Blood Donation Ambulance</option>
                                <option value="vet">Veterinary Ambulance</option>
                            </select><br>
                            Ambulance Name: <input type="text" name="aname" id="ambname" class="form-control"><br>
                            Bill: <input type="number" name="abill" id="ambbill" class="form-control"><br>
                            Ambulance img: <input type="file" name="amb_img" id="aimg"><br><br>
                        </div>
                    </div>
                    <input type="button" value="Add Driver" onclick="addDriver()" class="btn btn-dark btn-lg">
                </form>
            </div>

            <div class="container" id="drivers_details"></div>


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

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form class="mt-3">
                        Driver Name:
                        <input type="text" class="form-control" id="update-dname" placeholder="Driver Name" required><br>
                        Driver Phone No:
                        <input type="number" class="form-control" name="" id="update-phno" placeholder="Driver Ph No" required><br>
                        Driver Email:
                        <input type="text" class="form-control" id="update-email" placeholder="Driver Email" required><br>
                        Ambulance Name:
                        <input type="text" class="form-control" id="update-ambname" placeholder="Ambulance Name" required><br>
                        Ambulance No:
                        <input type="text" class="form-control" id="update-ambno" placeholder="Ambulance No" required><br>
                        Type:
                        <select class="form-control" id="update-type" required>
                            <option value="general">General Purpose</option>
                            <option value="covid">Covid Ambulance</option>
                            <option value="blood">Blood Donation Ambulance</option>
                            <option value="vet">Veterinary Ambulance</option>
                        </select><br>
                        <input type="hidden" id="driver_id"><br>
                        <div class="text-center mt-2">
                            <button class="btn btn-success" id="updateBtn" data-dismiss="modal" onclick="updateDriver()">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>