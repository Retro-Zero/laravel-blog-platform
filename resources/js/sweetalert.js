import Swal from 'sweetalert2';

// Default configuration
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

// Success alert
window.showSuccess = (message) => {
    Toast.fire({
        icon: 'success',
        title: message
    });
};

// Error alert
window.showError = (message) => {
    Toast.fire({
        icon: 'error',
        title: message
    });
};

// Warning alert
window.showWarning = (message) => {
    Toast.fire({
        icon: 'warning',
        title: message
    });
};

// Info alert
window.showInfo = (message) => {
    Toast.fire({
        icon: 'info',
        title: message
    });
};

// Confirmation dialog
window.showConfirm = (title, text, callback) => {
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, proceed!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
        }
    });
};

// Delete confirmation
window.showDeleteConfirm = (callback) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
        }
    });
};

// Form submission with loading
window.showLoading = (title = 'Please wait...') => {
    Swal.fire({
        title: title,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
};

// Close loading
window.closeLoading = () => {
    Swal.close();
};

// Input dialog
window.showInput = (title, inputType = 'text', inputValue = '', callback) => {
    Swal.fire({
        title: title,
        input: inputType,
        inputValue: inputValue,
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Cancel',
        inputValidator: (value) => {
            if (!value) {
                return 'You need to write something!'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            callback(result.value);
        }
    });
};

// Export for use in other modules
export { Swal, Toast }; 