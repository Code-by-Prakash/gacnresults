<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Gacn_Results</title>
    <link href="css/bootstrap.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        img {
            display: block;
            margin: 0 auto;
            max-width: 90%;
            padding: 0;
        }


        .branding {
            font-weight: bold;
            line-height: 25px;
            letter-spacing: 1px;
            color: white;
            margin-top: 0;
            max-width: 30%;
            margin-left: auto;
            margin-right: auto;
            background-color: #04AA6D;
            text-align: center;
            font-size: 12px;
            border-bottom-right-radius: 4% 100%;
            border-bottom-left-radius: 4% 100%;
        }

        @media (min-width: 768px) {
            .branding {
                line-height: 25px;
                letter-spacing: 1px;
                max-width: 50%;
                font-size: 12px;
            }
        }

        @media (min-width: 992px) {
            .branding {
                line-height: 25px;
                letter-spacing: 1px;
                max-width: 38%;
                font-size: 12px;
            }
        }

        @media (max-width: 768px) {
            .branding {
                line-height: 15px;
                letter-spacing: 1px;
                max-width: 60%;
                font-size: 8px;
            }
        }

        @media (max-width: 420px) {
            .branding {
                line-height: 10px;
                letter-spacing: 1px;
                max-width: 60%;
                font-size: 6px;
            }
        }

        @media (max-width: 336px) {
            .branding {
                line-height: 8px;
                letter-spacing: 1px;
                max-width: 50%;
                font-size: 4px;
            }
        }

        .box {
            color: rgb(58, 58, 58);
            border: 2px solid #ccc;
            text-align: center;
            background-color: #f5f5f5;
            min-height: 200px;
            margin: 20px;
        }

        main {
            padding-top: 50px;
            padding-bottom: 50px;
            background: url("img/gac11.jpeg") no-repeat center center;
            background-position-y: 28%;
            background-size: cover;
            background-color: #3b4465;

        }

        .box h4 {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-style: italic;
            line-height: 30px;
            margin-top: 0;
            color: white;
            background-color: #04AA6D;
        }

        .box a {
            color: rgb(58, 58, 58);
            ;
        }

        footer {

            color: #9d9d9d;
            background-color: rgb(15, 11, 11);
            text-align: center;
        }

        footer a {
            color: #9d9d9d;
        }

        footer a:hover {
            color: #9d9d9d;
            text-decoration: none;
        }

        footer p {
            text-decoration: none;
            padding-top: 10px;
            padding-bottom: 10px;
            margin-top: auto;
            margin-bottom: auto;
        }

        @media (max-width: 768px) {
            footer {
                font-size: 7px;
            }
        }
    </style>

</head>

<body>



    <div class="branding">
        <p>கற்றது கைம்மண்ணளவு, கல்லாதது உலகளவு !</p>
    </div>
    <a href="http://gacnandanam.com/" target="_blank">
        <img src="img/banner_gacn.png" alt="Government Arts College for Men(Autonomous), Nandanam, Chennai">
    </a>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse nav" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Examination Results</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                    <li>
                        <a href="http://localhost/Gacn_Results/users/"> <i class="fas fa-users"></i> Student / Department</a>
                    </li>

                    <li>
                        <a href="http://localhost/Gacn_Results/admin/"><i class="fas fa-university"></i> College Login</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <main>
        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="box">
                        <h4>What's new ?</h4>
                        <p><b>
                                <marquee scrollamount="4">
                                <?php
require_once('users/includes/connection.php');
$sql = "SELECT noticeDetails from tblnotice where id=5";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
        $notify= $row['noticeDetails'];
         echo $notify;
}
?>   </marquee>
<marquee scrollamount="4">
                                <?php

$sql = "SELECT noticeDetails from tblnotice where id=4";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
        $notify= $row['noticeDetails'];
        echo $notify;
}
?>   </marquee>
<marquee scrollamount="4">
                                <?php

$sql = "SELECT noticeDetails from tblnotice where id=3";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
        $notify= $row['noticeDetails'];
        echo $notify;
}
?>   </marquee>
<marquee scrollamount="4">
                                <?php

$sql = "SELECT noticeDetails from tblnotice where id=2";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
        $notify= $row['noticeDetails'];
        echo $notify;
}
?>   </marquee>
<marquee scrollamount="4">
                                <?php

$sql = "SELECT noticeDetails from tblnotice where id=1";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
        $notify= $row['noticeDetails'];
        echo $notify;
}
?>   </marquee>
                            </b></p>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="box">
                        <h4>Essential Links</h4>
                       
                        <p><b>
                                <marquee scrollamount="3"><a href="http://gacnandanam.com/" target="_blank">College Main Website</a>
                                </marquee>
                            </b></p>
                        <p><b>
                                <marquee scrollamount="3"><a href="http://nandhanam.ibossems.com/" target="_blank">Student Portal</a>
                                </marquee>
                            </b></p>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-sm-12">
                <p>Copyright &copy; 2023 <a href="http://www.gacnandanam.com/"> Government Arts College for
                        Men,Nandanam,Chennai</a></p>
            </div>
        </div>
        <!-- /.row -->
    </footer>

    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>