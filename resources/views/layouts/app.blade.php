<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Katalog Restorasi') — SK04 Pita Analog</title>

    <!-- Google Fonts: Space Mono & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-[#f9f5ed] text-[#241a14] font-sans antialiased min-h-screen flex flex-col tape-stripes selection:bg-[#c96b1b] selection:text-white">
    <!-- Main Sidebar -->
    @include('partials.sidebar')

    <!-- Right Main Wrapper -->
    <div class="lg:pl-72 flex flex-col flex-1 min-h-screen">
        <!-- Top Sticky Header -->
        @include('partials.navbar')

        <!-- Main Body Content -->
        <main class="flex-1 px-4 sm:px-6 lg:px-8 py-8 max-w-7xl w-full mx-auto">
            <!-- Flash Message Alerts -->
            @include('partials.flash')

            <!-- Page Title / Action Header -->
            @hasSection('header')
                <div class="mb-8 pb-5 border-b-2 border-[#241a14] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    @yield('header')
                </div>
            @endif

            <!-- Main Injected Content -->
            @yield('content')
        </main>

        <!-- Footer -->
        @include('partials.footer')
    </div>

    <!-- Mobile Sidebar Interaction Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebarBackdrop');

            if (toggleBtn && sidebar && backdrop) {
                const openSidebar = () => {
                    sidebar.classList.remove('-translate-x-full');
                    backdrop.classList.remove('hidden');
                };

                const closeSidebar = () => {
                    sidebar.classList.add('-translate-x-full');
                    backdrop.classList.add('hidden');
                };

                toggleBtn.addEventListener('click', openSidebar);
                backdrop.addEventListener('click', closeSidebar);
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
