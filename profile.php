<?php
global $profile;
global $profile_post;
global $user;
<form action="">
<img src="images/profile/<?$profile['profile_pic']?>" alt="">
<?$profile['username']?>//same as image
<?$profile['name']?>//same as image
//total post following follower dynnamically
<a class="post"><?=count($profile_post)?>posts</a>
<a class="follower" data-bs-toggle="modal" data-bs-target="#follower_list">><?=count($profile['followers'])?>followers</a>
<a class="following" data-bs-toggle="modal" data-bs-target="#following_list">><?=count($profile['following'])?>following</a>
//jo khud ni profile khole to unfollow button na dekhai
<?php
if($user['id']!=$profile['id']){
    ?>
    <div class="d-flex">
    <?php
        if(checkFollowStatus($profile['id'])){
            ?>
            <button class="unfollowbtn" data-user-id='<?=$profile['id']?>' >unfollow</button>
            <?php
            else{
                ?>
                <button class="followbtn" data-user-id='<?=$profile['id']?>' >follow</button>
                <?php
            }
        }
    ?>
    </div>
    <?php
}
?>//same for a drop down list in block mate

//post ne loop ma chalava mate jethi badhi post dekhai
<?php
foreach($profile_post as $post){
?>
<img src="images/post/<?$post['post_img']?>" alt="">
<?php
}
</form>
?>



//this is for follwer list
//create modal for follwer list
//modal id=follower_list
<?php//niche no code modal ni body ma lakhavano
foreach($profile['followers'] as $f){
    $fuser=getUser($f['follower_id']);
    $fbtn='';
    if(checkFollowStatus($f['follower_id'])){
        <button class="unfollowbtn"data-user-id='<?$fuser['id']?>'>unfollow</button>
    }
    else if($user['id']==$f['follower_id']){
        $fbtn='';
    }
    else{
        <button class="followbtn"data-user-id='<?$fuser['id']?>'>follow</button>
    }
    ?>
    //wall page maathi niche no code lidho
    <img src="images/profile/<?=fuser['profile_pic']?>" alt="">//follow user profile
    <div class="followername"><?=fuser['first_name']?></div>
    <div class="username"><?=fuser['username']?></div>
    <div class="btn">
    <?$=fbtn?>
    </div>
    <?php

}
?>


//create modal for follweing list
<?php//niche no code modal ni body ma lakhavano
//modal id=following_list
foreach($profile['followering'] as $f){
    $fuser=getUser($f['user_id']);
    $fbtn='';
    if(checkFollowStatus($f['user_id'])){
        <button class="unfollowbtn"data-user-id='<?$fuser['id']?>'>unfollow</button>
    }
    else if($user['id']==$f['user_id']){
        $fbtn='';
    }
    else{
        <button class="followbtn"data-user-id='<?$fuser['id']?>'>follow</button>
    }
    ?>

    //comment
$comment=getComment($post['id']);
if(count($comments)<1){
  ?>
  <p class="nce">no comments</p>
  <?php
}
foreach($comments as $comment){
  $cuser=getUser($comment['user_id']);
  ?>
  <img src="profile/<?=$cuser['profile_pic']?>" alt="">
  <h4 name="username"><?=$cuser['username']?></h4>
  <p><?=$comment['comment']?></p>
  <?php
}
    //wall page maathi niche no code lidho
    <img src="images/profile/<?=fuser['profile_pic']?>" alt="">//follow user profile
    <div class="followername"><?=fuser['first_name']?></div>
    <div class="username"><?=fuser['username']?></div>
    <div class="btn">
    <?$=fbtn?>
    </div>
    <?php

}
?>