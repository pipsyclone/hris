<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        {{-- Fontawesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css">

        {{-- Sweetalert2 --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- Toastr CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <!-- Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Theme Store -->
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('theme', {
                    init() {
                        const savedTheme = localStorage.getItem('theme');
                        const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' :
                            'light';
                        this.theme = savedTheme || systemTheme;
                        this.updateTheme();
                    },
                    theme: 'light',
                    toggle() {
                        this.theme = this.theme === 'light' ? 'dark' : 'light';
                        localStorage.setItem('theme', this.theme);
                        this.updateTheme();
                    },
                    updateTheme() {
                        const html = document.documentElement;
                        const body = document.body;
                        if (this.theme === 'dark') {
                            html.classList.add('dark');
                            body.classList.add('dark', 'bg-gray-900');
                        } else {
                            html.classList.remove('dark');
                            body.classList.remove('dark', 'bg-gray-900');
                        }
                    }
                });

                Alpine.store('sidebar', {
                    // Initialize based on screen size
                    isExpanded: window.innerWidth >= 1280, // true for desktop, false for mobile
                    isMobileOpen: false,
                    isHovered: false,

                    toggleExpanded() {
                        this.isExpanded = !this.isExpanded;
                        // When toggling desktop sidebar, ensure mobile menu is closed
                        this.isMobileOpen = false;
                    },

                    toggleMobileOpen() {
                        this.isMobileOpen = !this.isMobileOpen;
                        // Don't modify isExpanded when toggling mobile menu
                    },

                    setMobileOpen(val) {
                        this.isMobileOpen = val;
                    },

                    setHovered(val) {
                        // Only allow hover effects on desktop when sidebar is collapsed
                        if (window.innerWidth >= 1280 && !this.isExpanded) {
                            this.isHovered = val;
                        }
                    }
                });
            });
        </script>

        <!-- Apply dark mode immediately to prevent flash -->
        <script>
            (function() {
                const savedTheme = localStorage.getItem('theme');
                const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                const theme = savedTheme || systemTheme;
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                    document.body.classList.add('dark', 'bg-gray-900');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.body.classList.remove('dark', 'bg-gray-900');
                }
            })();
        </script>

        @livewireStyles
    </head>
    <body
        x-data="{ 'loaded': true}"
        x-init="$store.sidebar.isExpanded = window.innerWidth >= 1280;
        const checkMobile = () => {
            if (window.innerWidth < 1280) {
                $store.sidebar.setMobileOpen(false);
                $store.sidebar.isExpanded = false;
            } else {
                $store.sidebar.isMobileOpen = false;
                $store.sidebar.isExpanded = true;
            }
        };
        window.addEventListener('resize', checkMobile);">

        {{-- preloader --}}
        <x-common.preloader/>
        {{-- preloader end --}}

        <div class="min-h-screen xl:flex">
            @include('layouts.backdrop')
            @include('layouts.sidebar')

            <div class="flex-1 transition-all duration-300 ease-in-out"
                :class="{
                    'xl:ml-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                    'xl:ml-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
                    'ml-0': $store.sidebar.isMobileOpen
                }">

                <!-- app header start -->
                @include('layouts.app-header')

                <!-- app header end -->
                <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                    {{ $slot }}
                </div>
            </div>

        </div>

        @livewireScripts
    </body>
</html>
