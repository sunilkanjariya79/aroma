<form action="action.php?signup"></form>
<!-- showing error for all filed like username ,password -->
<?=showError('username')?>
<?=showError('password')?>


<!-- enter karel data re etla mate for all field -->
 <input type="text"  name="username" value=<?=$showFormData('username')?>>
 <input type="text"  name="password" value=<?=$showFormData('password')?>>
