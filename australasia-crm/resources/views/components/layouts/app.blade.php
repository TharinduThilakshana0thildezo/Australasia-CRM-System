<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $metaDescription ?? 'Australasia CRM — Enterprise Operations Management' }}">

    <title>{{ $title ?? 'Dashboard' }} — Australasia CRM</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles

    {{ $head ?? '' }}
</head>
<body class="h-full" x-data="{ sidebarOpen: false, mobileMenu: false }">

<!-- Toast Container -->
<div id="toast-container" class="toast-container"></div>

<!-- Mobile Overlay -->
<div x-show="sidebarOpen"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false"
     class="fixed inset-0 bg-black/50 z-40 lg:hidden"
     style="display:none"></div>

<div class="crm-layout">

    <!-- ===== SIDEBAR ===== -->
    <aside id="crm-sidebar"
           :class="sidebarOpen ? 'open' : ''"
           class="crm-sidebar"
           x-bind:class="{ 'open': sidebarOpen }">

        <!-- Logo -->
        <div class="sidebar-logo">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-white no-underline">
                <div class="w-9 h-9 rounded-xl gradient-brand flex items-center justify-center flex-shrink-0">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                        <circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-bold leading-tight text-white">Australasia</div>
                    <div class="text-xs text-slate-400 leading-tight">CRM Platform</div>
                </div>
            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 py-3 overflow-y-auto">

            <!-- MAIN -->
            <div class="sidebar-section-title">Main</div>

            <a href="{{ route('dashboard') }}"
               class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard" class="icon"></i>
                Director Dashboard
            </a>

            <!-- FOREIGN EMPLOYMENT -->
            <div class="sidebar-section-title mt-2">Foreign Employment</div>

            <div x-data="{ open: {{ request()->is('employment*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="sidebar-item w-full text-left {{ request()->is('employment*') ? 'active' : '' }}">
                    <i data-lucide="briefcase" class="icon"></i>
                    Employment
                    <svg x-bind:class="open ? 'rotate-90' : ''"
                         class="ml-auto w-3.5 h-3.5 transition-transform duration-200"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>

                <div x-show="open" x-collapse class="sidebar-sub-menu">
                    <a href="{{ route('employment.dashboard') }}" class="sidebar-sub-item {{ request()->routeIs('employment.dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('employment.leads.index') }}" class="sidebar-sub-item {{ request()->routeIs('employment.leads*') ? 'active' : '' }}">Leads</a>
                    <a href="{{ route('employment.candidates.index') }}" class="sidebar-sub-item {{ request()->routeIs('employment.candidates*') ? 'active' : '' }}">Candidates</a>
                    <a href="{{ route('employment.talent-pool') }}" class="sidebar-sub-item {{ request()->routeIs('employment.talent-pool*') ? 'active' : '' }}">Talent Pool</a>
                    <a href="{{ route('employment.employers.index') }}" class="sidebar-sub-item {{ request()->routeIs('employment.employers*') ? 'active' : '' }}">Employers</a>
                    <a href="{{ route('employment.vacancies.index') }}" class="sidebar-sub-item {{ request()->routeIs('employment.vacancies*') ? 'active' : '' }}">Vacancies</a>
                    <a href="{{ route('employment.matching') }}" class="sidebar-sub-item {{ request()->routeIs('employment.matching*') ? 'active' : '' }}">Matching</a>
                    <a href="{{ route('employment.applications.index') }}" class="sidebar-sub-item {{ request()->routeIs('employment.applications*') ? 'active' : '' }}">Applications</a>
                    <a href="{{ route('employment.checklists.index') }}" class="sidebar-sub-item {{ request()->routeIs('employment.checklists*') ? 'active' : '' }}">Checklists</a>
                    <a href="{{ route('employment.visas.index') }}" class="sidebar-sub-item {{ request()->routeIs('employment.visas*') ? 'active' : '' }}">Visa Processing</a>
                    <a href="{{ route('employment.deployments.index') }}" class="sidebar-sub-item {{ request()->routeIs('employment.deployments*') ? 'active' : '' }}">Deployments</a>
                    <a href="{{ route('employment.refunds.index') }}" class="sidebar-sub-item {{ request()->routeIs('employment.refunds*') ? 'active' : '' }}">Refunds</a>
                    <a href="{{ route('employment.registration-links.index') }}" class="sidebar-sub-item {{ request()->routeIs('employment.registration-links*') ? 'active' : '' }}">Reg. Links</a>
                </div>
            </div>

            <!-- CONSULTANCY -->
            <div class="sidebar-section-title mt-2">Consultancy</div>

            <div x-data="{ open: {{ request()->is('consultancy*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="sidebar-item w-full text-left {{ request()->is('consultancy*') ? 'active' : '' }}">
                    <i data-lucide="graduation-cap" class="icon"></i>
                    Consultancy
                    <svg x-bind:class="open ? 'rotate-90' : ''"
                         class="ml-auto w-3.5 h-3.5 transition-transform duration-200"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>

                <div x-show="open" x-collapse class="sidebar-sub-menu">
                    <a href="{{ route('consultancy.dashboard') }}" class="sidebar-sub-item {{ request()->routeIs('consultancy.dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('consultancy.students.index') }}" class="sidebar-sub-item {{ request()->routeIs('consultancy.students*') ? 'active' : '' }}">Students</a>
                    <a href="{{ route('consultancy.counselling.index') }}" class="sidebar-sub-item {{ request()->routeIs('consultancy.counselling*') ? 'active' : '' }}">Counselling</a>
                    <a href="{{ route('consultancy.institutions.index') }}" class="sidebar-sub-item {{ request()->routeIs('consultancy.institutions*') ? 'active' : '' }}">Institutions</a>
                    <a href="{{ route('consultancy.applications.index') }}" class="sidebar-sub-item {{ request()->routeIs('consultancy.applications*') ? 'active' : '' }}">Applications</a>
                    <a href="{{ route('consultancy.visas.index') }}" class="sidebar-sub-item {{ request()->routeIs('consultancy.visas*') ? 'active' : '' }}">Visa</a>
                    <a href="{{ route('consultancy.payments.index') }}" class="sidebar-sub-item {{ request()->routeIs('consultancy.payments*') ? 'active' : '' }}">Payments</a>
                    <a href="{{ route('consultancy.enrollment.index') }}" class="sidebar-sub-item {{ request()->routeIs('consultancy.enrollment*') ? 'active' : '' }}">Enrollment</a>
                </div>
            </div>

            <!-- ACADEMY -->
            <div class="sidebar-section-title mt-2">Academy</div>

            <div x-data="{ open: {{ request()->is('academy*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="sidebar-item w-full text-left {{ request()->is('academy*') ? 'active' : '' }}">
                    <i data-lucide="book-open" class="icon"></i>
                    Academy
                    <svg x-bind:class="open ? 'rotate-90' : ''"
                         class="ml-auto w-3.5 h-3.5 transition-transform duration-200"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>

                <div x-show="open" x-collapse class="sidebar-sub-menu">
                    <a href="{{ route('academy.dashboard') }}" class="sidebar-sub-item {{ request()->routeIs('academy.dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('academy.students.index') }}" class="sidebar-sub-item {{ request()->routeIs('academy.students*') ? 'active' : '' }}">Students</a>
                    <a href="{{ route('academy.courses.index') }}" class="sidebar-sub-item {{ request()->routeIs('academy.courses*') ? 'active' : '' }}">Courses</a>
                    <a href="{{ route('academy.batches.index') }}" class="sidebar-sub-item {{ request()->routeIs('academy.batches*') ? 'active' : '' }}">Batches</a>
                    <a href="{{ route('academy.enrollments.index') }}" class="sidebar-sub-item {{ request()->routeIs('academy.enrollments*') ? 'active' : '' }}">Enrollments</a>
                    <a href="{{ route('academy.attendance.index') }}" class="sidebar-sub-item {{ request()->routeIs('academy.attendance*') ? 'active' : '' }}">Attendance</a>
                    <a href="{{ route('academy.exams.index') }}" class="sidebar-sub-item {{ request()->routeIs('academy.exams*') ? 'active' : '' }}">Exams</a>
                    <a href="{{ route('academy.certificates.index') }}" class="sidebar-sub-item {{ request()->routeIs('academy.certificates*') ? 'active' : '' }}">Certificates</a>
                </div>
            </div>

            <!-- OPERATIONS -->
            <div class="sidebar-section-title mt-2">Operations</div>

            <a href="{{ route('finance.dashboard') }}"
               class="sidebar-item {{ request()->is('finance*') ? 'active' : '' }}">
                <i data-lucide="wallet" class="icon"></i>
                Finance
            </a>

            <a href="{{ route('documents.index') }}"
               class="sidebar-item {{ request()->is('documents*') ? 'active' : '' }}">
                <i data-lucide="folder-open" class="icon"></i>
                Documents
            </a>

            <a href="{{ route('tasks.index') }}"
               class="sidebar-item {{ request()->is('tasks*') ? 'active' : '' }}">
                <i data-lucide="check-square" class="icon"></i>
                Tasks
                <span class="sidebar-badge">5</span>
            </a>

            <!-- ADMIN -->
            <div class="sidebar-section-title mt-2">Admin</div>

            <a href="{{ route('staff.index') }}"
               class="sidebar-item {{ request()->is('staff*') ? 'active' : '' }}">
                <i data-lucide="users" class="icon"></i>
                Staff
            </a>

            <a href="{{ route('reports.index') }}"
               class="sidebar-item {{ request()->is('reports*') ? 'active' : '' }}">
                <i data-lucide="bar-chart-2" class="icon"></i>
                Reports
            </a>

            <a href="{{ route('settings.index') }}"
               class="sidebar-item {{ request()->is('settings*') ? 'active' : '' }}">
                <i data-lucide="settings" class="icon"></i>
                Settings
            </a>

        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-slate-800">
            <div class="flex items-center gap-3">
                <div class="avatar avatar-sm avatar-indigo flex-shrink-0">
                    {{ substr(auth()->user()->name ?? 'AD', 0, 2) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-xs font-semibold text-slate-200 truncate">{{ auth()->user()->name ?? 'Admin User' }}</div>
                    <div class="text-xs text-slate-500 truncate">{{ auth()->user()->email ?? 'admin@australasia.lk' }}</div>
                </div>
                <button class="btn-ghost btn-icon" title="Logout">
                    <i data-lucide="log-out" style="width:14px;height:14px;color:#94a3b8"></i>
                </button>
            </div>
        </div>

    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="crm-main">

        <!-- Top Bar -->
        <header class="crm-topbar">

            <!-- Mobile menu toggle -->
            <button @click="sidebarOpen = !sidebarOpen"
                    class="btn-ghost btn-icon lg:hidden">
                <i data-lucide="menu" style="width:20px;height:20px;color:#64748b"></i>
            </button>

            <!-- Breadcrumb (desktop) -->
            <div class="hidden lg:block flex-1">
                {{ $breadcrumbs ?? '' }}
            </div>

            <!-- Global Search -->
            <div class="search-wrapper flex-1 max-w-xs lg:max-w-sm">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input id="global-search"
                       type="text"
                       class="search-input"
                       placeholder="Search candidates, NIC, passport… (Ctrl+K)">
            </div>

            <!-- Right actions -->
            <div class="flex items-center gap-2 ml-2">

                <!-- Notifications -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                            class="btn-ghost btn-icon relative"
                            id="notif-btn">
                        <i data-lucide="bell" style="width:20px;height:20px;color:#64748b"></i>
                        <span class="notif-dot"></span>
                    </button>

                    <!-- Notification dropdown -->
                    <div x-show="open"
                         @click.outside="open = false"
                         x-transition
                         class="absolute right-0 top-12 w-80 bg-white rounded-xl shadow-xl border border-slate-100 z-50"
                         style="display:none">
                        <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100">
                            <span class="font-semibold text-sm text-slate-800">Notifications</span>
                            <span class="badge badge-registered text-xs">3 new</span>
                        </div>
                        @include('partials.notifications-dropdown')
                        <div class="px-4 py-2 border-t border-slate-100">
                            <a href="#" class="text-xs text-indigo-600 font-semibold">View all notifications →</a>
                        </div>
                    </div>
                </div>

                <!-- User menu -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                            class="flex items-center gap-2 hover:bg-slate-50 px-2 py-1.5 rounded-lg transition-colors">
                        <div class="avatar avatar-sm avatar-indigo">
                            {{ substr(session('auth_user')['name'] ?? 'AD', 0, 2) }}
                        </div>
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-semibold text-slate-700 leading-tight">{{ session('auth_user')['name'] ?? 'Admin' }}</div>
                            <div class="text-xs text-slate-500 leading-tight">{{ session('auth_user')['role'] ?? 'User' }}</div>
                        </div>
                        <i data-lucide="chevron-down" style="width:14px;height:14px;color:#94a3b8" class="ml-1"></i>
                    </button>

                    <div x-show="open"
                         @click.outside="open = false"
                         x-transition
                         class="absolute right-0 top-12 w-48 bg-white rounded-xl shadow-xl border border-slate-100 z-50 py-1"
                         style="display:none">
                        <a href="#" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">
                            <i data-lucide="user" style="width:14px;height:14px"></i> Profile
                        </a>
                        <a href="#" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">
                            <i data-lucide="settings" style="width:14px;height:14px"></i> Settings
                        </a>
                        <div class="border-t border-slate-100 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 px-4 py-2.5 text-sm text-rose-600 hover:bg-rose-50 w-full text-left">
                                <i data-lucide="log-out" style="width:14px;height:14px"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </header>

        <!-- Page Content -->
        <div class="crm-content">
            {{ $slot }}
        </div>

    </main>
</div>

<!-- Livewire Scripts -->
@livewireScripts

<script>
    // Initialize Lucide icons after page load
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });

    // Re-init icons after Livewire updates
    document.addEventListener('livewire:navigated', () => {
        lucide.createIcons();
    });
</script>

{{ $scripts ?? '' }}

</body>
</html>
