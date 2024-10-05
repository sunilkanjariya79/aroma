<div class="left-panel hide pop-up-side-bar" id="notification_sidebar">
  <div class="left-panel-header">
    <h5 class="heading-2" id="left-panel-title">Notifications</h5>
    <a class="close-side-bar"><img src="assets/images/site-meta/charm_cross.svg" width="32" height="32" alt=""></a>
  </div>
  <div class="left-panel-body">
    <?php
    $notifications = getNotifications();
    foreach ($notifications as $not) {
      $fuser = getUser($not['from_user_id']);
      $post = '?u='.$fuser['username'];
      if ($not['pid'] != 0) {
        $post="?post=".$not['pid'];
      }
      if ($not['bid'] != 0) {
        $post="?post=".$not['bid'];
      }
      $fbtn = '';
      ?>
        <a href="<?=$post?>" class="not-card">
        <div class="nc-details">
          <img src="assets/images/profile/<?= $fuser['uprofile_photo'] ?>" alt="" height="40" width="40" class="pcm-img">
          <div>&nbsp;&nbsp;</div>
          <div class="nc-info">
              <h6 style="margin: 0px;font-size: small;"><?= $fuser['uname'] ?></h6>
            <p style="margin:0px;font-size:small" class="<?= $not['read_status'] ? 'muted' : '' ?>">
              u/<?= $fuser['username'] ?>   <?= $not['message'] ?></p>
            <span class="pcm-text"><?= timeAgo($not['created_at']) ?></span>
          </div>
        </div>
        <div class="d-flex align-items-center">
          <?php
          if ($not['read_status'] == 0) {
            ?>
            <div class="p-1 bg-primary rounded-circle"></div>

            <?php

          } else if ($not['read_status'] == 2) {
            ?>
              <span class="badge bg-danger">Post Deleted</span>
            <?php
          }
          ?>

        </div>
        </a>
      <?php
    }
    ?>

  </div>
</div>

<div class="left-panel hide pop-up-side-bar" id="messages_sidebar">
  <div class="left-panel-header">
    <h5 class="heading-2" id="left-panel-title">Messages</h5>
    <a class="close-side-bar"><img src="assets/images/site-meta/charm_cross.svg" width="32" height="32" alt=""></a>
  </div>
  <div class="left-panel-body chatlist">
  </div>
</div>


<div class="pop-up-window hide" id="chatbox" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="pop-up chatbox">
    <div class="pop-up-heading" style="padding:15px 20px">
      <div class="profile-card-min" style="padding:0px;">
        <a href="" id="cplink" class="link-block w-inline-block">
          <img src="assets/images/profile/default_profile.jpg" id="chatter_pic" loading="lazy" alt="" class="pcm-img" />
          <div class="pcm-details">
            <p class="pcm-text pcm-username" id="chatter_username">Loading?></p>
            <p class="pcm-text" id="chatter_name">Loading</p>
          </div>
        </a>
        <a class="close"><img src="assets/images/site-meta/xmark-circle.svg" alt=""></a>
      </div>

    </div>
    <div class="pop-up-content" style="flex-direction:column-reverse;gap:0.5em; height:80%" id="user_chat">
      loading..
    </div>
    <div class="pop-up-footer">
      <span class="" id="blerror" style="display:none"> you are not allowed to send msg to this user anymore</span>
    </div>
    <div class="search-bar message-bar" id="msgsender">
      <input type="text" class="log-reg-field search-area" style="width:100%" id="msginput"
        placeholder="say something.." aria-label="Recipient's username" aria-describedby="button-addon2">
      <button class="primery-button search-button" id="sendmsg" data-user-id="0" type="button">Send</button>
    </div>
  </div>
</div>
</div>


<div class="pop-up-window hide" id="create-post">
  <div class="pop-up">
    <div class="pop-up-heading">
      <h2 class="heading-2">create Post</h2>
      <a class="close"><img src="assets/images/site-meta/charm_cross.svg" width="32" height="32" alt=""></a>
    </div>
    <div class="pop-up-content">
      <a href="?create-post">create Text Post</a>
      <a href="?create-book">Create book Post</a>
    </div>
  </div>
</div>







<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
<script src="assets/js/myjs.js" type="text/javascript"></script>
<script src="../js/myjs.js" type="text/javascript"></script>
</body>

</html>