<?php
include_once('assets/pages/header.php');?>
    <div class="log-reg-side">
      <img src="assets/images/site-meta/bookshelf.png" loading="lazy" width="Auto" height="Auto" alt="" class="log-reg-img" />
    </div>
    <div class="log-reg-form-container">
      <div class="log-reg-form">
        <div>
          <h2 class="secondary-heading"> Create Account</h2>
        </div>
        <div class="form-block w-form">
          <form method="post" class="register-form" action="assets/php/action.php?register">
            <a class="reg-edit-img-in w-inline-block">
              <img src="assets/images/site-meta/typcn_plus.svg" alt="" class="image-2" /></a>
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
            
            <input class="log-reg-field w-input" maxlength="20" name="umail" placeholder="Enter your Email" type="email" required=""/>
            <?=showError('umail')?>
            <input class="log-reg-field w-input" maxlength="256" name="uname" placeholder="Enter your Name" type="text" required=""/>
            <?=showError('uname')?>
            <div class="lr-field-box">
              <input class="log-reg-field lg-field w-input" maxlength="256" name="username" placeholder="Enter your Username" type="text"  required="" />
              <?=showError('username')?>
              <select name="gender" required="" class="log-reg-field lg-field w-select">
                <option value="1" <?=showFormaData('gender')==1?'male':''?>>Male</option>
                <option value="2" <?=showFormaData('gender')==2?'male':''?>>Female</option>
                <option value="3" <?=showFormaData('gender')==3?'male':''?>>Other</option>
              </select>
            </div>
            <textarea placeholder="Enter your about" maxlength="220" name="uabout"  value="<?=showFormaData('uabout')?>" class="log-reg-field reg-edit-about w-input"></textarea>
            <?=showError('uabout')?>
            <input type="date" class="log-reg-field" name="udate" />
            <input class="log-reg-field w-input" maxlength="256" name="upassword" placeholder="Enteer tour password" type="text" required="">
            <?=showError('upassword')?>
            <input class="log-reg-field w-input" maxlength="256" name="cpassword" placeholder="Confirm password" type="text" required="">
            <div class="lr-field-box lr-fb-2">
              <a href="login.php" class="side-bar-heading lr-link">Log in</a>
              <input type="submit" class="primery-button lr-btn w-button" value="Submit"/>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('assets/pages/header.php');
?>
