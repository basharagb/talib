// Toast Notification System
class Toast {
    constructor() {
        this.createContainer();
    }

    createContainer() {
        if (!document.getElementById('toast-container')) {
            const container = document.createElement('div');
            container.id = 'toast-container';
            container.className = 'fixed top-4 right-4 z-50 space-y-2';
            document.body.appendChild(container);
        }
    }

    show(message, type = 'info', duration = 5000) {
        const toast = document.createElement('div');
        const toastId = 'toast-' + Date.now();
        toast.id = toastId;
        
        const typeClasses = {
            success: 'bg-green-500 text-white',
            error: 'bg-red-500 text-white',
            warning: 'bg-yellow-500 text-black',
            info: 'bg-blue-500 text-white'
        };

        const icons = {
            success: '✓',
            error: '✕',
            warning: '⚠',
            info: 'ℹ'
        };

        toast.className = `${typeClasses[type]} px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full opacity-0 flex items-center space-x-3`;
        
        toast.innerHTML = `
            <span class="text-lg font-bold">${icons[type]}</span>
            <span class="flex-1">${message}</span>
            <button onclick="window.toastManager.remove('${toastId}')" class="text-lg font-bold hover:opacity-75">×</button>
        `;

        document.getElementById('toast-container').appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full', 'opacity-0');
        }, 100);

        // Auto remove
        if (duration > 0) {
            setTimeout(() => {
                this.remove(toastId);
            }, duration);
        }
    }

    remove(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }
    }

    success(message, duration = 5000) {
        this.show(message, 'success', duration);
    }

    error(message, duration = 7000) {
        this.show(message, 'error', duration);
    }

    warning(message, duration = 6000) {
        this.show(message, 'warning', duration);
    }

    info(message, duration = 5000) {
        this.show(message, 'info', duration);
    }
}

// Initialize global toast manager
window.toastManager = new Toast();

// Helper functions for easy access
window.showToast = (message, type, duration) => window.toastManager.show(message, type, duration);
window.showSuccess = (message, duration) => window.toastManager.success(message, duration);
window.showError = (message, duration) => window.toastManager.error(message, duration);
window.showWarning = (message, duration) => window.toastManager.warning(message, duration);
window.showInfo = (message, duration) => window.toastManager.info(message, duration);
