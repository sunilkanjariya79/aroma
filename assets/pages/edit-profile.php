<?php

include_once('assets/pages/header.php');
global $user;
?>
    <div class="main-content">
    <div class="log-reg-form-container" style="width:80%;left:auto;right:auto;">
      <div class="log-reg-form">
        <div>
          <h2 class="secondary-heading"> Edit Account Details</h2>
          <?php
            if(isset($_GET['success'])){
                echo "<p class='text-success'>Profile is updated !</p>";
            }
          ?>
        </div>
        <div class="form-block w-form">
          <form method="post" class="register-form" action="assets/php/action.php?updateprofile" enctype="multipart/form-data">
            <input type="file" name="uprofile_pic" id="uprofile_pic">
            <label for="uprofile_pic">
              <img src="assets/images/profile/<?php echo $user['uprofile_photo']?>" alt="" class="image-2" /></label>
            <div class="lr-field-box" style="">
            <input class="log-reg-field lg-field w-input" maxlength="256" name="uname" value=<?php echo $user['uname']?> placeholder="Enter your Name" type="text" required=""/>
            <?=showError('uname')?>
            <input class="log-reg-field lg-field w-input" maxlength="256" name="username" placeholder="Enter your Username" value=<?php echo $user['username']?> type="text"  required="" />
            <?=showError('username')?>
            </div>
            <textarea placeholder="Enter your about" maxlength="220" name="uabout" class="log-reg-field reg-edit-about w-input"><?php echo $user['uabout']?></textarea>
            <?=showError('uabout')?>
            <input class="log-reg-field w-input" maxlength="256" name="umail" value=<?php echo $user['umail']?> placeholder="Enter your Email" type="text" required="">
            <div class="lr-field-box lr-fb-2">
            <a href="?change-password" class="side-bar-heading lr-link">Change Password</a>
              <input type="submit" class="primery-button lr-btn w-button" value="Edit"/>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  <?php include_once('assets/pages/header.php');
?>
