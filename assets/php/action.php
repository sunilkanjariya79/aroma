<?php
require_once 'function.php';
//for managing register
if (isset($_GET['register'])) {
    $response = validateRegisterForm($_POST,$_FILES['uprofile_pic']);
    if ($response['status']) {
        if (createuser($_POST,$_FILES['uprofile_pic'])) {
            unset($_SESSION['formdata']);
            header('location:/aroma/?login');
        } else {
            echo "<script>alert('something is wrong')</script>";
        }
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("location:/aroma/?register");
    }
}
 //for managing login
if (isset($_GET['login'])) {
    $response = validateLoginForm($_POST);
    if ($response['status']) {
        $_SESSION['auth'] = true;
        $_SESSION['userdata'] = $response['user'];
        unset($_SESSION['formdata']);
        $userinfo = json_encode($_SESSION['userdata']);
        header("location:/aroma/?post-wall");
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("location:/aroma/?login");
    }
}
 if (isset($_GET['logout'])) {
    session_destroy();
    header('location:/aroma/');
 }
 
if (isset($_GET['deleteuser']) && ($_GET['id'] == $_SESSION['userdata']['uid'])) {
    if (deleteUser($_GET['id'])) {
        session_destroy();
        header('location:/aroma/');
    }else{ echo "noo";}
 }
else{
    echo $_SESSION['userdata']['uid'];
}
 if (isset($_GET['updateprofile'])) {
     $response = validateUpdateForm($_POST, $_FILES['uprofile_pic']);
     if ($response['status']) {
         if (updateProfile($_POST, $_FILES['uprofile_pic'])) {
            header("location:/aroma/?edit-profile&success");
         } else {
            echo "something is wrong";
        }
 
    } else {
        $_SESSION['error'] = $response;
        header("location:/aroma/?edit-profile");
    }
 }
 if (isset($_GET['updatepassword'])) {
     $response = validateUpdatePass($_POST);
    header("location:/aroma/?change-password&success");
}
 //for managing add post
if (isset($_GET['addpost'])) {
    $response = validatePostDetails($_POST);
    if ($response['status']) {
        if (createPost($_POST)) {
            header("location:/aroma/?new_post_added");
        } else {
            echo "something went wrong";
        }
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("location:/aroma/?create-post");
    }
}
 //for managing add book
if (isset($_GET['addbook'])) {
    $response = validateBookDetails($_POST, $_FILES['bcover']);
     if ($response['status']) {
        if (createBook($_POST, $_FILES['bcover'])) {
             header("location:/aroma/?new_book_added");
        } else {
            echo "something went wrong";
        }
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("location:/aroma/?create-book");
    }
}
 if (isset($_GET["search"])) {
    if ($_POST['search'] == "") {
        header("location:/aroma/");
    }
    header("location:/aroma/?search=" . $_POST['search']);
 }
 if (isset($_GET['deletepost'])) {
    $post_id = $_GET['deletepost'];
    if (deletePost($post_id)) {
        header("location:/aroma/");
    } else {
        echo "something went wrong";
    }
 
}
if (isset($_GET['deletebook'])) {
    $book_id = $_GET['deletebook'];
    if (deleteBook($book_id)) {
        header("location:/aroma/");
    } else {
        echo "something went wrong";
    }
 
}
 if (isset($_GET['block'])) {
    $user_id = $_GET['block'];
    $user = $_GET['username'];
    if (blockUser($user_id)) {
        header("location:/aroma/?u=$user");
    } else {
        echo "something went wrong";
    }
 
}
 if (isset($_GET['unblock'])) {
    $user_id = $_GET['unblock'];
    $user = $_GET['username'];
    if (unblockUser($user_id)) {
        header("location:/aroma/?u=$user");
    } else {
        echo "something went wrong";
    }
 
}
 if (isset($_GET['report'])) {
    $response = validateReport($_POST);
     if ($response['status']) {
        addReport($_POST);
        header('location:/aroma/');
    } else {
        $_SESSION['error'] = $response;
        header("location:/aroma/?not_done");
    }
}
?>