<?php
require_once 'conn.php';
//functio for show pages
function showPage($page, $data = "")
{
    include("assets/pages/$page.php");
}
function checkSpecialCharacters($value)
{
    return preg_match('/^[a-zA-Z0-9_]+$/', $value) === 1;
}
//for validating register form
function validateRegisterForm($form_data, $image_data)
{
    $response = array();
    $response['status'] = true;
    if (!$form_data['upassword']) {
        $response['msg'] = "password is not given";
        $response['status'] = false;
        $response['field'] = 'upassword';
    }
    if (!$form_data['uabout']) {
        $response['msg'] = "user about is not given";
        $response['status'] = false;
        $response['field'] = 'uabout';
    }
    if (!$form_data['username']) {
        $response['msg'] = "username is not given";
        $response['status'] = false;
        $response['field'] = 'username';
    }
    if (!checkSpecialCharacters($form_data['username'])) {
        $response['msg'] = "username can not contain special character other than _";
        $response['status'] = false;
        $response['field'] = 'username';
    }
    if (!$form_data['uname']) {
        $response['msg'] = " name is not given";
        $response['status'] = false;
        $response['field'] = 'uname';
    }
    if (!$form_data['umail']) {
        $response['msg'] = "Email is not given";
        $response['status'] = false;
        $response['field'] = 'umail';
    }
    if (isEmailRegistered($form_data['umail'])) {
        $response['msg'] = "Email is already register";
        $response['status'] = false;
        $response['field'] = 'umail';
    }
    if (isUsernameRegistered($form_data['username'])) {
        $response['msg'] = "username is already register";
        $response['status'] = false;
        $response['field'] = 'username';
    }
    if ($image_data['name']) {
        $image = basename($image_data['name']);
        $type = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $size = $image_data['size'] / 1000;
        if ($type != 'jpg' && $type != 'jpeg' && $type != 'png') {
            $response['msg'] = "only jpg,jpeg,png images are allowed";
            $response['status'] = false;
            $response['field'] = 'profile_pic';
        }
        if ($size > 5000) {
            $response['msg'] = "upload image less then 5 mb";
            $response['status'] = false;
            $response['field'] = 'profile_pic';
        }
    }
    return $response;
}
//for managing login form
function validateLoginForm($form_data)
{
    $response = array();
    $response['status'] = true;
    $blank = false;
    if (!$form_data['upassword']) {
        $response['msg'] = "password is not given";
        $response['status'] = false;
        $response['field'] = 'upassword';
        $blank = true;
    }
    if (!$form_data['username_email']) {
        $response['msg'] = "username/email is not given";
        $response['status'] = false;
        $response['field'] = 'username_email';
        $blank = true;
    }
    if (!$blank && !checkUser($form_data)['status']) {
        $response['msg'] = "something is wrong";
        $response['status'] = false;
        $response['field'] = 'checkuser';
    } else {
        $response['user'] = checkUser($form_data)['user'];
    }
    return $response;
}
//for checking a user
function checkUser($login_data)
{
    global $db;
    $username_email = $login_data['username_email'];
    $password = $login_data['upassword'];
    $query = "select * from users where (umail='" . $username_email . "' || username='" . $username_email . "') && upassword='" . $password . "'";
    $run = mysqli_query($db, $query);
    $data['user'] = mysqli_fetch_assoc($run);
    if ($data['user'] > 0) {
        $data['status'] = true;
    } else {
        $data['status'] = false;
    }
    return $data;
}
//for getting userdata by id
function getUser($uid)
{
    global $db;
    $query = "SELECT * FROM users WHERE uid=" . $uid;
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run);
}
//function for follow the user
function followUser($user_id)
{
    global $db;
    $cu = getUser($_SESSION['userdata']['uid']);
    $current_user = $_SESSION['userdata']['uid'];
    $query = "insert into follower (uid,follower) values('" . $user_id . "','" . $current_user . "')";
    createNotification($cu['uid'], $user_id, "started following you !");
    return mysqli_query($db, $query);
}
function unfollowUser($user_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "DELETE FROM follower WHERE follower=$current_user and uid=$user_id";
    deleteNotification($current_user, $user_id, 0, 0);
    return mysqli_query($db, $query);
}
//for filtering the suggestion list
function filterFollowSuggestion()
{
    $list = getFollowSuggestions();
    $filter_list = array();
    foreach ($list as $user) {
        if (!checkBlockStatus($user['uid'], $_SESSION['userdata']['uid'])) {
            if (!checkFollowStatus($user['uid']) && count($filter_list) < 10) {
                $filter_list[] = $user;
            }
        }
    }
    return $filter_list;
}
//for checking the user is followed by current user or not
function checkFollowStatus($user_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "SELECT count(*) as r FROM follower WHERE follower=" . $current_user . " && uid=" . $user_id;
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['r'];
}
// for getting follow suggestions
function getFollowSuggestions()
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "SELECT * FROM users WHERE uid!=" . $current_user . " LIMIT 10";
    $run = mysqli_query($db, $query) or die(mysqli_error($db));
    return mysqli_fetch_all($run, true);
}
function getAllUsers()
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "SELECT * FROM users WHERE uid!=" . $current_user;
    $run = mysqli_query($db, $query) or die(mysqli_error($db));
    return mysqli_fetch_all($run, true);
}
//get followers count
function getFollowers($uid)
{
    global $db;
    $query = "SELECT * FROM follower WHERE uid=" . $uid;
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run);
}
//get following count
function getFollowing($uid)
{
    global $db;
    $query = "SELECT * FROM follower WHERE  follower=" . $uid;
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run);
}
//for getting userdata by username
function getUserByUsername($username)
{
    global $db;
    $query = "SELECT * FROM users WHERE username='" . $username . "'";
    $run = mysqli_query($db, $query);
    $u = mysqli_fetch_assoc($run);
    if (!empty($u)) {
        return $u;
    } else {
        showPage('header', ['page_title' => 'Main wall']);
        showPage('404');
        exit;
    }
}
//function for blocking the user
function blockUser($blocked_user_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "INSERT INTO block(blocker,uid) VALUES(" . $current_user . "," . $blocked_user_id . ")";
    $query2 = "DELETE FROM follower WHERE follower=$current_user && uid=$blocked_user_id";
    mysqli_query($db, $query2);
    $query3 = "DELETE FROM follower WHERE follower=$blocked_user_id && uid=$current_user";
    mysqli_query($db, $query3);
    return mysqli_query($db, $query);
}
//for unblocking the user
function unblockUser($user_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "DELETE FROM block WHERE blocker=" . $current_user . " and uid=" . $user_id;
    return mysqli_query($db, $query);
}

