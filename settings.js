document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector("#toggle-btn");

    hamburger.addEventListener("click",function() {
        document.querySelector("#sidebar").classList.toggle("expand");
    }); 

    $('#update-form').submit(function(event) {
        event.preventDefault();
        var updateText = $('#tbClothes').val();
        $.ajax({
        type: 'POST',
        url: 'update.php', // or update.py, update.rb, etc.
        data: { update_text: updateText },
        success: function(data) {
            console.log('Data updated successfully!');
        },
        error: function(xhr, status, error) {
            console.log('Error updating data:', error);
        }
        });
    });
});
// 8/22/24 1:02 am kailangan ko ilagay yung sa settings.js niya tapos integrate dine para gumana ang sidebar
