<?php
global $user; 
global $posts;
global $follow_suggestions;
//any post mate
<?php
showError('post_img');
foreach($posts as $post){
    $likes=getLikes($post['id']);
    $comments=getComment($post['id']);
?>
    <div class="card">
        //user profile photo annd name dynamically
        <img src="iamges/<?=$post['profile_pic']?>" alt="" srcset=""><?=$post['firstname']?><?=$post['lastname']?>
        //post image and text dynamically
        <img src="images/post/<?=$post['post_img']?>" alt="">
        if($post('post_text')){
            ?>
            <div class="any text">
            <?=$post['post_text']?>
            </div>
            <?php
        }
      //like button
      <span>
      <?php
      if(checkLikeStatus($post['id'])){
        $like_btn_display='none';
        $unlike_btn_display='';
      }else{
        $like_btn_display='';
        $unlike_btn_display='none';
      }
        
      
      ?>
      <i class="bi-heart-fill unlike_btn"  style="diplay:<?=$unlike_btn_display?>" data-post-id='<?=$post['id']?>'>like</i> 
      <i class="bi-heart-fill unlike_btn" style="diplay:<?=$like_btn_display?>" data-post-id='<?=$post['id']?>'>like</i> 
}</span>
<small><?=count($likes)?>likes</small>//count the likes
<small><?=count($comments)?>comments</small>//count the likes

//follower suggestion images username
<?php
foreach($follow_suggestions as $suser){
    ?>
    <img src="images/profile/<?=suser['profile_pic']?>" alt="">//follow user profile
    <div class="followername"><?=suser['first_name']?></div>
    <div class="username"><?=suser['username']?></div>
    <button class="followbtn"data-user-id='<?$suser['id']?>'>follow</button>
    <?php

}
if(count($follow_suggestions)<1){
    echo "currently no user suggetions";
}
?>