//for checking the user is followed by current user or not
function checkBlockStatus($current_user, $user_id)
{
    global $db;
    $query = "SELECT count(*) as r FROM block WHERE blocker=" . $current_user . " && uid=" . $user_id;
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['r'];
}
//to check the block status
function checkBS($user_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "SELECT count(*) as r FROM block WHERE (blocker=" . $current_user . " && uid=" . $user_id . ") || (blocker=" . $user_id . " && uid=" . $current_user . ")";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['r'];
}
//for getting posts by id
function getPostById($uid)
{
    global $db;
    $query = "SELECT casual_post.pid,casual_post.ptitle,casual_post.pcontent, casual_post.ptag, casual_post.pdate,users.uname,users.username, users.uprofile_photo,users.uid from casual_post join users on users.uid=casual_post.uid WHERE users.uid=" . $uid . " ORDER BY casual_post.pid DESC";
    $run = mysqli_query($db, $query) or die(mysqli_error($db));
    return mysqli_fetch_all($run, true);
}
//to get single post
function getSinglePost($pid)
{
    global $db;
    $query = "SELECT casual_post.pid,casual_post.ptitle,casual_post.pcontent, casual_post.ptag, casual_post.pdate,users.uname,users.username, users.uprofile_photo,users.uid from casual_post join users on users.uid=casual_post.uid WHERE casual_post.pid=" . $pid;
    $run = mysqli_query($db, $query) or die(mysqli_error($db));
    return mysqli_fetch_all($run, true);
}
//to get single book info
function getSingleBook($bid)
{
    global $db;
    $query = "SELECT book_post.bid,book_post.btitle,book_post.bcontent,book_post.babout, book_post.btag, book_post.bdate,book_post.bcover,users.uname,users.username ,users.uprofile_photo, users.uid from book_post join users on users.uid=book_post.uid WHERE book_post.bid=" . $bid;
    $run = mysqli_query($db, $query) or die(mysqli_error($db));
    return mysqli_fetch_all($run, true);
}
//to get book's information based on user id
function getBookById($uid)
{
    global $db;
    $query = "SELECT book_post.bid,book_post.btitle,book_post.bcontent,book_post.babout, book_post.btag, book_post.bdate,book_post.bcover,users.uname,users.username from book_post join users on users.uid=book_post.uid WHERE users.uid=" . $uid . " ORDER BY book_post.bid DESC";
    $run = mysqli_query($db, $query) or die(mysqli_error($db));
    return mysqli_fetch_all($run, true);
}

//function for show error
function showError($field)
{
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        if (isset($error['field']) && $field == $error['field']) {
            ?>
            <div class="errormsg"><?= $error['msg'] ?></div>
            <?php
        }
    }
}
//function for showing pervious form data
function showFormaData($field)
{
    if (isset($_SESSION['formdata'])) {
        $formdata = $_SESSION['formdata'];
        return $formdata[$field];
    }
}
//for checking dublicate email
function isEmailRegistered($email)
{
    global $db;
    $query = "select count(*) as 'row' from users where umail='" . $email . "'";
    $run = mysqli_query($db, $query);
    if (!$run) {
        echo "Query error: " . mysqli_error($db);
    }
    $return_data = mysqli_fetch_array($run);
    return $return_data['row'];
}
//for checking dublicate username
function isUsernameRegistered($username)
{
    global $db;
    $query = "select count(*) as 'row' from users where  username='$username'";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}
//for checking duplicate username by other
function isUsernameRegisteredByOther($username)
{
    global $db;
    $user_id = $_SESSION['userdata']['uid'];
    $query = "select count(*) as 'row' from users where  username='$username' && uid !=$user_id";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}
