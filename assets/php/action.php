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
       $_SESSION['auth']=true;
       $_SESSION['uid']=$response['user'];
       header("location:../../");
    }
    else{
        $_SESSION['error']=$response;
        $_SESSION['formdata']=$_POST;
        header("location:../../?login");
    }
}

if(isset($_GET['login'])){
    $response=validatesLoginForm($_POST);
    if($response['status']){
        $_SESSION['Auth']=true;
        $_SESSION['userdata']=$response['user'];
        print_r( $response);
        // header("location:index.php?done");
    }
    else{
        $_SESSION['error']=$response;
        $_SESSION['formdata']=$_POST;
        header("location:../../?login");
    }
}
?>