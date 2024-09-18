<?php

include_once('assets/pages/header.php');
global $user;
?>
    <div class="main-content">
    <div class="log-reg-form-container" style="width:80%;">
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
            <a class="reg-edit-img-in w-inline-block">
              <img src="assets/images/profile/<?php echo $user['uprofile_photo']?>" alt="" class="image-2" /></a>
            <div class="pop-up-window add-img hide" >
              <div class="pop-up">
                <div class="pop-up-heading">
                  <h2 class="heading-2">heading</h2>
                  <a class="close"><img src="assets/images/site-meta/charm_cross.svg" width="32" height="32" alt=""></a>
                </div>
                <div class="pop-up-content">
                  <input type="file" name="uprofile_pic" id="uprofile_photo">
                  <a onClick class="primery-button"> Add</a>
                </div>
              </div>
            </div>
            <div class="lr-field-box" style="flex-direction:column;">
            <input class="log-reg-field lg-field w-input" maxlength="256" name="uname" value=<?php echo $user['uname']?> placeholder="Enter your Name" type="text" required=""/>
            <?=showError('uname')?>
            <input class="log-reg-field lg-field w-input" maxlength="256" name="username" placeholder="Enter your Username" value=<?php echo $user['username']?> type="text"  required="" />
            <?=showError('username')?>
            </div>
            <textarea placeholder="Enter your about" maxlength="220" name="uabout" class="log-reg-field reg-edit-about w-input"><?php echo $user['uabout']?></textarea>
            <?=showError('uabout')?>
            <input class="log-reg-field w-input" maxlength="256" name="umail" value=<?php echo $user['umail']?> placeholder="Enter your Email" type="text" required="">
            <div class="lr-field-box lr-fb-2">
            <a href="?login" class="side-bar-heading lr-link">Change Password</a>
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
