<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'Panel de Control'))</title>
    <link rel="stylesheet" href="{{ asset('css/custom-dashboard.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

                <a href="{{ route('secciones.index') }}" class="menu-item">
                    <i class="fas fa-layer-group"></i> <span>Secciones</span>
                </a>

                <a href="{{ route('tareas.index') }}" class="menu-item">
                    <i class="fas fa-tasks"></i> <span>Tareas</span>
                </a>

                <a href="{{ route('files.index') }}" class="menu-item">
                    <i class="fas fa-file-alt"></i> <span>Archivos</span>
                </a>

                @auth
                    <a href="{{ route('files.create') }}" class="menu-item">
                        <i class="fas fa-upload"></i> <span>Subir archivos</span>
                    </a>
                @endauth

                @can('is-admin')
                    <a href="{{ route('emails.create') }}" class="menu-item">
                        <i class="fas fa-envelope"></i> <span>Enviar correo</span>
                    </a>
                @endcan

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
                <span style="color: #94a3b8;">Bienvenido</span>
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

    <script>
    // Overlay removal script (more aggressive): hides large fixed/absolute/sticky elements that cover the app.
    // Protects only `.sidebar` and `.top-bar` (navigation). Uses MutationObserver to catch elements injected later.
    (function(){
        const PROTECTED = ['.sidebar', '.top-bar', '.dashboard-container'];
        const HIDE_ATTR = 'data-hidden-by';
        const THRESHOLD = 120; // pixels (width or height) to consider an element 'large'

        function isProtected(el){
            try{
                for(const sel of PROTECTED){ if(el.closest && el.closest(sel)) return true; }
            }catch(e){ }
            return false;
        }

        function hideOverlay(el){
            if(!el || el.hasAttribute(HIDE_ATTR)) return false;
            try{
                if(isProtected(el)) return false;
                // mark then fade out
                el.setAttribute(HIDE_ATTR, 'hide-overlay-script');
                el.style.transition = 'opacity 180ms ease, transform 180ms ease';
                el.style.opacity = '0';
                el.style.transform = 'scale(0.01)';
                el.style.pointerEvents = 'none';
                setTimeout(()=>{ try{ el.style.display = 'none'; }catch(e){} }, 220);
                console.debug('hide-overlay-script: hid', el);
                return true;
            }catch(e){ return false; }
        }

        function scanAndHide(){
            try{
                const els = Array.from(document.querySelectorAll('body *'));
                for(const el of els){
                    try{
                        const style = window.getComputedStyle(el);
                        if(!style) continue;
                        const pos = style.position;
                        if(pos !== 'fixed' && pos !== 'absolute' && pos !== 'sticky') continue;
                        const rect = el.getBoundingClientRect();
                        const area = rect.width * rect.height;
                        const z = parseInt(style.zIndex) || 0;
                        // Hide if large enough or obviously overlay (high z-index)
                        if((rect.width > THRESHOLD || rect.height > THRESHOLD || area > 10000 || z >= 999) && !isProtected(el)){
                            hideOverlay(el);
                        }
                    }catch(e){ /* ignore */ }
                }

            }catch(e){ console.error('scanAndHide error', e); }
        }

        // Run immediately and after load
        document.addEventListener('DOMContentLoaded', scanAndHide);
        window.addEventListener('load', ()=>{ setTimeout(scanAndHide, 200); });

        // Observe DOM changes (toolbars may be injected later)
        const observer = new MutationObserver((mutations)=>{
            // debounce
            clearTimeout(window.__hideOverlayTimer);
            window.__hideOverlayTimer = setTimeout(scanAndHide, 120);
        });
        observer.observe(document.body, { childList: true, subtree: true });
        // Expose helper for debugging
        window.__scanAndHideOverlays = scanAndHide;
    })();
    </script>

</body>
</html>
