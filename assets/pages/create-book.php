    <form action="assets/php/action.php?addbook" method="post" class="main-content" id="add-post-form"enctype="multipart/form-data" style= "padding: 0px 20px; top:0px;">
    <h2 class="secondary-heading" style="margin-right:auto"> Create Post</h2>
    <div class="pop-up-window book-input hide">
    <div class="pop-up">
                <div class="pop-up-heading">
                  <h2 class="heading-2">heading</h2>
                  <a class="close"><img src="assets/images/site-meta/xmark-circle.svg" width="32" height="32" alt=""></a>
                </div>
                <div class="pop-up-content" style="gap:20px;padding-bottom:20px">
                <input type="text" name="btitle" id="btitle" placeholder="Title" value="<?=showFormaData('btitle')?>" class="log-reg-field">
                <input type="text" name="btag" id="btag" placeholder="tag" value="<?=showFormaData('btag')?>" class="log-reg-field">
                <textarea placeholder="What's this book about" maxlength="220" name="babout" value="<?=showFormaData('babout')?>" class="log-reg-field reg-edit-about w-input"></textarea>
                <label for="file-upload" class="custom-file-upload">Add Book Cover   <img src="assets/images/site-meta/plus-circle.svg" alt=""  /></a></label>
                <input id="file-upload" type="file" name="bcover" id="bcover"/> 
                <a class="primery-button"> Add</a>
              </div>
                
                </div>
              </div>
    
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

        <!-- Alignment -->
        <button type="button" id="justifyLeft" class="option-button align">
        <img src="assets/images/site-meta/align-left.svg" alt="B">
        </button>
        <button type="button" id="justifyCenter" class="option-button align">
        <img src="assets/images/site-meta/align-center.svg" alt="B">
        </button>
        <button type="button" id="justifyRight" class="option-button align">
        <img src="assets/images/site-meta/align-right.svg" alt="B">
        </button>
        <button type="button" id="justifyFull" class="option-button align">
        <img src="assets/images/site-meta/align-justify.svg" alt="B">
        </button>
        <button type="button" id="indent" class="option-button spacing">
        <img src="assets/images/site-meta/text-indent-left.svg" alt="B">
        </button>
        <button type="button" id="outdent" class="option-button spacing">
        <img src="assets/images/site-meta/text-indent-right.svg" alt="B">
        </button>

        <!-- Undo/Redo -->
        <button type="button" id="undo" class="option-button">
        <img src="assets/images/site-meta/undo.svg" alt="B">
        </button>
        <button type="button" id="redo" class="option-button">
        <img src="assets/images/site-meta/redo.svg" alt="B">
        </button>
        <a class="secondary-button show-book-input" style="margin-left:auto"> Add Details </a>
        <input type="submit" value="Post" class="primery-button" >
      </div>
      <?=showError('btitle')?>
      <?=showError('btag')?>
      <?=showError('babout')?>
      <?=showError('bcover')?>
      <?=showError('hidden-input')?>
      <div id="text-input"  contenteditable="true"><?=showFormaData('hidden-input')?></div>
      <input type="hidden" id="hidden-input" name="hidden-input">
      
    </div>
    </form>
