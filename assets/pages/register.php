<?php
include_once('assets/pages/header.php'); ?>
<div class="log-reg-side">
  <img src="assets/images/site-meta/bookshelf.png"   width="Auto" height="Auto" alt=""
    class="log-reg-img" />
</div>
<div class="log-reg-form-container">
  <div class="log-reg-form">
    <div>
      <h2 class="secondary-heading"> Create Account</h2>
    </div>
    <div class="form-block w-form">
      <form method="post" class="register-form" action="assets/php/action.php?register" enctype="multipart/form-data">
        <input type="file" name="uprofile_pic" id="uprofile_pic">
              <label for="uprofile_pic" class="custom-file-upload">
          <img src="assets/images/site-meta/profile-circle.svg" alt="" class="image-2" /></label>
          <?= showError('profile_pic') ?>
         <input class="log-reg-field w-input" value="<?=showFormaData('umail')?>" maxlength="20" name="umail" placeholder="Enter your Email" type="email"
          required="" />
        <?= showError('umail') ?>
        <input class="log-reg-field w-input" value="<?=showFormaData('uname')?>" maxlength="256" name="uname" placeholder="Enter your Name" type="text"
          required="" />
        <?= showError('uname') ?>
        <div class="lr-field-box">
          <input class="log-reg-field lg-field w-input" value="<?=showFormaData('username')?>" maxlength="256" name="username"
            placeholder="Enter your Username" type="text" required="" />
           <select name="gender" class="log-reg-field lg-field w-select" >
            <option value="1" <?= showFormaData('gender') == 1 ? 'male' : '' ?>>Male</option>
            <option value="2" <?= showFormaData('gender') == 2 ? 'male' : '' ?>>Female</option>
            <option value="3" <?= showFormaData('gender') == 3 ? 'male' : '' ?>>Other</option>
          </select>
        </div>
        <?= showError('username') ?>
        <textarea placeholder="Enter your about" maxlength="220" name="uabout"
          class="log-reg-field reg-edit-about w-input" value="<?=showFormaData('uabout')?>" ></textarea>
        <?= showError('uabout') ?>
        <input type="date" class="log-reg-field" name="udate" />
        <input class="log-reg-field w-input" maxlength="256" name="upassword" placeholder="Enter tour password"
          type="password" required="">
        <?= showError('upassword') ?>
        <input class="log-reg-field w-input" maxlength="256" name="cpassword" placeholder="Confirm password" type="password"
          required="">
        <div class="lr-field-box lr-fb-2">
          <a href="?login" class="side-bar-heading lr-link">Log in</a>
          <input type="submit" class="primery-button lr-btn w-button" value="Submit" />
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<?php include_once('assets/pages/header.php');
?>