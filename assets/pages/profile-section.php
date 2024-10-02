<?php global $profile;
global $profile_post;
global $profile_books;
$following = getFollowing($profile['uid']);
$follower = getFollowers($profile['uid']);
global $user; ?>
<div class="profile-panel">
  <div class="profile-card">
    <img src="assets/images/profile/<?= $profile['uprofile_photo'] ?>" loading="lazy" alt="" class="profile-picture" />
    <div class="profile-information">
      <div class="profile-info-1">
        <div class="profile-identity">
          <div class="text-block">u/<?= $profile['username'] ?></div>
          <div class="text-block-2"><?= $profile['uname'] ?></div>
        </div>
        <a href="#" class="profile-action w-inline-block">
          <img src="assets/images/site-meta/zondicons_dots-horizontal-triple.svg" loading="lazy" alt=""
            class="image-3" /></a>
      </div>
      <div class="profile-states">
        <div class="profile-status-text"><?= count($profile_post) ?> Posts</div>
        <a href="#" class="profile-status-text show-follow-input"><?= count($profile['following']) ?> Following</a>
        <div class="pop-up-window hide" id="following">
          <div class="pop-up">
            <div class="pop-up-heading">
              <h2 class="heading-2">Followeing</h2>
              <a class="close"><img src="assets/images/site-meta/charm_cross.svg" width="32" height="32" alt=""></a>
            </div>
            <div class="pop-up-content">

              <div class="profile-list">
                <?php foreach ($following as $usercard) {
                  $userdata = getUser($usercard[1]) ?>
                  <div class="profile-card-min">
                    <a href="?u=<?= $userdata['username'] ?>" class="link-block w-inline-block">
                      <img src="assets/images/profile/<?= $userdata['uprofile_photo'] ?>" loading="lazy" alt=""
                        class="pcm-img" />
                      <div class="pcm-details">
                        <p class="pcm-text pcm-username">u/<?= $userdata['username'] ?></p>
                        <p class="pcm-text"><?= $userdata['uname'] ?></p>
                      </div>
                    </a>
                    <?php
                    if ($_SESSION['userdata']['uid'] != $userdata['uid']) {
                      ?>
                      <?php
                      if (checkFollowStatus($userdata['uid'])) {
                        ?>
                        <a href="#" class="secondary-button lr-btn w-button unfollowbtn"
                          data-user-id="<?= $profile['uid'] ?>">Unfollow</a>

                        <?php
                      } else {
                        ?>
                        <a href="#" class="primery-button lr-btn w-button followbtn"
                          data-user-id="<?= $profile['uid'] ?>">Follow</a>

                        <?php
                      }

                    }
                    ?>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <a href="#" class="profile-status-text show-follower-input"><?= count($profile['followers']) ?> Followers</a>
        <div class="pop-up-window hide" id="followers">
          <div class="pop-up">
            <div class="pop-up-heading">
              <h2 class="heading-2">Followers</h2>
              <a class="close"><img src="assets/images/site-meta/charm_cross.svg" width="32" height="32" alt=""></a>
            </div>
            <div class="pop-up-content">
            </div>
            <div class="profile-list">
              <?php foreach ($follower as $usercard) {
                $userdata = getUser($usercard[2]) ?>
                <div class="profile-card-min">
                  <a href="?u=<?= $userdata['username'] ?>" class="link-block w-inline-block">
                    <img src="assets/images/profile/<?= $userdata['uprofile_photo'] ?>" loading="lazy" alt=""
                      class="pcm-img" />
                    <div class="pcm-details">
                      <p class="pcm-text pcm-username">u/<?= $userdata['username'] ?></p>
                      <p class="pcm-text"><?= $userdata['uname'] ?></p>
                    </div>
                  </a>
                  <?php
                  if ($_SESSION['userdata']['uid'] != $userdata['uid']) {
                    ?>
                    <?php
                    if (checkFollowStatus($userdata['uid'])) {
                      ?>
                      <a href="#" class="secondary-button lr-btn w-button unfollowbtn"
                        data-user-id="<?= $userdata['uid'] ?>">Unfollow</a>

                      <?php
                    } else {
                      ?>
                      <a href="#" class="primery-button lr-btn w-button followbtn"
                        data-user-id="<?= $userdata['uid'] ?>">Follow</a>

                      <?php
                    }

                  }
                  ?>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <p class="profile-about">
        it’s all about me that this is me, this is walter white, and i am not
        batman, nothing is nothing, but something is something, and i don’t know
        if i am nothing, or something,
      </p>
      <?php
      if ($user['uid'] != $profile['uid']) {
        ?>
        <?php
        if (checkFollowStatus($profile['uid'])) {
          ?>
          <a href="#" class="secondary-button lr-btn w-button unfollowbtn"
            data-user-id="<?= $userdata['uid'] ?>">Unfollow</a>

          <?php
        } else {
          ?>
          <a href="#" class="primery-button lr-btn w-button followbtn" data-user-id="<?= $userdata['uid'] ?>">Follow</a>

          <?php
        }

      }
      ?>
    </div>
  </div>
  <div class="profile-content">
    <?php include("assets/pages/tabs.php"); ?>
  </div>
</div>
</body>

</html>