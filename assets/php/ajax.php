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



if (isset($_POST['likepost'])) {
    $post_id = $_POST['post_id'];

    if (!checkPostLikeStatus($post_id)) {
        if (likePost($post_id)) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }

        echo json_encode($response);
    }


}

if (isset($_POST['likebook'])) {
    $book_id = $_POST['book_id'];
    if (!checkBookLikeStatus($book_id)) {
        if (likeBook($book_id)) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }

        echo json_encode($response);
    }


}


if (isset($_POST['unlikepost'])) {
    $post_id = $_POST['post_id'];

    if (checkPostLikeStatus($post_id)) {
        if (unlikePost($post_id)) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }

        echo json_encode($response);
    }


}

if (isset($_POST['unlikebook'])) {
    $book_id = $_POST['book_id'];

    if (checkBookLikeStatus($book_id)) {
        if (unlikeBook($book_id)) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }

        echo json_encode($response);
    }


}


if (isset($_POST['addpostcomment'])) {
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    if (addPostComment($post_id, $comment)) {
        $response['status'] = true;
    } else {
        $response['status'] = false;
    }
    echo json_encode($response);
}

if (isset($_POST['addbookcomment'])) {
    $book_id = $_POST['book_id'];
    $comment = $_POST['comment'];
    if (addBookComment($book_id, $comment)) {
        $response['status'] = true;
    } else {
        $response['status'] = false;
    }
    echo json_encode($response);
}


if (isset($_GET['notread'])) {
    if (setNotificationStatusAsRead()) {
        $response['status'] = true;
    } else {
        $response['status'] = false;
    }
    echo json_encode($response);
}


if (isset($_GET['sendmessage'])) {
    if (sendMessage($_POST['user_id'], $_POST['msg'])) {
        $response['status'] = true;
    } else {
        $response['status'] = false;

    }

    echo json_encode($response);
}

if (isset($_POST['getmessages'])) {
    $chats = getAllMessages();
    $chatlist = "";
    foreach ($chats as $chat) {
        $ch_user = getUser($chat['user_id']);
        $seen = false;
        if ($chat['messages'][0]['read_status'] == 1 || $chat['messages'][0]['from_user_id'] == $_SESSION['userdata']['uid']) {
            $seen = true;
        }
        $chatlist .= '  
    <div class="not-card" data-bs-toggle="modal" data-bs-target="#chatbox" onclick="popchat(' . $chat['user_id'] . ')" >
                        <div class="nc-details">
                            <img src="assets/images/profile/'.$ch_user['uprofile_photo'].'" alt="" height="40" width="40" class="pcm-img">
                            
                            <div>&nbsp;&nbsp;</div>
                            <div class="nc-info" >
                                <a href="#" class="pcm-username"><h6 style="color: #b867f5;margin: 0px;font-size: small;">' . $ch_user['uname'] . '</h6></a>
                                <p style="margin:0px;font-size:small" class="">' . $chat['messages'][0]['msg'] . '</p>
                                <time style="font-size:small" class="timeago text-small" datetime="' . $chat['messages'][0]['created_at'] . '">' . timeAgo($chat['messages'][0]['created_at']) . '</time>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
      
                          <div class="p-1 bg-primary rounded-circle ' . ($seen ? 'd-none' : '') . '"></div>
    

    

    
    
                        </div>
                    </div>';

    }
    $json['chatlist'] = $chatlist;


    if (isset($_POST['chatter_id']) && $_POST['chatter_id'] != 0) {
        
        $messages = getMessages($_POST['chatter_id']);
        $chatmsg = "";
        if (checkBS($_POST['chatter_id'])) {
            $json['blocked'] = true;
        } else {
            $json['blocked'] = false;

        }
        updateMessageReadStatus($_POST['chatter_id']);

        foreach ($messages as $cm) {
            if ($cm['from_user_id'] == $_SESSION['userdata']['uid']) {
                $cl1 = ' message-self';
                $cl2 = 'white-txt';
                if($cm['read_status']==0){
                $cl3 = ' - unread';}
                else{
                    $cl3 = ' - read';
                }
            } else {
                $cl1 = '';
                $cl2 = 'text-muted';
                $cl3='';
            }

            $chatmsg .= ' <div class="message-box' . $cl1 . '"><span style="display:block">' . $cm['msg'] . '</span>
    <span style="font-size:.8em;display:block;text-align:right" class="' . $cl2 . '">' .  timeAgo($cm['created_at']) . $cl3 .'</span>
</div>';
        }
        $json['chat']['msgs'] = $chatmsg;
        $json['chat']['userdata'] = getUser($_POST['chatter_id']);
    } else {
        $json['chat']['msgs'] = '<div class="spinner-border text-center" role="status">
</div>';
    }

    $json['newmsgcount'] = newMsgCount();
    echo json_encode($json);
}
