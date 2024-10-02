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


if(isset($_POST['unlike'])){
    $post_id = $_POST['post_id'];

    if(checkLikeStatus($post_id)){
        if(unlike($post_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    }

  
}
