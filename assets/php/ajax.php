<?php
require_once 'function.php';
$response = array('status' => false);

if (isset($_POST['follow'])) {
    $user_id = $_POST['user_id'];
    if (followUser($user_id)) {
        $response['status'] = true;
    } else {
        $response['status'] = false;
    }

    echo json_encode($response);
}

if (isset($_POST['unfollow'])) {
    $user_id = $_POST['user_id'];
    if (unfollowUser($user_id)) {
        $response['status'] = true;
    } else {
        $response['status'] = false;
    }

    echo json_encode($response);
}



if(isset($_POST['likepost'])){
    $post_id = $_POST['post_id'];

    if(!checkPostLikeStatus($post_id)){
        if(likePost($post_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    }

  
}

if(isset($_POST['likebook'])){
    $book_id = $_POST['book_id'];

    if(!checkBookLikeStatus($book_id)){
        if(likeBook($book_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    }

  
}


if(isset($_POST['unlikepost'])){
    $post_id = $_POST['post_id'];

    if(checkPostLikeStatus($post_id)){
        if(unlikePost($post_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    }

  
}

if(isset($_POST['unlikebook'])){
    $book_id = $_POST['book_id'];

    if(checkBookLikeStatus($book_id)){
        if(unlikeBook($book_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    }

  
}


if(isset($_POST['addpostcomment'])){
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
        if(addPostComment($post_id,$comment)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
        echo json_encode($response); 
}

if(isset($_POST['addbookcomment'])){
    $book_id = $_POST['book_id'];
    $comment = $_POST['comment'];
        if(addBookComment($book_id,$comment)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
        echo json_encode($response); 
}


if(isset($_GET['notread'])){
    if(setNotificationStatusAsRead()){
        $response['status']=true;
    }else{
        $response['status']=false;
    }
    echo json_encode($response);
}
