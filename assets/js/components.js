/**
 * Custom JavaScript components to replace Bootstrap functionality
 */

document.addEventListener('DOMContentLoaded', function () {
    // Initialize all components
    initializeDropdowns();
    initializeCollapses();
    initializeModals();
    initializeTooltips();
    initializePopovers();
    initializeToasts();
});

// Dropdown functionality
function initializeDropdowns() {
    const dropdownToggles = document.querySelectorAll('[data-toggle="dropdown"]');

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const dropdownMenu = this.nextElementSibling;
            if (!dropdownMenu.classList.contains('dropdown-menu')) return;

            // Close all other dropdowns
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                if (menu !== dropdownMenu) {
                    menu.classList.remove('show');
                }
            });

            // Toggle current dropdown
            dropdownMenu.classList.toggle('show');
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });
}

// Collapse functionality
function initializeCollapses() {
    const collapseToggles = document.querySelectorAll('[data-toggle="collapse"]');

    collapseToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('data-target') || this.getAttribute('href');
            if (!targetId) return;

            const target = document.querySelector(targetId);
            if (!target) return;

            if (target.classList.contains('collapsing')) return;

            const isExpanded = target.classList.contains('show');

            if (isExpanded) {
                target.classList.remove('show');
                target.classList.add('collapsing');
                target.style.height = target.scrollHeight + 'px';

                setTimeout(() => {
                    target.style.height = '0';
                }, 10);

                setTimeout(() => {
                    target.classList.remove('collapsing');
                    target.style.height = '';
                }, 350);
            } else {
                target.classList.add('collapsing');
                target.style.height = '0';

                setTimeout(() => {
                    target.style.height = target.scrollHeight + 'px';
                }, 10);

                setTimeout(() => {
                    target.classList.remove('collapsing');
                    target.classList.add('show');
                    target.style.height = '';
                }, 350);
            }

            // Update aria attributes
            this.setAttribute('aria-expanded', !isExpanded);
        });
    });
}

// Modal functionality
function initializeModals() {
    const modalToggles = document.querySelectorAll('[data-toggle="modal"]');

    modalToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('data-target') || this.getAttribute('href');
            if (!targetId) return;

            const modal = document.querySelector(targetId);
            if (!modal) return;

            openModal(modal);
        });
    });

    // Close modal when clicking on close button
    document.querySelectorAll('[data-dismiss="modal"]').forEach(button => {
        button.addEventListener('click', function () {
            const modal = this.closest('.modal');
            if (modal) closeModal(modal);
        });
    });

    // Close modal when clicking on backdrop
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('modal') && e.target.classList.contains('show')) {
            closeModal(e.target);
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const modal = document.querySelector('.modal.show');
            if (modal) closeModal(modal);
        }
    });
}

function openModal(modal) {
    // Create backdrop if it doesn't exist
    let backdrop = document.querySelector('.modal-backdrop');
    if (!backdrop) {
        backdrop = document.createElement('div');
        backdrop.classList.add('modal-backdrop');
        document.body.appendChild(backdrop);
    }

    // Show modal and backdrop
    modal.style.display = 'block';
    setTimeout(() => {
        modal.classList.add('show');
        document.body.classList.add('modal-open');
    }, 10);
}

function closeModal(modal) {
    modal.classList.remove('show');

    setTimeout(() => {
        modal.style.display = 'none';

        const backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) backdrop.remove();

        document.body.classList.remove('modal-open');
    }, 300);
}

// Tooltip functionality
function initializeTooltips() {
    const tooltipTriggers = document.querySelectorAll('[data-toggle="tooltip"]');

    tooltipTriggers.forEach(trigger => {
        const title = trigger.getAttribute('title') || trigger.getAttribute('data-title');
        if (!title) return;

        // Create tooltip element
        const tooltip = document.createElement('div');
        tooltip.classList.add('tooltip');
        tooltip.innerHTML = `<div class="tooltip-inner">${title}</div>`;
        document.body.appendChild(tooltip);

        // Store tooltip reference
        trigger.tooltip = tooltip;

        // Remove title attribute to prevent default browser tooltip
        trigger.setAttribute('data-title', title);
        trigger.removeAttribute('title');

        // Show tooltip on hover
        trigger.addEventListener('mouseenter', function () {
            const rect = this.getBoundingClientRect();
            const tooltipRect = tooltip.getBoundingClientRect();

            tooltip.style.top = (rect.top - tooltipRect.height - 10) + 'px';
            tooltip.style.left = (rect.left + (rect.width / 2) - (tooltipRect.width / 2)) + 'px';
            tooltip.classList.add('show');
        });

        // Hide tooltip on mouse leave
        trigger.addEventListener('mouseleave', function () {
            tooltip.classList.remove('show');
        });
    });
}

