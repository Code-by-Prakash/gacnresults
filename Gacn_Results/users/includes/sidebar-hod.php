<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                              <?php $query=mysqli_query($con,"select staffName,staffImage from tblstaffs where StaffUserid='".$_SESSION['DUser']."'");
 while($row=mysqli_fetch_array($query)) 
 {
 ?> 
                  <p class="centered"><a href="profile-hod.php">
<?php $userphoto=$row['staffImage'];
if($userphoto==""):
?>
<img src="userimages/noimage.png"  class="img-circle" width="70" height="70" >
<?php else:?>
  <img src="userimages/<?php echo htmlentities($userphoto);?>" class="img-circle" width="70" height="70">

<?php endif;?>
</a>
</p>
 
                  <h5 class="centered"><?php echo htmlentities($row['staffName']);?></h5>
                  <?php } ?>
                    
                  <li class="mt">
                      <a href="profile-hod.php">
                          <i class="fa fa-user"></i>
                          <span>Profile</span>
                      </a>
                  </li>


                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-pencil-square-o"></i>
                          <span>Result</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="student-result-hod.php">By Reg No</a></li>
                          <li><a  href="class-result-hod.php">Class-wise</a></li>
                          <li><a  href="subject-result-hod.php">Subject-wise</a></li>
                        
                      </ul>
                  </li>
                
                 
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      
      <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>
         <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>