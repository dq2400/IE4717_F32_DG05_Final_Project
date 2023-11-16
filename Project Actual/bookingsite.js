// Function called when the form is submitted.
// Function validates the form data and returns a Boolean value.
function validateForm() {
    'use strict';
    
    // Get references to the form elements:
    var NTUEmail = document.getElementById('NTUEmail');
    var DateSlot = document.getElementById('DateSlot');
	var TimeSlot = document.getElementById('TimeSlot');
	
    // Validate!
    if ( (NTUEmail.value.length > 0) && (DateSlot.value.length > 0) ) {
        return true;
    } else {
        alert('Please complete the form!');
        return false;
    }
    
} // End of validateForm() function.

// Function called when the window has been loaded.
// Function needs to add an event listener to the form.
function init() {
    'use strict';
    
    // Confirm that document.getElementById() can be used:
    if (document && document.getElementById) {
        var bookingform = document.getElementById('bookingform');
        bookingform.onsubmit = validateForm;
    }

} // End of init() function.

// Assign an event listener to the window's load event:
window.onload = init;