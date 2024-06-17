$(document).ready(function() {
    // Listen for form submission
    $('#submitBtn').on('click', function() {
        // Gather form data
        var formData = $('#registrationForm').serialize();

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: 'register_process_ajax.php', // Create a new PHP file for handling AJAX requests
            data: formData,
            success: function(response) {
                // Handle the response from the server (e.g., show success/failure message)
                alert(response);
            },
            error: function(error) {
                console.log('AJAX request failed:', error);
            }
        });
    });
});

function submitLoginForm() {
    var username = $('#username').val();
    var password = $('#password').val();

    $.ajax({
        type: 'POST',
        url: 'login_process_ajax.php',
        data: { username: username, password: password },
        success: function(response) {
            // Handle the response from the server
            console.log(response);
            // You can redirect or perform other actions based on the response
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ' + status + ' - ' + error);
        }
    });
}