//for creating user
function createuser($data, $image_data)
{
    global $db;
    $umail = mysqli_real_escape_string($db, $data['umail']);
    $uname = mysqli_real_escape_string($db, $data['uname']);
    $username = strtolower(mysqli_real_escape_string($db, $data['username']));
    $gender = mysqli_real_escape_string($db, $data['gender']);
    $uabout = mysqli_real_escape_string($db, $data['uabout']);
    $udate = mysqli_real_escape_string($db, $data['udate']);
    $upassword = mysqli_real_escape_string($db, $data['upassword']);
    $profile_pic = "profile.jpeg";
    if ($image_data['name']) {
        $image_name = time() . basename($image_data['name']);
        $image_dir = "../images/profile/$image_name";
        move_uploaded_file($image_data['tmp_name'], $image_dir);
        $profile_pic = $image_name;
    }
    $query = "insert into users(uprofile_photo,umail,uname,username,gender,uabout,udate,upassword) values('" . $profile_pic . "','" . $umail . "','" . $uname . "','" . $username . "','" . $gender . "','" . $uabout . "','" . $udate . "','" . $upassword . "')";
    return mysqli_query($db, $query) or die(mysqli_error($db));
}
//deleting user
function deleteUser($uid)
{
    global $db;
    $delete_comments = "DELETE FROM comments WHERE uid=" . intval($uid);
    mysqli_query($db, $delete_comments);
    $select_casual_posts = "SELECT pid FROM casual_post WHERE uid=" . intval($uid);
    $result = mysqli_query($db, $select_casual_posts);
    while ($row = mysqli_fetch_assoc($result)) {
        deletePost($row['pid']); // Call the function to delete each post
    }
    $select_book_posts = "SELECT bid FROM book_post WHERE uid=" . intval($uid);
    $result = mysqli_query($db, $select_book_posts);
    while ($row = mysqli_fetch_assoc($result)) {
        deleteBook($row['bid']);
    }
    $delete_likes = "DELETE FROM likes WHERE uid=" . intval($uid);
    mysqli_query($db, $delete_likes);
    $delete_messages = "DELETE FROM messages WHERE from_user_id=" . intval($uid) . " OR to_user_id=" . intval($uid);
    mysqli_query($db, $delete_messages) or die(mysqli_error($db));
    $delete_notification = "DELETE FROM notification WHERE from_user_id=" . intval($uid) . " OR to_user_id=" . intval($uid);
    mysqli_query($db, $delete_notification) or die(mysqli_error($db));
    $delete_followers = "DELETE FROM follower WHERE uid=" . intval($uid) . " OR follower =" . intval($uid);
    mysqli_query($db, $delete_followers);
    $file = "select uprofile_photo from users where uid=" . intval($uid);
    $delfile = mysqli_query($db, $file) or die(mysqli_error($db));
    $filename = mysqli_fetch_assoc($delfile);
    if ($filename['uprofile_photo'] != "profile.jpeg") {
        deleteFile("../images/profile", $filename['uprofile_photo']);
    }
    $delete_user = "DELETE FROM users WHERE uid=" . intval($uid);
    if (mysqli_query($db, $delete_user)) {
        return true;
    } else {
        return false;
    }

}

//for validating update form
function validateUpdateForm($form_data, $image_data)
{
    $response = array();
    $response['status'] = true;
    if (!$form_data['uabout']) {
        $response['msg'] = "About is not given";
        $response['status'] = false;
        $response['field'] = 'uabout';
    }
    if (!$form_data['username']) {
        $response['msg'] = "username is not given";
        $response['status'] = false;
        $response['field'] = 'username';
    }
    if (!$form_data['uname']) {
        $response['msg'] = "name is not given";
        $response['status'] = false;
        $response['field'] = 'name';
    }
    if (isUsernameRegisteredByOther($form_data['username'])) {
        $response['msg'] = $form_data['username'] . " is already registered";
        $response['status'] = false;
        $response['field'] = 'username';
    }
    if ($image_data['name']) {
        $image = basename($image_data['name']);
        $type = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $size = $image_data['size'] / 1000;
        if ($type != 'jpg' && $type != 'jpeg' && $type != 'png') {
            $response['msg'] = "only jpg,jpeg,png images are allowed";
            $response['status'] = false;
            $response['field'] = 'profile_pic';
        }
        if ($size > 5000) {
            $response['msg'] = "upload image less then 5 mb";
            $response['status'] = false;
            $response['field'] = 'profile_pic';
        }
    }
    return $response;
}

