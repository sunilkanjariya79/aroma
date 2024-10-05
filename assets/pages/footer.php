<div class="left-panel hide pop-up-side-bar" id="notification_sidebar" style="background-color:black;">
  <div class="left-panel-header">
    <h5 class="heading-2" id="left-panel-title">Notifications</h5>
    <a class="close-side-bar"><img src="assets/images/site-meta/charm_cross.svg" width="32" height="32" alt=""></a>
  </div>
  <div class="left-panel-body">
    <?php
    $notifications = getNotifications();
    foreach ($notifications as $not) {
      $fuser = getUser($not['from_user_id']);
      $post = '';
      $book = '';
      if ($not['pid'] != 0) {

      }
      if ($not['bid'] != 0) {

      }
      $fbtn = '';
      ?>
      <a <?= $post ?> class="not-card">
        <div class="nc-details">
          <div><img src="assets/images/profile/<?= $fuser['uprofile_photo'] ?>" alt="" height="40" width="40" class="">
          </div>
          <div class="nc-info">
            <a href='?u=<?= $fuser['username'] ?>' class="nc-text">
              <h6 style="margin: 0px;font-size: small;"><?= $fuser['uname'] ?></h6>
            </a>
            <p style="margin:0px;font-size:small" class="<?= $not['read_status'] ? 'muted' : '' ?>">
              @<?= $fuser['username'] ?>   <?= $not['message'] ?></p>
            <p><?= timeAgo($not['created_at']) ?></p>
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

<div class="left-panel hide pop-up-side-bar" id="messages_sidebar" style="background-color:black;">
  <div class="left-panel-header">
    <h5 class="heading-2" id="left-panel-title">Messages</h5>
    <a class="close-side-bar"><img src="assets/images/site-meta/charm_cross.svg" width="32" height="32" alt=""></a>
  </div>
  <div class="left-panel-body chatlist">
  </div>
</div>


<div class="pop-up-window hide" id="chatbox" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="pop-up">
    <div class="pop-up-heading">
      <a href="" id="cplink" class="text-decoration-none text-dark">
        <h5 class="modal-title" id="exampleModalLabel"><img src="assets/images/profile/default_profile.jpg"
            id="chatter_pic" height="40" width="40" class="m-1 rounded-circle border"><span
            id="chatter_name"></span>(u/<span id="chatter_username">loading..</span>)</h5>
      </a>
      <a class="close" data-bs-dismiss="modal" aria-label="Close"></a>
    </div>
    <div class="modal-body d-flex flex-column-reverse gap-2" id="user_chat">
      loading..
    </div>
    <div class="modal-footer">

      <p class="p-2 text-danger mx-auto" id="blerror" style="display:none">
        <i class="bi bi-x-octagon-fill"></i> you are not allowed to send msg to this user anymore

    </div>
    <div class="input-group p-2 " id="msgsender">
      <input type="text" class="form-control rounded-0 border-0" id="msginput" placeholder="say something.."
        aria-label="Recipient's username" aria-describedby="button-addon2">
      <button class="btn btn-outline-primary primery-button rounded-0 border-0" id="sendmsg" data-user-id="0"
        type="button">Send</button>
    </div>
  </div>
</div>
</div>







<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
<script src="assets/js/myjs.js" type="text/javascript"></script>
<script src="../js/myjs.js" type="text/javascript"></script>
</body>

</html>