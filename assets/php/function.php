<?php
require_once 'conn.php';
//functio for show pages
function showPage($page, $data = "")
{
    include("assets/pages/$page.php");
}
//for validating register form
function validateRegisterForm($form_data)
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
    return $response;
}

//for managing login form
//for validating register form
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
    $query = "select * from users where (umail='$username_email' || username='$username_email') && upassword='$password'";
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
    // $cu = getUser($_SESSION['userdata']['uid']);
    $current_user = $_SESSION['userdata']['uid'];
    $query = "insert into follower (uid,follower) values('" . $user_id . "','" . $current_user . "')";
    // createNotification($cu['id'],$user_id,"started following you !");
    return mysqli_query($db, $query);

}
function unfollowUser($user_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "DELETE FROM follower WHERE follower=$current_user and uid=$user_id";
    return mysqli_query($db, $query);


}

//for filtering the suggestion list
function filterFollowSuggestion()
{
    $list = getFollowSuggestions();
    $filter_list = array();
    foreach ($list as $user) {
        if (!checkFollowStatus($user['uid']) && count($filter_list) < 10) {
            $filter_list[] = $user;
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

//get followers count
function getFollowers($uid)
{
    global $db;
    $query = "SELECT * FROM follower WHERE uid=" . $uid;
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run);
}

function getFollowersDetials($uid)
{
    $list = getFollowers($uid);

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
        showPage('side-bar');
        showPage('top');
        showPage('post-wall');
        showPage('right-bar');
        exit;
    }

}
//for getting posts by id
function getPostById($uid)
{
    global $db;
    $query = "SELECT casual_post.pid,casual_post.ptitle,casual_post.pcontent, casual_post.ptag, casual_post.pdate,users.uname,users.username, users.uprofile_photo from casual_post join users on users.uid=casual_post.uid WHERE users.uid=" . $uid . " ORDER BY casual_post.pid DESC";
    $run = mysqli_query($db, $query) or die(mysqli_error($db));
    return mysqli_fetch_all($run, true);
}

function getSinglePost($pid)
{
    global $db;
    $query = "SELECT casual_post.pid,casual_post.ptitle,casual_post.pcontent, casual_post.ptag, casual_post.pdate,users.uname,users.username, users.uprofile_photo from casual_post join users on users.uid=casual_post.uid WHERE casual_post.pid=" . $pid;
    $run = mysqli_query($db, $query) or die(mysqli_error($db));
    return mysqli_fetch_all($run, true);
}

function getSingleBook($bid)
{
    global $db;
    $query = "SELECT book_post.bid,book_post.btitle,book_post.bcontent,book_post.babout, book_post.btag, book_post.bdate,book_post.bcover,users.uname,users.username ,users.uprofile_photo, users.uid from book_post join users on users.uid=book_post.uid WHERE book_post.bid=" . $bid;
    $run = mysqli_query($db, $query) or die(mysqli_error($db));
    return mysqli_fetch_all($run, true);
}

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
            <?= $error['msg'] ?>
            <?php
        }
    }
}

