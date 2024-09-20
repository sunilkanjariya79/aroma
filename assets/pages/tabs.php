

<?php
     global $user;
     global $posts;
     global $books;
     if(isset($_GET['post-wall']) || empty($_GET)){
      $display_posts = $posts;
      $display_books = $books;
     }
?>


<div style="width:100%">
      <div class="tabs-menu w-tab-menu">
        <a class="p-tab w-inline-block w-tab-link w--current"
          id="casuals">
          <div>Casuals</div>
        </a>
        <a class="p-tab w-inline-block w-tab-link" id="books">
          <div>Books</div>
        </a>
      </div>
      <div class="tabs-content w-tab-content">
        <div class="p-tab-content w-tab-pane " id="casuals-container">

        <?php 
        showError('post_img');
        if(count($display_posts)<1){
            echo "<p style='width:93vw' class='heading-2'>Follow Someone or Add a new post</p>";
        }

        foreach($display_posts as $post_details){
        ?>
          <a href="?post-page&post_id="<?=$post_details['pid']?> class="post-thumbnail tab-details w-inline-block">
            <div class="post-controls">
              <div class="pc-option">
                <img src="images/mdi_heart-outline.svg" alt="" width="24" height="24"/>
                <div class="pco-count">1280</div>
              </div>
              <div class="pc-option">
                <img src="images/uil_comment.svg" alt="" width="24" height="24"/>
                <div class="pco-count">1280</div>
              </div>
              <img src="images/uil_share.svg" alt="" width="24" height="24"/>
              <img src="images/zondicons_dots-horizontal-triple.svg" alt="" width="24" height="24"/>
            </div>
            <div class="post-content-container">
              <div class="pc-title-container">
                <h1 class="heading-2"><?=$post_details['ptitle']?></h1>
                <p class="pcm-text pcm-username"><?=$post_details['ptag']?></p>
              </div>
              <div class="pc-container">
                <div class="post-content">
                  <p class="pc-text">
                  <?php echo cutString(getPostContent($post_details['pcontent']),200)?>
                  </p>
                </div>
                <div class="post-details">
                  <p class="pcm-text pcm-username">u/<?=$post_details['username']?></p>
                  <p class="pcm-text"><?=timeAgo($post_details['pdate'])?></p>
                </div>
              </div>
            </div>
          </a>
       
        <?php
        }
        ?>
         </div>
        <div class="p-tab-content w-tab-pane hide" id="books-container">
        <?php 
        showError('post_img');
        if(count($display_books)<1){
            echo "<p style='width:93vw' class='heading-2'>Follow Someone or Add a new book</p>";
        }

        foreach($display_books as $book_details){
        ?>

          <div class="book-card tab-details">
            <div class="book-thumbnail">
              <img src="assets/images/book-cover/<?=$book_details['bcover']?>"   loading="lazy" width="Auto" height="200" alt="" class="image"/>
            </div>
            <div class="book-details">
              <div class="book-title-container">
                <h1 class="book-title"><?=$book_details['btitle']?></h1>
                <p class="pcm-text pcm-username"><?=$book_details['btag']?></p>
              </div>
              <div class="book-description">
                <a class="book-description-text">
                <?=$book_details['babout']?>
                </a>
              </div>
              <div class="bd-bottom">
                <a href="#" class="primery-button">Read Now</a>
                <div class="post-details">
                  <p class="pcm-text pcm-username">U/<?=$book_details['username']?></p>
                  <p class="pcm-text"><?=$book_details['bdate']?></p>
                </div>
              </div>
            </div>
          </div>

          <?php
        }
          ?>
        </div>
      </div>
    </div>