// Popover functionality
function initializePopovers() {
    const popoverTriggers = document.querySelectorAll('[data-toggle="popover"]');

    popoverTriggers.forEach(trigger => {
        const title = trigger.getAttribute('data-title') || trigger.getAttribute('title') || '';
        const content = trigger.getAttribute('data-content') || '';
        if (!content) return;

        // Create popover element
        const popover = document.createElement('div');
        popover.classList.add('popover');
        popover.innerHTML = `
            ${title ? `<div class="popover-header">${title}</div>` : ''}
            <div class="popover-body">${content}</div>
        `;
        document.body.appendChild(popover);

        // Store popover reference
        trigger.popover = popover;

        // Remove title attribute to prevent default browser tooltip
        if (trigger.hasAttribute('title')) {
            trigger.setAttribute('data-title', title);
            trigger.removeAttribute('title');
        }

        // Toggle popover on click
        trigger.addEventListener('click', function (e) {
            e.preventDefault();

            // Close all other popovers
            document.querySelectorAll('.popover.show').forEach(p => {
                if (p !== popover) {
                    p.classList.remove('show');
                }
            });

            const rect = this.getBoundingClientRect();
            const popoverRect = popover.getBoundingClientRect();

            popover.style.top = (rect.bottom + 10) + 'px';
            popover.style.left = (rect.left + (rect.width / 2) - (popoverRect.width / 2)) + 'px';
            popover.classList.toggle('show');
        });
    });

    // Close popovers when clicking outside
    document.addEventListener('click', function (e) {
        if (!e.target.closest('[data-toggle="popover"]') && !e.target.closest('.popover')) {
            document.querySelectorAll('.popover.show').forEach(popover => {
                popover.classList.remove('show');
            });
        }
    });
}

// Toast functionality
function initializeToasts() {
    document.querySelectorAll('.toast').forEach(toast => {
        // Create show and hide methods for toast
        toast.show = function () {
            this.classList.add('show');

            // Auto hide if data-autohide is not false
            const autohide = this.getAttribute('data-autohide') !== 'false';
            const delay = parseInt(this.getAttribute('data-delay') || '5000');

            if (autohide) {
                setTimeout(() => {
                    this.hide();
                }, delay);
            }
        };

        toast.hide = function () {
            this.classList.remove('show');
        };

        // Add event listeners to close buttons
        toast.querySelectorAll('[data-dismiss="toast"]').forEach(button => {
            button.addEventListener('click', () => {
                toast.hide();
            });
        });
    });
}

// Export Toast constructor for cart.js
window.bootstrap = {
    Toast: function (element) {
        return {
            show: function () {
                element.classList.add('show');

                // Auto hide if data-autohide is not false
                const autohide = element.getAttribute('data-autohide') !== 'false';
                const delay = parseInt(element.getAttribute('data-delay') || '5000');

                if (autohide) {
                    setTimeout(() => {
                        this.hide();
                    }, delay);
                }
            },
            hide: function () {
                element.classList.remove('show');
            }
        };
    },
    Tooltip: function (element) {
        // Initialize tooltip
        const title = element.getAttribute('title') || element.getAttribute('data-title');
        if (!title) return {};

        // Create tooltip element
        const tooltip = document.createElement('div');
        tooltip.classList.add('tooltip');
        tooltip.innerHTML = `<div class="tooltip-inner">${title}</div>`;
        document.body.appendChild(tooltip);

        // Store tooltip reference
        element.tooltip = tooltip;

        // Remove title attribute to prevent default browser tooltip
        element.setAttribute('data-title', title);
        element.removeAttribute('title');

        // Show tooltip on hover
        element.addEventListener('mouseenter', function () {
            const rect = this.getBoundingClientRect();
            const tooltipRect = tooltip.getBoundingClientRect();

            tooltip.style.top = (rect.top - tooltipRect.height - 10) + 'px';
            tooltip.style.left = (rect.left + (rect.width / 2) - (tooltipRect.width / 2)) + 'px';
            tooltip.classList.add('show');
        });

        // Hide tooltip on mouse leave
        element.addEventListener('mouseleave', function () {
            tooltip.classList.remove('show');
        });

        return {};
    },
    Popover: function (element) {
        // Initialize popover
        const title = element.getAttribute('data-title') || element.getAttribute('title') || '';
        const content = element.getAttribute('data-content') || '';
        if (!content) return {};

        // Create popover element
        const popover = document.createElement('div');
        popover.classList.add('popover');
        popover.innerHTML = `
            ${title ? `<div class="popover-header">${title}</div>` : ''}
            <div class="popover-body">${content}</div>
        `;
        document.body.appendChild(popover);

        // Store popover reference
        element.popover = popover;

        // Remove title attribute to prevent default browser tooltip
        if (element.hasAttribute('title')) {
            element.setAttribute('data-title', title);
            element.removeAttribute('title');
        }

        // Toggle popover on click
        element.addEventListener('click', function (e) {
            e.preventDefault();

            // Close all other popovers
            document.querySelectorAll('.popover.show').forEach(p => {
                if (p !== popover) {
                    p.classList.remove('show');
                }
            });

            const rect = this.getBoundingClientRect();
            const popoverRect = popover.getBoundingClientRect();

            popover.style.top = (rect.bottom + 10) + 'px';
            popover.style.left = (rect.left + (rect.width / 2) - (popoverRect.width / 2)) + 'px';
            popover.classList.toggle('show');
        });

        return {};
    }
};