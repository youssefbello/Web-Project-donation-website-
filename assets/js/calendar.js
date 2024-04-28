$(document).ready(function () {
    // Handle click on a day
    $('.day_num').on('click', function () {
        // Remove the "selected" class from all days
        $('.day_num').removeClass('selected');

        // Add the "selected" class to the clicked day
        $(this).addClass('selected');

        // Display any existing sticky note for the selected day
        var selectedDate = $(this).find('span').text();
        var storedNote = localStorage.getItem('note-' + selectedDate);

        // Show the note input form in the day box
        var noteInput = '<div class="note-input">';
        noteInput += '<textarea id="stickyNote" placeholder="Add a sticky note...">' + (storedNote || '') + '</textarea>';
        noteInput += '<button id="saveNote">Save</button>';
        noteInput += '</div>';

        $(this).append(noteInput);

        // Make the input form visible
        $('.note-input').fadeIn();

        // Handle save button click
        $('#saveNote').on('click', function () {
            var userNote = $('#stickyNote').val();

            // Save the note to local storage with a unique key based on the selected date
            if (userNote) {
                localStorage.setItem('note-' + selectedDate, userNote);

                // Reload the page to reflect the changes
                location.reload();
            }
        });
    });

    // ... (your existing JavaScript code)
});
