
// Variables
let currentStep = 1;
const totalSteps = 4;

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

function formValidation() {
    let invalidFields = false;
    $('.error-message').text('');

    // Validate name
    const name = $('input[name="name"]').val();
    if (!name) {
        $('#name-error').text('Please enter your name.');
        invalidFields = true;
    }

    // Validate email
    const email = $('input[name="email"]').val();
    if (!email) {
        $('#email-error').text('Please enter your email address.');
        invalidFields = true;
    }
    if (email && !validateEmail(email)) {
        $('#email-error').text('Please enter a valid email address.');
        invalidFields = true;
    }
    
    // Validate phone number
    const phoneNumber = $('input[name="phone_number"]').val();
    if (!phoneNumber) {
        $('#phone-error').text('Please enter your phone number.');
        invalidFields = true;
    }
    if (phoneNumber && !validatePhoneNumber(phoneNumber)) {
        $('#phone-error').text('Please enter a valid phone number.');
        invalidFields = true;
    }

    if (invalidFields) {
        return false;
    }

    return true;
}
function validateEmail(email) {
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailPattern.test(email);
}
function validatePhoneNumber(phoneNumber) {
    const phonePattern = /^[89]\d{7}$/;
    return phoneNumber.length
}
