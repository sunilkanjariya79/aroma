
<?php
  global $post_data;
?>


<div class="post-page">
  <div class="pp-top">
    <a onClick="javascript:history.back()" class="action-button w-inline-block">
      <img src="assets/images/site-meta/arrow-left-circle.svg" loading="lazy" alt="" class="action-button-img"/></a>
    <div class="heading-2">Post</div>
  </div>
  <div class="pp-container">
    <div class="post-section">
      <div class="ps-info">
        <a href="#" class="link-block w-inline-block">
          <img src="assets/images/profile/<?=$post_data[0]['uprofile_photo']?>" loading="lazy" width="Auto" alt="" class="pcm-img"/>
          <div class="pcm-details">
            <p class="pcm-text pcm-username">u/<?=$post_data[0]['username']?></p>
            <p class="pcm-text"><?=$post_data[0]['uname']?></p>
          </div>
          
        </a>
        <a href="#" class="primery-button w-button">Follow</a>
      </div>
      <div class="ps-head">
        <div class="pc-title-container">
          <h1 class="heading-2"><?=$post_data[0]['ptitle']?></h1>
          <p class="pcm-text pcm-username"><?=$post_data[0]['ptag']?></p>
          <p class="pcm-text pd-date"><?=timeAgo($post_data[0]['pdate'])?></p>
        </div>
      </div>
      <div class="ps-content">
        <div class="main-text">
        <?=getPostContent($post_data[0]['pcontent'])?>
</div>
        <div class="ps-controls">
          <div class="pc-option">
          <?php
