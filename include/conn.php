<?php
session_start();
$db=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("database not connected");
const DB_NAME='aroma';
const DB_HOST='localhost';
const DB_USER='root';
const DB_PASS='';
?>