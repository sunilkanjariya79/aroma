<?php global $profile;
global $profile_post;
global $profile_books;
$following = getFollowing($profile['uid']);
$follower = getFollowers($profile['uid']);
global $user;

if (checkBlockStatus($profile['uid'], $user['uid'])) {
  echo "user blocke you";
  exit;
}
?>
<div class="profile-panel">
  <div class="profile-card">
    <img src="assets/images/profile/<?= $profile['uprofile_photo'] ?>" loading="lazy" alt="" class="profile-picture" />
    <div class="profile-information">
      <div class="profile-info-1">
        <div class="profile-identity">
          <div class="text-block">u/<?= $profile['username'] ?></div>
          <div class="text-block-2"><?= $profile['uname'] ?></div>
        </div>
        <a class="profile-action w-inline-block">
          <img src="assets/images/site-meta/zondicons_dots-horizontal-triple.svg" loading="lazy" alt=""
            class="image-3 user-action" /></a>

        <?php
        if ($user['uid'] != $profile['uid']) {
          ?>
          <div class="pop-up-window hide" id="user-action">
            <div class="pop-up">
              <div class="pop-up-heading">
                <h2 class="heading-2">User Actions</h2>
                <a class="close"><img src="assets/images/site-meta/charm_cross.svg" width="32" height="32" alt=""></a>
              </div>
              <div class="pop-up-content">
                <a
                  href="assets/php/action.php?block=<?= $profile['uid'] ?>&username=<?= $profile['username'] ?>">Block</a>
                  <a
                  data-bs-target="#chatbox" onclick="popchat(<?=$profile['uid']?>)"> message</a>
                  <a class="report-user" data-user-id="<?= $profile['uid'] ?>"> report User</a>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
      <div class="profile-states">
        <?php
        if (!checkBS($profile['uid'])) {
          ?>
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
                  <?php
                  foreach ($following as $usercard) {
                    $userdata = getUser($usercard[1]); ?>

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
        </div>
        <p class="profile-about">
          it’s all about me that this is me, this is walter white, and i am not
          batman, nothing is nothing, but something is something, and i don’t know
          if i am nothing, or something,
        </p><?php } ?>
      <?php
      if ($user['uid'] != $profile['uid']) {
        ?>
        <?php
        if (checkBlockStatus($user['uid'], $profile['uid'])) {
          ?>
          <a href="assets/php/action.php?unblock=<?= $profile['uid'] ?>&username=<?= $profile['username'] ?>"
            class=" primery-button" data-user-id='<?= $profile['uid'] ?>'>Unblock</a>
        <?php } else if (checkFollowStatus($profile['uid'])) {
          ?>
            <a href="#" class="secondary-button lr-btn w-button unfollowbtn"
              data-user-id="<?= $profile['uid'] ?>">Unfollow</a>

          <?php
        } else {
          ?>
            <a href="#" class="primery-button lr-btn w-button followbtn" data-user-id="<?= $profile['uid'] ?>">Follow</a>

          <?php
        }

      }
      ?>
    </div>
  </div>
  <?php
        if (!checkBS($profile['uid'])) {
          ?>
  <div class="profile-content">
    <?php include("assets/pages/tabs.php"); ?>
  </div>
  <?php } ?>
</div>


<div class="pop-up-window report-user hide">
  <div class="pop-up">
    <div class="pop-up-heading">
      <h2 class="heading-2">Reporting user</h2>
      <a class="close"><img src="assets/images/site-meta/charm_cross.svg" width="32" height="32" alt=""></a>
    </div>
    <div class="pop-up-content">
      <form action="assets/php/action.php/?report" method="post">
        <textarea placeholder="Why Are You Reporting This Post?" maxlength="220" name="preport" id="preport"
          class="log-reg-field reg-edit-about w-input"></textarea>
        <input type="hidden" id="user-id" name="user-id" value="0">
        <input type="submit" class="primery-button" value="Report">

      </form>

    </div>
  </div>
</div>
</body>

</html>