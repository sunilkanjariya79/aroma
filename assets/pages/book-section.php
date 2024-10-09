<?php
global $book_data;
$likes = getBookLikes($book_data[0]['bid']);
if (empty($book_data)) {
  echo "no book saar";
  exit;
}
?>
<div class="book-page">
  <div class="top-fade"></div>
  <div class="book-page-content">
    <div class="book-cover"><img src="assets/images/book-cover/<?= $book_data[0]['bcover'] ?>" loading="lazy" alt=""
        class="image-5"></div>
    <div class="book-main-content">
      <h1 class="heading-2"><?= $book_data[0]['btitle'] ?></h1>
      <p class="pcm-text pd-date"><?= timeAgo($book_data[0]['bdate']) ?></p>
      <div class="book-main-text w-richtext">
        <?= getBookContent($book_data[0]['bcontent']) ?>
      </div>
    </div>
    <div class="ps-controls">
      <div class="pc-option">
        <?php
        if (checkBookLikeStatus($book_data[0]['bid'])) {
          $like_btn_display = 'hide';
          $unlike_btn_display = '';
        } else {
          $like_btn_display = '';
          $unlike_btn_display = 'hide';
        }
        ?>
        <img src="assets/images/site-meta/heart.svg " class="ps-option likebookbtn <?= $like_btn_display ?>"
          data-book-id="<?= $book_data[0]['bid'] ?>" data-user-id="<?= $_SESSION['userdata']['uid'] ?>" alt=""
          width="24" height="24" />
        <img src="assets/images/site-meta/heart-solid.svg " class="ps-option unlikebookbtn <?= $unlike_btn_display ?>"
          data-book-id="<?= $book_data[0]['bid'] ?>" data-user-id="<?= $_SESSION['userdata']['uid'] ?>" alt=""
          width="24" height="24" />
      </div><img src="assets/images/site-meta/share-android-solid.svg" alt="" width="24" class="ps-option" height="24"><?php
      if ($book_data[0]['uid'] == $_SESSION['userdata']['uid']) {
        ?>

        <a href="assets/php/action.php/?deletebook=<?= $book_data[0]['bid'] ?>" style="line-height:0px;" ><img
            src="assets/images/site-meta/bin-minus-in.svg" alt="" class="ps-option" width="24" height="24" /></a>

      <?php } else { ?>
        <a data-book-id="<?= $book_data[0]['bid'] ?>" style="line-height:0px;" class="report-book"><img
                  src="assets/images/site-meta/warning-circle.svg" alt="" class="ps-option" width="24" height="24" /></a>
      <?php } ?>
    </div>
    <div class="pco-count show-likes"> <span id="likecount<?= $book_data[0]['bid'] ?>"><?= count($likes) ?></span>
      People Liked This
    </div>
    <div class="pop-up-window hide" id="likes">
      <div class="pop-up">
        <div class="pop-up-heading">
          <h2 class="heading-2">Likes</h2>
          <a class="close"><img src="assets/images/site-meta/xmark-circle.svg" width="32" height="32" alt=""></a>
        </div>
        <div class="pop-up-content">

          <div class="profile-list">
            <?php foreach ($likes as $usercard) {
              $userdata = getUser($usercard['uid']) ?>
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
    <div class="ps-info">
      <a href="#" class="link-block w-inline-block"><img
          src="assets/images/profile/<?= $book_data[0]['uprofile_photo'] ?>" loading="lazy" width="Auto" alt=""
          class="pcm-img">
        <div class="pcm-details">
          <p class="pcm-text pcm-username">u/<?= $book_data[0]['username'] ?></p>
          <p class="pcm-text"><?= $book_data[0]['uname'] ?></p>
        </div>
      </a>
      <a href="#" class="primery-button w-button">Follow</a>
    </div>
    <div class="comment-section book-comments">
      <h1 class="heading-2">Comments</h1>
      <div class="form-comment w-form">
        <textarea placeholder="Your Comment" maxlength="5000" id="comment-box"
          class="log-reg-field comment-box w-input"></textarea>
        <button type="button" class="primery-button w-button addbookcomment"
          data-book-id="<?= $book_data[0]['bid'] ?>">Comment</button>
      </div>
      <div class="comments-container">
        <?php
        $comments = getBookComments($book_data[0]['bid']);
        if (count($comments) < 1) {
          echo "<p>No Comments</p>";
        }
        foreach ($comments as $comment) {
          ?>
          <div class="comment-card">
            <div>
              <a href="#" class="link-block w-inline-block"><img
                  src="assets/images/profile/<?= $comment['uprofile_photo'] ?>"" loading=" lazy" width="Auto" alt=""
                  class="pcm-img">
                <div class="pcm-details">
                  <p class="pcm-text pcm-username">u/<?= $comment['username'] ?></p>
                  <p class="pcm-text"><?= $comment['uname'] ?></p>
                </div>
                
              </a>
            </div>
            <p class="main-text"><?= $comment['c_content'] ?></p>
            <p class="pcm-text pd-date" style="align-self:flex-end;"><?= timeAgo($comment['cdate']) ?></p>
          </div>
        <?php } ?>
      </div>

    </div>
  </div>
</div>
<div class="right-panel book-suggestion">
  <div class="side-bar follow-suggestions">
    <h2 class="heading">Suggestions for you</h2>
    <div class="book-list">
      <?php
      global $books;
      $display_books = $books;
      foreach ($display_books as $book_details) {
        ?>
        <div class="book-card book-suggestion">
          <div class="book-thumbnail"><img src="assets/images/book-cover/<?= $book_details['bcover'] ?>" loading="lazy"
              width="Auto" height="Auto" alt="" class="image bs"></div>
          <div class="book-details">
            <div class="book-title-container">
              <h1 class="book-title bs"><?= $book_details['btitle'] ?></h1>
            </div>
            <div class="book-description">
              <p class="book-description-text bs"><?= $book_details['babout'] ?></p>
            </div>
            <div class="bd-bottom">
              <a href="#" class="primery-button">Read Now</a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>


<div class="pop-up-window report-book hide">
  <div class="pop-up">
    <div class="pop-up-heading">
      <h2 class="heading-2">Reporting Book</h2>
      <a class="close"><img src="assets/images/site-meta/charm_cross.svg" width="32" height="32" alt=""></a>
    </div>
    <div class="pop-up-content">
      <form action="assets/php/action.php/?report" method="post">
        <textarea placeholder="Why Are You Reporting This Post?" maxlength="220" name="preport" id="preport"
          class="log-reg-field reg-edit-about w-input"></textarea>
        <input type="hidden" id="book-id" name="book-id" value="0">
        <input type="submit" class="primery-button" value="Report">

      </form>

    </div>
  </div>
</div>
</body>

</html>