<?php
  if(isset($_GET['search'])){
    $search = $_GET['search'];
  }
  else{
    $search = '';
  }
?>
<div class="top-panel">
    <div class="search-area">
      <form method="post" action="assets/php/action.php/?search"  class="search-bar w-form">
        <input class="log-reg-field search-area w-input" value="<?=$search?>" placeholder="Search…" type="search" name="search" id="search">
        <input type="submit" class=" primery-button search-button  w-button" value="Search"></form>
    </div>
  </div>
 