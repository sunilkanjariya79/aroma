
  <div id="left-panel" class="left-panel">
    <div class="w-layout-vflex side-bar">
      <div class="w-layout-vflex side-bar-top">
        <img src="assets/images/site-meta/logo.svg" loading="eager" width="24" height="24"   id="logo"/>
        <a href="?post-wall" class="side-bar-heading">Aroma</a>
      </div>
      <div class="w-layout-vflex side-bar-nav">
        <div class="w-layout-hflex flex-block">
          <a href="?post-wall">
          <img src="assets/images/site-meta/home-simple-door.svg"  loading="eager" width="24" height="24"   id="logo"/></a>
          <a href="?post-wall" class="side-bar-heading">Home</a>
        </div>
        <div class="w-layout-hflex flex-block">
          <a class="messages-button">
          <img src="assets/images/site-meta/chat-bubble.svg" loading="eager" width="24" height="24"   id="chat"/>
          <img src="assets/images/site-meta/chat-bubble-solid.svg" class="hide" loading="eager" width="24" height="24"   id="new-chat"/></a>
          <a class="side-bar-heading messages-button">Messages</a>
        </div>
        <div class="w-layout-hflex flex-block">
          <a class="create-post">
          <img src="assets/images/site-meta/plus-circle.svg" loading="eager" width="24" height="24"   id="logo" /></a>
          <a class="side-bar-heading create-post">Create Post</a>
        </div>
        <div class="w-layout-hflex flex-block"><a class="notification-button show-not">
        <?php
if(getUnreadNotificationsCount()>0){
    ?> <img class="show-not" src="assets/images/site-meta/app-notification-solid.svg" loading="eager" width="24" height="24"   id="logo"/><?php }else {?>
          <img class="show-not" src="assets/images/site-meta/app-notification.svg" loading="eager" width="24" height="24"   id="logo"/><?php }?></a>
          <a class="side-bar-heading notification-button show-not">Notification</a>
        </div>
        <div class="w-layout-hflex flex-block">
          <a href="?u=<?=$_SESSION['userdata']['username']?>">
          <img src="assets/images/site-meta/profile-circle.svg" loading="eager" width="24" height="24"   id="logo"/></a>
          <a href="?u=<?=$_SESSION['userdata']['username']?>" class="side-bar-heading">Profile</a>
        </div>
        <?php if($_SESSION['userdata']['is_admin']==1){?>
        <div class="w-layout-hflex flex-block">
          <a href="?adminpanel">
          <img src="assets/images/site-meta/profile-circle-fill.svg" loading="eager" width="24" height="24"   id="logo"/></a>
          <a href="?adminpanel" class="side-bar-heading">Admin Panel</a>
        </div><?php } ?>
      </div>
      <div class="w-layout-vflex side-bar-bottom">
        <div class="w-layout-hflex flex-block">
          <a href="assets/php/action.php?logout">
          <img src="assets/images/site-meta/basil_logout-outline.svg" loading="eager" width="24" height="24"   id="logo"/></a>
          <a href="assets/php/action.php?logout" class="side-bar-heading">Log Out</a>
        </div>
      </div>
    </div>
  </div>