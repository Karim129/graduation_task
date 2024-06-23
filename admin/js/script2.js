document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('.delete-button').addEventListener('click', () => {
        // Handle delete button click
        alert('Delete button clicked');
    });

    document.querySelector('.close-button').addEventListener('click', () => {
        // Handle close button click
        alert('Close button clicked');
    });

    document.querySelector('.add-service-button').addEventListener('click', (event) => {
        event.preventDefault();
        // Handle add service button click
        alert('Add Service button clicked');
    });
});
