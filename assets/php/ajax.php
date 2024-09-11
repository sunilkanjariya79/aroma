<?php
require_once 'function.php'
if(isset($_GET['follow'])){
    $user_id=$_POST['user_id'];
    if(followUser($user_id)){
        $response['status']=true;
    }
    else{
        $response['status']=false;
    }
    echo json_encode($response); //this function php array ne jsan ma convert kare
}

if(isset($_GET['unfollow'])){
    $user_id=$_POST['user_id'];
    if(unfollowUser($user_id)){
        $response['status']=true;
    }
    else{
        $response['status']=false;
    }
    echo json_encode($response); //this function php array ne jsan ma convert kare
}
//like
if(isset($_GET['like'])){
    $post_id=$_POST['post_id'];
    if(checkLikeStatus($post_id)){
        if(like($post_id)){
            $response['status']=true;
        }
        else{
            $response['status']=false;
        }
    }
  
    echo json_encode($response); //this function php array ne jsan ma convert kare
}


//unlike
if(isset($_GET['unlike'])){
    $post_id=$_POST['post_id'];
    if(checkLikeStatus($post_id)){
        if(unlike($post_id)){
            $response['status']=true;
        }
        else{
            $response['status']=false;
        }
    }
  
    echo json_encode($response); //this function php array ne jsan ma convert kare
}

//comment
if(isset($_GET['addcomment'])){
    $post_id=$_POST['post_id'];
    $comment=$_POST['comment'];
    if(addcomment($post_id,$comment)){
        $cuser=getUser($_SESSION['userdata']['id']);
            $response['status']=true;
            $response['comment']='  <img src="profile/'.cuser['profile_pic'].'" alt="">
  <h4 name="username">'.$cuser['username'].'</h4>
  <p>'.$comment['comment'].'</p>'
        }
        else{
            $response['status']=false;
        }
    
  
    echo json_encode($response); //this function php array ne jsan ma convert kare
}

//messages(chat)
if(isset($_GET['test'])){
    $chats=getMessages();
    $chatlist="";
    foreach($chats as $chat){
        $ch_user=getUser($chat['user_id']);
        $chaatlist=''
    }
    
}
?>