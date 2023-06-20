<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student / Department Login</title>
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
  padding-top:  40px;
}


.forms {
  display: flex;
  align-items: flex-start;
  margin-top: 0px;
}

.form-wrapper {
  animation: hideLayer .3s ease-out forwards;
}

.form-wrapper.is-active {
  animation: showLayer .3s ease-in forwards;
}

@keyframes showLayer {
  50% {
    z-index: 1;
  }
  100% {
    z-index: 1;
  }
}

@keyframes hideLayer {
  0% {
    z-index: 1;
  }
  49.999% {
    z-index: 1;
  }
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
  color: #999;
  background-color: transparent;
  border: none;
  outline: none;
  transform: translateX(0);
  transition: all .3s ease-out;
}

.form-wrapper.is-active .switcher-Department {
  color: #fff;
  transform: translateX(90px);
}

.form-wrapper.is-active .switcher-Student {
  color: #fff;
  transform: translateX(-90px);
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
  transition: transform .2s ease-out;
}

.switcher-Department .underline::before {
  transform: translateX(101%);
}

.switcher-Student .underline::before {
  transform: translateX(-101%);
}

.form-wrapper.is-active .underline::before {
  transform: translateX(0);
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
  animation: hidedept .3s ease-out forwards;
}

.form-wrapper.is-active .form-dept {
  animation: showdept .3s ease-in forwards;
}

@keyframes showdept {
  0% {
    background: #d7e7f1;
    transform: translate(40%, 0px);
  }
  50% {
    transform: translate(0, 0);
  }
  100% {
    background-color: #fff;
    transform: translate(35%, -20px);
  }
}

@keyframes hidedept {
  0% {
    background-color: #fff;
    transform: translate(35%, -20px);
  }
  50% {
    transform: translate(0, 0);
  }
  100% {
    background: #d7e7f1;
    transform: translate(40%, 0px);
  }
}

.form-stu {
  animation: hidestu .3s ease-out forwards;
}

.form-wrapper.is-active .form-stu {
  animation: showstu .3s ease-in forwards;
}

@keyframes showstu {
  0% {
    background: #d7e7f1;
    transform: translate(-40%, 10px) scaleY(.8);
  }
  50% {
    transform: translate(0, 0) scaleY(.8);
  }
  100% {
    background-color: #fff;
    transform: translate(-35%, -20px) scaleY(1);
  }
}

@keyframes hidestu {
  0% {
    background-color: #fff;
    transform: translate(-35%, -20px) scaleY(1);
  }
  50% {
    transform: translate(0, 0) scaleY(.8);
  }
  100% {
    background: #d7e7f1;
    transform: translate(-40%, 10px) scaleY(.8);
  }
}

.form fieldset {
  position: relative;
  opacity: 0;
  margin: 0;
  padding: 0;
  border: 0;
  transition: all .3s ease-out;
}

.form-dept fieldset {
  transform: translateX(-50%);
}

.form-stu fieldset {
  transform: translateX(50%);
}

.form-wrapper.is-active fieldset {
  opacity: 1;
  transform: translateX(0);
  transition: opacity .4s ease-in, transform .35s ease-in;
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
  opacity: 0;
  display: block;
  min-width: 80px;
  margin: 15px auto;
  font-size: 18px;
  line-height: 30px;
  border-radius: 25px;
  border: none;
  transition: all .3s ease-out;
}

.form-wrapper.is-active .form [type='submit'] {
  opacity: 1;
  transform: translateX(0);
  transition: all .4s ease-in;
}

.btn-dept {
  color: #fbfdff;
  background-color: #04AA6D;
  transform: translateX(-30%);
}

.btn-stu {
  
  color: #fbfdff;
  background-color: #04AA6D;
  transform: translateX(30%);
  
}
.dept-container
{
    display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background: #3b4465;
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
                <a class="navbar-brand" href="index.php">Student / Department Login</a>
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
            Department
              <span class="underline"></span>
            </button>
            <form class="form form-dept" action="dprocess.php" method="post">
              <fieldset>
                <div class="input-block">
                <label for="ddepts">Department</label><br>
        <select name="ddepts" id="ddepts" required="required" class="form-control">
        <option value="">--Select Department--</option>
        <option value="Tamil">Tamil</option>
        <option value="English">English</option>
        <option value="Computer Science">Computer Science</option>
        <option value="Commerce">Commerce</option>
        <option value="Zoology">Zoology</option>
        <option value="Botony">Botony</option>
        <option value="Physics">Physics</option>
        <option value="Chemistry">Chemistry</option>
        <option value="Mathematics">Mathematics</option>
        <option value="Statistics">Statistics</option>
        <option value="Historical Studies">Historical Studies</option>
        <option value="Commerce (Corporate Secretaryship)">Corporate Secretaryship</option>
        <option value="Economics">Economics</option>
        <option value="B.B.A. Business Administration">B.B.A</option>
        <option value="Public Administration">Public Administration</option>
        </select>
    </div>
                <div class="input-block">
                  <label for="duserid">User-id</label>
                  <input name="duserid" id="duserid" required>
                </div>
                <div class="input-block">
                  <label for="dpassword">Password</label>
                  <input name="dpassword" id="dpassword" type="password" required>
                </div>
              </fieldset>
              <button type="submit" name="submit" class="btn-dept">Login</button>
            </form>
          </div>
         
          <div class="form-wrapper">
            <button type="button" class="switcher switcher-Student">
             STUDENT
              <span class="underline"></span>
            </button>
           
            <form class="form form-stu"  method="POST" action="sprocess.php">
              <fieldset>
              <div class="input-block">
                <label for="depts">Department</label><br>
        <select name="depts" id="depts" required="required" class="form-control">
        <option value="">--Select Department--</option>
        <option value="Tamil">Tamil</option>
        <option value="English">English</option>
        <option value="Computer Science">Computer Science</option>
        <option value="Commerce">Commerce</option>
        <option value="Zoology">Zoology</option>
        <option value="Botony">Botony</option>
        <option value="Physics">Physics</option>
        <option value="Chemistry">Chemistry</option>
        <option value="Mathematics">Mathematics</option>
        <option value="Statistics">Statistics</option>
        <option value="Historical Studies">Historical Studies</option>
        <option value="Commerce (Corporate Secretaryship)">Corporate Secretaryship</option>
        <option value="Economics">Economics</option>
        <option value="B.B.A. Business Administration">B.B.A</option>
        <option value="Public Administration">Public Administration</option>
        </select>
    </div>
                <div class="input-block">
                  <label for="suserid" >User-id</label>
                  <input id="suserid" name="suserid" required>
                </div>
                <div class="input-block">
                  <label for="spassword" >Password</label>
                  <input id="spassword" type="password" name="spassword" required>
                </div>
              </fieldset>
              <button type="submit" name="submit" class="btn-stu">Login</button>
            </form>
          </div>
          </div>
<br>
<br>
<br>
      </section>
      <?php
      if (isset($_SESSION["error"])) {
        $error = $_SESSION["error"];
        echo '<script>alert("Invalid User-id or Password")</script>';
      }
      ?>
      
      <script>
      const switchers = [...document.querySelectorAll('.switcher')]

switchers.forEach(item => {
  item.addEventListener('click', function() {
    switchers.forEach(item => item.parentElement.classList.remove('is-active'))
    this.parentElement.classList.add('is-active')
  })
})
</script>
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
