// ======================
// ANIMASI INTERAKTIF DASHBOARD PKL
// ======================

class DashboardAnimations {
    constructor() {
        this.initAnimations();
        this.initIntersectionObserver();
        this.initHoverEffects();
    }

    // Inisialisasi semua animasi
    initAnimations() {
        // Animasikan elemen dengan data-animate
        document.querySelectorAll('[data-animate]').forEach(element => {
            const animation = element.getAttribute('data-animate');
            element.classList.add(`animate-${animation}`);
        });

        // Animasikan angka counter
        this.animateCounters();

        // Inisialisasi tooltip
        this.initTooltips();

        // Inisialisasi modal
        this.initModals();
    }

    // Intersection Observer untuk animasi saat scroll
    initIntersectionObserver() {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;

                    // Tambahkan animasi berdasarkan data attributes
                    if (element.dataset.animateOnScroll) {
                        element.classList.add(`animate-${element.dataset.animateOnScroll}`);
                    }

                    // Animasi khusus untuk cards
                    if (element.classList.contains('animate-on-scroll')) {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }

                    observer.unobserve(element);
                }
            });
        }, observerOptions);

        // Observe elemen yang perlu di-animate saat scroll
        document.querySelectorAll('.animate-on-scroll, [data-animate-on-scroll]').forEach(el => {
            observer.observe(el);
        });
    }

    // Animasi hover effects
    initHoverEffects() {
        // Card hover effects
        document.querySelectorAll('.card-hover').forEach(card => {
            card.addEventListener('mouseenter', (e) => {
                card.style.transform = 'translateY(-5px)';
            });

            card.addEventListener('mouseleave', (e) => {
                card.style.transform = 'translateY(0)';
            });
        });

        // Button hover effects
        document.querySelectorAll('.btn-hover').forEach(button => {
            button.addEventListener('mouseenter', (e) => {
                button.style.transform = 'translateY(-2px)';
            });

            button.addEventListener('mouseleave', (e) => {
                button.style.transform = 'translateY(0)';
            });
        });
    }

    // Animasi counter untuk statistik
    animateCounters() {
        document.querySelectorAll('.counter').forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count') || counter.textContent);
            const duration = parseInt(counter.getAttribute('data-duration') || 2000);
            const increment = target / (duration / 16); // 60fps

            let current = 0;
            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };

            updateCounter();
        });
    }

    // Tooltip dengan animasi
    initTooltips() {
        const tooltips = document.querySelectorAll('[data-tooltip]');

        tooltips.forEach(tooltip => {
            tooltip.addEventListener('mouseenter', (e) => {
                const text = tooltip.getAttribute('data-tooltip');
                this.showTooltip(e, text);
            });

            tooltip.addEventListener('mouseleave', () => {
                this.hideTooltip();
            });
        });
    }

    showTooltip(event, text) {
        // Hapus tooltip sebelumnya
        this.hideTooltip();

        // Buat tooltip baru
        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip animate-fade-in';
        tooltip.textContent = text;
        tooltip.style.cssText = `
            position: fixed;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            z-index: 1000;
            pointer-events: none;
            transform: translate(-50%, -100%);
            margin-top: -10px;
        `;

        document.body.appendChild(tooltip);

        // Posisikan tooltip
        const updatePosition = (e) => {
            tooltip.style.left = e.clientX + 'px';
            tooltip.style.top = e.clientY + 'px';
        };

        updatePosition(event);
        tooltip._updatePosition = updatePosition;

        // Update posisi saat mouse bergerak
        document.addEventListener('mousemove', updatePosition);
    }

    hideTooltip() {
        const existingTooltip = document.querySelector('.tooltip');
        if (existingTooltip) {
            document.removeEventListener('mousemove', existingTooltip._updatePosition);
            existingTooltip.remove();
        }
    }

    // Modal dengan animasi
    initModals() {
        const modals = document.querySelectorAll('.modal-trigger');

        modals.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                const modalId = trigger.getAttribute('data-modal');
                this.showModal(modalId);
            });
        });

        // Tutup modal
        document.querySelectorAll('.modal-close, .modal-overlay').forEach(el => {
            el.addEventListener('click', () => {
                this.hideModal();
            });
        });

        // ESC key untuk menutup modal
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.hideModal();
            }
        });
    }

    showModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('modal-enter');

            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }
    }

    hideModal() {
        const modal = document.querySelector('.modal:not(.hidden)');
        if (modal) {
            modal.classList.add('modal-exit');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('modal-enter', 'modal-exit');
                document.body.style.overflow = 'auto';
            }, 200);
        }
    }

    // Ripple effect untuk buttons
    initRippleEffects() {
        document.querySelectorAll('.ripple').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.7);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    pointer-events: none;
                `;

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    }

    // Progress bar animation
    animateProgressBars() {
        document.querySelectorAll('.progress-bar').forEach(bar => {
            const percent = bar.getAttribute('data-percent') || 0;
            const fill = bar.querySelector('.progress-fill');

            if (fill) {
                fill.style.width = '0%';
                setTimeout(() => {
                    fill.style.width = percent + '%';
                }, 100);
            }
        });
    }

    // Notification system dengan animasi
    showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification animate-slide-up notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
            </div>
            <button class="notification-close">
                <i class="fas fa-times"></i>
            </button>
        `;

        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#10B981' : '#EF4444'};
            color: white;
            padding: 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-width: 300px;
            max-width: 400px;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        `;

        document.body.appendChild(notification);

        // Close button
        notification.querySelector('.notification-close').addEventListener('click', () => {
            this.hideNotification(notification);
        });

        // Auto hide setelah 5 detik
        setTimeout(() => {
            this.hideNotification(notification);
        }, 5000);
    }

    hideNotification(notification) {
        notification.classList.add('animate-slide-down');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }

    // Page transition
    pageTransition(url) {
        const overlay = document.createElement('div');
        overlay.className = 'page-transition-overlay';
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            animation: fadeIn 0.3s ease-out forwards;
        `;

        overlay.innerHTML = `
            <div class="page-transition-content">
                <div class="animate-spin" style="width: 40px; height: 40px; border: 4px solid white; border-top-color: transparent; border-radius: 50%;"></div>
                <p style="color: white; margin-top: 20px; font-size: 18px;">Memuat...</p>
            </div>
        `;

        document.body.appendChild(overlay);

        setTimeout(() => {
            window.location.href = url;
        }, 500);
    }
}

// Inisialisasi saat dokumen siap
document.addEventListener('DOMContentLoaded', () => {
    const animations = new DashboardAnimations();

    // Ekspos ke global untuk akses dari console
    window.DashboardAnimations = animations;

    // Tambahkan style untuk tooltip
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .page-transition-content {
            text-align: center;
        }

        .notification-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notification-close {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 0;
            margin-left: 10px;
        }
    `;
    document.head.appendChild(style);
});

// Helper function untuk delay
function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// Export untuk module (jika menggunakan ES6 modules)
// export default DashboardAnimations;
