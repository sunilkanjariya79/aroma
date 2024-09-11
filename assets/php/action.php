<?php
require_once 'function.php';

//form managing signup
if(isset($_GET['signup'])){
    $response=validatesSignupForm($_POST);
    if($response['status']){
        if(createUser($_POST)){
            header("location:login.php?login")
        }
        else{
            echo "<script>alert('something is wrong')</script>";
        }
    }
    else{
        $_SESSION['error']=$response;
        $_SESSION['formdata']=$_POST;
        header("location:index.php?signup");
    }
}


//form managing login
if(isset($_GET['login'])){
    $response=validatesLoginForm($_POST);
    if($response['status']){
        $_SESSION['Auth']=true;
        $_SESSION['userdata']=$response['user'];
        header("")
    }
    else{
        $_SESSION['error']=$response;
        $_SESSION['formdata']=$_POST;
        header("location:index.php?login");
    }
}
// logout functions
if(isset($_GET['logput'])){
    session_destroy();
    header("login.php");
}

//edit profile 
if(isset($_GET['editprofile'])){
    $response=validatesEditForm($_POST,$_FILES['profile_pic']);
    if($response['status']){
      if(updateProfile($_POST,$_FILES['pprofile_pic'])){
        header("location:index.php?editprogile&success");
      }
      else{
        echo "something is wrong";
      }
    }
    else{
        $_SESSION['error']=$response;
        header("location:index.php?editprogile");
    }
}

//for managing add post
if(isset($_GET['addpost'])){
    $response=validdatePostImage($_FILES['post_img']);
    if($response['status']){
           if(createPost($_POST,$_FILES['post_img'])){
            header("action.php?new_post_added");
           }
           else{
            echo "something is wrong";
           }
    }else{
        $_SESSION['error']=$response;
        header("location:index.php?home.php");
    }
}
?>