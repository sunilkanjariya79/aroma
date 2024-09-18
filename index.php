<?php
require_once 'assets/php/function.php';

if(isset($_SESSION['Auth'])){
    $user = getUser($_SESSION['uid']);
}
//open register page
if(isset($_GET['register'])){
showPage('header',['page_title'=>'aroma-register']);
showPage('register');
}
//open log-in if get is open
elseif(isset($_GET['login'])){
    showPage('header',['page_title'=>'aroma-Log-In']);
    showPage('login');
}
elseif(isset($_GET['profile-section']) && isset($_SESSION['auth'])){
    showPage('header',['page_title'=>'profile page']);
    showPage('profile-section');
    showPage('side-bar');
}

elseif(isset($_GET['post-wall']) && isset($_SESSION['auth'])){
    showPage('header',['page_title'=>'Main wall']);
    showPage('side-bar');
    showPage('right-bar');
    showPage('top');
    showPage('post-wall');
}


elseif(isset($_GET['edit-profile']) && isset($_SESSION['auth'])){
    showPage('header',['page_title'=>'Edit Profile']);
    // showPage('side-bar');
    showPage('edit-profile');
}
else{
        if(isset($_SESSION['Auth'])){
        showPage('header',['page_title'=>'Main wall']);
        showPage('navbar');
        showPage('wall');
        }else{
            showPage('header',['page_title'=>'aroma-Log-In']);
            showPage('login');
        }
    }

showPage('footer');
unset($_SESSION['error'])
?>
