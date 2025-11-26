@extends('layouts.custom')

@section('title', __('Dashboard'))
@guest
    <script>window.location = "{{ route('login') }}";</script>
@endguest

@section('content')
    <style>
        /* Dashboard local styles: tamaño/colores y offcanvas */
        .dashboard-card { background: var(--card-bg, #ffffff); border-radius: 0.75rem; padding: 1rem; }
        .dashboard-title { font-size: 1.125rem; font-weight: 600; }
        .stat-big { font-size: 1.75rem; font-weight: 700; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: .5rem; padding: .5rem 1rem; border-radius: .5rem; cursor: pointer; border: 1px solid transparent; }
        .btn-primary { background: #0d6efd; color: #fff; border-color: #0d6efd; }
        .btn-outline-secondary { background: transparent; color: #6c757d; border-color: #6c757d; }
        /* Chart canvas fixed height for consistent layout */
        #visitsChart { height: 220px !important; max-height: 280px; }

        /* Offcanvas simple */
        #offcanvas { position: fixed; right: -340px; top: 0; height: 100%; width: 320px; background: #fff; box-shadow: -8px 0 24px rgba(0,0,0,0.12); transition: right .28s ease; z-index: 1055; padding: 1rem; overflow-y: auto; }
        #offcanvas.open { right: 0; }
        #offcanvas .heading { font-weight:600; margin-bottom: .5rem; }
        #offcanvasBackdrop { position: fixed; inset: 0; background: rgba(0,0,0,0.35); opacity: 0; visibility: hidden; transition: opacity .2s ease; z-index: 1050; }
        #offcanvasBackdrop.show { opacity: 1; visibility: visible; }
        /* small helper for the toggle button */
        .offcanvas-toggle { position: absolute; top: 1rem; right: 1rem; z-index: 1060; }
    </style>

    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <button id="offcanvasToggle" class="offcanvas-toggle btn btn-outline-secondary" title="Controles">
            <i class="bi bi-gear-fill"></i>
        </button>
        <!-- Card 1: gráfico sencillo con Chart.js -->
        <div class="dashboard-card border border-neutral-200 dark:border-neutral-700">
            <div class="d-flex items-center justify-between mb-3">
                <div class="dashboard-title">Visitas</div>
                <i class="bi bi-bar-chart-line-fill" style="font-size:1.35rem;color:#0d6efd"></i>
            </div>
            <canvas id="visitsChart" aria-label="Visitas" role="img"></canvas>
        </div>

        <!-- Card 2: estadística simple -->
        <div class="dashboard-card border border-neutral-200 dark:border-neutral-700 flex flex-col justify-center items-start">
            <div class="text-sm text-muted">Usuarios activos</div>
            <div class="stat-big">1,254</div>
            <div class="text-xs text-muted mt-2">Últimas 24 horas</div>
        </div>

        <!-- Card 3: acción rápida -->
        <div class="dashboard-card border border-neutral-200 dark:border-neutral-700 flex items-center justify-center">
            <div class="text-center">
                <div class="mb-2 text-sm text-muted">Crear nuevo registro</div>
                <a href="#" class="btn btn-primary">Nuevo</a>
            </div>
        </div>
    </div>
    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 bg-white dark:bg-zinc-900 mt-4">
        <!-- Contenedor principal: kept simple, puedes reemplazar con más widgets -->
        <h3 class="mb-3">Resumen</h3>
        <p class="text-sm text-muted">Aquí puedes añadir más widgets, tablas o informes.</p>
    </div>

    <!-- Chart.js CDN y script de inicialización (solo para esta vista) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Offcanvas markup -->
    <div id="offcanvasBackdrop"></div>
    <aside id="offcanvas" aria-hidden="true">
        <div class="heading">Controles rápidos</div>
        <div class="mb-3">
            <label class="form-label">Periodo</label>
            <select id="periodSelect" class="form-select" style="width:100%;padding:.45rem;border-radius:.35rem;border:1px solid #ddd;">
                <option value="7">Últimos 7 días</option>
                <option value="30">Últimos 30 días</option>
                <option value="90">Últimos 90 días</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Mostrar valores</label>
            <div>
                <label style="display:inline-flex;align-items:center;gap:.5rem"><input type="checkbox" id="showPoints" checked> Puntos</label>
            </div>
        </div>
        <div class="mt-4">
            <button id="closeOffcanvas" class="btn btn-outline-secondary">Cerrar</button>
        </div>
    </aside>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('visitsChart');
            if (!ctx) return;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'],
                    datasets: [{
                        label: 'Visitas',
                        data: [120, 200, 150, 220, 300, 250, 400],
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13,110,253,0.12)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });

            // Offcanvas toggle behavior
            const offToggle = document.getElementById('offcanvasToggle');
            const offcanvas = document.getElementById('offcanvas');
            const backdrop = document.getElementById('offcanvasBackdrop');
            const closeBtn = document.getElementById('closeOffcanvas');

            function openOffcanvas() {
                offcanvas.classList.add('open');
                backdrop.classList.add('show');
                offcanvas.setAttribute('aria-hidden','false');
            }

            function closeOffcanvas() {
                offcanvas.classList.remove('open');
                backdrop.classList.remove('show');
                offcanvas.setAttribute('aria-hidden','true');
            }

            if (offToggle) offToggle.addEventListener('click', openOffcanvas);
            if (backdrop) backdrop.addEventListener('click', closeOffcanvas);
            if (closeBtn) closeBtn.addEventListener('click', closeOffcanvas);

            // Simple control: cambiar periodo recarga datos de ejemplo
            const periodSelect = document.getElementById('periodSelect');
            if (periodSelect) {
                periodSelect.addEventListener('change', function () {
                    const val = parseInt(this.value, 10);
                    const multiplier = val === 7 ? 1 : val === 30 ? 0.8 : 0.6;
                    const newData = [120,200,150,220,300,250,400].map(n => Math.round(n * multiplier));
                    Chart.getChart('visitsChart').data.datasets[0].data = newData;
                    Chart.getChart('visitsChart').update();
                });
            }
        });
    </script>

@endsection
