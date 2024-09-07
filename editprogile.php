<?php
global $user;
<form action="action.php?editprogile" enctype="">
<?php
    if(isset($_GET[success])){
        <p>profile updated</p>
    }
?>
<img src="images/<?$user['profile_pic']?>" alt="">
<?=showError('profile_pic')?>
<input type="text" name="firstname" value="<?=$user['firstname']?>">
<?=showError('firstname')?> 
<input type="text" name="lastname"  value="<?=$user['lastname']?>">
<input type="radio" name="gender">
<option value="<?=$user['gender']==1?'checked':''?>">male</option>
<option value="<?=$user['gender']==2?'checked':''?>">female</option>
<option value="<?=$user['gender']==0?'checked':''?>">other</option>
<input type="text" name="email" value="<?=$user['email']?>">
<input type="text" name="username" value="<?=$user['username']?>">
<?=showError('username')?>
<input type="text" name="password">
</form>

?>