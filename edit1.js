document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle functionality
    const hamburger = document.querySelector("#toggle-btn");
    hamburger.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("expand");
    });

    // Function to close the edit form
    const editButtons = document.querySelectorAll(".edit-btn");

    editButtons.forEach(button => {
        button.addEventListener("click", function() {
            const price = this.getAttribute("data-price");
            const categoryOption = this.getAttribute("data-option");
            const serviceId = this.getAttribute("data-id");

            document.getElementById("price").value = price; // Set price in the input field
            document.getElementById("laundry_category_option").value = categoryOption;
            document.getElementById("service_id").value = serviceId; // Assuming you add a hidden input for service_id

            // Show the edit form
            document.getElementById("editForm").style.display = "flex";
            document.body.classList.add('modal-open');
        });

    });

    // close the form
    const closeFormButton = document.querySelector('.form-popup .close');
    closeFormButton.addEventListener('click', closeForm);
    
    // for cancel button
    const cancelButton = document.getElementById('cancelButton');
    cancelButton.addEventListener('click', closeForm);

    function closeForm() {
        document.getElementById("editForm").style.display = 'none';
        document.body.classList.remove('modal-open'); 
        document.getElementById("editForm").reset();
    }

    // for success
    const successModal = document.getElementById('successModal');
    const closeSuccessModal = document.getElementById('closeSuccessModal');
    const closeSuccessButton = document.getElementById('closeSuccessButton');

     // Function to show the success modal
     function showSuccessModal() {
        successModal.style.display = 'flex'; // Show the success modal
        document.body.classList.add('modal-open'); // Prevent body scroll
    }

    // Close the success modal when the close button is clicked
    closeSuccessModal.addEventListener('click', function() {
        successModal.style.display = 'none';
        document.body.classList.remove('modal-open'); // Allow body scroll
    });

    // Close the success modal when the OK button is clicked
    closeSuccessButton.addEventListener('click', function() {
        successModal.style.display = 'none';
        document.body.classList.remove('modal-open'); // Allow body scroll
    });

    // Check if the PHP script indicated to show the success modal
    if (typeof showSuccessModal !== 'undefined' && showSuccessModal) {
        showSuccessModal();
    }

    // Example of handling errors (if you want to show an error modal as well)
    if (typeof showErrorModal !== 'undefined' && showErrorModal) {
        successModal.style.display = 'flex'; // Show the success modal
    document.body.classList.add('modal-open'); // Prevent body scroll
    }
});
