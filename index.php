
<?php
// showing page dynamically
require_once 'function.php';
//user variable thi editprogile ma user ni pic get karava
if(isset($_SESSION['Auth'])){
    $user=getUser($_SESSION['userdata']['id']);
    $post=filterPost();
    $follow_suggestion=filterFollowSuggetions();
}
if(isset($_SESSION['Auth'])){
    showPage('header',['page_title'=>'aroma-home']);
    showPage('navbar');
    showPage('home');
}
elseif(isset($_SESSION['Auth']) && isset($_GET['editprofile'])){
    showPage('header',['page_title'=>'editprogile']);
    showPage('navbar');
    showPage('editprofile');
}
elseif(isset($_SESSION['Auth']) && isset($_GET['u'])){
    $profile=getUserByUsername($_GET['u']);
    if(!$profile){
        showPage('header',['page_title'=>'user not found']);
        showPage('user_not_found');
        showPage('navbar');
    }else{
        $profile_post=getPostById($profile['id']);
        $profile['followers']=getFollower($profile['id']);
        $profile['following']=getFollowing($profile['id']);
        showPage('header',['page_title'=>$profile['first_name'].' '.$profile['last_name']]);
        showPage('navbar');
        showPage('profile');
    }
   
}
elseif(isset($_GET['signup'])){
 showPage('header',['page_title'=>'aroma-signup']);
 showPage('signup');
}
elseif(isset($_GET['login'])){
    showPage('header',['page_title'=>'aroma-login']);
    showPage('login');
}
else{
    if(isset($_SESSION['Auth'])){
        showPage('header',['page_title'=>'aroma-home']);
        showPage('navbar');
        showPage('home');
    }
    else{
        showPage('header',['page_title'=>'aroma-login']);
        showPage('login');
    }
}
//footer is common for all page
showPage('footer');
//referes karvathi error vai jai
unset($_SESSION['error']);
//page copy karvathi data vayo jai
unset($_SESSION['formdata']);

//logout button code for navbar
echo "<a href='action.php'>logout</a>"
 ?>