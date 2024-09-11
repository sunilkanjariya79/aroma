$(document).ready(function () {
    let optionsButtons = $(".option-button");
    let advancedOptionButton = $(".adv-option-button");
    let fontName = $("#fontName");
    let fontSizeRef = $("#fontSize");
    let linkButton = $("#createLink");
    let alignButtons = $(".align");
    let spacingButtons = $(".spacing");
    let formatButtons = $(".format");
    let scriptButtons = $(".script");
  
    // List of fonts
    const fontList = [
      "Arial",
      "Verdana",
      "Times New Roman",
      "Garamond",
      "Georgia",
      "Courier New",
      "cursive",
    ];
  
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
  