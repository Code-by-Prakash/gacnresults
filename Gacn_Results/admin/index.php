<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <style>
    img
    {
    display: block;
    margin: 0 auto;
    max-width: 90%;
    padding: 0;
    }    
    .branding
    {
    font-weight: bold;
    line-height: 25px;
    letter-spacing: 1px;
    color: white;
    margin-top: 0;
    max-width: 30%;
    margin-left: auto;
    margin-right: auto;
    background-color:#04AA6D;
    text-align: center;
    font-size: 12px;
    border-bottom-right-radius: 4% 100%;
    border-bottom-left-radius: 4% 100%;
    }
    @media (min-width: 768px) {
    .branding
    {      
    line-height: 25px;
    letter-spacing: 1px;
    max-width: 50%;
    font-size: 12px;
    }
    }
    @media (min-width: 992px) {
    .branding
    {
    line-height: 25px;
    letter-spacing: 1px;
    max-width: 38%;
    font-size: 12px;
    }
    }
    @media (max-width: 768px) {
    .branding
    {       
    line-height: 15px;
    letter-spacing: 1px;   
    max-width: 60%;    
    font-size: 8px;    
    }
    }
    @media (max-width: 420px) {
    .branding
    {        
    line-height: 10px;
    letter-spacing: 1px;
    max-width: 60%;
    font-size: 6px;   
    }
    }
    @media (max-width: 336px) {
    .branding
    {        
    line-height: 8px;
    letter-spacing: 1px;
    max-width: 50%;
    font-size: 4px;
    }
    }
    footer
{

    color: #9d9d9d;
    background-color: rgb(15, 11, 11);
   text-align: center;
}
footer a{
    color: #9d9d9d;
}
footer a:hover
{
    color: #9d9d9d;
    text-decoration: none;
}
footer p
{
   text-decoration: none;  padding-top: 10px;
    padding-bottom: 10px;
    margin-top: auto;
    margin-bottom: auto;
}
@media (max-width: 768px) {
  footer
{
font-size:  7px;
}
}
.sdlogin p
{
    width: 100%;
    font-weight: bold;
    color: white;
    background-color: #222;
    text-align: center;
    margin-bottom: 0;
    letter-spacing: 1px;
    padding-bottom: 3px;
    border-bottom: 1px solid black;
    border-top: 1px solid black;
}
*,
*::before,
*::after {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: Roboto, -apple-system, 'Helvetica Neue', 'Segoe UI', Arial, sans-serif;
  
}


.forms-section {
  
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background: #3b4465;
  background:url("img/gac11.jpeg") no-repeat center center;
  background-position-y:45%;
  background-size: cover;
  padding-top:  30px;
}


.forms {
  display: flex;
  align-items: flex-start;
  margin-top: 0px;
}


.switcher {
  position: relative;
  cursor: pointer;
  display: block;
  margin-right: auto;
  margin-left: auto;
  padding: 0;
  text-transform: uppercase;
  font-family: inherit;
  font-size: 16px;
  letter-spacing: .5px;
  font-weight: bold;

  background-color: transparent;
  border: none;
  outline: none;

  color: #fff;
}

.underline {
  position: absolute;
  bottom: -5px;
  left: 0;
  overflow: hidden;
  pointer-events: none;
  width: 100%;
  height: 2px;
}

.underline::before {
  content: '';
  position: absolute;
  top: 0;
  left: inherit;
  display: block;
  width: inherit;
  height: inherit;
  background-color: currentColor;

}

.form {
  overflow: hidden;
  min-width: 260px;
  margin-top: 30px;
  padding: 30px 25px;
  border-radius: 5px;
  transform-origin: top;
}

.form-dept {
 
  background-color: #fff;
}


.form fieldset {
  position: relative;
 
  margin: 0;
  padding: 0;
  border: 0;
}




.input-block {
  margin-bottom: 2px;
}

.input-block label {
  font-size: 14px;
  color: #a1b4b4;
}
option, select
{
  font-family: Roboto, -apple-system, 'Helvetica Neue', 'Segoe UI', Arial, sans-serif;
  display: block;
  width: 100%;
  margin-top: 7px;
  padding-right: 15px;
  padding-left: 15px;
  font-size: 14px;
  height: 25px;
  color: #3b4465;
  background: #eef9fe;
  border: 1px solid #cddbef;
  border-radius: 2px;
}
.input-block input {
  display: block;
  width: 100%;
  margin-top: 7px;
  padding-right: 15px;
  padding-left: 15px;
  font-size: 14px;
  line-height: 25px;
  color: #3b4465;
  background: #eef9fe;
  border: 1px solid #cddbef;
  border-radius: 2px;
}

.form [type='submit'] {

  display: block;
  min-width: 80px;
  margin: 15px auto;
  font-size: 18px;
  line-height: 30px;
  border-radius: 25px;
  border: none;
  transition: all .3s ease-out;
}



.btn-dept {
  color: #fbfdff;
  background-color: #04AA6D;
 
}


.nav ul li
{
  list-style: none;
  color: rgb(255, 255, 255);
  margin-top: 0;
  margin-bottom: 0;
}
    </style>
    
    
</head>
<body>
  <div class="branding">
    <p>கற்றது கைம்மண்ணளவு, கல்லாதது உலகளவு !</p></div>
    <a href="http://gacnandanam.com/" target="_blank">
        <img src="img/banner_gacn.png" alt="Government Arts College for Men(Autonomous), Nandanam, Chennai">
        </a>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse nav" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin Login</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                   
                    <li>
                        <a href="http://localhost/Gacn_Results/"><i class="fa fa-chevron-circle-left" style="font-size: 16px; vertical-align: middle;"></i>  Back to Home</a>
                    </li>
                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
   
    <section class="forms-section">
        <div class="forms">
          <div class="form-wrapper is-active">
            <button type="button" class="switcher switcher-Department">
            Admin
              <span class="underline"></span>
            </button>
            <form class="form form-dept" action="aprocess.php" method="post">
              <fieldset>
                <div class="input-block">
    </div>
                <div class="input-block">
                  <label for="userid">User-id</label>
                  <input name="userid" id="userid" required>
                </div>
                <div class="input-block">
                  <label for="password">Password</label>
                  <input name="password" id="password" type="password" required>
                </div>
              </fieldset>
              <button type="submit" name="submit" class="btn-dept">Login</button>
            </form>
            <br>
<br>
<br>
          </div>
         
        

      </section>

   <!-- jQuery -->
   <script src="assets/js/jquery.js"></script>

   <!-- Bootstrap Core JavaScript -->
   <script src="assets/js/bootstrap.min.js"></script>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-sm-12">
                    <p>Copyright &copy; 2023 <a href="http://www.gacnandanam.com/"> Government Arts College for Men,Nandanam,Chennai</a></p>
                </div>
            </div>
            <!-- /.row -->
        </footer>
</body>
</html>
