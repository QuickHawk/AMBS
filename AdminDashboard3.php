<?php
session_start();

if (!isset($_SESSION['user']))
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

<body onload="getTransports()">
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

                <li>
                    <a href="AdminDashboard.php">Driver</a>
                </li>
                <li>
                    <a href="AdminDashboard2.php">Ambulance</a>
                </li>
                <li class="active">
                    <a href="#">Transport</a>
                </li>
                <li>
                    <a href="AdminDashboard4.php">Bookings</a>
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
                <div class="row">
                    <div class="col-sm border-right">
                        <form id="add_transport_form">

                            Ambulance ID:
                            <input type="text" class="form-control" id="aid" placeholder="Ambulance ID" required><br>
                            Driver ID:
                            <input type="text" class="form-control" id="did" placeholder="Driver ID" required><br>
                            License Plate Number:
                            <input type="text" class="form-control" id="licenseplate" placeholder="License Plate Number" required><br>

                            <div class="text-center mt-2">
                                <button class="btn btn-success" type="button" onclick="addTransport()">Add Driver</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm">
                        <div class="container" id="transport_list">

                        </div>
                    </div>
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

        <script type="text/javascript">
            function makeCardBody(details) {

                card = document.createElement("div");
                card.setAttribute("class", "card shadow-sm mt-5");

                cardbody = document.createElement("div");
                cardbody.setAttribute("class", "card-body");

                div1 = document.createElement("div");
                div1.setAttribute("class", "row");

                div2 = document.createElement("div");
                div2.setAttribute("class", "col-sm-3");

                div3 = document.createElement("div");
                div3.setAttribute("class", "col-sm-4");

                div4 = document.createElement("div");
                div4.setAttribute("class", "col-sm-4");

                div1.appendChild(div2);
                div1.appendChild(div3);
                div1.appendChild(div4);

                cardbody.appendChild(div1);

                div3.innerHTML += "<div><b>Ambulance ID:</b> " + details['AID'] + "</div>";
                div3.innerHTML += "<div><b>Driver ID: </b>" + details['Driver_ID'] + "</div>";
                div4.innerHTML += "<div><b>Number Plate: </b> " + details['NumberPlate'] + "</div>";
                div4.innerHTML += "<div><b>Transport ID: </b> " + details['Transport_ID'] + "</div>";

                div4.appendChild(editBtn(details['Transport_ID']));
                // div4.appendChild(removeBtn(details.did));

                card.appendChild(cardbody);

                return card;
            }

            function getTransports() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status == 200) {
                        var x = document.getElementById("transport_list");
                        x.innerHTML = "";
                        var d = JSON.parse(xhr.responseText);

                        for (i = 0; i < d.length; i++) {
                            x.appendChild(makeCardBody(d[i]));
                        }
                    }
                };

                xhr.open('GET', 'controller.php?action=list_transports');
                xhr.send()
            }

            function addTransport() {
                var aid = document.getElementById("aid");
                var did = document.getElementById("did");
                var license = document.getElementById("licenseplate");

                var data = new FormData();

                data.append("aid", aid);
                data.append("did", did);
                data.append("licenseplate", license);

                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(xhr.responseText);
                        getTransports();
                    }
                };

                xhr.open('GET', 'controller.php?action=addTransport');
                xhr.send(data);
            }

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