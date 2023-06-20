<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                              <?php $query=mysqli_query($con,"select Name,userImage from tblstudents where Userid='".$_SESSION['SUser']."'");
 while($row=mysqli_fetch_array($query)) 
 {
 ?> 
                  <p class="centered"><a href="profile.php">
<?php $userphoto=$row['userImage'];
if($userphoto==""):
?>
<img src="userimages/noimage.png"  class="img-circle" width="70" height="70" >
<?php else:?>
  <img src="userimages/<?php echo htmlentities($userphoto);?>" class="img-circle" width="70" height="70">

<?php endif;?>
</a>
</p>
 
                  <h5 class="centered"><?php echo htmlentities($row['Name']);?></h5>
                  <?php } ?>
                    
                  <li class="mt">
                      <a href="profile.php">
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
                          <li><a  href="result-examwise.php">Exam-wise</a></li>
                          <li><a  href="result-semester.php">Semester-wise</a></li>
                          <li><a  href="result-subject.php">Subject-wise</a></li>
                        
                      </ul>
                  </li>
                
                 
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>