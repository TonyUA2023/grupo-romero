<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Grupo Romero Ópticas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .sidebar {
            width: 250px;
            transition: all 0.3s;
        }
        .content {
            margin-left: 250px;
            transition: all 0.3s;
        }
        .collapsed .sidebar {
            width: 70px;
        }
        .collapsed .content {
            margin-left: 70px;
        }
        .active-menu {
            background-color: #1e40af;
            color: white !important;
        }
        .submenu {
            display: none;
            background-color: rgba(0, 0, 0, 0.1);
        }
        .submenu.active {
            display: block;
        }
        .has-submenu > a::after {
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            float: right;
            transition: transform 0.3s;
        }
        .has-submenu.active > a::after {
            transform: rotate(180deg);
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen" id="admin-container">
        <!-- Sidebar -->
        <div class="sidebar bg-gray-800 text-white fixed h-full overflow-y-auto">
            <div class="p-4 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <span class="text-xl font-bold">GR Admin</span>
                    <button id="toggle-sidebar" class="text-white focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            
            <nav class="mt-5">
                <ul>
                    <li class="mb-1">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'active-menu' : '' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                    </li>
                    
                    <!-- Catálogo con submenú -->
                    <li class="mb-1 has-submenu {{ request()->is('admin/catalog/*') ? 'active' : '' }}">
                        <a href="#" class="block py-3 px-4 hover:bg-gray-700 {{ request()->is('admin/catalog/*') ? 'bg-gray-700' : '' }}" onclick="toggleSubmenu(event, 'catalog-submenu')">
                            <i class="fas fa-shopping-bag mr-3"></i>
                            <span class="sidebar-text">Catálogo</span>
                        </a>
                        <ul id="catalog-submenu" class="submenu {{ request()->is('admin/catalog/*') ? 'active' : '' }}">
                            <li>
                                <a href="{{ route('admin.catalog.products.index') }}" 
                                   class="block py-2 px-8 hover:bg-gray-700 text-sm {{ request()->routeIs('admin.products.*') ? 'active-menu' : '' }}">
                                    <i class="fas fa-glasses mr-2 text-xs"></i>
                                    <span class="sidebar-text">Productos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.catalog.categories.index') }}" 
                                   class="block py-2 px-8 hover:bg-gray-700 text-sm {{ request()->routeIs('admin.categories.*') ? 'active-menu' : '' }}">
                                    <i class="fas fa-folder mr-2 text-xs"></i>
                                    <span class="sidebar-text">Categorías</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.catalog.brands.index') }}" 
                                   class="block py-2 px-8 hover:bg-gray-700 text-sm {{ request()->routeIs('admin.brands.*') ? 'active-menu' : '' }}">
                                    <i class="fas fa-tag mr-2 text-xs"></i>
                                    <span class="sidebar-text">Marcas</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="mb-1">
                        <a href="{{ route('admin.services.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.services.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-concierge-bell mr-3"></i>
                            <span class="sidebar-text">Servicios</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.pages.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.pages.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-file-alt mr-3"></i>
                            <span class="sidebar-text">Páginas</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.sections.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.sections.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-th-large mr-3"></i>
                            <span class="sidebar-text">Secciones</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.team.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.team.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-users mr-3"></i>
                            <span class="sidebar-text">Equipo</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.testimonials.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.testimonials.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-comment-alt mr-3"></i>
                            <span class="sidebar-text">Testimonios</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.blog.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.blog.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-blog mr-3"></i>
                            <span class="sidebar-text">Blog</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.gallery.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('admin.gallery.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-images mr-3"></i>
                            <span class="sidebar-text">Galería</span>
                        </a>
                    </li>
                    <li class="mt-8 border-t border-gray-700 pt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block py-3 px-4 hover:bg-gray-700 w-full text-left">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                <span class="sidebar-text">Cerrar Sesión</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="content flex-1 overflow-y-auto">
            <!-- Top Bar -->
            <header class="bg-white shadow">
                <div class="flex justify-between items-center px-6 py-4">
                    <h1 class="text-xl font-bold text-gray-800">@yield('title', 'Panel de Administración')</h1>
                    <div class="flex items-center">
                        <span class="mr-4 text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=Admin' }}" 
                             alt="Avatar" class="w-10 h-10 rounded-full">
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Toggle sidebar
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            document.getElementById('admin-container').classList.toggle('collapsed');
            
            // Toggle sidebar icons/text
            const sidebarTexts = document.querySelectorAll('.sidebar-text');
            sidebarTexts.forEach(text => {
                text.classList.toggle('hidden');
            });
        });
        
        // Toggle submenu
        function toggleSubmenu(event, submenuId) {
            event.preventDefault();
            const submenu = document.getElementById(submenuId);
            const parent = submenu.parentElement;
            
            // Toggle active class
            submenu.classList.toggle('active');
            parent.classList.toggle('active');
            
            // Close other submenus
            document.querySelectorAll('.submenu').forEach(menu => {
                if (menu.id !== submenuId) {
                    menu.classList.remove('active');
                    menu.parentElement.classList.remove('active');
                }
            });
        }
    </script>
</body>
</html>