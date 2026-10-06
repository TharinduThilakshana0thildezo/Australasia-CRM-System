import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';

// Make Alpine and Chart globally available
window.Alpine = Alpine;
window.Chart = Chart;

Alpine.start();

// =============================================
// AUSTRALASIA CRM — Global JS
// =============================================

// Global search shortcut (Ctrl+K)
document.addEventListener('keydown', (e) => {
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        const searchEl = document.getElementById('global-search');
        if (searchEl) searchEl.focus();
    }
});

// Toast notification system
window.AustralasiaCRM = {
    toast(message, type = 'success', duration = 4000) {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const colors = {
            success: '#059669',
            error:   '#f43f5e',
            warning: '#d97706',
            info:    '#6366f1',
        };

        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.innerHTML = `
            <div style="flex:1">
                <div style="font-size:14px;font-weight:600;color:#0f172a">${message}</div>
            </div>
            <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;color:#94a3b8;font-size:18px;line-height:1;padding:0">×</button>
        `;

        container.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            toast.style.transition = 'all 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, duration);
    },

    confirm(message, onConfirm) {
        if (window.confirm(message)) onConfirm();
    }
};

// Sidebar toggle for mobile
window.toggleSidebar = function() {
    const sidebar = document.getElementById('crm-sidebar');
    if (sidebar) sidebar.classList.toggle('open');
};
