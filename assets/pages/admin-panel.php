<?php
global $postlist;
global $booklist;
global $userlist;
global $reportlist;
?>
<div class="admin-panel top-panel">
    <a class="admin-card" id="user-panel">
        <div class="count"><?= count($userlist) ?></div> <!-- Example user count -->
        <div class="label">Users</div>
    </a>
    <a class="admin-card" id="book-panel">
        <div class="count"><?= count($booklist) ?></div> <!-- Example book count -->
        <div class="label">Books</div>
    </a>
    <a class="admin-card" id="post-panel">
        <div class="count"><?= count($postlist) ?></div> <!-- Example post count -->
        <div class="label">Posts</div>
    </a>
    <a class="admin-card" id="report-panel">
        <div class="count"><?= count($reportlist) ?></div> <!-- Example report count -->
        <div class="label">Reports</div>
    </a>
</div>
<div class="list">
    <div id="post-container" class="main-content" style="inset:">
        <?php
        showError('post_img');
        if (count($postlist) < 1) {
            echo "<div class='no-posts'>
                    <img src='assets/images/site-meta/warning-circle.svg' alt='No posts' class='no-posts-image'>
                    <h2>No Posts Yet</h2>
                    <p>Looks like there’s nothing here. Start sharing your thoughts!</p>
                </div>";
        }
        foreach ($postlist as $post_details) {
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
                        <img src="assets/images/site-meta/heart.svg "
                            class="pc-control likepostbtn <?= $like_btn_display ?>"
                            data-post-id="<?= $post_details['pid'] ?>" data-user-id="<?= $_SESSION['userdata']['uid'] ?>" width="24" height="24" />
                        <img src="assets/images/site-meta/heart-solid.svg "
                            class="pc-control unlikepostbtn <?= $unlike_btn_display ?>"
                            data-post-id="<?= $post_details['pid'] ?>" data-user-id="<?= $_SESSION['userdata']['uid'] ?>" width="24" height="24" />
                        <div class="pco-count" id="likecount<?= $post_details['pid'] ?>"><?= count($likes) ?></div>
                    </div>
                    <div class="pc-option">
                        <img src="assets/images/site-meta/chat-lines.svg" class="pc-control" width="24"
                            height="24" />
                        <div class="pco-count"><?= count($comments) ?></div>
                    </div>
                    <img src="assets/images/site-meta/share-android-solid.svg" class="pc-control" width="24"
                        height="24" />
                    <?php
                    if ($post_details['uid'] == $_SESSION['userdata']['uid'] || $_SESSION['userdata']['is_admin'] == 1) {
                        ?>
                        <a href="assets/php/action.php/?deletepost=<?= $post_details['pid'] ?>"><img
                                src="assets/images/site-meta/bin-minus-in.svg" width="24" class="pc-control"
                                height="24" /></a>
                    <?php } else { ?>
                        <a data-post-id="<?= $post_details['pid'] ?>" class="report-post"><img
                                src="assets/images/site-meta/warning-circle.svg" width="24" class="pc-control"
                                height="24" /></a>
                    <?php } ?>
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
            <?php } ?>
    </div>
    <div id="book-container" class="main-content">
        <?php
        showError('post_img');
        if (count($booklist) < 1) {
            echo "<div class='no-posts'>
  <img src='assets/images/site-meta/warning-circle.svg' alt='No posts' class='no-posts-image'>
  <h2>No Posts Yet</h2>
  <p>Looks like there’s nothing here. Start sharing your thoughts!</p>
</div>";
        }
        foreach ($booklist as $book_details) {
            ?>
            <div class="book-card tab-details">
                <div class="book-thumbnail">
                    <img src="assets/images/book-cover/<?= $book_details['bcover'] ?>"   width="Auto"
                        height="200" class="image" />
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
    <div id="user-container" class="main-content"><?php
    if (count($userlist) < 1) {
        echo "<div class='no-posts'>
  <img src='assets/images/site-meta/warning-circle.svg' alt='No posts' class='no-posts-image'>
  <h2>No User Found</h2>
  <p>Looks like You're trying to find someone, who does not exists </p>
</div>";
    }
    foreach ($userlist as $userdata) {
        ?>
            <div class="profile-card-min">
                <a href="?u=<?= $userdata['username'] ?>" style="width:100%; margin-right: 20px;"
                    class="link-block w-inline-block">
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
            <?php
    }
    ?>
    </div>
    <div id="report-container" class="main-content"><?php
    showError('post_img');
    if (count($reportlist) < 1) {
        echo "<div class='no-posts'>
  <img src='assets/images/site-meta/warning-circle.svg' alt='No posts' class='no-posts-image'>
  <h2>No Reports Yet</h2>
  <p>Looks like there’s nothing here.</p>
</div>";
    }
    foreach ($reportlist as $report_details) {
        ?>
            <div class="post-thumbnail tab-details w-inline-block">
                <div class="post-controls">
                    <a href="assets/php/action.php/?deletereport=<?= $report_details['rid'] ?>"><img
                            src="assets/images/site-meta/bin-minus-in.svg" width="24" class="pc-control"
                            height="24" /></a>
                </div>
                <?php
                $linkid;
                $report = "none";
                if ($report_details['uid'] != 0) {
                    $linkid = $report_details['uid'];
                    $report = "user";
                } else if ($report_details['rpost'] != 0) {
                    $linkid = $report_details['rpost'];
                    $report = "post";
                } else {
                    $linkid = $report_details['rbook'];
                    $report = 'book';
                }
                ?>
                <a <?php if ($report == "post") { ?> href="?post=<?= $linkid ?>" <?php } elseif ($report == "book") { ?>
                        href="?book=<?= $linkid ?>" <?php } else { ?> href="?u=<?= $report_details['username'] ?>" <?php } ?>
                    class="post-content-container">
                    <div class="pc-title-container">
                        <h1 class="heading-2"><?= $report ?></h1>
                    </div>
                    <div class="pc-container">
                        <div class="post-content">
                            <p class="pc-text">
                                <?= $report_details['report_text'] ?>
                            </p>
                        </div>
                        <div class="post-details">
                            <p class="pcm-text pcm-username">u/<?= $report_details['username'] ?></p>
                            <p class="pcm-text"><?= timeAgo($report_details['report_time']) ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
    </div>
</div>