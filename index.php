<?php
require_once 'assets/php/function.php';
if (isset($_SESSION['auth'])) {
    $user = getUser($_SESSION['userdata']['uid']);
    $posts = filterPosts();
    $books = filterBooks();
    $followSuggestions = filterFollowSuggestion();
}
//open register page
if (isset($_GET['register'])) {
    showPage('header', ['page_title' => 'aroma-register']);
    showPage('register');
}
//open log-in if get is open
elseif (isset($_GET['login'])) {
    if(isset($_SESSION['formdata']) && !isset($_SESSION['formdata']['username_email'])){
        unset($_SESSION['formdata']);
    }
    showPage('header', ['page_title' => 'aroma-Log-In']);
    showPage('login');
}elseif (isset($_GET['change-password'])) {
    showPage('side-bar');
    showPage('header', ['page_title' => 'change password']);
    showPage('change-password');
} elseif (isset($_GET['u']) && isset($_SESSION['auth'])) {
    $profile = getUserByUsername($_GET['u']);
    $profile_post = getPostById($profile['uid']);
    $profile_books = getBookById($profile['uid']);
    $profile['followers'] = getFollowers($profile['uid']);
    $profile['following'] = getFollowing($profile['uid']);
    showPage('header', ['page_title' => $profile['username']]);
    showPage('side-bar');
    showPage('profile-section');
} elseif (isset($_GET['post']) && isset($_SESSION['auth'])) {
    $post_data = getSinglePost($_GET['post']);
    showPage('header', ['page_title' => 'post']);
    showPage('casual-post-section');
    showPage('side-bar');
} elseif (isset($_GET['book']) && isset($_SESSION['auth'])) {
    $book_data = getSingleBook($_GET['book']);
    showPage('header', ['page_title' => 'post']);
    showPage('book-section');
    showPage('side-bar');
} elseif (isset($_GET['post-wall']) && isset($_SESSION['auth'])) {
    showPage('header', ['page_title' => 'Main wall']);
    showPage('side-bar');
    showPage('right-bar');
    showPage('top');
    showPage('post-wall');
} elseif (isset($_GET['create-post']) && isset($_SESSION['auth'])) {
    showPage('header', ['page_title' => 'Create post']);
    showPage('side-bar');
    showPage('create-post');
} elseif (isset($_GET['create-book']) && isset($_SESSION['auth'])) {
    showPage('header', ['page_title' => 'Create Book']);
    showPage('side-bar');
    showPage('create-book');
} elseif (isset($_GET['edit-profile']) && isset($_SESSION['auth'])) {
    showPage('header', ['page_title' => 'Edit Profile']);
    showPage('side-bar');
    showPage('edit-profile');
} elseif(isset($_GET['search']) && isset($_SESSION['auth'])) {
    $seachedposts = searchPost($_GET['search']);
    $seachedbooks = searchBook($_GET['search']);
    $seachedusers = searchUser($_GET['search']);
    showPage('header', ['page_title' => 'Main wall']);
    showPage('side-bar');
    showPage('right-bar');
    showPage('top');
    showPage('post-wall');
 }elseif(isset($_GET['adminpanel']) && isset($_SESSION['auth']) && $_SESSION['userdata']['is_admin']==1) {
    $userlist= getAllUsers();
    $postlist= getPost();
    $booklist= getBook();
    $reportlist= getReport();
    showPage('header', ['page_title' => 'Main wall']);
    showPage('side-bar');
    showPage('admin-panel');
}
 else {
    if (isset($_SESSION['auth'])) {
        showPage('header', ['page_title' => 'Main wall']);
        showPage('side-bar');
        showPage('top');
        showPage('post-wall');
        showPage('right-bar');
    } else {
        showPage('header', ['page_title' => 'aroma-Log-In']);
        showPage('login');
    }
}
 showPage('footer');
unset($_SESSION['error']);
?>