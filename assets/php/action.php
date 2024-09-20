<?php
require_once 'function.php';
//for managing register
if(isset($_GET['register'])){
    $response=validateRegisterForm($_POST);
    if($response['status']){
        if(createuser($_POST)){
        header('location:../../?login');
        }else{
            echo "<script>alert('something is wrong')</script>";
        }
    }
    else{
        $_SESSION['error']=$response;
        $_SESSION['formdata']=$_POST;
        header("location:../../?register");
    }
}

//for managing login
if(isset($_GET['login'])){
    $response=validateLoginForm($_POST);
    if($response['status']){
       $_SESSION['Auth']=true;
       $_SESSION['userdata']=$response['user'];
       header("location:../../?post-wall");
    }
    else{
        $_SESSION['error']=$response;
        $_SESSION['formdata']=$_POST;
        header("location:../../?login");
    }
}

if(isset($_GET['updateprofile'])){

    $response=validateUpdateForm($_POST,$_FILES['uprofile_pic']);

    if($response['status']){
       
        if(updateProfile($_POST,$_FILES['uprofile_pic'])){
            header("location:../../?edit-profile&success");

        }else{
            echo "something is wrong";
        }
       
    
    }else{
        $_SESSION['error']=$response;
        header("location:../../?edit-profile");
    }
     
}

//for managing add post
if(isset($_GET['addpost'])){
    $response = validatePostDetails($_POST);
    if($response['status']){
 if(createPost($_POST)){
     header("location:../../?new_post_added");
 }else{
     echo "something went wrong";
 }
    }else{
     $_SESSION['error']=$response;
     header("location:../../");
    }
 }

 //for managing add book
if(isset($_GET['addbook'])){
    $response = validateBookDetails($_POST,$_FILES['bcover']);
    
    if($response['status']){
 if(createBook($_POST,$_FILES['bcover'])){
    
     header("location:../../?new_book_added");
 }else{
     echo "something went wrong";
 }
    }else{
     $_SESSION['error']=$response;
     header("location:../../");
    }
 }
?>