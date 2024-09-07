<?php
require_once 'include/conn.php'
$db=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("database not connected");
// function for showing pages
function showPage($page,$data=""){
    include("include/$page.php");
}
//function for show error
function showError(){
    if(isset($_SESSION['error'])){
        $error=$_SESSION['error'];
        if(isset($error['field']) && $field==$error['field']){
            ?>
            <div class="alert alert-danger" role="alert">
            <?=$error['msg']?>
            </div>      
            <?php
        }
    }
}

//functio for show prevform data
function showFormData($field){
    if(isset($_SESSION['formdata'])){
        $formdata=$_SESSION['formdata'];
        return $formdata['$field'];
    }
}

// for validating the signup form
function validatesSignupForm($form_data){
    $response=array();
    $response['status']=true;
    //for all filed are desending order like password,email,username etc
    if(!$form_data['password']){
        $response['msg']="password is not give";
        $response['status']=false;
        $response['field']='password';
    }
    if(!$form_data['email']){
        $response['msg']="email is not give";
        $response['status']=false;
        $response['field']='email';
    }
    if(!$form_data['username']){
        $response['msg']="user name is not give";
        $response['status']=false;
        $response['field']='username';
    }

    //username and email alredy register to
    if($isEmailRegistered($form_data['email'])){
        $response['msg']="username is alredy registered";
        $response['status']=false;
        $response['field']='email';
    }
    if($isUsernameRegistered($form_data['username'])){
        $response['msg']="email is alredy registered";
        $response['status']=false;
        $response['field']='username';
    }
    return $response;
}
//for creating new user
function createUser($data){
    global $db;
    $username=mysqli_escape_real_string($db,$data['username']);
    $email=mysqli_escape_real_string($db,$data['email']);
    $query="insert into tablename(username,name,gender,password ,etc)";
    $query="values('$username','$email')";
    return mysqli_query($db,$query);
}
//for checking dublicate username
function isUsernameRegisterd($$username){
    global $db;
    $query="SELECT count(*) as row FROM tablename where username ='$username'";
    $run=mysqli_query($db,$query);
    $return_data=mysqli_fetch_assoc($run);
    return $return_data['row'];
}
//for checking dublicate username by other
function isUsernameRegisterdByOther($$username){
    global $db;
    $ser_id=$_SESSION['username']['id'];
    $query="SELECT count(*) as row FROM tablename where username='$username' && id!=$user_id";
    $run=mysqli_query($db,$query);
    $return_data=mysqli_fetch_assoc($run);
    return $return_data['row'];
}
//for checking dublicate email
function isEmailRegisterd($email){
    global $db;
    $query="SELECT count(*) as row FROM tablename where email='$email'";
    $run=mysqli_query($db,$query);
    $return_data=mysqli_fetch_assoc($run);
    return $return_data['row'];
}



//login functions

// for validating the login form
function validatesLoginForm($form_data){
    $response=array();
    $response['status']=true;
    $blank=true;
    //for all filed are desending order like password,email,username etc
    if(!$form_data['password']){
        $response['msg']="password is not give";
        $response['status']=false;
        $response['field']='password';
        $blank=true;
    }
    if(!$form_data['username_email']){
        $response['msg']="username/email is not give";
        $response['status']=false;
        $response['field']='username_email';
        $blank=true;
    }
    //for incorrect password or usernaame hoi tyare
    if(!$blank && !checkUser($form_data)['status']){
        $response['msg']="something is incorect";
        $response['status']=false;
        $response['field']='checkUser';
    }
    else{
        $response['user']=checkUser($form_data)['user'];
    }
    return $response;
}
//for chacking user
function checkUser($login_data){
    global $db;
$username_email=$login_data['username_email'];
$password=$login_data['password'];
$query="SELECT *FROM taablename WHERE (email='$username_email' || username='$username_email')&& password='$password'";
$run=mysqli_query($db,$query);
$data['user']= mysqli_fetch_assoc($run);
if(count($data['user'])>0){
    $data['status']=true;
}
else{
    $data['status']=false;
}
return $data;
}

//for getting userdata by id
function getUser($user_id){
    global $db;
$query="SELECT *FROM taablename WHERE id=$user_id";
$run=mysqli_query($db,$query);
return mysqli_fetch_assoc($run);

}




