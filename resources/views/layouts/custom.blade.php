<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'Panel de Control'))</title>
    <link rel="stylesheet" href="{{ asset('css/custom-dashboard.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <div class="dashboard-container">
        
        <aside class="sidebar">
            {{-- Logo removido por petición del usuario; se conserva el sidebar sin logo --}}
            
            <nav>
                <!-- Solo mostrar: Ingresar nuevo alumno (ir al CRUD) y Salir -->
                <a href="{{ route('alumnos.create') }}" class="menu-item">
                    <i class="fas fa-user-plus"></i> <span>Ingresar nuevo alumno</span>
                </a>
                <a href="{{ route('alumnos.index') }}" class="menu-item">
                    <i class="fas fa-users"></i> <span>Ver Alumnos</span>
                </a>
                <a href="{{ route('tareas.index') }}" class="menu-item">
                    <i class="fas fa-tasks"></i> <span>Tareas</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
                    @csrf
                    <button type="submit" class="menu-item" style="background:none; border:none; width:100%; cursor:pointer; text-align:left; padding:12px 15px;">
                        <i class="fas fa-sign-out-alt"></i> <span>Salir</span>
                    </button>
                </form>
            </nav>
        </aside>

        <header class="top-bar">
            <div class="search-bar">
                <span style="color: #94a3b8;">Bienvenido, <strong>{{ Auth::user()->name ?? 'Usuario' }}</strong></span>
            </div>
            <div class="user-profile">
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
            </div>
        </header>

        <main class="main-content">
            
            
            <div class="content-area">
               @yield('content')
            </div>

        </main>
    </div>

</body>
</html>
