<?php
require_once 'function.php';
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
        header("location:../../");
    }
}
?>