//validate edit form
function validatesEditForm($form_data,$image_data){
    $response=array();
    $response['status']=true;
    if(!$form_data['firstname']){
        $response['msg']="user name is not give";
        $response['status']=false;
        $response['field']='firstname';
    }

    if(!$form_data['username']){
        $response['msg']="user name is not give";
        $response['status']=false;
        $response['field']='username';
    }

    //username  alredy register by other
    if($isUsernameRegisteredByOther($form_data['email'])){
        $response['msg']=$form_data['username']". is alredy registered";
        $response['status']=false;
        $response['field']='username';
    }
    if($image_data['name']){
        $image=basename($image_data['name']);
        $type=strtolower(pathinfo($image,PATHINFO_EXTENTION));
        $size=$image_data['size']/1000;
        if($type!='jpg' && $type!=jpeg && $type!='png'){
            $response['msg']="only jpg,jpeg,png are allowed";
            $response['status']=false;
            $response['field']='profile_pic';
        }

        if($size>1000){
            $response['msg']="upload img is less than 1 mb";
            $response['status']=false;
            $response['field']='profile_pic';
        }  
    return $response;
}

//function for updating profile
function updateProfile($formdata,$imagedata){
    global $db;   
    $firstname=mysqli_escape_real_string($db,$data['firstname']);
    $username=mysqli_escape_real_string($db,$data['username']);
    $password=mysqli_escape_real_string($db,$data['password']);
    if(!$data['password']){
        $password=$_SESSION['userdata']['password'];
    }
    else{
        $_SESSION['userdata']['password']=$password;
    }
    $progile_pic="";
    if($image_data['name']){
        $image_name=time("this function genrate seprate name").basename($image_data['name']);
        $image_dir="images/profile/$image_name";
        move_uploaded_file($image_data['tmp_name'],$image_dir);
        $profile_pic=", profile_pic='$image_name'";
    }   
    $query="update tablename set firstname='$firstname',username='$username',password='$password',$profile_pic where id=".$_SESSION['userdata']['id'];
    return mysqli_query($db,$query);

}

//for validate add post
function validdatePostImage($image_data){
    $response=array();
    $response['status']=true;
    
    if(!$image_data['name']){
        $response['msg']="no image selected";
        $response['status']=false;
        $response['field']='post_img';
    }
    if($image_data['name']){
        $image=basename($image_data['name']);
        $type=strtolower(pathinfo($image,PATHINFO_EXTENTION));
        $size=$image_data['size']/1000;
        if($type!='jpg' && $type!=jpeg && $type!='png'){
            $response['msg']="only jpg,jpeg,png are allowed";
            $response['status']=false;
            $response['field']='post_img';
        }

        if($size>1000){
            $response['msg']="upload img is less than 1 mb";
            $response['status']=false;
            $response['field']='post_img';
        }  
    return $response;
}


//create post
function createPost($text,$image){
    global $db;
    $user_id=$_SESSION['userdata']['id'];
    $post_text=mysqli_escape_real_string($db,$data['post_text']);
        $image_name=time("this function genrate unique name").basename($image['name']);
        $image_dir="images/post/$image_name";
        move_uploaded_file($image['tmp_name'],$image_dir);
    $query="insert into tablename(user_id,post_text,post_img)";
    $query="values('$user_id,$post_text,$image_name)";
    return mysqli_query($db,$query);
}
// for get post
function getPost(){
    global $db;
$query="SELECT post.id,post.img,post.post_text user.username,user.profile_pic FROM post join user on user.id=post.user_id ";
$run=mysqli_query($db,$query);
return mysqli_fetch_all($run,true);

}

//for getting post dynamically
function filterPost(){
    $list=getPost();
    $filter_list=array();
    foreach($list as $Post){
        if(!checkFollowStatus($post['user_id']) || $post['user_id']==$_SESSION['userdata']['id']){
            $filter_list=$post;
        }
    }
    return $filter_list;
}

//profile page

//for getting post by id in profile page
function getPostById($user_id){
    global $db;
$query="SELECT * from post where user_id=$user_id order by id desc";
$run=mysqli_query($db,$query);
return mysqli_fetch_all($run,true);
}

//for getting userdata by username
function getUserByUsername($username){
    global $db;
$query="SELECT *FROM taablename WHERE username='$username'";
$run=mysqli_query($db,$query);
return mysqli_fetch_assoc($run);

}
// for getting user for follow suggetions
function getFollowSuggetions(){
    global $db;
    $current_user=$_SESSION['userdata']['id']; 
    $query="select * from users where id!=$current_user";
    $run=mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
} 
//for filtering suggetion list
function filterFollowSuggetion(){
    $list=getFollowSuggetions();
    $filter_list=array();
    foreach($list as $user){
        if(!checkFollowStatus($user['id']) && count($filter_list)<6){
            $filter_list=$user;
        }
    }
    return $filter_list;
}
// for checking the user is followed by current user or no
function checkFollowStatus($user_id){
    global $db;
    $current_user=$_SESSION['userdata']['id']; 
    $query="select count(*) as row from follow_list where follower_id=$current_user && user_id=$user_id";
    $run=mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}
//function for follow the user
function followUser($user_id){
    global$db;
    $current_user=$_SESSION['userdata']['id'];
    $query="insert into follow_list(follower_id,user_id)values($current_user,$user_id)";
    return mysqli_query($db,$query);  
}

//function for unfollow the user
function unfollowUser($user_id){
    global$db;
    $current_user=$_SESSION['userdata']['id'];
    $query="delete from foolow_list where follower_id=$current_user && user_id=$user_id";
    return mysqli_query($db,$query);  
}
//get followers count
function getFollower($user_id){
      global $db;
    $query="select * from follow_list where user_id=$user_id";
    $run=mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}


//get following count
function getFollowing($user_id){
    global $db;
  $query="select * from follow_list where follower_id=$user_id";
  $run=mysqli_query($db,$query);
  return mysqli_fetch_all($run,true);
}
//function check like status jenathi database ma double var like na thai jo tame unlike karo to unlike thai
function checkLikeStatus($post_id){
    global $db;
    $current_user=$_SESSION['userdata']['id']; 
    $query="select count(*) as row from likes where user_id=$current_user && post_id=$post_id";
    $run=mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}

//function for like the post
function like($post_id){
    global$db;
    $current_user=$_SESSION['userdata']['id'];
    $query="insert into likes(post_id,user_id)values($post_id,$current_user)";
    return mysqli_query($db,$query);  
}



//function for unlike the post
function unlike($post_id){
    global$db;
    $current_user=$_SESSION['userdata']['id'];
    $query="delete from likes where user_id=$current_user && post_id=$post_id"; 
    return mysqli_query($db,$query);  
}

//funcion for getting like count
function getLikes($post_id){
    global $db;
    $query="select * from comment where  post_id=$post_id";
    $run=mysqli_query($db,$query);
    return mysqli_fetch_assoc($run);
}

//funcion for getting comment count
function getComment($post_id){
    global $db;
    $query="select * from likes where  post_id=$post_id";
    $run=mysqli_query($db,$query);
    return mysqli_fetch_assoc($run);
}

//function for creating comment
function addcomment($post_id,$comment){
    global$db;
    $comment=mysqli_escape_real_string($db,$comment);
    $current_user=$_SESSION['userdata']['id'];
    $query="insert into comment(post_id,user_id,comment)values($current_user,$post_id,$comment)";
    return mysqli_query($db,$query);  
}

//for getting id of chat user
function getActiveChaatUserIds(){
    global $db;
    $current_user_id=$_SESSION['userdata']['id'];
    $query="select from_user_id,to_user_id from messages where to_user_id=$current_user_id || from_user_id=$current_user_id order by id DESC";
    $run=mysqli_query($db,$run);
    $data= mysqli_fetch_all($run,true);
    $ids=array();
    foreach($data as $ch){
        if($ch['from_user_id']!=$current_user_id && !in_array($ch['from_user_id'],$ids)){
            $ids[]=$ch['from_user_id'];
        }
        if($ch['to_user_id']!=$current_user_id && !in_array($ch['to_user_id'],$ids)){
            $ids[]=$ch['to_user_id'];
        }
    }
    return $ids;
}
function getMessages($user_id){
    global $db;
    $current_user_id=$_SESSION['userdata']['id'];
    $query="select* from messages where (to_user_id=$current_user_id && from_user_id=$user_id) || (from_user_id=$current_user_id && to_user_id=$user_id) order by id DESC";
    $run=mysqli_query($db,$run);
    return mysqli_fetch_all($run,true);
}

function getAllMessages(){
    $active_chat_ids=getActiveChaatUserIds();
    $conversation=array();
    foreach($active_chat_ids as $index=>$id){
        $conversation[$index]['useer_id']=$id;
        $conversation[$index]['messages']=>getMessages($id);
    }
    return $conversation;
}
?>