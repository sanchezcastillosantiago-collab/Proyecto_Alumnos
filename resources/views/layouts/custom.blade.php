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
            <div class="logo">
                <i class="fas fa-rocket"></i>
                <span>{{ config('app.name', 'MiMarca') }}</span>
            </div>
            
            <nav>
                <a href="#" class="menu-item active">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-users"></i> <span>Usuarios</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-line"></i> <span>Reportes</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-cog"></i> <span>Configuración</span>
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
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-title">Usuarios Totales</div>
                    <div class="stat-value">1,240</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Ingresos Mes</div>
                    <div class="stat-value">$45,200</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Nuevas Órdenes</div>
                    <div class="stat-value">85</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Alertas</div>
                    <div class="stat-value">3</div>
                </div>
            </div>

            <div class="content-area">
               @yield('content')
            </div>

        </main>
    </div>

</body>
</html>
