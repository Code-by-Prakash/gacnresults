<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                              <?php $query=mysqli_query($con,"select staffName,staffImage from tblstaffs where StaffUserid='".$_SESSION['DUser']."'");
 while($row=mysqli_fetch_array($query)) 
 {
 ?> 
                  <p class="centered"><a href="profile-dept.php">
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
                      <a href="profile-dept.php">
                          <i class="fa fa-user"></i>
                          <span>Profile</span>
                      </a>
                  </li>
                   <li>
                      <a href="result-depts.php">
                          <i class="fa fa-pencil-square-o"></i>
                          <span>Results</span>
                      </a>
                  </li>
                
                 
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      
      <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>
         <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>