     <form action="assets/php/action.php?addpost" method="post" class="main-content" style= "padding: 0px 20px;top:0px;" id="add-post-form">
    <h2 class="secondary-heading" style="margin-right:auto"> Create Post</h2>
    <input type="text" name="title" id="title" placeholder="Title" value="<?=showFormaData('title')?>" class="log-reg-field">
    <?=showError('title')?>
    <input type="text" name="tag" id="tag" placeholder="tag" value="<?=showFormaData('tag')?>" class="log-reg-field">
    <?=showError('tag')?>
       <div class="options">
        <!-- Text Format -->
        <button type="button" id="bold" class="option-button format">
          <img src="assets/images/site-meta/bold.svg" alt="B">
        </button>
        <button type="button" id="italic" class="option-button format">
        <img src="assets/images/site-meta/italic.svg" alt="B">
        </button>
        <button type="button" id="underline" class="option-button format">
        <img src="assets/images/site-meta/underline.svg" alt="B">
          
        </button>
        <button type="button" id="strikethrough" class="option-button format">
        <img src="assets/images/site-meta/strikethrough.svg" alt="B">
        </button>
        <button type="button" id="superscript" class="option-button script">
        <img src="assets/images/site-meta/superscript.svg" alt="B">
        </button>
        <button type="button" id="subscript" class="option-button script">
        <img src="assets/images/site-meta/subscript.svg" alt="B">
        </button>   
         <!-- Undo/Redo -->
        <button type="button" id="undo" class="option-button">
        <img src="assets/images/site-meta/undo.svg" alt="B">
         </button>
        <button type="button" id="redo" class="option-button">
        <img src="assets/images/site-meta/redo.svg" alt="B">
        </button>
         <!-- Link -->
        <button type="button" id="createLink" class="adv-option-button">
          <img src="assets/images/site-meta/attachment.svg" alt="B">
        </button>
        <button type="button" id="unlink" class="option-button">
        <img src="assets/images/site-meta/deattachment.svg" alt="B">
          
        </button>
        <input type="submit" value="Post" class="primery-button" style="margin-left:auto">
      </div>
      <?=showError('hidden-input')?>
      <div id="text-input" contenteditable="true"> <?=showFormaData('hidden-input')?></div>
      <input type="hidden" id="hidden-input" name="hidden-input">
      
    </div>
    </form> 
