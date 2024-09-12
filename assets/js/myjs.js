    // script.js
$(document).ready(function() {

    //to change to casual posts tab
    $('#casuals').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        
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
});


