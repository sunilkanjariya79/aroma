    
    <div class="left-panel hide pop-up-side-bar" id="notification_sidebar" >
    <div class="left-panel-header">
      <h5 class="left-panel-title" id="left-panel-title">Notifications</h5>
      <a class="close-side-bar"><img src="assets/images/site-meta/charm_cross.svg" width="32" height="32" alt=""></a>
    </div>
    <div class="left-panel-body">
      <?php
      $notifications = getNotifications();
      foreach ($notifications as $not) {
        $fuser = getUser($not['from_user_id']);
        $post = '';
        $book = '';
        if ($not['pid']!=0) {
          
        }
        if ($not['bid']!=0) {
          
        }
        $fbtn = '';
        ?>
        <a <?=$post?> class="">
          <div class="">
            <div><img src="assets/images/profile/<?= $fuser['uprofile_photo'] ?>" alt="" height="40" width="40"
                class="">
            </div>
            <div class="" >
              <a href='?u=<?= $fuser['username'] ?>' class="">
                <h6 style="margin: 0px;font-size: small;"><?= $fuser['uname'] ?></h6>
              </a>
              <p style="margin:0px;font-size:small" class="<?= $not['read_status'] ? 'text-muted' : '' ?>">
                @<?= $fuser['username'] ?>     <?= $not['message'] ?></p>
              <p><?=timeAgo($not['created_at'])?></p>
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
    
    
    
    
    
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="assets/js/myjs.js" type="text/javascript"></script>
    <script src="../js/myjs.js" type="text/javascript"></script>
</body>
</html>