//function for showing pervious form data
function showFormaData($field)
{
    if (isset($_SESSION['formdata'])) {
        $formdata = $_SESSION['formdata'];
        return $formdata['$field'];
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
function createuser($data)
{
    global $db;
    $umail = mysqli_real_escape_string($db, $data['umail']);
    $uname = mysqli_real_escape_string($db, $data['uname']);
    $username = mysqli_real_escape_string($db, $data['username']);
    $gender = mysqli_real_escape_string($db, $data['gender']);
    $uabout = mysqli_real_escape_string($db, $data['uabout']);
    $udate = mysqli_real_escape_string($db, $data['udate']);
    $upassword = mysqli_real_escape_string($db, $data['upassword']);
    $profile_pic = mysqli_real_escape_string($db, $data['uprofile_pic']);
    $query = "insert into users(uprofile_photo,umail,uname,username,gender,uabout,udate,upassword) values('" . $profile_pic . "','" . $umail . "','" . $uname . "','" . $username . "','" . $gender . "','" . $uabout . "','" . $udate . "','" . $upassword . "')";
    return mysqli_query($db, $query);
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
        // Prepare an SQL statement to save title, tags, and filename
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
        // Prepare an SQL statement to save title, tags, and filename
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
        // If query fails, output error details
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

        // Remove the HTML tags but keep the content
        $clean_content = strip_tags($html_content);
        return $clean_content;
    }
    return $html_content;
}

function getPostContent($post_file)
{
    $file_path = 'assets/post_data/casual/' . $post_file;
    $html_content = file_get_contents($file_path);
    return $html_content;
}

function getBook()
{
    global $db;
    $query = "SELECT book_post.bid,book_post.btitle,book_post.bcontent,book_post.babout, book_post.btag, book_post.bdate,book_post.bcover,users.uname,users.username, users.uprofile_photo, users.uid from book_post join users on users.uid=book_post.uid ORDER BY book_post.bid DESC";
    $run = mysqli_query($db, $query);
    if (!$run) {
        // If query fails, output error details
        die("Query Failed: " . mysqli_error($db));
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

function getBookContent($post_file)
{
    $file_path = 'assets/post_data/books/' . $post_file;
    $html_content = file_get_contents($file_path);
    return $html_content;
}

function checkPostLikeStatus($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "SELECT count(*) as r FROM likes WHERE uid=" . $current_user . " and lpost=" . $post_id;
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['r'];

}

function checkBookLikeStatus($book_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "SELECT count(*) as r FROM likes WHERE uid=" . $current_user . " and lbook=" . $book_id;
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['r'];

}

function likePost($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "INSERT INTO likes(lpost,uid) VALUES(" . $post_id . "," . $current_user . ")";
    //    $poster_id = getPosterId($post_id);

    //    if($poster_id!=$current_user){
    //     createNotification($current_user,$poster_id,"liked your post !",$post_id);
    //    }


    return mysqli_query($db, $query);

}

function getPostLikes($post_id)
{
    global $db;
    $query = "SELECT * FROM likes WHERE lpost=" . $post_id;
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}


function unlikePost($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "DELETE FROM likes WHERE uid=" . $current_user . " and lpost=" . $post_id;

    // $poster_id = getPosterId($post_id);
    // if($poster_id!=$current_user){
    //     createNotification($current_user,$poster_id,"unliked your post !",$post_id);
    // }

    return mysqli_query($db, $query);
}

function likebook($book_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "INSERT INTO likes(lbook,uid) VALUES(" . $book_id . "," . $current_user . ")";
    //    $poster_id = getPosterId($post_id);

    //    if($poster_id!=$current_user){
    //     createNotification($current_user,$poster_id,"liked your post !",$post_id);
    //    }


    return mysqli_query($db, $query);

}

function getBookLikes($book_id)
{
    global $db;
    $query = "SELECT * FROM likes WHERE lbook=" . $book_id;
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, true);
}
function unlikeBook($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['uid'];
    $query = "DELETE FROM likes WHERE uid=" . $current_user . " and lbook=" . $post_id;

    // $poster_id = getPosterId($post_id);
    // if($poster_id!=$current_user){
    //     createNotification($current_user,$poster_id,"unliked your post !",$post_id);
    // }

    return mysqli_query($db, $query);
}


//function for creating comments
function addPostComment($post_id, $comment){
    global $db;
    $comment = mysqli_real_escape_string($db, $comment);
    $current_user = $_SESSION['userdata']['uid'];
    $query = "INSERT INTO comments (uid,cpost,c_content) VALUES(".$current_user.",".$post_id.",'".$comment."')";
    // $poster_id = getPosterId($post_id);
    // if ($poster_id != $current_user) {
    //     createNotification($current_user, $poster_id, "commented on your post", $post_id);
    // }
    return mysqli_query($db, $query) or die(mysqli_error($db));
}

function getPostComments($post_id){
    global $db;
    $query="SELECT comments.*, users.username,users.uprofile_photo,users.uname FROM comments join users on comments.uid=users.uid WHERE cpost=".$post_id." ORDER BY cdate DESC";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run, true);
}

function addBookComment($book_id, $comment){
    global $db;
    $comment = mysqli_real_escape_string($db, $comment);
    $current_user = $_SESSION['userdata']['uid'];
    $query = "INSERT INTO comments (uid,cbook,c_content) VALUES(".$current_user.",".$book_id.",'".$comment."')";
    // $poster_id = getPosterId($post_id);
    // if ($poster_id != $current_user) {
    //     createNotification($current_user, $poster_id, "commented on your post", $post_id);
    // }
    return mysqli_query($db, $query) or die(mysqli_error($db));
}

function getBookComments($book_id){
    global $db;
    $query="SELECT comments.*, users.username,users.uprofile_photo,users.uname FROM comments join users on comments.uid=users.uid WHERE cbook=".$book_id." ORDER BY cdate DESC";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run, true);
}


function getPosterId($post_id)
{
    global $db;
    $query = "SELECT user_id FROM posts WHERE id=$post_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['user_id'];

}

function searchPost($query){
    global $db;
    $search = '%' . $query . '%';
    $sql = "SELECT casual_post.pid,casual_post.ptitle,casual_post.pcontent, casual_post.ptag, casual_post.pdate,users.uname,users.username, users.uprofile_photo from casual_post join users on users.uid=casual_post.uid WHERE casual_post.ptitle LIKE '".$search."'";
    $run = mysqli_query($db, $sql);
    if ($run) {
        $posts = [];
        while ($post = mysqli_fetch_assoc($run)) {
            $posts[] = $post;
        }
        $sql_content = "SELECT casual_post.pid,casual_post.ptitle,casual_post.pcontent, casual_post.ptag, casual_post.pdate,users.uname,users.username, users.uprofile_photo from casual_post join users on users.uid=casual_post.uid";
        $result_content = mysqli_query($db, $sql_content);
        while ($post = mysqli_fetch_assoc($result_content)) {
            $file_content = getPostContentWithoutFormating($post['pcontent']);
                if (stripos($file_content, $query) !== false) {
                    if (!in_array($post, $posts)) {
                        $posts[] = $post;
                    }
                }
            }
        mysqli_free_result($run);
        return $posts;
    }else {
        // Log error and return an empty array in case of failure
        error_log("SQL Error: " . mysqli_error($db));
        return [];
    }
}

