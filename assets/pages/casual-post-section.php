<?php
global $post_data;
if (empty($post_data)) {
  showPage('404');
  exit;
}
$likes = getPostLikes($post_data[0]['pid']);
?>
 
<div class="post-page">
  <div class="pp-top">
    <a onClick="javascript:history.back()" class="action-button w-inline-block">
      <img src="assets/images/site-meta/arrow-left-circle.svg"     class="action-button-img" /></a>
    <div class="heading-2">Post</div>
  </div>
  <div class="pp-container">
    <div class="post-section">
      <div class="ps-info">
        <a href="#" class="link-block w-inline-block">
          <img src="assets/images/profile/<?= $post_data[0]['uprofile_photo'] ?>"   width="Auto"  
            class="pcm-img" />
          <div class="pcm-details">
            <p class="pcm-text pcm-username">u/<?= $post_data[0]['username'] ?></p>
            <p class="pcm-text"><?= $post_data[0]['uname'] ?></p>
          </div>
         </a>
        <?php
        if ($_SESSION['userdata']['uid'] != $post_data[0]['uid']) {
          ?>
          <?php
          if (checkFollowStatus($post_data[0]['uid'])) {
            ?>
            <a href="#" class="secondary-button lr-btn w-button unfollowbtn"
              data-user-id="<?= $post_data[0]['uid'] ?>">Unfollow</a>
             <?php
          } else {
            ?>
            <a href="#" class="primery-button lr-btn w-button followbtn"
              data-user-id="<?= $post_data[0]['uid'] ?>">Follow</a>
            <?php
          }
        }
        ?>
      </div>
      <div class="ps-head">
        <div class="pc-title-container">
          <h1 class="heading-2"><?= $post_data[0]['ptitle'] ?></h1>
          <p class="pcm-text pcm-username"><?= $post_data[0]['ptag'] ?></p>
          <p class="pcm-text pd-date"><?= timeAgo($post_data[0]['pdate']) ?></p>
        </div>
      </div>
      <div class="ps-content">
        <div class="main-text">
          <?= getPostContent($post_data[0]['pcontent']) ?>
        </div>
      </div>
      <div class="ps-controls">
        <div class="pc-option">
          <?php
          if (checkPostLikeStatus($post_data[0]['pid'])) {
            $like_btn_display = 'hide';
            $unlike_btn_display = '';
          } else {
            $like_btn_display = '';
            $unlike_btn_display = 'hide';
          }
          ?>
          <img src="assets/images/site-meta/heart.svg " class="ps-option likepostbtn <?= $like_btn_display ?>"
            data-post-id="<?= $post_data[0]['pid'] ?>" data-user-id="<?= $_SESSION['userdata']['uid'] ?>"  
            width="24" height="24" />
          <img src="assets/images/site-meta/heart-solid.svg " class="ps-option unlikepostbtn <?= $unlike_btn_display ?>"
            data-post-id="<?= $post_data[0]['pid'] ?>" data-user-id="<?= $_SESSION['userdata']['uid'] ?>"  
            width="24" height="24" />
        </div>
        <img src="assets/images/site-meta/share-android-solid.svg"   id="sharethispage" class="ps-option" width="24" height="24" />
        <?php
        if ($post_data[0]['uid'] == $_SESSION['userdata']['uid']) {
          ?>
           <a style="line-height:0px;" href="assets/php/action.php/?deletepost=<?= $post_data[0]['pid'] ?>"><img
              src="assets/images/site-meta/bin-minus-in.svg"   class="ps-option" width="24" height="24" /></a>
         <?php } else { ?>
          <a data-post-id="<?= $post_data[0]['pid'] ?>" style="line-height:0px;" class="report-post"><img
              src="assets/images/site-meta/warning-circle.svg"   class="ps-option" width="24" height="24" /></a>
        <?php } ?>
      </div>
      <div class="pco-count show-likes "> <span id="likecount<?= $post_data[0]['pid'] ?>"><?= count($likes) ?></span>
        People Liked
        This</div>
      <div class="pop-up-window hide" id="likes">
        <div class="pop-up">
          <div class="pop-up-heading">
            <h2 class="heading-2">Likes</h2>
            <a class="close"><img src="assets/images/site-meta/xmark-circle.svg" width="32" height="32"  ></a>
          </div>
          <div class="pop-up-content">
             <div class="profile-list">
              <?php foreach ($likes as $usercard) {
                $userdata = getUser($usercard['uid']) ?>
                <div class="profile-card-min">
                  <a href="?u=<?= $userdata['username'] ?>" class="link-block w-inline-block">
                    <img src="assets/images/profile/<?= $userdata['uprofile_photo'] ?>"    
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
     <div class="comment-section">
      <h1 class="heading-2">Comments</h1>
      <div class="form-comment w-form">
        <textarea placeholder="Your Comment" maxlength="5000" id="comment-box"
          class="log-reg-field comment-box w-input"></textarea>
        <button type="button" class="primery-button w-button addpostcomment"
          data-post-id="<?= $post_data[0]['pid'] ?>">Comment</button>
      </div>
       <div class="comments-container">
        <?php
        $comments = getPostComments($post_data[0]['pid']);
        if (count($comments) < 1) {
          echo "<p>No Comments</p>";
        }
        foreach ($comments as $comment) {
          ?>
          <div class="comment-card">
            <div>
              <a href="#" class="link-block w-inline-block">
                <img src="assets/images/profile/<?= $comment['uprofile_photo'] ?>"   width="Auto"  
                  class="pcm-img" />
                <div class="pcm-details">
                  <p class="pcm-text pcm-username">u/<?= $comment['username'] ?></p>
                  <p class="pcm-text"><?= $comment['uname'] ?></p>
                </div>
               </a>
            </div>
            <p class="main-text">
              <?= $comment['c_content'] ?>
            </p>
            <p class="pcm-text pd-date"><?= timeAgo($comment['cdate']) ?></p>
          </div>
        <?php } ?>
      </div>
     </div>
  </div>
</div>
 
<div class="pop-up-window hide" id="report-post">
  <div class="pop-up">
    <div class="pop-up-heading">
      <h2 class="heading-2">Reporting Post</h2>
      <a class="close"><img src="assets/images/site-meta/xmark-circle.svg" width="32" height="32"  ></a>
    </div>
    <div class="pop-up-content">
      <form action="assets/php/action.php/?report" method="post">
        <textarea placeholder="Why Are You Reporting This Post?" maxlength="220" name="preport" id="preport"
          class="log-reg-field reg-edit-about w-input"></textarea>
        <input type="hidden" id="post-id" name="post-id" value="0">
        <input type="submit" class="primery-button" value="Report">
       </form>
     </div>
  </div>
</div>