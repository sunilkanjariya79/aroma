<?php
require_once 'assets/php/function.php';
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



showPage('footer');
unset($_SESSION['error'])
?>
