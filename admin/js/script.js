document.addEventListener('DOMContentLoaded', () => {
    // Function to handle remove button
    const handleRemove = (button) => {
        const row = button.closest('tr');
        row.remove();
    };

    // Function to handle edit/save button
    const handleEditSave = (button) => {
        const row = button.closest('tr');
        const isEditing = button.textContent === 'Save';

        row.querySelectorAll('td[contenteditable="false"], td[contenteditable="true"]').forEach(cell => {
            cell.contentEditable = isEditing ? 'false' : 'true';
        });

        const qtyInput = row.querySelector('td input[type="number"]');
        if (isEditing) {
            qtyInput.disabled = true;
            button.textContent = 'Edit';
        } else {
            qtyInput.disabled = false;
            button.textContent = 'Save';
        }
    };

    // Add event listeners to existing remove buttons
    document.querySelectorAll('.remove').forEach(button => {
        button.addEventListener('click', () => handleRemove(button));
    });

    // Add event listeners to existing edit buttons
    document.querySelectorAll('.edit').forEach(button => {
        button.addEventListener('click', () => handleEditSave(button));
    });

    // Handle add button
    document.querySelector('.add').addEventListener('click', () => {
        const table = document.querySelector('tbody');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td contenteditable="false">New Name</td>
            <td contenteditable="false">New Number</td>
            <td contenteditable="false">#NewCode</td>
            <td contenteditable="false">New Service</td>
            <td contenteditable="false">New Price</td>
            <td contenteditable="false"><input type="number" value="1" disabled></td>
            <td>New Total</td>
            <td>
                <button class="btn edit">Edit</button>
                <button class="btn remove">Remove</button>
            </td>
        `;

        table.appendChild(newRow);

        // Add event listeners to the new buttons
        newRow.querySelector('.edit').addEventListener('click', (e) => handleEditSave(e.target));
        newRow.querySelector('.remove').addEventListener('click', (e) => handleRemove(e.target));
    });
});
