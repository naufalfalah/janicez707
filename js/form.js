$(document).ready(function() {
    $('input[name="name"], input[name="ph_number"], input[name="email"]').on('input', function() {
        formValidation();
    });
    
    $('input[name="name"], input[name="ph_number"]').on('input', function() {
        this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
    });

    $('input[name="block"], input[name="floor"], input[name="unit"], input[name="sqft"], input[name="ph_number"]').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#submit-form').on('submit', function(event) {
        // console.log("submit");
        event.preventDefault();

        // Validate form fields
        if (!formValidation()) {
            return;
        }
        
        const formData = $(this).serialize();
        // console.log("formData", formData);
        
        $('#loading-indicator').show();
        $('.btn-submit').prop('disabled', true);

        $.ajax({
            url: '../submit.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log('Success Response:', response);

                $('#loading-indicator').hide();
                $('.btn-submit').prop('disabled', false);
                $('.container').css({
                    'width': '100%',
                    'max-width': '100%'
                });

                nextStep();
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);

                $('#loading-indicator').hide();
                $('.btn-submit').prop('disabled', false);
                
                alert('Something went wrong. Please try again.');
            }
        });
    });
});

function formValidation() {
    let validFields = true;
    $('.error-message').text('');

    // Validate name
    const name = $('input[name="name"]').val();
    if (!name) {
        $('#name-error').text('Please enter your name.');
        validFields = false;
    }

    // Validate email
    const email = $('input[name="email"]').val();
    if (!email) {
        $('#email-error').text('Please enter your email address.');
        validFields = false;
    }
    if (email && !validateEmail(email)) {
        $('#email-error').text('Please enter a valid email address.');
        validFields = false;
    }
    
    // Validate phone number
    const phoneNumber = $('input[name="ph_number"]').val();
    if (!phoneNumber) {
        $('#phone-error').text('Please enter your phone number.');
        validFields = false;
    }
    if (phoneNumber && !validatePhoneNumber(phoneNumber)) {
        $('#phone-error').text('Must exactly 8 digits & start with 8 or 9 (valid Singapore mobile numbers)');
        validFields = false;
    }

    // Validate checkbox
    const isChecked = $('input[name="terms"]').is(':checked');
    if (!isChecked) {
        $('#terms-error').text('You must agree to the terms and conditions.');
        validFields = false;
    }

    return validFields;
}

function validateEmail(email) {
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailPattern.test(email);
}

function validatePhoneNumber(phoneNumber) {
    const phonePattern = /^[89]\d{7}$/;
    return phonePattern.test(phoneNumber);
}

// Elements
const progressFill = document.getElementById('progress-fill');
const progressPercentage = document.getElementById('progress-percentage');
const stepItems = document.querySelectorAll('.step-item');
const formSections = document.querySelectorAll('.form-section');

// Update progress
function updateProgress() {
    const percent = ((currentStep - 1) / (totalSteps - 1)) * 100;
    progressFill.style.width = `${percent}%`;
    progressPercentage.textContent = `${Math.round(percent)}%`;
    
    // Update step items
    stepItems.forEach((item, index) => {
        const step = index + 1;
        item.classList.remove('active', 'completed');
        
        if (step === currentStep) {
            item.classList.add('active');
        } else if (step < currentStep) {
            item.classList.add('completed');
        }
    });
    
    // Show current section
    formSections.forEach((section, index) => {
        section.classList.remove('active');
        if (index + 1 === currentStep) {
            section.classList.add('active');
        }
    });
}

// Next step
function nextStep() {
    if (currentStep < totalSteps) {
        currentStep++;
        updateProgress();
    }
}

// Previous step
function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        updateProgress();
    }
}

// Go to specific step
function goToStep(step) {
    if (step >= 1 && step <= totalSteps) {
        currentStep = step;
        updateProgress();
    }
}

// Clear radio buttons
function clearRadios(name) {
    const radios = document.querySelectorAll(`input[name="${name}"]`);
    radios.forEach(radio => {
        radio.checked = false;
    });
}

// Initialize
updateProgress();