//for validating update password
function validateUpdatePass($form_data)
{
    $response = array();
    $response['status'] = true;
    $userdata['username_email'] = $_SESSION['userdata']['username'];
    $userdata['upassword'] = $_POST['oldpass'];
    $blank = false;
    if (!$form_data['oldpass']) {
        $response['msg'] = "Enter Old password please";
        $response['status'] = false;
        $response['field'] = 'oldpass';
        $blank = true;
    }
    if (!$form_data['newpass']) {
        $response['msg'] = "Enter new password please";
        $response['status'] = false;
        $response['field'] = 'newpass';
        $blank = true;
    }
    if (!$blank && !checkUser($userdata)['status']) {
        $response['msg'] = "old password does not match";
        $response['status'] = false;
        $response['field'] = 'oldpass';
    } else {
        updatePassword($_POST);
    }
    return $response;
}
//function for updating profile
function updateProfile($data, $imagedata)
{
    global $db;
    $name = mysqli_real_escape_string($db, $data['uname']);
    $about = mysqli_real_escape_string($db, $data['uabout']);
    $username = mysqli_real_escape_string($db, $data['username']);
    $profile_pic = "";
    if ($imagedata['name']) {
        $image_name = time() . basename($imagedata['name']);
        $image_dir = "../images/profile/$image_name";
        move_uploaded_file($imagedata['tmp_name'], $image_dir);
        $profile_pic = ", uprofile_photo='$image_name'";
    }
    $query = "UPDATE users SET uname = '" . $name . "', uabout='" . $about . "',username='" . $username . "'" . $profile_pic . "WHERE uid=" . $_SESSION['userdata']['uid'];
    return mysqli_query($db, $query);
}

