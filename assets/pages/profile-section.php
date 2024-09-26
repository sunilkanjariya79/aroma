<?php global $profile;?>
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
        <div class="profile-status-text">12 Posts</div>
        <a href="#" class="profile-status-text">189 Following</a>
        <a href="#" class="profile-status-text">890 Followers</a>
      </div>
      <p class="profile-about">
        it’s all about me that this is me, this is walter white, and i am not
        batman, nothing is nothing, but something is something, and i don’t know
        if i am nothing, or something,
      </p>
      <a href="#" class="primery-button lr-btn w-button">Follow</a>
    </div>
  </div>
  <div class="profile-content">
    <?php include("assets/pages/tabs.php");?>
  </div>
</div>
</body>
</html>