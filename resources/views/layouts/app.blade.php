<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Sistem PKL</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <script src="{{ asset('js/animations.js') }}" defer></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#1e40af',
                        accent: '#10b981',
                        dark: '#1f2937',
                        light: '#f9fafb',
                        'card-bg': '#ffffff'
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out forwards',
                        'slide-up': 'slideUp 0.5s ease-out forwards',
                        'slide-down': 'slideDown 0.3s ease-out forwards',
                        'slide-in-left': 'slideInLeft 0.3s ease-out forwards',
                        'scale-fade': 'scaleFade 0.4s ease-out forwards',
                        'bounce': 'bounce 1s ease infinite',
                        'pulse': 'pulse 2s ease-in-out infinite',
                        'rotate': 'rotate 2s linear infinite',
                        'float': 'float 3s ease-in-out infinite',
                        'gradient': 'gradient 15s ease infinite',
                        'spin': 'spin 1s linear infinite',
                        'ripple': 'ripple 0.6s linear',
                        'modal-in': 'modalIn 0.3s ease-out forwards',
                        'modal-out': 'modalOut 0.2s ease-in forwards',
                        'message-slide': 'messageSlide 0.5s ease-out forwards',
                        'count-up': 'countUp 0.5s ease-out forwards',
                        'page-enter': 'pageEnter 0.5s ease-out forwards',
                        'border-rotate': 'borderRotate 3s linear infinite',
                        'shimmer': 'shimmer 2s infinite linear',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideDown: {
                            '0%': { opacity: '0', transform: 'translateY(-30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideInLeft: {
                            '0%': { opacity: '0', transform: 'translateX(-100%)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' },
                        },
                        scaleFade: {
                            '0%': { opacity: '0', transform: 'scale(0.95)' },
                            '70%': { opacity: '0.7', transform: 'scale(1.02)' },
                            '100%': { opacity: '1', transform: 'scale(1)' },
                        },
                        bounce: {
                            '0%, 20%, 50%, 80%, 100%': { transform: 'translateY(0)' },
                            '40%': { transform: 'translateY(-10px)' },
                            '60%': { transform: 'translateY(-5px)' },
                        },
                        pulse: {
                            '0%': { transform: 'scale(1)', boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)' },
                            '50%': { transform: 'scale(1.05)', boxShadow: '0 10px 15px rgba(0, 0, 0, 0.1)' },
                            '100%': { transform: 'scale(1)', boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)' },
                        },
                        rotate: {
                            'from': { transform: 'rotate(0deg)' },
                            'to': { transform: 'rotate(360deg)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        gradient: {
                            '0%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                            '100%': { backgroundPosition: '0% 50%' },
                        },
                        spin: {
                            'from': { transform: 'rotate(0deg)' },
                            'to': { transform: 'rotate(360deg)' },
                        },
                        ripple: {
                            '0%': { transform: 'scale(0)', opacity: '1' },
                            '100%': { transform: 'scale(4)', opacity: '0' },
                        },
                        modalIn: {
                            'from': { opacity: '0', transform: 'scale(0.9) translateY(-20px)' },
                            'to': { opacity: '1', transform: 'scale(1) translateY(0)' },
                        },
                        modalOut: {
                            'from': { opacity: '1', transform: 'scale(1) translateY(0)' },
                            'to': { opacity: '0', transform: 'scale(0.9) translateY(-20px)' },
                        },
                        messageSlide: {
                            'from': { opacity: '0', transform: 'translateX(-100%)' },
                            'to': { opacity: '1', transform: 'translateX(0)' },
                        },
                        countUp: {
                            'from': { transform: 'translateY(20px)', opacity: '0' },
                            'to': { transform: 'translateY(0)', opacity: '1' },
                        },
                        pageEnter: {
                            'from': { opacity: '0', transform: 'translateY(20px)' },
                            'to': { opacity: '1', transform: 'translateY(0)' },
                        },
                        borderRotate: {
                            '0%': { borderImageSource: 'linear-gradient(0deg, #3B82F6, #8B5CF6)' },
                            '25%': { borderImageSource: 'linear-gradient(90deg, #3B82F6, #8B5CF6)' },
                            '50%': { borderImageSource: 'linear-gradient(180deg, #3B82F6, #8B5CF6)' },
                            '75%': { borderImageSource: 'linear-gradient(270deg, #3B82F6, #8B5CF6)' },
                            '100%': { borderImageSource: 'linear-gradient(360deg, #3B82F6, #8B5CF6)' },
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '-200% center' },
                            '100%': { backgroundPosition: '200% center' },
                        }
                    },
                    backgroundImage: {
                        'gradient-to-r': 'linear-gradient(to right, var(--tw-gradient-stops))',
                        'gradient-to-br': 'linear-gradient(to bottom right, var(--tw-gradient-stops))',
                        'gradient-to-bl': 'linear-gradient(to bottom left, var(--tw-gradient-stops))',
                    }
                }
            }
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            scroll-behavior: smooth;
        }

        .sidebar {
            transition: all 0.3s ease;
        }

        .main-content {
            transition: all 0.3s ease;
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.15);
        }

        .active-menu {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
            border-left: 4px solid #3b82f6;
            color: #1e40af;
            font-weight: 600;
        }

        .greeting-card {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            color: white;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .sidebar-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .sidebar-scrollbar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        /* Glass effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Progress bar animation */
        .progress-fill {
            transition: width 1s ease-out;
        }

        /* Notification styles */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-width: 300px;
            max-width: 400px;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .notification-success {
            background: #10B981;
            color: white;
        }

        .notification-error {
            background: #EF4444;
            color: white;
        }

        .notification-warning {
            background: #F59E0B;
            color: white;
        }

        .notification-info {
            background: #3B82F6;
            color: white;
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

        /* Page transition */
        .page-transition-overlay {
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
        }

        .page-transition-content {
            text-align: center;
        }

        /* Tooltip */
        .tooltip {
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
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                height: 100vh;
                z-index: 50;
                width: 280px;
                overflow-y: auto;
                box-shadow: 5px 0 25px rgba(0, 0, 0, 0.1);
            }

            .sidebar.active {
                left: 0;
                animation: slideInLeft 0.3s ease-out;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }

            .overlay.active {
                display: block;
                animation: fadeIn 0.3s ease-out;
            }

            .mobile-header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                height: 60px;
                background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
                color: white;
                z-index: 45;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 16px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .hamburger-menu {
                transition: transform 0.3s ease;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 8px;
                padding: 8px;
            }

            .hamburger-menu.active {
                transform: rotate(90deg);
            }

            .mobile-content-padding {
                padding-top: 60px;
            }

            nav a {
                color: #4b5563;
            }

            nav a:hover, nav a.active-menu {
                color: #1e40af;
                background-color: #eff6ff;
            }
        }

        @media (min-width: 769px) {
            .sidebar {
                position: sticky;
                top: 0;
                height: 100vh;
                overflow-y: auto;
            }

            .overlay {
                display: none !important;
            }

            .mobile-header {
                display: none;
            }

            .desktop-content-margin {
                margin-left: 0;
            }

            .mobile-content-padding {
                padding-top: 0;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        body.no-scroll {
            overflow: hidden;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content-area {
            flex: 1;
            overflow-y: auto;
        }

        /* Animation delay classes */
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        .delay-400 { animation-delay: 400ms; }
        .delay-500 { animation-delay: 500ms; }

        /* Animation duration classes */
        .duration-100 { animation-duration: 100ms; }
        .duration-200 { animation-duration: 200ms; }
        .duration-300 { animation-duration: 300ms; }
        .duration-500 { animation-duration: 500ms; }
        .duration-700 { animation-duration: 700ms; }
        .duration-1000 { animation-duration: 1000ms; }

        /* Stagger children animation */
        .stagger-children > * {
            opacity: 0;
            animation: fadeIn 0.5s ease-out forwards;
        }

        .stagger-children > *:nth-child(1) { animation-delay: 100ms; }
        .stagger-children > *:nth-child(2) { animation-delay: 200ms; }
        .stagger-children > *:nth-child(3) { animation-delay: 300ms; }
        .stagger-children > *:nth-child(4) { animation-delay: 400ms; }
        .stagger-children > *:nth-child(5) { animation-delay: 500ms; }
        .stagger-children > *:nth-child(6) { animation-delay: 600ms; }
        .stagger-children > *:nth-child(7) { animation-delay: 700ms; }
        .stagger-children > *:nth-child(8) { animation-delay: 800ms; }

        /* Form input focus effects */
        .form-input {
            transition: all 0.3s ease;
        }

        .form-input:focus {
            transform: scale(1.02);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        /* Button hover effects */
        .btn-hover {
            transition: all 0.2s ease;
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                        0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Modal animation classes */
        .modal-enter {
            animation: modalIn 0.3s ease-out;
        }

        .modal-exit {
            animation: modalOut 0.2s ease-in;
        }

        /* Shimmer loading effect */
        .shimmer {
            background: linear-gradient(90deg,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.3) 50%,
                rgba(255, 255, 255, 0) 100%);
            background-size: 200% auto;
            animation: shimmer 2s infinite linear;
        }
    </style>
</head>
<body class="bg-gray-50">
    @auth
        <header class="mobile-header">
            <button id="mobile-menu-toggle" class="hamburger-menu">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <div class="text-lg font-bold">
                <i class="fas fa-graduation-cap mr-2"></i>
                Administrasi PKL
            </div>
        </header>

        <div class="overlay" id="overlay"></div>
    @endauth

    <div class="app-container">
        @auth
            <aside class="sidebar w-64 bg-white shadow-xl flex flex-col shrink-0">
                @include('partials.sidebar')
            </aside>
        @endauth

        <div class="main-content-area flex-1 @auth mobile-content-padding @endauth">
            <main class="p-4 md:p-6 min-h-full">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('overlay');
            const hamburgerMenu = document.querySelector('.hamburger-menu');
            const body = document.body;

            function toggleSidebar() {
                const isOpening = !sidebar.classList.contains('active');
                sidebar.classList.toggle('active');
                if (overlay) overlay.classList.toggle('active');
                if (hamburgerMenu) {
                    hamburgerMenu.classList.toggle('active');
                }

                if (window.innerWidth <= 768) {
                    if (isOpening) {
                        body.classList.add('no-scroll');
                    } else {
                        body.classList.remove('no-scroll');
                    }
                }
            }

            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', toggleSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', toggleSidebar);
            }

            function setupProfileToggle() {
                const profileToggle = document.getElementById('profile-toggle');
                if (profileToggle) {
                    profileToggle.replaceWith(profileToggle.cloneNode(true));

                    const newProfileToggle = document.getElementById('profile-toggle');
                    newProfileToggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        const menu = document.getElementById('profile-menu');
                        const icon = document.getElementById('profile-chevron');

                        if (menu && icon) {
                            menu.classList.toggle('hidden');
                            icon.style.transform = menu.classList.contains('hidden')
                                ? 'rotate(0deg)'
                                : 'rotate(180deg)';
                        }
                    });
                }
            }

            setupProfileToggle();

            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && sidebar && sidebar.classList.contains('active')) {
                    if (e.target.closest('.sidebar a') && !e.target.closest('#profile-toggle')) {
                        toggleSidebar();
                    }
                }

                const profileMenu = document.getElementById('profile-menu');
                const profileToggle = document.getElementById('profile-toggle');

                if (profileMenu && !profileMenu.contains(e.target) &&
                    profileToggle && !profileToggle.contains(e.target)) {
                    if (!profileMenu.classList.contains('hidden')) {
                        profileMenu.classList.add('hidden');
                        const icon = document.getElementById('profile-chevron');
                        if (icon) {
                            icon.style.transform = 'rotate(0deg)';
                        }
                    }
                }
            });

            function handleResize() {
                if (window.innerWidth > 768) {
                    if (sidebar && sidebar.classList.contains('active')) {
                        sidebar.classList.remove('active');
                    }
                    if (overlay) overlay.classList.remove('active');
                    if (hamburgerMenu) hamburgerMenu.classList.remove('active');
                    body.classList.remove('no-scroll');
                }

                setupProfileToggle();
            }

            window.addEventListener('resize', handleResize);

            const currentPath = window.location.pathname;
            document.querySelectorAll('.sidebar a[href]').forEach(link => {
                const linkPath = link.getAttribute('href');
                if (linkPath === currentPath ||
                    (linkPath !== '#' && currentPath.startsWith(linkPath) && linkPath !== '/')) {
                    link.classList.add('active-menu');
                }
            });

            const sidebarCloseBtn = document.getElementById('sidebar-close');
            if (sidebarCloseBtn) {
                sidebarCloseBtn.addEventListener('click', toggleSidebar);
            }

            document.querySelectorAll('.sidebar nav a').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.getAttribute('href') && this.getAttribute('href') !== '#') {
                        document.querySelectorAll('.sidebar nav a').forEach(item => {
                            item.classList.remove('active-menu');
                        });
                        this.classList.add('active-menu');
                    }
                });
            });
        });

        function setActiveMenuFromUrl() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.sidebar a.nav-menu-item');

            menuItems.forEach(item => {
                item.classList.remove('active-menu');

                const href = item.getAttribute('href');
                if (href && currentPath === href) {
                    item.classList.add('active-menu');
                } else if (href && href !== '#' && href !== '/' && currentPath.startsWith(href)) {
                    item.classList.add('active-menu');
                }
            });
        }

        setActiveMenuFromUrl();

        document.addEventListener('click', function(e) {
            if (e.target.closest('.sidebar a.nav-menu-item')) {
                const clickedItem = e.target.closest('.sidebar a.nav-menu-item');

                document.querySelectorAll('.sidebar a.nav-menu-item').forEach(item => {
                    item.classList.remove('active-menu');
                });

                clickedItem.classList.add('active-menu');

                const menuName = clickedItem.getAttribute('data-menu');
                if (menuName) {
                    localStorage.setItem('activeMenu', menuName);
                }
            }
        });

        const savedMenu = localStorage.getItem('activeMenu');
        if (savedMenu) {
            const savedMenuItem = document.querySelector(`.sidebar a.nav-menu-item[data-menu="${savedMenu}"]`);
            if (savedMenuItem && !savedMenuItem.classList.contains('active-menu')) {
                document.querySelectorAll('.sidebar a.nav-menu-item').forEach(item => {
                    item.classList.remove('active-menu');
                });
                savedMenuItem.classList.add('active-menu');
            }
        }

        // Initialize DashboardAnimations if available
        if (typeof DashboardAnimations !== 'undefined') {
            window.dashboardAnimations = new DashboardAnimations();
        }

        // SweetAlert2 configuration
        window.Swal = Swal;
        window.SwalToast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

    </script>

    @yield('scripts')
</body>
</html>