if(checkPostLikeStatus($post_data[0]['pid'])){
$like_btn_display='hide';
$unlike_btn_display='';
}else{
    $like_btn_display='';
    $unlike_btn_display='hide';  
}
    ?>
             <img src="assets/images/site-meta/heart.svg " class="likepostbtn <?=$like_btn_display?>"
                data-post-id="<?= $post_data[0]['pid'] ?>" data-user-id="<?= $_SESSION['userdata']['uid'] ?>" alt=""
                width="24" height="24" />
                <img src="assets/images/site-meta/heart-solid.svg " class="likepostbtn <?=$unlike_btn_display?>"
                data-post-id="<?= $post_data[0]['pid'] ?>" data-user-id="<?= $_SESSION['userdata']['uid'] ?>" alt=""
                width="24" height="24" />
          </div>
          <img src="assets/images/site-meta/share-android-solid.svg" alt="" width="24" height="24" />
          <img src="assets/images/site-meta/zondicons_dots-horizontal-triple.svg" alt="" width="24" height="24"/>
        </div>
      </div>
    </div>
    <div class="comment-section">
      <h1 class="heading-2">Comments</h1>
      <div class="form-comment w-form">
        <form id="email-form-2" name="email-form-2" method="post" class="form">
          <textarea placeholder="Example Text" maxlength="5000" id="field-5" name="field-5" data-name="Field 5" class="log-reg-field comment-box w-input"></textarea>
          <input type="submit" class="primery-button w-button" value="Comment"/>
        </form>
      </div>
      <div class="comments-container">
        <div class="comment-card">
          <div>
            <a href="#" class="link-block w-inline-block">
              <img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img"/>
              <div class="pcm-details">
                <p class="pcm-text pcm-username">u/username</p>
                <p class="pcm-text">Name</p>
              </div>
              <p class="pcm-text pd-date">dd-mm-yyyy</p>
            </a>
          </div>
          <p class="main-text">
            here is nothing but something on name of nathing here is bunch of
            text that does not matter but matters, but is just here to put
            something here is nothing but something on name of nathing here is
            nothing but something on name of nathing here is bunch of text that
            does no
          </p>
        </div>
        <div class="comment-card">
          <div>
            <a href="#" class="link-block w-inline-block">
              <img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img"/>
              <div class="pcm-details">
                <p class="pcm-text pcm-username">u/username</p>
                <p class="pcm-text">Name</p>
              </div>
              <p class="pcm-text pd-date">dd-mm-yyyy</p>
            </a>
          </div>
          <p class="main-text">
            here is nothing but something on name of nathing here is bunch of
            text that does not matter but matters, but is just here to put
            something here is nothing but something on name of nathing here is
            nothing but something on name of nathing here is bunch of text that
            does no
          </p>
        </div>
        <div class="comment-card">
          <div>
            <a href="#" class="link-block w-inline-block">
              <img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img"/>
              <div class="pcm-details">
                <p class="pcm-text pcm-username">u/username</p>
                <p class="pcm-text">Name</p>
              </div>
              <p class="pcm-text pd-date">dd-mm-yyyy</p>
            </a>
          </div>
          <p class="main-text">
            here is nothing but something on name of nathing here is bunch of
            text that does not matter but matters, but is just here to put
            something here is nothing but something on name of nathing here is
            nothing but something on name of nathing here is bunch of text that
            does no
          </p>
        </div>
        <div class="comment-card">
          <div>
            <a href="#" class="link-block w-inline-block">
              <img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img"/>
              <div class="pcm-details">
                <p class="pcm-text pcm-username">u/username</p>
                <p class="pcm-text">Name</p>
              </div>
              <p class="pcm-text pd-date">dd-mm-yyyy</p>
            </a>
          </div>
          <p class="main-text">
            here is nothing but something on name of nathing here is bunch of
            text that does not matter but matters, but is just here to put
            something here is nothing but something on name of nathing here is
            nothing but something on name of nathing here is bunch of text that
            does no
          </p>
        </div>
        <div class="comment-card">
          <div>
            <a href="#" class="link-block w-inline-block">
              <img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img"/>
              <div class="pcm-details">
                <p class="pcm-text pcm-username">u/username</p>
                <p class="pcm-text">Name</p>
              </div>
              <p class="pcm-text pd-date">dd-mm-yyyy</p>
            </a>
          </div>
          <p class="main-text">
            here is nothing but something on name of nathing here is bunch of
            text that does not matter but matters, but is just here to put
            something here is nothing but something on name of nathing here is
            nothing but something on name of nathing here is bunch of text that
            does no
          </p>
        </div>
        <div class="comment-card">
          <div>
            <a href="#" class="link-block w-inline-block">
              <img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img"/>
              <div class="pcm-details">
                <p class="pcm-text pcm-username">u/username</p>
                <p class="pcm-text">Name</p>
              </div>
              <p class="pcm-text pd-date">dd-mm-yyyy</p>
            </a>
          </div>
          <p class="main-text">
            here is nothing but something on name of nathing here is bunch of
            text that does not matter but matters, but is just here to put
            something here is nothing but something on name of nathing here is
            nothing but something on name of nathing here is bunch of text that
            does no
          </p>
        </div>
        <div class="comment-card">
          <div>
            <a href="#" class="link-block w-inline-block">
              <img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img"/>
              <div class="pcm-details">
                <p class="pcm-text pcm-username">u/username</p>
                <p class="pcm-text">Name</p>
              </div>
              <p class="pcm-text pd-date">dd-mm-yyyy</p>
            </a>
          </div>
          <p class="main-text">
            here is nothing but something on name of nathing here is bunch of
            text that does not matter but matters, but is just here to put
            something here is nothing but something on name of nathing here is
            nothing but something on name of nathing here is bunch of text that
            does no
          </p>
        </div>
        <div class="comment-card">
          <div>
            <a href="#" class="link-block w-inline-block">
              <img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img"/>
              <div class="pcm-details">
                <p class="pcm-text pcm-username">u/username</p>
                <p class="pcm-text">Name</p>
              </div>
              <p class="pcm-text pd-date">dd-mm-yyyy</p>
            </a>
          </div>
          <p class="main-text">
            here is nothing but something on name of nathing here is bunch of
            text that does not matter but matters, but is just here to put
            something here is nothing but something on name of nathing here is
            nothing but something on name of nathing here is bunch of text that
            does no
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>