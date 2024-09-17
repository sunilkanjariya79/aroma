<?php
include("header.php");?>




    <form action="" method="post" class="main-content" style= "padding: 0px 20px;">
    <h2 class="secondary-heading" style="margin-right:auto"> Create Post</h2>
    <div class="pop-up-window hide">
    <div class="pop-up">
                <div class="pop-up-heading">
                  <h2 class="heading-2">heading</h2>
                  <a class="close"><img src="assets/images/site-meta/charm_cross.svg" width="32" height="32" alt=""></a>
                </div>
                <div class="pop-up-content">
                <input type="text" name="title" id="title" placeholder="Title" class="log-reg-field">
                <textarea placeholder="What's this book about" maxlength="220" name="babout" class="log-reg-field reg-edit-about w-input"></textarea>
                Add Book Cover <input type="file" name="uprofile_pic" id="uprofile_photo"></div>
                <a onClick class="primery-button"> Add</a>
                </div>
              </div>
    
      <div class="options">
        <!-- Text Format -->
        <button id="bold" class="option-button format">
          <i class="fa-solid fa-bold"></i>
        </button>
        <button id="italic" class="option-button format">
          <i class="fa-solid fa-italic"></i>
        </button>
        <button id="underline" class="option-button format">
          <i class="fa-solid fa-underline"></i>
        </button>
        <button id="strikethrough" class="option-button format">
          <i class="fa-solid fa-strikethrough"></i>
        </button>  

        <!-- Alignment -->
        <button id="justifyLeft" class="option-button align">
          <i class="fa-solid fa-align-left"></i>
        </button>
        <button id="justifyCenter" class="option-button align">
          <i class="fa-solid fa-align-center"></i>
        </button>
        <button id="justifyRight" class="option-button align">
          <i class="fa-solid fa-align-right"></i>
        </button>
        <button id="justifyFull" class="option-button align">
          <i class="fa-solid fa-align-justify"></i>
        </button>
        <button id="indent" class="option-button spacing">
          <i class="fa-solid fa-indent"></i>
        </button>
        <button id="outdent" class="option-button spacing">
          <i class="fa-solid fa-outdent"></i>
        </button>

        <!-- Undo/Redo -->
        <button id="undo" class="option-button">
          <i class="fa-solid fa-rotate-left"></i>
        </button>
        <button id="redo" class="option-button">
          <i class="fa-solid fa-rotate-right"></i>
        </button>
        <a class="secondary-button show-book-input" style="margin-left:auto"> Add Details </a>
        <input type="submit" value="Post" class="primery-button" >
      </div>
      
      <div id="book-input"  contenteditable="true"></div>
      
    </div>
    </form>
    <?php
include("footer.php");?>
