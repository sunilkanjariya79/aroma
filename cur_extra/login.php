<form action="action.php?login">
    <input type="text" name="username_email" value=<?=$showFormData('username_password')?>>
    <?=showError('username_email')?>
    <input type="text" name="password">
    <?=showError('password')?>
    <!-- jyare password khoto nalho tyare error show thai -->
    <?=showError('checkUser')?>
</form>