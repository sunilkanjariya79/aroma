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

//for managing login form
//for validating register form
function validateLoginForm($form_data){
    $response=array();
    $response['status']=true;
    $blank=false;
    if(!$form_data['upassword']){
        $response['msg']="password is not given";
        $response['status']=false;
        $response['field']='upassword';
        $blank=true;
    }
    if(!$form_data['username_email']){
        $response['msg']="username/email is not given";
        $response['status']=false;
        $response['field']='username_email';
        $blank=true;
    }
    if(!$blank && !checkUser($form_data)['status']){
        $response['msg']="something is wrong";
        $response['status']=false;
        $response['field']='checkuser';
    }else{
       $response['user']=checkUser($form_data)['user'];
    }
    return $response;
}
//for checking a user
function checkUser($login_data){
    global $db;
    $username_email=$login_data['username_email'];
    $password=$login_data['upassword'];
    $query="select * from users where (umail='$username_email' || username='$username_email') && upassword='$password'";
    $run=mysqli_query($db,$query);
    $data['user']=mysqli_fetch_assoc($run);
    if($data['user']>0){
        $data['status']=true;
    }else{
        $data['status']=false;
    }
    return $data;
}
//for getting userdata by id
function getUser($uid){
    global $db;
 $query = "SELECT * FROM users WHERE uid=".$uid;
 $run = mysqli_query($db,$query);
 return mysqli_fetch_assoc($run);

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
    if (!$run) {
        echo "Query error: " . mysqli_error($db);
    }
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

//for checking duplicate username by other
function isUsernameRegisteredByOther($username){
    global $db;
    $user_id=$_SESSION['userdata']['uid'];
    $query="select count(*) as 'row' from users where  username='$username' && uid !=$user_id";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
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
    return mysqli_query($db,$query);
}




//for validating update form
function validateUpdateForm($form_data,$image_data){
    $response=array();
    $response['status']=true;
        if(!$form_data['uabout']){
            $response['msg']="About is not given";
            $response['status']=false;
            $response['field']='uabout';
        }
        
        if(!$form_data['username']){
            $response['msg']="username is not given";
            $response['status']=false;
            $response['field']='username';
        }
        if(!$form_data['uname']){
            $response['msg']="name is not given";
            $response['status']=false;
            $response['field']='name';
        }
  
        if(isUsernameRegisteredByOther($form_data['username'])){
            $response['msg']=$form_data['username']." is already registered";
            $response['status']=false;
            $response['field']='username';
        }
    
       if($image_data['name']){
           $image = basename($image_data['name']);
           $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
           $size = $image_data['size']/1000;

           if($type!='jpg' && $type!='jpeg' && $type!='png'){
            $response['msg']="only jpg,jpeg,png images are allowed";
            $response['status']=false;
            $response['field']='profile_pic';
        }

        if($size>5000){
            $response['msg']="upload image less then 5 mb";
            $response['status']=false;
            $response['field']='profile_pic';
        }
       }

        return $response;
    
    }
    

    //function for updating profile

    function updateProfile($data,$imagedata){
        global $db;
        $name = mysqli_real_escape_string($db,$data['uname']);
        $about = mysqli_real_escape_string($db,$data['uabout']);
        $username = mysqli_real_escape_string($db,$data['username']);
        $profile_pic="";
        if($imagedata['name']){
            $image_name = time().basename($imagedata['name']);
            $image_dir="../images/profile/$image_name";
            move_uploaded_file($imagedata['tmp_name'],$image_dir);
            $profile_pic=", uprofile_photo='$image_name'";
        }
        $query = "UPDATE users SET uname = '".$name."', uabout='".$about."',username='".$username."'". $profile_pic ."WHERE uid=".$_SESSION['userdata']['uid'];
        return mysqli_query($db,$query);

    }

//for post
    function validatePostDetails($post_data){
        $response=array();
        $response['status']=true;
          
    
            if(!$post_data['hidden-input']){
                $response['msg']="you don't have any text to post here";
                $response['status']=false;
                $response['field']='hidden-input';
            }
            if(!$post_data['tag']){
                $response['msg']="Please add Tag";
                $response['status']=false;
                $response['field']='tag';
            }
            if(!$post_data['title']){
                $response['msg']="Please add Title";
                $response['status']=false;
                $response['field']='title';
            }
            return $response;
        
        }

//for book

        function validateBookDetails($book_data,$image_data){
            $response=array();
            $response['status']=true;
            if(!$book_data['hidden-input']){
                $response['msg']="you don't have any text to post here";
                $response['status']=false;
                $response['field']='hidden-input';
            }
            if(!$book_data['babout']){
                $response['msg']="Please add Tag";
                $response['status']=false;
                $response['field']='babout';
            }
                if(!$book_data['btag']){
                    $response['msg']="Please add Tag";
                    $response['status']=false;
                    $response['field']='btag';
                }
                if(!$book_data['btitle']){
                    $response['msg']="Please add Title";
                    $response['status']=false;
                    $response['field']='btitle';
                }
          if(!$image_data['name']){
            $response['msg']="no image is selected";
            $response['status']=false;
            $response['field']='bcover';
        }  
       if($image_data['name']){
           $image = basename($image_data['name']);
           $type = strtolower(pathinfo($image,PATHINFO_EXTENSION));
           $size = $image_data['size']/1000;

           if($type!='jpg' && $type!='jpeg' && $type!='png'){
            $response['msg']="only jpg,jpeg,png images are allowed";
            $response['status']=false;
            $response['field']='bcover';
        }

        if($size>5000){
            $response['msg']="upload image less then 1 mb";
            $response['status']=false;
            $response['field']='bcover';
        }
       }
        return $response;
            
    }
    
    
   //for creating new post
   function createPost($post){
    global $db;
    $title = mysqli_real_escape_string($db,$post['title']);
    $tag = mysqli_real_escape_string($db,$post['tag']);
    $post_content = $post['hidden-input'];
    $user_id=$_SESSION['userdata']['uid'];

    $randomFileName = uniqid() . '.html';
    $filePath = '../post_data/casual/' . $randomFileName;
    if (file_put_contents($filePath, $post_content)) {
        // Prepare an SQL statement to save title, tags, and filename
        $query = "insert into casual_post (uid,ptitle,ptag,pcontent) values(".$user_id.",'".$title."','".$tag."','".$randomFileName."')";
    return mysqli_query($db,$query) or die(mysqli_error($db));
    }
    else{
        print_r("not done");
    }
   }
      
   //for creating new book
   function createBook($post,$image){
    global $db;
    
    $title = mysqli_real_escape_string($db,$post['btitle']);
    $tag = mysqli_real_escape_string($db,$post['btag']);
    $about = mysqli_real_escape_string($db,$post['babout']);
    $post_content = $post['hidden-input'];
    $user_id=$_SESSION['userdata']['uid'];

    $image_name = time().basename($image['name']);
        $image_dir="../images/book-cover/$image_name";
        move_uploaded_file($image['tmp_name'],$image_dir);
    $randomFileName = uniqid() . '.html';
    $filePath = '../post_data/books/' . $randomFileName;
    if (file_put_contents($filePath, $post_content)) {
        // Prepare an SQL statement to save title, tags, and filename
        $query = "insert into book_post (uid,btitle,btag,babout,bcover,bcontent) values(".$user_id.",'".$title."','".$tag."','".$about."','".$image_name."','".$randomFileName."')";
        return mysqli_query($db,$query) or die(mysqli_error($db));
    }
    else{
        print_r("not done");
    }
   }
       
   
   //for getting posts
   function getPost(){
       global $db;
    $query = "SELECT casual_post.pid,casual_post.ptitle,casual_post.pcontent, casual_post.ptag, casual_post.pdate,users.uname,users.username from casual_post join users on users.uid=casual_post.uid";
    $run = mysqli_query($db,$query);
    if (!$run) {
        // If query fails, output error details
        die("Query Failed: " . mysqli_error($db));
    }
    return mysqli_fetch_all($run,true);
   
   }

   //to display content of post in short
   function getPostContent($post_file){
    $file_path = 'assets/post_data/casual/'.$post_file;
    $html_content = file_get_contents($file_path);
    if (preg_match('/<[^>]+>/', $html_content)) {
        
        // Remove the HTML tags but keep the content
        $clean_content = strip_tags($html_content);
        return $clean_content;
    }
    return $html_content;
   }

   function getBook(){
    global $db;
    $query = "SELECT book_post.bid,book_post.btitle,book_post.bcontent,book_post.babout, book_post.btag, book_post.bdate,book_post.bcover,users.uname,users.username from book_post join users on users.uid=book_post.uid";
    $run = mysqli_query($db,$query);
    if (!$run) {
        // If query fails, output error details
        die("Query Failed: " . mysqli_error($db));
    }
    return mysqli_fetch_all($run,true);

    }

   // to return the string in given limit
   function cutString($string, $limit) {
       // Check if the string is longer than the limit
       if (strlen($string) > $limit) {
           // Cut the string to the limit and append '...' to indicate truncation
           return substr($string, 0, $limit) . '...';
       } else {
           // If the string is within the limit, return it as is
           return $string;
       }
   }
   


?>