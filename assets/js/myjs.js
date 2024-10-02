    // script.js
$(document).ready(function() {

    //opening last opened tab
      // Check the stored value in localStorage
      var activeTab = localStorage.getItem('active');
  
      // If no tab is set, default to casuals
      if (activeTab === 'books') {
          $('#casuals-container').addClass('hide').removeClass('show');
          $('#books-container').addClass('show').removeClass('hide');
          $('#books').addClass('w--current');
          $('#casuals').removeClass('w--current');
      } else {
          $('#books-container').addClass('hide').removeClass('show');
          $('#casuals-container').addClass('show').removeClass('hide');
          $('#casuals').addClass('w--current');
          $('#books').removeClass('w--current');
      }
  

    //to change to casual posts tab
    $('#casuals').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        $('#books-container').removeClass('fade-in show').addClass('fade-out hide');
        $('#casuals-container').addClass('show').removeClass('hide');
        $('#books-container').addClass('hide').removeClass('show');
        $('#casuals').addClass('w--current');
        $('#books').removeClass('w--current');
        localStorage.setItem('active','casuals');
    });

    //to change to books tab
    $('#books').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        
        $('#casuals-container').addClass('hide').removeClass('show');
        $('#books-container').addClass('show').removeClass('hide');
        $('#books').addClass('w--current');
        $('#casuals').removeClass('w--current');
        localStorage.setItem('active','books');

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

      //to show add details menu in follow section
    $('.show-follow-input').click(function(event) {
      $('#following').removeClass('hide');
    });

    //to close pop up manu on page
     $('.close').click(function(event) {
      $('.pop-up-window').addClass('hide');
      });

      //to show add details menu in followers section
    $('.show-follower-input').click(function(event) {
      $('#followers').removeClass('hide');
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


//for follow the user
$(".followbtn").click(function(){
var user_id_r = $(this).data('userId');
var button = this;
$(button).attr('disabled', true);
  $.ajax({
    url:'assets/php/ajax.php',
    method:'POST',
    dataType: 'json',
    data: { follow: true, user_id : user_id_r},
    success: function (response) {
      console.log(response);
      if (response.status) {
          $(button).data('userId', 0);
          $(button).html('Followed');
          $(button).removeClass('primery-button');
          $(button).addClass('secondary-button');


      } else {
          $(button).attr('disabled', false);

          alert('something is wrong,try again after some time');
      }
  },
  error: function(xhr, status, error) {
    // Handle errors
    console.error("AJAX Error: ", status, error);
    alert('An error occurred. Please try again later.');
    $(button).attr('disabled', false);  // Re-enable button on error
}
});

});


//for unfollow the user
$(".unfollowbtn").click(function(){
  var user_id_r = $(this).data('userId');
  var button = this;
  $(button).attr('disabled', true);
    $.ajax({
      url:'assets/php/ajax.php',
      method:'POST',
      dataType: 'json',
      data: { unfollow: true, user_id : user_id_r},
      success: function (response) {
        console.log(response);
        if (response.status) {
            $(button).data('userId', 0);
            $(button).html('Unfollowed');
            $(button).addClass('primery-button');
            $(button).removeClass('secondary-button');
  
  
        } else {
            $(button).attr('disabled', false);
  
            alert('something is wrong,try again after some time');
        }
    },
    error: function(xhr, status, error) {
      // Handle errors
      console.error("AJAX Error: ", status, error);
      alert('An error occurred. Please try again later.');
      $(button).attr('disabled', false);  // Re-enable button on error
  }
  });
  
  });

  

//for like the post



$(".likepostbtn").click(function () {
  var post_id_r = $(this).data('postId');
  var button = this;
  $(button).attr('disabled', true);
  $.ajax({
      url: 'assets/php/ajax.php',
      method: 'POST',
      dataType: 'json',
      data: { likepost: true, post_id: post_id_r },
      success: function (response) {
          console.log(response);
          if (response.status) {

              $(button).attr('disabled', false);
              $(button).attr('src','assets/images/site-meta/heart-solid.svg');
              $(button).siblings('.unlike_btn').show();
              $('#likecount' + post_id_v).text($('#likecount' + post_id_v).text() - (-1));
              // location.reload();

          } else {
              $(button).attr('disabled', false);
              alert('something is wrong,try again after some time');

          }


      },
      error: function(xhr, status, error) {
        // Handle errors
        console.error("AJAX Error: ", status, error);
        alert('An error occurred. Please try again later.');
        $(button).attr('disabled', false);  // Re-enable button on error
    }
  });
});



$(".unlike_btn").click(function () {
  var post_id_v = $(this).data('postId');
  var button = this;
  $(button).attr('disabled', true);
  $.ajax({
      url: 'assets/php/ajax.php?unlike',
      method: 'post',
      dataType: 'json',
      data: { post_id: post_id_v },
      success: function (response) {

          if (response.status) {

              $(button).attr('disabled', false);
              $(button).hide()
              $(button).siblings('.like_btn').show();
              // location.reload();
              $('#likecount' + post_id_v).text($('#likecount' + post_id_v).text() - 1);

          } else {
              $(button).attr('disabled', false);

              alert('something is wrong,try again after some time');


          }



      }
  });
});



$(".likebookbtn").click(function () {
  var book_id_r = $(this).data('bookId');
  var button = this;
  $(button).attr('disabled', true);
  $.ajax({
      url: 'assets/php/ajax.php',
      method: 'POST',
      dataType: 'json',
      data: { likebook: true, book_id: book_id_r },
      success: function (response) {
          console.log(response);
          if (response.status) {

              $(button).attr('disabled', false);
              $(button).attr('src','assets/images/site-meta/heart-solid.svg');
              $(button).siblings('.unlike_btn').show();
              $('#likecount' + book_id_v).text($('#likecount' + post_id_v).text() - (-1));
              // location.reload();

          } else {
              $(button).attr('disabled', false);
              alert('something is wrong,try again after some time');

          }


      },
      error: function(xhr, status, error) {
        // Handle errors
        console.error("AJAX Error: ", status, error);
        alert('An error occurred. Please try again later.');
        $(button).attr('disabled', false);  // Re-enable button on error
    }
  });
});



$(".unlike_btn").click(function () {
  var post_id_v = $(this).data('postId');
  var button = this;
  $(button).attr('disabled', true);
  $.ajax({
      url: 'assets/php/ajax.php?unlike',
      method: 'post',
      dataType: 'json',
      data: { post_id: post_id_v },
      success: function (response) {

          if (response.status) {

              $(button).attr('disabled', false);
              $(button).hide()
              $(button).siblings('.like_btn').show();
              // location.reload();
              $('#likecount' + post_id_v).text($('#likecount' + post_id_v).text() - 1);

          } else {
              $(button).attr('disabled', false);

              alert('something is wrong,try again after some time');


          }



      }
  });
});


//to get text of post

document.getElementById('add-post-form').addEventListener('submit', function (e) {
  // Get the content of the contenteditable div
  var editableContent = document.getElementById('text-input').innerHTML;

  // Set the value of the hidden input field
  document.getElementById('hidden-input').value = editableContent;
});

