
const inputs = document.querySelectorAll('#eventForm input,#eventForm textarea,#eventForm select');
const progress = document.getElementById('formProgress');
$(document).ready(function () {
    let today = new Date().toISOString().split('T')[0];
    $("#event_date").attr("min", today);
    $('#full_name').val("");
    $('#contact').val("");
    $('#email').val("");
    $('#total_guests').val("");
    $('#budget').val("");
    $('#location').val("");
    $("#event_date").val("");
    $('#event_type').val("");
    $('#menu').val().trim("");
    $('#notes').val().trim("");
    $('#menu_file')[0].files[0];
});
function updateProgress() {
    let f = 0;
    inputs.forEach(i => {
        if (i.value.trim() !== '') f++;
    });
    progress.style.width = Math.min(100, (f / inputs.length) * 100) + '%';
}
inputs.forEach(i => i.addEventListener('input', updateProgress));
$('#submitBtn').on('click', function (e) {
    e.preventDefault();
    $('.error').text('');
    let valid = true;

    let full_name = $('#full_name').val().trim();
    let contact = $('#contact').val().trim();
    let email = $('#email').val().trim();
    let total_guests = $('#total_guests').val().trim();
    let budget = $('#budget').val().trim();
    let location = $('#location').val().trim();
    let event_date = $("#event_date").val();
    let event_type = $('#event_type').val();
    let menu = $('#menu').val().trim();
    let notes = $('#notes').val().trim();
    let file = $('#menu_file')[0].files[0];

    if (full_name === '') {
        $('#err_full_name').text('Full name is required');
        valid = false;
    }
    if (contact === '' || contact.length < 10) {
        $('#err_contact').text('Valid contact number required');
        valid = false;
    }
    if (email !== '' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        $('#err_email').text('Invalid email');
        valid = false;
    }
    if (total_guests === '') {
        $('#err_total_guests').text('Total guests required');
        valid = false;
    }
    if (location === '') {
        $('#err_location').text('Location is required');
        valid = false;
    }
    if (event_type === '') {
        $('#err_event_type').text('Select event type');
        valid = false;
    }

    if (event_date === "") {
        $("#err_event_date").text("Please select event date");
        isValid = false;
    }


    if (file) {
        let allowed = ['image/jpeg', 'image/png', 'application/pdf'];
        if (!allowed.includes(file.type)) {
            $('#err_file').text('Only JPG, PNG, PDF allowed');
            valid = false;
        }
    }

    if (!valid) return;

    let formData = new FormData();
    formData.append('full_name', full_name);
    formData.append('contact', contact);
    formData.append('email', email);
    formData.append('total_guests', total_guests);
    formData.append('budget', budget);
    formData.append("event_date", event_date);
    formData.append('location', location);
    formData.append('event_type', event_type);
    formData.append('menu', menu);
    formData.append('notes', notes);
    if (file) formData.append('menu_file', file);
    $.ajax({
        url: BASE_URL + 'api/api_add_inquiry.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',

        beforeSend: function () {
            $("#globalLoader").removeClass("d-none");
        },

        success: function (res) {

            if (res.status === true) {
                showStatusModal(
                    'success',
                    res.message || 'Inquiry submitted successfully! We will get back to you shortly.'
                );

                $('#eventForm input, #eventForm textarea').val('');
                $('select').val('');
                $('#menu_file').val('');

            } else {
                showStatusModal(
                    'error',
                    res.message || 'Failed to submit inquiry. Please try again.'
                );
            }
        },

        error: function () {
            showStatusModal(
                'error',
                'Server error. Please try again later.'
            );
        },
        complete: function () {
            $("#globalLoader").addClass("d-none");
        }
    });
});
function showStatusModal(type, message) {
    const icon = document.getElementById('statusIcon');
    const title = document.getElementById('statusTitle');
    const msg = document.getElementById('statusMessage');


    if (type === 'success') {
        icon.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i>';
        title.innerText = 'Success';
    } else {
        icon.innerHTML = '<i class="bi bi-x-circle-fill text-danger"></i>';
        title.innerText = 'Failed';
    }
    msg.innerText = message;
    const modal = new bootstrap.Modal(document.getElementById('statusModal'));
    modal.show();
}