
    <form action="assets/php/action.php?addpost" method="post" class="main-content" style= "padding: 0px 20px;" id="add-post-form">
    <h2 class="secondary-heading" style="margin-right:auto"> Create Post</h2>
    <input type="text" name="title" id="title" placeholder="Title" class="log-reg-field">
    <input type="text" name="tag" id="tag" placeholder="tag" class="log-reg-field">

      <div class="options">
        <!-- Text Format -->
        <button type="button" id="bold" class="option-button format">
          <i class="fa-solid fa-bold"></i>
        </button>
        <button type="button" id="italic" class="option-button format">
          <i class="fa-solid fa-italic"></i>
        </button>
        <button type="button" id="underline" class="option-button format">
          <i class="fa-solid fa-underline"></i>
        </button>
        <button type="button" id="strikethrough" class="option-button format">
          <i class="fa-solid fa-strikethrough"></i>
        </button>
        <button type="button" id="superscript" class="option-button script">
          <i class="fa-solid fa-superscript"></i>
        </button>
        <button type="button" id="subscript" class="option-button script">
          <i class="fa-solid fa-subscript"></i>
        </button>   

        <!-- Undo/Redo -->
        <button type="button" id="undo" class="option-button">
          <i class="fa-solid fa-rotate-left"></i>
        </button>
        <button type="button" id="redo" class="option-button">
          <i class="fa-solid fa-rotate-right"></i>
        </button>

        <!-- Link -->
        <button type="button" id="createLink" class="adv-option-button">
          <i class="fa fa-link"></i>
        </button>
        <button type="button" id="unlink" class="option-button">
          <i class="fa fa-unlink"></i>
        </button>
        <input type="submit" value="Post" class="primery-button" style="margin-left:auto">
      </div>
      
      <div id="text-input" contenteditable="true"></div>
      <input type="hidden" id="hidden-input" name="hidden-input">
      
    </div>
    </form> 