function searchBook($query){
    global $db;
    $search = '%' . $query . '%';
    $sql = "SELECT book_post.bid,book_post.btitle,book_post.bcontent,book_post.babout, book_post.btag, book_post.bdate,book_post.bcover,users.uname,users.username from book_post join users on users.uid=book_post.uid WHERE book_post.btitle LIKE '".$search."'";
    $run = mysqli_query($db, $sql);
    if ($run) {
        $posts = [];
        while ($post = mysqli_fetch_assoc($run)) {
            $posts[] = $post;
        }
        $sql_content = "SELECT book_post.bid,book_post.btitle,book_post.bcontent,book_post.babout, book_post.btag, book_post.bdate,book_post.bcover,users.uname,users.username from book_post join users on users.uid=book_post.uid";
        $result_content = mysqli_query($db, $sql_content);
        while ($post = mysqli_fetch_assoc($result_content)) {
            $file_content = getBookContent($post['bcontent']);
                if (stripos($file_content, $query) !== false) {
                    if (!in_array($post, $posts)) {
                        $posts[] = $post;
                    }
                }
            }
        mysqli_free_result($run);
        return $posts;
    }else {
        // Log error and return an empty array in case of failure
        error_log("SQL Error: " . mysqli_error($db));
        return [];
    }
}

function searchUser($query){
    global $db;
    $search = '%' . $query . '%';
    $sql ="SELECT uid, uname, username, uprofile_photo FROM users WHERE username LIKE '$search' OR uname LIKE '$search' ORDER BY  CASE  WHEN username LIKE '$search' THEN 1  ELSE 2  END";
    $run = mysqli_query($db, $sql);
    return mysqli_fetch_all($run, true);
}

function deletePost($post_id){
    global $db;
$user_id=$_SESSION['userdata']['uid'];
    $dellike = "DELETE FROM likes WHERE lpost=".$post_id." && uid=".$user_id;
    mysqli_query($db,$dellike) or die(mysqli_error($db));
    $delcom = "DELETE FROM comments WHERE cpost=".$post_id." && uid=".$user_id;
    mysqli_query($db,$delcom) or die(mysqli_error($db));
//     $not = "UPDATE notifications SET read_status=2 WHERE post_id=$post_id && to_user_id=$user_id";
// mysqli_query($db,$not);
    $file = "select pcontent from casual_post where pid=".$post_id;
    $delfile= mysqli_query($db,$file) or die(mysqli_error($db));
    $filename= mysqli_fetch_assoc($delfile);
    if(deleteFile("../post_data/casual",$filename['pcontent'])) {
    $query = "DELETE FROM casual_post WHERE pid=".$post_id;
    return mysqli_query($db,$query) or die(mysqli_error($db));} 
    else {
        echo "not done";}
}


function deleteBook($book_id){
    global $db;
$user_id=$_SESSION['userdata']['uid'];
    $dellike = "DELETE FROM likes WHERE lbook=".$book_id." && uid=".$user_id;
    mysqli_query($db,$dellike) or die(mysqli_error($db));
    $delcom = "DELETE FROM comments WHERE cbook=".$book_id." && uid=".$user_id;
    mysqli_query($db,$delcom) or die(mysqli_error($db));
//     $not = "UPDATE notifications SET read_status=2 WHERE post_id=$post_id && to_user_id=$user_id";
// mysqli_query($db,$not);
    $file = "select bcontent,bcover from book_post where bid=".$book_id;
    $delfile= mysqli_query($db,$file) or die(mysqli_error($db));
    $filename= mysqli_fetch_assoc($delfile);
    if(deleteFile("../post_data/books",$filename['bcontent']) && deleteFile("../images/book-cover",$filename['bcover'])) {
    $query = "DELETE FROM book_post WHERE bid=".$book_id;
    return mysqli_query($db,$query) or die(mysqli_error($db));} 
    else {
        echo "not done";}
}

function deleteFile($directory, $filename) {
    $filepath = $directory . '/' . $filename;
    if (file_exists($filepath)) {
        if (unlink($filepath)) {
            return true;
        } else {
            return $response=false;
        }
    } else {
        return $response = false;
    }
}


// to return the string in given limit
function cutString($string, $limit)
{
    // Check if the string is longer than the limit
    if (strlen($string) > $limit) {
        // Cut the string to the limit and append '...' to indicate truncation
        return substr($string, 0, $limit) . '...';
    } else {
        // If the string is within the limit, return it as is
        return $string;
    }
}
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