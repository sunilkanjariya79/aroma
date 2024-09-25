    // script.js
$(document).ready(function() {

    //to change to casual posts tab
    $('#casuals').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        $('#books-container').removeClass('fade-in show').addClass('fade-out hide');
        $('#casuals-container').addClass('show').removeClass('hide');
        $('#books-container').addClass('hide').removeClass('show');
        $('#casuals').addClass('w--current');
        $('#books').removeClass('w--current');
    });

    //to change to books tab
    $('#books').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        
        $('#casuals-container').addClass('hide').removeClass('show');
        $('#books-container').addClass('show').removeClass('hide');
        $('#books').addClass('w--current');
        $('#casuals').removeClass('w--current');
    });

    //to show add photo menu on register and update page
    $('.reg-edit-img-in').click(function(event) {
        $('.add-img').removeClass('hide');
    });

    //to close pop up manu on page
    $('.close').click(function(event) {
        $('.pop-up-window').addClass('hide');
    });

    //to show add details menu in books section
    $('.show-book-input').click(function(event) {
      $('.pop-up-window').removeClass('hide');
    });

    //to close pop up manu on page
     $('.close').click(function(event) {
      $('.pop-up-window').addClass('hide');
      });


    // create post, books and casual posts both
    let optionsButtons = $(".option-button");
    let advancedOptionButton = $(".adv-option-button");
    let linkButton = $("#createLink");
    let alignButtons = $(".align");
    let spacingButtons = $(".spacing");
    let formatButtons = $(".format");
    let scriptButtons = $(".script");
  
  
    // Initial Settings
    const initializer = () => {
      // Function calls for highlighting buttons
      highlighter(alignButtons, true);
      highlighter(spacingButtons, true);
      highlighter(formatButtons, false);
      highlighter(scriptButtons, true);
    };
  
    // Function to focus on contenteditable div
    const focusEditableDiv = () => {
      let editableDiv = $('div[contenteditable="true"]');
      if (editableDiv.length) {
        editableDiv.focus();
      } else {
        console.error("Contenteditable div not found.");
      }
    };
  
    // Main logic for text modification
    const modifyText = (command, defaultUi, value) => {
      document.execCommand(command, defaultUi, value);
      focusEditableDiv(); // Focus after modification
    };
  
    // Add event listeners for basic operations
    optionsButtons.on("click", function () {
      modifyText($(this).attr("id"), false, null);
    });
  
    // Add event listeners for advanced options that require a value
    advancedOptionButton.on("change", function () {
      modifyText($(this).attr("id"), false, $(this).val());
    });
  
    // Add event listener for link creation
    linkButton.on("click", function () {
      let userLink = prompt("Enter a URL");
      if (userLink) {
        if (!/^https?:\/\//i.test(userLink)) {
          userLink = "http://" + userLink;
        }
        modifyText("createLink", false, userLink);
      }
    });
  
    // Highlight clicked button
    const highlighter = (buttons, needsRemoval) => {
      buttons.on("click", function () {
        if (needsRemoval) {
          const alreadyActive = $(this).hasClass("active");
          highlighterRemover(buttons);
          if (!alreadyActive) {
            $(this).addClass("active");
          }
        } else {
          $(this).toggleClass("active");
        }
      });
    };
  
    // Remove highlights from all buttons in a group
    const highlighterRemover = (buttons) => {
      buttons.removeClass("active");
    };
  
    // Initialize on page load
    initializer();
});


//to get text of post

document.getElementById('add-post-form').addEventListener('submit', function (e) {
  // Get the content of the contenteditable div
  var editableContent = document.getElementById('text-input').innerHTML;

  // Set the value of the hidden input field
  document.getElementById('hidden-input').value = editableContent;
});