//function for updating password
function updatePassword($data)
{
    global $db;
    $password = mysqli_real_escape_string($db, $data['newpass']);
    $query = "UPDATE users SET upassword = '" . $password . "' WHERE uid=" . $_SESSION['userdata']['uid'];
    return mysqli_query($db, $query);
}
//for post
function validatePostDetails($post_data)
{
    $response = array();
    $response['status'] = true;
    if (!$post_data['hidden-input']) {
        $response['msg'] = "you don't have any text to post here";
        $response['status'] = false;
        $response['field'] = 'hidden-input';
    }
    if (!$post_data['tag']) {
        $response['msg'] = "Please add Tag";
        $response['status'] = false;
        $response['field'] = 'tag';
    }
    if (!$post_data['title']) {
        $response['msg'] = "Please add Title";
        $response['status'] = false;
        $response['field'] = 'title';
    }
    return $response;
}
//for book
function validateBookDetails($book_data, $image_data)
{
    $response = array();
    $response['status'] = true;
    if (!$book_data['hidden-input']) {
        $response['msg'] = "you don't have any text to post here";
        $response['status'] = false;
        $response['field'] = 'hidden-input';
    }
    if (!$book_data['babout']) {
        $response['msg'] = "Please add Tag";
        $response['status'] = false;
        $response['field'] = 'babout';
    }
    if (!$book_data['btag']) {
        $response['msg'] = "Please add Tag";
        $response['status'] = false;
        $response['field'] = 'btag';
    }
    if (!$book_data['btitle']) {
        $response['msg'] = "Please add Title";
        $response['status'] = false;
        $response['field'] = 'btitle';
    }
    if (!$image_data['name']) {
        $response['msg'] = "no image is selected";
        $response['status'] = false;
        $response['field'] = 'bcover';
    }
    if ($image_data['name']) {
        $image = basename($image_data['name']);
        $type = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $size = $image_data['size'] / 1000;
        if ($type != 'jpg' && $type != 'jpeg' && $type != 'png') {
            $response['msg'] = "only jpg,jpeg,png images are allowed";
            $response['status'] = false;
            $response['field'] = 'bcover';
        }
        if ($size > 5000) {
            $response['msg'] = "upload image less then 1 mb";
            $response['status'] = false;
            $response['field'] = 'bcover';
        }
    }
    return $response;
}
//for creating new post
function createPost($post)
{
    global $db;
    $title = mysqli_real_escape_string($db, $post['title']);
    $tag = mysqli_real_escape_string($db, $post['tag']);
    $post_content = $post['hidden-input'];
    $user_id = $_SESSION['userdata']['uid'];
    $randomFileName = uniqid() . '.html';
    $filePath = '../post_data/casual/' . $randomFileName;
    if (file_put_contents($filePath, $post_content)) {
        $query = "insert into casual_post (uid,ptitle,ptag,pcontent) values(" . $user_id . ",'" . $title . "','" . $tag . "','" . $randomFileName . "')";
        return mysqli_query($db, $query) or die(mysqli_error($db));
    } else {
        print_r("not done");
    }
}
//for creating new book
function createBook($post, $image)
{
    global $db;
    $title = mysqli_real_escape_string($db, $post['btitle']);
    $tag = mysqli_real_escape_string($db, $post['btag']);
    $about = mysqli_real_escape_string($db, $post['babout']);
    $post_content = $post['hidden-input'];
    $user_id = $_SESSION['userdata']['uid'];
    $image_name = time() . basename($image['name']);
    $image_dir = "../images/book-cover/$image_name";
    move_uploaded_file($image['tmp_name'], $image_dir);
    $randomFileName = uniqid() . '.html';
    $filePath = '../post_data/books/' . $randomFileName;
    if (file_put_contents($filePath, $post_content)) {
        $query = "insert into book_post (uid,btitle,btag,babout,bcover,bcontent) values(" . $user_id . ",'" . $title . "','" . $tag . "','" . $about . "','" . $image_name . "','" . $randomFileName . "')";
        return mysqli_query($db, $query) or die(mysqli_error($db));
    } else {
        print_r("not done");
    }
}
//for getting posts
function getPost()
{
    global $db;
    $query = "SELECT casual_post.pid,casual_post.ptitle,casual_post.pcontent, casual_post.ptag, casual_post.pdate,users.uname,users.username, users.uid from casual_post join users on users.uid=casual_post.uid ORDER BY casual_post.pid DESC";
    $run = mysqli_query($db, $query);
    if (!$run) {
        die("Query Failed: " . mysqli_error($db));
    }
    return mysqli_fetch_all($run, true);
}
//for getting posts dynamically
function filterPosts()
{
    $list = getPost();
    $filter_list = array();
    foreach ($list as $post) {
        if (checkFollowStatus($post['uid']) || $post['uid'] == $_SESSION['userdata']['uid']) {
            $filter_list[] = $post;
        }
    }
    return $filter_list;
}
//to display content of post in short
function getPostContentWithoutFormating($post_file)
{
    $file_path = 'assets/post_data/casual/' . $post_file;
    $html_content = file_get_contents($file_path);
    if (preg_match('/<[^>]+>/', $html_content)) {
        $clean_content = strip_tags($html_content);
        return $clean_content;
    }
    return $html_content;
}
//get's the content of html file of post
function getPostContent($post_file)
{
    $file_path = 'assets/post_data/casual/' . $post_file;
    $html_content = file_get_contents($file_path);
    return $html_content;
}
//get's list of books
function getBook()
{
    global $db;
    $query = "SELECT book_post.bid,book_post.btitle,book_post.bcontent,book_post.babout, book_post.btag, book_post.bdate,book_post.bcover,users.uname,users.username, users.uprofile_photo, users.uid from book_post join users on users.uid=book_post.uid ORDER BY book_post.bid DESC";
    $run = mysqli_query($db, $query);
    if (!$run) {
        die("Query Failed: " . mysqli_error($db));
    }
    return mysqli_fetch_all($run, true);
}
function getReport()
{
    global $db;
    $query = "select report.*,users.username from report join users on report.reporter_id=users.uid";
    $run = mysqli_query($db, $query);
    if (!$run) {
        die("" . mysqli_error($db));
    }
    return mysqli_fetch_all($run, true);
}
//for getting posts dynamically
function filterBooks()
{
    $list = getBook();
    $filter_list = array();
    foreach ($list as $book) {
        if (checkFollowStatus($book['uid']) || $book['uid'] == $_SESSION['userdata']['uid']) {
            $filter_list[] = $book;
        }
    }
    return $filter_list;
}
//get's html content of book post
function getBookContent($post_file)
{
    $file_path = 'assets/post_data/books/' . $post_file;
    $html_content = file_get_contents($file_path);
    return $html_content;
}
//check if current user has already liked this post
function checkPostLikeStatus($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "SELECT count(*) as r FROM likes WHERE uid=" . $current_user . " and lpost=" . $post_id;
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['r'];
}
//check if current user has already liked this book
function checkBookLikeStatus($book_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "SELECT count(*) as r FROM likes WHERE uid=" . $current_user . " and lbook=" . $book_id;
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['r'];
}
//to like the post
function likePost($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "INSERT INTO likes(lpost,uid) VALUES(" . $post_id . "," . $current_user . ")";
    $poster_id = getPosterId($post_id, 0);
    if ($poster_id != $current_user) {
        createNotification($current_user, $poster_id, "liked your post !", $post_id, 0);
    }
    return mysqli_query($db, $query);
}
//to get all the likes of single post
function getPostLikes($post_id)
{
    global $db;
    $query = "SELECT * FROM likes WHERE lpost=" . $post_id;
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
//to unlike the post
function unlikePost($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "DELETE FROM likes WHERE uid=" . $current_user . " and lpost=" . $post_id;
    $poster_id = getPosterId($post_id, 0);
    deleteNotification($current_user, $poster_id, $post_id, 0);
    return mysqli_query($db, $query);
}
//to like book
function likebook($book_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "INSERT INTO likes(lbook,uid) VALUES(" . $book_id . "," . $current_user . ")";
    $poster_id = getPosterId(0, $book_id);
    if ($poster_id != $current_user) {
        createNotification($current_user, $poster_id, "liked your post !", 0, $book_id);
    }
    return mysqli_query($db, $query);
}
//to get likes of single book
function getBookLikes($book_id)
{
    global $db;
    $query = "SELECT * FROM likes WHERE lbook=" . $book_id;
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
//to unlike a book
function unlikeBook($book_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "DELETE FROM likes WHERE uid=" . $current_user . " and lbook=" . $book_id;
    $poster_id = getPosterId(0, $book_id);
    deleteNotification($current_user, $poster_id, 0, $book_id);
    return mysqli_query($db, $query);
}
//function for creating comments
function addPostComment($post_id, $comment)
{
    global $db;
    $comment = mysqli_real_escape_string($db, $comment);
    $current_user = $_SESSION['userdata']['uid'];
    $query = "INSERT INTO comments (uid,cpost,c_content) VALUES(" . $current_user . "," . $post_id . ",'" . $comment . "')";
    $poster_id = getPosterId($post_id, 0);
    if ($poster_id != $current_user) {
        createNotification($current_user, $poster_id, "commented on your post", $post_id, 0);
    }
    return mysqli_query($db, $query) or die(mysqli_error($db));
}
//to get comments of a post
function getPostComments($post_id)
{
    global $db;
    $query = "SELECT comments.*, users.username,users.uprofile_photo,users.uname FROM comments join users on comments.uid=users.uid WHERE cpost=" . $post_id . " ORDER BY cdate DESC";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
//to add comment to book
function addBookComment($book_id, $comment)
{
    global $db;
    $comment = mysqli_real_escape_string($db, $comment);
    $current_user = $_SESSION['userdata']['uid'];
    $query = "INSERT INTO comments (uid,cbook,c_content) VALUES(" . $current_user . "," . $book_id . ",'" . $comment . "')";
    $poster_id = getPosterId(0, $book_id);
    if ($poster_id != $current_user) {
        createNotification($current_user, $poster_id, "commented on your post", 0, $book_id);
    }
    return mysqli_query($db, $query) or die(mysqli_error($db));
}
//to get comments of book
function getBookComments($book_id)
{
    global $db;
    $query = "SELECT comments.*, users.username,users.uprofile_photo,users.uname FROM comments join users on comments.uid=users.uid WHERE cbook=" . $book_id . " ORDER BY cdate DESC";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
//to get id of the poster of book or post
function getPosterId($post_id, $book_id)
{
    global $db;
    if ($post_id != 0) {
        $query = "SELECT uid FROM casual_post WHERE pid=" . $post_id;
        $run = mysqli_query($db, $query);
        return mysqli_fetch_assoc($run)['uid'];
    } else if ($book_id != 0) {
        $query = "SELECT uid FROM book_post WHERE bid=" . $book_id;
        $run = mysqli_query($db, $query);
        return mysqli_fetch_assoc($run)['uid'];
    }
    return 0;
}
//to search for a post
function searchPost($query)
{
    global $db;
    $search = '%' . $query . '%';
    $sql = "SELECT casual_post.pid,casual_post.ptitle,casual_post.pcontent, casual_post.ptag, casual_post.pdate,users.uname,users.username,users.uprofile_photo,users.uid from casual_post join users on users.uid=casual_post.uid WHERE casual_post.ptitle LIKE '" . $search . "'";
    $run = mysqli_query($db, $sql);
    if ($run) {
        $posts = [];
        while ($post = mysqli_fetch_assoc($run)) {
            if (!checkBlockStatus($post['uid'], $_SESSION['userdata']['uid'])) {
                $posts[] = $post;
            }
        }
        $sql_content = "SELECT casual_post.pid,casual_post.ptitle,casual_post.pcontent, casual_post.ptag, casual_post.pdate,users.uname,users.username, users.uprofile_photo,users.uid from casual_post join users on users.uid=casual_post.uid";
        $result_content = mysqli_query($db, $sql_content);
        while ($post = mysqli_fetch_assoc($result_content)) {
            $file_content = getPostContentWithoutFormating($post['pcontent']);
            if (stripos($file_content, $query) !== false) {
                if (!checkBlockStatus($post['uid'], $_SESSION['userdata']['uid'])) {
                    if (!in_array($post, $posts)) {
                        $posts[] = $post;
                    }
                }
            }
        }
        mysqli_free_result($run);
        return $posts;
    } else {
        error_log("SQL Error: " . mysqli_error($db));
        return [];
    }
}
//to search for book
function searchBook($query)
{
    global $db;
    $search = '%' . $query . '%';
    $sql = "SELECT book_post.bid,book_post.btitle,book_post.bcontent,book_post.babout, book_post.btag, book_post.bdate,book_post.bcover,users.uname,users.username,users.uid from book_post join users on users.uid=book_post.uid WHERE book_post.btitle LIKE '" . $search . "'";
    $run = mysqli_query($db, $sql);
    if ($run) {
        $posts = [];
        while ($post = mysqli_fetch_assoc($run)) {
            if (!in_array($post, $posts)) {
                if (!checkBlockStatus($post['uid'], $_SESSION['userdata']['uid'])) {
                    $posts[] = $post;
                }
            }
        }
        $sql_content = "SELECT book_post.bid,book_post.btitle,book_post.bcontent,book_post.babout, book_post.btag, book_post.bdate,book_post.bcover,users.uname,users.username,users.uid from book_post join users on users.uid=book_post.uid";
        $result_content = mysqli_query($db, $sql_content);
        while ($post = mysqli_fetch_assoc($result_content)) {
            $file_content = getBookContent($post['bcontent']);
            if (stripos($file_content, $query) !== false) {
                if (!checkBlockStatus($post['uid'], $_SESSION['userdata']['uid'])) {
                    if (!in_array($post, $posts)) {
                        $posts[] = $post;
                    }
                }
            }
        }
        mysqli_free_result($run);
        return $posts;
    } else {
        error_log("SQL Error: " . mysqli_error($db));
        return [];
    }
}
//to search for user
function searchUser($query)
{
    global $db;
    $search = '%' . $query . '%';
    $sql = "SELECT uid, uname, username, uprofile_photo FROM users WHERE username LIKE '$search' OR uname LIKE '$search' ORDER BY  CASE  WHEN username LIKE '$search' THEN 1  ELSE 2  END";
    $run = mysqli_query($db, $sql);
    $userlist = [];
    while ($user = mysqli_fetch_assoc($run)) {
        if (!checkBlockStatus($user['uid'], $_SESSION['userdata']['uid'])) {
            $userlist[] = $user;
        }
    }
    return $userlist;
}
// to delete post
function deletePost($post_id)
{
    global $db;
    $file = "select pcontent,uid from casual_post where pid=" . $post_id;
    $delfile = mysqli_query($db, $file) or die(mysqli_error($db));
    $filename = mysqli_fetch_assoc($delfile);
    if ($filename['uid'] == $_SESSION['userdata']['uid'] || $_SESSION['userdata']['is_admin'] == 1) {
        $dellike = "DELETE FROM likes WHERE lpost=" . $post_id;
        mysqli_query($db, $dellike) or die(mysqli_error($db));
        $delcom = "DELETE FROM comments WHERE cpost=" . $post_id;
        mysqli_query($db, $delcom) or die(mysqli_error($db));
        $not = "UPDATE notification SET read_status=2 WHERE pid=" . $post_id;
        mysqli_query($db, $not);
        if (deleteFile("../post_data/casual", $filename['pcontent'])) {
            $query = "DELETE FROM casual_post WHERE pid=" . $post_id;
            return mysqli_query($db, $query) or die(mysqli_error($db));
        } else {
            echo "not done";
        }
    } else {
        echo "<script> alert('invalid action')</script>";
        exit();
    }
}
//to delete book
function deleteBook($book_id)
{
    global $db;
    $file = "select bcontent,bcover,uid from book_post where bid=" . $book_id;
    $delfile = mysqli_query($db, $file) or die(mysqli_error($db));
    $filename = mysqli_fetch_assoc($delfile);
    if ($filename['uid'] == $_SESSION['userdata']['uid'] || $_SESSION['userdata']['is_admin'] == 1) {
        $dellike = "DELETE FROM likes WHERE lbook=" . $book_id;
        mysqli_query($db, $dellike) or die(mysqli_error($db));
        $delcom = "DELETE FROM comments WHERE cbook=" . $book_id;
        mysqli_query($db, $delcom) or die(mysqli_error($db));
        $not = "UPDATE notification SET read_status=2 WHERE bid=" . $book_id;
        mysqli_query($db, $not);
        if (deleteFile("../post_data/books", $filename['bcontent']) && deleteFile("../images/book-cover", $filename['bcover'])) {
            $query = "DELETE FROM book_post WHERE bid=" . $book_id;
            return mysqli_query($db, $query) or die(mysqli_error($db));
        } else {
            echo "not done";
        }
    } else {
        echo "<script> alert('invalid action')</script>";
        exit();
    }
}
function deleteReport($report_id)
{
    global $db;
    if ($_SESSION['userdata']['is_admin'] == 1) {
        $query = "delete from report where rid=" . $report_id;
        return mysqli_query($db, $query) or die(mysqli_error($db));
    }
}
//to delete html,image file of book,post
function deleteFile($directory, $filename)
{
    $filepath = $directory . '/' . $filename;
    print_r($filepath);
    if (file_exists($filepath)) {
        if (unlink($filepath)) {
            return true;
        } else {
            return $response = false;
        }
    } else {
        return $response = false;
    }
}
//to create notification
function createNotification($from_user_id, $to_user_id, $msg, $post_id = 0, $book_id = 0)
{
    global $db;
    $check_query = "SELECT * FROM notification WHERE from_user_id =" . $from_user_id . " AND to_user_id =" . $to_user_id . " AND pid =" . $post_id . " AND bid =" . $book_id . "  AND message ='" . $msg . "'";
    $result = mysqli_query($db, $check_query);
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO notification(from_user_id,to_user_id,message,pid,bid) VALUES(" . $from_user_id . "," . $to_user_id . ",'" . $msg . "'," . $post_id . "," . $book_id . ")";
        mysqli_query($db, $query);
    }
}
//to delete notification
function deleteNotification($from_user_id, $to_user_id, $post_id = 0, $book_id = 0)
{
    global $db;
    $delete_query = "DELETE FROM notification WHERE from_user_id = " . $from_user_id . " AND to_user_id =" . $to_user_id . " AND pid =" . $post_id . " AND bid=" . $book_id;
    mysqli_query($db, $delete_query) or die(mysqli_error($db));
}

// to get all notification for logged in user
function getNotifications()
{
    $cu_user_id = $_SESSION['userdata']['uid'];
    global $db;
    $query = "SELECT * FROM notification WHERE to_user_id=" . $cu_user_id . " ORDER BY nid DESC";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
//to get count of unread notifications
function getUnreadNotificationsCount()
{
    $cu_user_id = $_SESSION['userdata']['uid'];
    global $db;
    $query = "SELECT count(*) as r FROM notification WHERE to_user_id=" . $cu_user_id . " and read_status=0 ORDER BY nid DESC";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['r'];
}
//to set notification status as read
function setNotificationStatusAsRead()
{
    $cu_user_id = $_SESSION['userdata']['uid'];
    global $db;
    $query = "UPDATE notification SET read_status=1 WHERE to_user_id=" . $cu_user_id . " and read_status=0";
    return mysqli_query($db, $query);
}
//for getting ids of chat users
function getActiveChatUserIds()
{
    global $db;
    $current_user_id = $_SESSION['userdata']['uid'];
    $query = "SELECT from_user_id,to_user_id FROM messages WHERE to_user_id=" . $current_user_id . " or from_user_id=" . $current_user_id . " ORDER BY mid DESC";
    $run = mysqli_query($db, $query);
    $data = mysqli_fetch_all($run, true);
    $ids = array();
    foreach ($data as $ch) {
        if ($ch['from_user_id'] != $current_user_id && !in_array($ch['from_user_id'], $ids)) {
            $ids[] = $ch['from_user_id'];
        }
        if ($ch['to_user_id'] != $current_user_id && !in_array($ch['to_user_id'], $ids)) {
            $ids[] = $ch['to_user_id'];
        }
    }
    return $ids;
}
//to get all the messages for logged in user
function getMessages($user_id)
{
    global $db;
    $current_user_id = $_SESSION['userdata']['uid'];
    $query = "SELECT * FROM messages WHERE (to_user_id=" . $current_user_id . " and from_user_id=" . $user_id . ") or (from_user_id=" . $current_user_id . " and to_user_id=" . $user_id . ") ORDER BY mid DESC";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
//to send message
function sendMessage($user_id, $msg)
{
    global $db;
    $current_user_id = $_SESSION['userdata']['uid'];
    $query = "INSERT INTO messages (from_user_id,to_user_id,msg) VALUES(" . $current_user_id . "," . $user_id . ",'" . $msg . "')";
    return mysqli_query($db, $query);
}
//to get message count 
function newMsgCount()
{
    global $db;
    $current_user_id = $_SESSION['userdata']['uid'];
    $query = "SELECT COUNT(*) as r FROM messages WHERE to_user_id=" . $current_user_id . " and read_status=0";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['r'];
}
//to update read status of message
function updateMessageReadStatus($user_id)
{
    $cu_user_id = $_SESSION['userdata']['uid'];
    global $db;
    $query = "UPDATE messages SET read_status=1 WHERE to_user_id=" . $cu_user_id . " and from_user_id=" . $user_id;
    return mysqli_query($db, $query);
}
//to get all the messages and set them as conversations
function getAllMessages()
{
    $active_chat_ids = getActiveChatUserIds();
    $conversation = array();
    foreach ($active_chat_ids as $index => $id) {
        $conversation[$index]['user_id'] = $id;
        $conversation[$index]['messages'] = getMessages($id);
    }
    return $conversation;
}
// to return the string in given limit
function cutString($string, $limit)
{
    if (strlen($string) > $limit) {
        return substr($string, 0, $limit) . '...';
    } else {
        return $string;
    }
}
function validateReport($report)
{
    $response = array();
    $response['status'] = true;
    if (!$report['preport']) {
        $response['msg'] = "Add a reason to report this";
        $response['status'] = false;
        $response['field'] = 'preport';
    }
    return $response;
}
//to add report 
function addReport($report)
{
    global $db;
    $current_user_id = $_SESSION['userdata']['uid'];
    if (isset($report['post-id']) && $report['post-id'] != 0) {
        $query = "INSERT INTO report (reporter_id,rpost,report_text) VALUES(" . $current_user_id . "," . $report['post-id'] . ",'" . $report['preport'] . "')";
        return mysqli_query($db, $query);
    } else if (isset($report['book-id']) && $report['book-id'] != 0) {
        $query = "INSERT INTO report (reporter_id,rbook,report_text) VALUES(" . $current_user_id . "," . $report['book-id'] . ",'" . $report['preport'] . "')";
        return mysqli_query($db, $query);
    } else if (isset($report['user-id']) && $report['user-id'] != 0) {
        $query = "INSERT INTO report (reporter_id,uid,report_text) VALUES(" . $current_user_id . "," . $report['user-id'] . ",'" . $report['preport'] . "')";
        return mysqli_query($db, $query);
    }
}
//to dispay time in relative form
function timeAgo($saved_date)
{
    date_default_timezone_set('Asia/Kolkata');
    $saved_timestamp = strtotime($saved_date);
    $current_timestamp = time();
    $time_diff = $current_timestamp - $saved_timestamp;
    $minute = 60; // 60 seconds
    $hour = 3600; // 60 minutes * 60 seconds
    $day = 86400; // 24 hours * 60 minutes * 60 seconds
    $week = 604800; // 7 days * 24 hours * 60 minutes * 60 seconds
    if ($time_diff < $minute) {
        return "Just now";
    } elseif ($time_diff < $hour) {
        $minutes_diff = floor($time_diff / $minute);
        return $minutes_diff . " minute" . ($minutes_diff > 1 ? "s" : "") . " ago";
    } elseif ($time_diff < $day) {
        $hours_diff = floor($time_diff / $hour);
        return $hours_diff . " hour" . ($hours_diff > 1 ? "s" : "") . " ago";
    } elseif ($time_diff < $week) {
        $days_diff = floor($time_diff / $day);
        return $days_diff . " day" . ($days_diff > 1 ? "s" : "") . " ago";
    } elseif ($time_diff < 2 * $week) {
        return "1 week ago";
    }
    $saved_year = date('Y', $saved_timestamp);
    $current_year = date('Y', $current_timestamp);
    if ($saved_year == $current_year) {
        return date('F j', $saved_timestamp);
    } else {
        return date('Y-m-d', $saved_timestamp);
    }
}