function toggleDropdown(event) {
    event.preventDefault();
    var dropdownContent = document.getElementById('dropdownContent');
    dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';

    var icon = document.getElementById('dropdown-icon');
    if (icon.classList.contains('rotated')) {
        icon.classList.remove('rotated');
    } else {
        icon.classList.add('rotated');
    }
}

function boldOption1(element) {
    // Get the parent element of the selected radio button
    var parent = element.parentElement.parentElement;

    // Get all labels in the same group as the selected radio button
    var labels = parent.querySelectorAll('.option');

    // Remove the 'bold' class from all labels in the group
    labels.forEach(function(label) {
        label.classList.remove('bold');
    });

    // Add the 'bold' class to the selected label
    var label = document.querySelector('label[for="' + element.id + '"]');
    label.classList.add('bold');
}

function boldOption2(element) {
    // Get the parent element of the selected radio button
    var parent = element.parentElement.parentElement;

    // Get all labels in the same group as the selected radio button
    var labels = parent.querySelectorAll('.option');

    // Remove the 'bold' class from all labels in the group
    labels.forEach(function(label) {
        label.classList.remove('bold');
    });

    // Add the 'bold' class to the selected label
    var label = document.querySelector('label[for="' + element.id + '"]');
    label.classList.add('bold');
}


$(document).ready(function() {
    $('#dropdown1, #dropdown2').change(function() {
        if ($(this).val() == "") {
            $(this).css('color', 'grey');
        } else {
            $(this).css('color', 'black');
        }
    }).css('color', 'grey');
});


