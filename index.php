<?php
require_once 'assets/php/function.php';
if(isset($_GET['register'])){
showPage('header',['page_title'=>'aroma-register']);
showPage('register');
}
showPage('footer');
?>
