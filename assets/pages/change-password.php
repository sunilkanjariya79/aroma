<?php
include_once('assets/pages/header.php');
global $user;
?>
    <div class="main-content">
    <div class="log-reg-form-container" style="width:80%;left:auto;right:auto">
      <div class="log-reg-form">
        <div>
          <h2 class="secondary-heading"> Edit Password</h2>
          <?php
            if(isset($_GET['success'])){
                echo "<p class='text-success'>Profile is updated !</p>";
            }
          ?>
        </div>
        <div class="form-block w-form">
          <form method="post" class="register-form" action="assets/php/action.php?updatepassword">
            <input class="log-reg-field w-input" maxlength="256" name="oldpass"  placeholder="Enter your Password" type="text"/>
            <?=showError('oldpass')?>
            <input class="log-reg-field w-input" maxlength="256" name="newpass" placeholder="Enter new Password"  type="text"/>
            <?=showError('newpass')?>
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
