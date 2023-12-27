$(document).ready(function() {
    // Attach a change event to the checkbox
    $('#linkCheckbox').change(function() {
        // Check if the checkbox is checked
        if ($(this).is(':checked')) {
            // If checked, add the 'checked' class to the container
            $('.checkbox-container').addClass('check-solid');
        } else {
            // If unchecked, remove the 'checked' class from the container
            $('.checkbox-container').removeClass('check-solid');
        }
    });
});
