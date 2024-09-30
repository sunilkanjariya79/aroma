<?php global $profile;
global $profile_post;
global $profile_books;
global $user;?>
<div class="profile-panel">
  <div class="profile-card">
    <img src="assets/images/profile/<?=$profile['uprofile_photo']?>" loading="lazy" alt="" class="profile-picture" />
    <div class="profile-information">
      <div class="profile-info-1">
        <div class="profile-identity">
          <div class="text-block">u/<?=$profile['username']?></div>
          <div class="text-block-2"><?=$profile['uname']?></div>
        </div>
        <a href="#" class="profile-action w-inline-block">
          <img src="assets/images/site-meta/zondicons_dots-horizontal-triple.svg" loading="lazy" alt="" class="image-3"/></a>
      </div>
      <div class="profile-states">
        <div class="profile-status-text"><?=count($profile_post)?> Posts</div>
          <a href="#" class="profile-status-text"><?=count($profile['following'])?> Following</a>
          <a href="#" class="profile-status-text"><?=count($profile['followers'])?> Followers</a>
        </div>
      <p class="profile-about">
        it’s all about me that this is me, this is walter white, and i am not
        batman, nothing is nothing, but something is something, and i don’t know
        if i am nothing, or something,
      </p>
      <?php
      if($user['uid']!=$profile['uid']){
?>
   <?php 
   if(checkFollowStatus($profile['uid'])){
   ?>
   <a href="#" class="secondary-button lr-btn w-button">Unfollow</a>
   
   <?php
}else{
    ?>
   <a href="#" class="primery-button lr-btn w-button">Follow</a>

    <?php
}
}
?>
    </div>
  </div>
  <div class="profile-content">
    <?php include("assets/pages/tabs.php");?>
  </div>
</div>
</body>
</html>