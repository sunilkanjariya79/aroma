<?php
require_once 'function.php';
$response = array('status' => false);

if(isset($_POST['follow'])){
    $user_id = $_POST['user_id'];
    if(followUser($user_id)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

if(isset($_POST['unfollow'])){
    $user_id = $_POST['user_id'];
    if(unfollowUser($user_id)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}