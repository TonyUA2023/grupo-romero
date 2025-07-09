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
                    <li class="mb-1">
                        <a href="{{ route('admin.services.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('services.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-glasses mr-3"></i>
                            <span class="sidebar-text">Servicios</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.pages.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('pages.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-file-alt mr-3"></i>
                            <span class="sidebar-text">Páginas</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.sections.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('sections.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-th-large mr-3"></i>
                            <span class="sidebar-text">Secciones</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.team.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('team.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-users mr-3"></i>
                            <span class="sidebar-text">Equipo</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.testimonials.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('testimonials.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-comment-alt mr-3"></i>
                            <span class="sidebar-text">Testimonios</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.blog.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('blog.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-blog mr-3"></i>
                            <span class="sidebar-text">Blog</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.gallery.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('gallery.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-images mr-3"></i>
                            <span class="sidebar-text">Galería</span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.settings.index') }}" 
                           class="block py-3 px-4 hover:bg-gray-700 {{ request()->routeIs('settings.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-cog mr-3"></i>
                            <span class="sidebar-text">Configuración</span>
                        </a>
                    </li>
                    <li class="mt-8 border-t border-gray-700 pt-4">
                        <form method="POST" action="">
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
                        <span class="mr-4 text-gray-700">{{ Auth::user()->name }}</span>
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" 
                             alt="Avatar" class="w-10 h-10 rounded-full">
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            document.getElementById('admin-container').classList.toggle('collapsed');
            
            // Toggle sidebar icons/text
            const sidebarTexts = document.querySelectorAll('.sidebar-text');
            sidebarTexts.forEach(text => {
                text.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>