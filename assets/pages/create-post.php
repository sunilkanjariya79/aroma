<?php
include("header.php");?>

<div class="main-content">
    <form action="" method="post"></form>
    <input type="text" name="title" id="title" placeholder="Title" class="log-reg-field">
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
        <button id="superscript" class="option-button script">
          <i class="fa-solid fa-superscript"></i>
        </button>
        <button id="subscript" class="option-button script">
          <i class="fa-solid fa-subscript"></i>
        </button>   

        <!-- Undo/Redo -->
        <button id="undo" class="option-button">
          <i class="fa-solid fa-rotate-left"></i>
        </button>
        <button id="redo" class="option-button">
          <i class="fa-solid fa-rotate-right"></i>
        </button>

        <!-- Link -->
        <button id="createLink" class="adv-option-button">
          <i class="fa fa-link"></i>
        </button>
        <button id="unlink" class="option-button">
          <i class="fa fa-unlink"></i>
        </button>
      </div>
      
      <div id="text-input" contenteditable="true"></div>
      <input type="submit" value="Post" class="primery-button">
    </div>

    <?php
include("footer.php");?>
