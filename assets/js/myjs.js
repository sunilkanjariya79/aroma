    // script.js
$(document).ready(function() {
    $('#casuals').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        
        $('#casuals-container').addClass('show').removeClass('hide');
        $('#books-container').addClass('hide').removeClass('show');
        $('#casuals').addClass('w--current');
        $('#books').removeClass('w--current');
    });

    $('#books').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        
        $('#casuals-container').addClass('hide').removeClass('show');
        $('#books-container').addClass('show').removeClass('hide');
        $('#books').addClass('w--current');
        $('#casuals').removeClass('w--current');
    });
});
