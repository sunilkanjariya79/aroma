<?php
require_once 'conn.php';
//functio for show pages
function showPage($page,$data=""){
    include("assets/pages/$page.php");
}
//for validating register form
function validateRegisterForm($form_data){
    $response=array();
    $response['status']=true;
    if(!$form_data['upassword']){
        $response['msg']="password is not given";
        $response['status']=false;
        $response['field']='upassword';
    }
    if(!$form_data['uabout']){
        $response['msg']="user about is not given";
        $response['status']=false;
        $response['field']='uabout';
    }
    if(!$form_data['username']){
        $response['msg']="username is not given";
        $response['status']=false;
        $response['field']='username';
    }
    if(!$form_data['uname']){
        $response['msg']=" name is not given";
        $response['status']=false;
        $response['field']='uname';
    }
    if(!$form_data['umail']){
        $response['msg']="Email is not given";
        $response['status']=false;
        $response['field']='umail';
    }
    if(isEmailRegistered($form_data['umail'])){
        $response['msg']="Email is already register";
        $response['status']=false;
        $response['field']='umail';
    }
    if(isUsernameRegistered($form_data['username'])){
        $response['msg']="username is already register";
        $response['status']=false;
        $response['field']='username';
    }
    return $response;
}
//function for show error
function showError($field){
    if(isset($_SESSION['error'])){
        $error=$_SESSION['error'];
        if(isset($error['field']) && $field==$error['field']){
            ?>
            <?=$error['msg']?>
            <?php
        }
    }
}
//function for showing pervious form data
function showFormaData($field){
    if(isset($_SESSION['formdata'])){
        $formdata=$_SESSION['formdata'];
        return $formdata['$field'];      
    }
} 
//for checking dublicate email
function isEmailRegistered($email){
    global $db;
    $query="select count(*) as 'row' from users where umail='".$email."'";
    $run=mysqli_query($db,$query);
    $return_data=mysqli_fetch_array($run);
    return $return_data['row'];
}
//for checking dublicate username
function isUsernameRegistered($username){
    global $db;
    $query="select count(*) as 'row' from users where  username='$username'";
    $run=mysqli_query($db,$query);
    $return_data=mysqli_fetch_assoc($run);
    return $return_data['row'];
}
//for creating user
function createuser($data){
    global $db;
    $umail = mysqli_real_escape_string($db, $data['umail']);
    $uname = mysqli_real_escape_string($db, $data['uname']);
    $username = mysqli_real_escape_string($db, $data['username']);
    $gender = mysqli_real_escape_string($db, $data['gender']);
    $uabout = mysqli_real_escape_string($db, $data['uabout']);
    $udate = mysqli_real_escape_string($db, $data['udate']);
    $upassword = mysqli_real_escape_string($db, $data['upassword']);
    $profile_pic = mysqli_real_escape_string($db, $data['uprofile_pic']);
    $query="insert into users(uprofile_photo,umail,uname,username,gender,uabout,udate,upassword) values('".$profile_pic."','".$umail."','".$uname."','".$username."','".$gender."','".$uabout."','".$udate."','".$upassword."')";
    $run = mysqli_query($db,$query);
    return mysqli_query($db,$query);
}

//login functions


//for validating login
function validatesLoginForm($form_data){
    $response=array();
    $response['status']=true;
    $blank=false;
    //for all filed are desending order like password,email,username etc
    if(!$form_data['upassword']){
        $response['msg']="password is not give";
        $response['status']=false;
        $response['field']='password';
        $blank=true;
    }
    if(!$form_data['umail']){
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
$username_email=$login_data['umail'];
$password=$login_data['upassword'];
$query="SELECT * FROM users WHERE (umail='".$username_email."' || username='".$username_email."')&& upassword='".$password."'";
$run=mysqli_query($db,$query);
$data['user']= mysqli_fetch_assoc($run);
if(!is_null($data['user']) && count($data['user'])>0){
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
$query="SELECT *FROM users WHERE uid=$user_id";
$run=mysqli_query($db,$query);
return mysqli_fetch_assoc($run);

}
?>