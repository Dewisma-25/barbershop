document.addEventListener('DOMContentLoaded', function () {
    const toastManager = new ToasterUi();
    const toast = document.body.dataset.toast;
    
    const toastMessages = {
        // User
        user_added: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You added new user account.</span> </div>',
            type: "success"
        },
        user_edited: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You edited user data.</span> </div>',
            type: "success"
        },
        user_change: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You change the user account password.</span> </div>',
            type: "success"
        },
        user_deleted: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You deleted user data.</span> </div>',
            type: "error"
        },
    };
    
    if (toast && toastMessages[toast]) {
        const { message, type } = toastMessages[toast];
        toastManager.addToast(message, type, {
            autoClose: true,
            duration: 8000,
            allowHtml: true,
        });
    }

});

// ===============
//     Service
// ===============
document.addEventListener('DOMContentLoaded', function () {
    const toastManager = new ToasterUi();
    const toast = document.body.dataset.toast;
    
    const toastMessages = {
        service_added: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You added Service data.</span> </div>',
            type: "success"
        },
        service_edit: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You edited Service data.</span> </div>',
            type: "success"
        },
        service_inactive: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You inactived Service data.</span> </div>',
            type: "error"
        },
        service_active: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You activate the Service.</span> </div>',
            type: "success"
        },
    };
    
    if (toast && toastMessages[toast]) {
        const { message, type } = toastMessages[toast];
        toastManager.addToast(message, type, {
            autoClose: true,
            duration: 8000,
            allowHtml: true,
        });
    }
});

// ===============
//     Barber
// ===============
document.addEventListener('DOMContentLoaded', function () {
    const toastManager = new ToasterUi();
    const toast = document.body.dataset.toast;
    
    const toastMessages = {
        barber_added: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You added a new barber.</span> </div>',
            type: "success"
        },
        barber_edit: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You edited barber data.</span> </div>',
            type: "success"
        },
        barber_delete: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You deleted barber data.</span> </div>',
            type: "error"
        },
    };
    
    if (toast && toastMessages[toast]) {
        const { message, type } = toastMessages[toast];
        toastManager.addToast(message, type, {
            autoClose: true,
            duration: 8000,
            allowHtml: true,
        });
    }
});

// ===============
//     customer
// ===============
document.addEventListener('DOMContentLoaded', function () {
    const toastManager = new ToasterUi();
    const toast = document.body.dataset.toast;
    
    const toastMessages = {
        customer_edit: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You edited a customer data.</span> </div>',
            type: "success"
        },
        customer_delete: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You deleted a customer data.</span> </div>',
            type: "error"
        },
    };
    
    if (toast && toastMessages[toast]) {
        const { message, type } = toastMessages[toast];
        toastManager.addToast(message, type, {
            autoClose: true,
            duration: 8000,
            allowHtml: true,
        });
    }
});

// ===============
//     Booking
// ===============
document.addEventListener('DOMContentLoaded', function () {
    const toastManager = new ToasterUi();
    const toast = document.body.dataset.toast;
    
    const toastMessages = {
        booking_accept: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You accepted a new booking.</span> </div>',
            type: "success"
        },
        booking_reject: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You rejected a new booking.</span> </div>',
            type: "error"
        },
        booking_edit: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You edited a booking data.</span> </div>',
            type: "success"
        },
        booking_transaction: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You process the booking transaction.</span> </div>',
            type: "success"
        },
    };
    
    if (toast && toastMessages[toast]) {
        const { message, type } = toastMessages[toast];
        toastManager.addToast(message, type, {
            autoClose: true,
            duration: 8000,
            allowHtml: true,
        });
    }
});

// ===============
//   Transaction
// ===============
document.addEventListener('DOMContentLoaded', function () {
    const toastManager = new ToasterUi();
    const toast = document.body.dataset.toast;
    
    const toastMessages = {
        transaction_finish: {
            message: '<div style="display:flex; align-items:center; gap:8px; max-width:100%;"> <i class="bi bi-megaphone me-2"></i> <span style="white-space:nowrap;">You finished a transaction.</span> </div>',
            type: "success"
        },
    };
    
    if (toast && toastMessages[toast]) {
        const { message, type } = toastMessages[toast];
        toastManager.addToast(message, type, {
            autoClose: true,
            duration: 8000,
            allowHtml: true,
        });
    }
});