<?php
global $user;
global $posts;
global $books;
global $profile_post;
global $profile_books;
global $seachedusers;
global $seachedposts;
global $seachedbooks;
$display_posts = $posts;
$display_books = $books;

if (isset($_GET['u'])) {
  $display_posts = $profile_post;
  $display_books = $profile_books;
}
if (isset($_GET['search'])) {
  $display_posts = $seachedposts;
  $display_books = $seachedbooks;
  $display_users = $seachedusers;
}
?>


<div style="width:100%">
  <div class="tabs-menu w-tab-menu">
    <a class="p-tab w-inline-block w-tab-link w--current" id="casuals">
      <div>Casuals</div>
    </a>
    <a class="p-tab w-inline-block w-tab-link" id="books">
      <div>Books</div>
    </a>
    <?php if (isset($_GET['search'])) {
      ?>
      <a class="p-tab w-inline-block w-tab-link" id="users">
        <div>Users</div>
      </a>
    <?php } ?>
  </div>
  <div class="tabs-content w-tab-content">
    <div class="p-tab-content w-tab-pane " id="casuals-container">

      <?php
      showError('post_img');
      if (count($display_posts) < 1) {
        echo "<p style='width:93vw' class='heading-2'>Follow Someone or Add a new post</p>";
      }
      foreach ($display_posts as $post_details) {
        $likes = getPostLikes($post_details['pid']);
        $comments = getPostComments($post_details['pid']);
        ?>
        <div class="post-thumbnail tab-details w-inline-block">
          <div class="post-controls">
            <div class="pc-option">
              <?php
              if (checkPostLikeStatus($post_details['pid'])) {
                $like_btn_display = 'hide';
                $unlike_btn_display = '';
              } else {
                $like_btn_display = '';
                $unlike_btn_display = 'hide';
              }
              ?>
              <img src="assets/images/site-meta/heart.svg " class="likepostbtn <?= $like_btn_display ?>"
                data-post-id="<?= $post_details['pid'] ?>" data-user-id="<?= $_SESSION['userdata']['uid'] ?>" alt=""
                width="24" height="24" />
              <img src="assets/images/site-meta/heart-solid.svg " class="unlikepostbtn <?= $unlike_btn_display ?>"
                data-post-id="<?= $post_details['pid'] ?>" data-user-id="<?= $_SESSION['userdata']['uid'] ?>" alt=""
                width="24" height="24" />
              <div class="pco-count" id="likecount<?= $post_details['pid'] ?>"><?= count($likes) ?></div>
            </div>
            <div class="pc-option">
              <img src="assets/images/site-meta/uil_comment.svg" alt="" width="24" height="24" />
              <div class="pco-count"><?= count($comments) ?></div>
            </div>
            <img src="assets/images/site-meta/share-android-solid.svg" alt="" width="24" height="24" />
            <?php
if($post_details['uid']==$_SESSION['userdata']['uid']){
    ?>

<a href="assets/php/action.php/?deletepost=<?=$post_details['pid']?>"><img src="assets/images/site-meta/bin-minus-in.svg" alt="" width="24" height="24" /></a>

            <?php }else{?>
            <a href="/assets"><img src="assets/images/site-meta/warning-circle.svg" alt="" width="24" height="24" /></a>
            <?php }?>

          </div>

          <a href="?post=<?= $post_details['pid'] ?>" class="post-content-container">
            <div class="pc-title-container">
              <h1 class="heading-2"><?= $post_details['ptitle'] ?></h1>
              <p class="pcm-text  tags"><?= $post_details['ptag'] ?></p>
            </div>
            <div class="pc-container">
              <div class="post-content">
                <p class="pc-text">
                  <?php echo cutString(getPostContentWithoutFormating($post_details['pcontent']), 200) ?>
                </p>
              </div>
              <div class="post-details">
                <p class="pcm-text pcm-username">u/<?= $post_details['username'] ?></p>
                <p class="pcm-text"><?= timeAgo($post_details['pdate']) ?></p>
              </div>
            </div>
          </a>
        </div>

        <?php
      }
      ?>
    </div>
    <div class="p-tab-content w-tab-pane hide" id="books-container">
      <?php
      showError('post_img');
      if (count($display_books) < 1) {
        echo "<p style='width:93vw' class='heading-2'>Follow Someone or Add a new book</p>";
      }

      foreach ($display_books as $book_details) {
        ?>

        <div class="book-card tab-details">
          <div class="book-thumbnail">
            <img src="assets/images/book-cover/<?= $book_details['bcover'] ?>" loading="lazy" width="Auto" height="200"
              alt="" class="image" />
          </div>
          <div class="book-details">
            <div class="book-title-container">
              <h1 class="book-title"><?= $book_details['btitle'] ?></h1>
              <p class="pcm-text tags"><?= $book_details['btag'] ?></p>
            </div>
            <div class="book-description">
              <a class="book-description-text">
                <?= $book_details['babout'] ?>
              </a>
            </div>
            <div class="bd-bottom">
              <a href="?book=<?= $book_details['bid'] ?>" class="primery-button">Read Now</a>
              <div class="post-details">
                <p class="pcm-text pcm-username">U/<?= $book_details['username'] ?></p>
                <p class="pcm-text"><?= timeAgo($book_details['bdate']) ?></p>
              </div>
            </div>
          </div>
        </div>

        <?php
      }
      ?>
    </div>
    <div class="p-tab-content w-tab-pane hide" style= "padding: 0px 10%;"id="users-container">

      <?php
      if(isset($_GET['search']))
      if (count($display_users) < 1) {
        echo "<p style='width:93vw' class='heading-2'>No user Found</p>";
      }
      foreach ($display_users as $userdata) {
        ?>
        <div class="profile-card-min">
                  <a href="?u=<?= $userdata['username'] ?>"  style="width:100%; margin-right: 20px;" class="link-block w-inline-block">
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

        <?php
      }
      ?>
    </div>
  </div>
</div>