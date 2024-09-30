<?php
  global $book_data;

  if(empty($book_data)){
      echo "no book saar";
      exit;
  }
?>
  <div class="book-page">
    <div class="top-fade"></div>
    <div class="book-page-content">
      <div class="book-cover"><img src="assets/images/book-cover/<?=$book_data[0]['bcover']?>" loading="lazy" alt="" class="image-5"></div>
      <div class="book-main-content">
      <h1 class="heading-2"><?=$book_data[0]['btitle']?></h1>
      <p class="pcm-text pd-date"><?=timeAgo($book_data[0]['bdate'])?></p>
        <div class="book-main-text w-richtext">
        <?=getBookContent($book_data[0]['bcontent'])?>
          </div>
      </div>
      <div class="ps-controls">
        <div class="pc-option"><img src="images/mdi_heart-outline.svg" alt="" width="24" height="24" class="image-4"></div><img src="images/uil_share.svg" alt="" width="24" height="24"><img src="images/zondicons_dots-horizontal-triple.svg" alt="" width="24" height="24">
      </div>
      <div class="ps-info">
        <a href="#" class="link-block w-inline-block"><img src="assets/images/profile/<?=$book_data[0]['uprofile_photo']?>" loading="lazy" width="Auto" alt="" class="pcm-img">
          <div class="pcm-details">
            <p class="pcm-text pcm-username">u/<?=$book_data[0]['username']?></p>
            <p class="pcm-text"><?=$book_data[0]['uname']?></p>
          </div>
        </a>
        <a href="#" class="primery-button w-button">Follow</a>
      </div>
      <div class="comment-section book-comments">
        <h1 class="heading-2">Comments</h1>
        <div class="form-comment w-form">
          <form id="email-form-2" name="email-form-2" data-name="Email Form 2" method="get" class="form" data-wf-page-id="669d16533b2ec3c734b481bc" data-wf-element-id="89f40168-5edc-57e8-94b1-3f8f2d62334d"><textarea placeholder="Example Text" maxlength="5000" id="field-5" name="field-5" data-name="Field 5" class="log-reg-field comment-box w-input"></textarea><input type="submit" data-wait="Please wait..." class="primery-button w-button" value="Comment"></form>
        </div>
        <div class="comments-container">
          <div class="comment-card">
            <div>
              <a href="#" class="link-block w-inline-block"><img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img">
                <div class="pcm-details">
                  <p class="pcm-text pcm-username">u/username</p>
                  <p class="pcm-text">Name</p>
                </div>
                <p class="pcm-text pd-date">dd-mm-yyyy</p>
              </a>
            </div>
            <p class="main-text">here is nothing but something on name of nathing here is bunch of text that does not matter but matters, but is just here to put something here is nothing but something on name of nathing here is nothing but something on name of nathing here is bunch of text that does no</p>
          </div>
          <div class="comment-card">
            <div>
              <a href="#" class="link-block w-inline-block"><img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img">
                <div class="pcm-details">
                  <p class="pcm-text pcm-username">u/username</p>
                  <p class="pcm-text">Name</p>
                </div>
                <p class="pcm-text pd-date">dd-mm-yyyy</p>
              </a>
            </div>
            <p class="main-text">here is nothing but something on name of nathing here is bunch of text that does not matter but matters, but is just here to put something here is nothing but something on name of nathing here is nothing but something on name of nathing here is bunch of text that does no</p>
          </div>
          <div class="comment-card">
            <div>
              <a href="#" class="link-block w-inline-block"><img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img">
                <div class="pcm-details">
                  <p class="pcm-text pcm-username">u/username</p>
                  <p class="pcm-text">Name</p>
                </div>
                <p class="pcm-text pd-date">dd-mm-yyyy</p>
              </a>
            </div>
            <p class="main-text">here is nothing but something on name of nathing here is bunch of text that does not matter but matters, but is just here to put something here is nothing but something on name of nathing here is nothing but something on name of nathing here is bunch of text that does no</p>
          </div>
          <div class="comment-card">
            <div>
              <a href="#" class="link-block w-inline-block"><img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img">
                <div class="pcm-details">
                  <p class="pcm-text pcm-username">u/username</p>
                  <p class="pcm-text">Name</p>
                </div>
                <p class="pcm-text pd-date">dd-mm-yyyy</p>
              </a>
            </div>
            <p class="main-text">here is nothing but something on name of nathing here is bunch of text that does not matter but matters, but is just here to put something here is nothing but something on name of nathing here is nothing but something on name of nathing here is bunch of text that does no</p>
          </div>
          <div class="comment-card">
            <div>
              <a href="#" class="link-block w-inline-block"><img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img">
                <div class="pcm-details">
                  <p class="pcm-text pcm-username">u/username</p>
                  <p class="pcm-text">Name</p>
                </div>
                <p class="pcm-text pd-date">dd-mm-yyyy</p>
              </a>
            </div>
            <p class="main-text">here is nothing but something on name of nathing here is bunch of text that does not matter but matters, but is just here to put something here is nothing but something on name of nathing here is nothing but something on name of nathing here is bunch of text that does no</p>
          </div>
          <div class="comment-card">
            <div>
              <a href="#" class="link-block w-inline-block"><img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img">
                <div class="pcm-details">
                  <p class="pcm-text pcm-username">u/username</p>
                  <p class="pcm-text">Name</p>
                </div>
                <p class="pcm-text pd-date">dd-mm-yyyy</p>
              </a>
            </div>
            <p class="main-text">here is nothing but something on name of nathing here is bunch of text that does not matter but matters, but is just here to put something here is nothing but something on name of nathing here is nothing but something on name of nathing here is bunch of text that does no</p>
          </div>
          <div class="comment-card">
            <div>
              <a href="#" class="link-block w-inline-block"><img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img">
                <div class="pcm-details">
                  <p class="pcm-text pcm-username">u/username</p>
                  <p class="pcm-text">Name</p>
                </div>
                <p class="pcm-text pd-date">dd-mm-yyyy</p>
              </a>
            </div>
            <p class="main-text">here is nothing but something on name of nathing here is bunch of text that does not matter but matters, but is just here to put something here is nothing but something on name of nathing here is nothing but something on name of nathing here is bunch of text that does no</p>
          </div>
          <div class="comment-card">
            <div>
              <a href="#" class="link-block w-inline-block"><img src="images/php.jpeg" loading="lazy" width="Auto" alt="" class="pcm-img">
                <div class="pcm-details">
                  <p class="pcm-text pcm-username">u/username</p>
                  <p class="pcm-text">Name</p>
                </div>
                <p class="pcm-text pd-date">dd-mm-yyyy</p>
              </a>
            </div>
            <p class="main-text">here is nothing but something on name of nathing here is bunch of text that does not matter but matters, but is just here to put something here is nothing but something on name of nathing here is nothing but something on name of nathing here is bunch of text that does no</p>
          </div>
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
        foreach($display_books as $book_details){
          ?>
          <div class="book-card book-suggestion">
            <div class="book-thumbnail"><img src="assets/images/book-cover/<?=$book_details['bcover']?>" loading="lazy" width="Auto" height="Auto" alt="" class="image bs"></div>
            <div class="book-details">
              <div class="book-title-container">
                <h1 class="book-title bs"><?=$book_details['btitle']?></h1>
              </div>
              <div class="book-description">
                <p class="book-description-text bs"><?=$book_details['babout']?></p>
              </div>
              <div class="bd-bottom">
                <a href="#" class="primery-button">Read Now</a>
              </div>
            </div>
          </div>
          <?php }?>
        </div>
      </div>
    </div>
    </body>
    </html>