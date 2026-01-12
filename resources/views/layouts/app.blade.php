<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Prodaja nekretnina')</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 120 120'%3E%3Cpath d='M60 20L20 55V100H40V75H80V100H100V55L60 20Z' fill='%23FFB800'/%3E%3Crect x='50' y='60' width='20' height='20' fill='white'/%3E%3C/svg%3E">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>

    <style>
        :root { --sidebar-width: 240px; }
        body, html { height: 100%; margin: 0; }
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #f1f3f5;
            border-right: 1px solid #e9ecef;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }
        .sidebar .nav-link { color: #212529; }
        .sidebar .nav-link.active {
            font-weight: 600;
            background: rgba(13,110,253,.10);
            border-radius: .5rem;
        }
        main {
            margin-left: var(--sidebar-width);
            height: 100vh;
            overflow-y: auto;
            width: calc(100% - var(--sidebar-width));
            box-sizing: border-box;
        }
        
        /* Mobile responsive */
        @media (max-width: 991.98px) {
            main {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body class="bg-white">

<div style="display: flex;">

    {{-- Desktop sidebar --}}
    <aside class="sidebar d-none d-lg-flex p-3">
        <h6 class="text-muted mb-3">Navigacija</h6>

        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}">Kontrolna tabla</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('kupac.*') ? 'active' : '' }}"
                   href="{{ route('kupac.index') }}">Kupci</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('nekretnina.*') ? 'active' : '' }}"
                   href="{{ route('nekretnina.index') }}">Nekretnine</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('prodaja.*') ? 'active' : '' }}"
                   href="{{ route('prodaja.index') }}">Prodaje</a>
            </li>
        </ul>

        <div class="mt-auto pt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-secondary w-100">Odjavi se</button>
            </form>
        </div>
    </aside>

    {{-- Main content --}}
    <main>
        {{-- Mobile topbar + offcanvas sidebar --}}
        <nav class="navbar navbar-light bg-light d-lg-none border-bottom">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                    ☰
                </button>
                <span class="navbar-brand mb-0 h1">@yield('title', 'Prodaja nekretnina')</span>
            </div>
        </nav>

        <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="mobileSidebar">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Navigacija</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column">
                <ul class="nav nav-pills flex-column gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                           href="{{ route('dashboard') }}">Kontrolna tabla</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kupac.*') ? 'active' : '' }}"
                           href="{{ route('kupac.index') }}">Kupci</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('nekretnina.*') ? 'active' : '' }}"
                           href="{{ route('nekretnina.index') }}">Nekretnine</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('prodaja.*') ? 'active' : '' }}"
                           href="{{ route('prodaja.index') }}">Prodaje</a>
                    </li>
                </ul>

                <div class="mt-auto pt-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-secondary w-100">Odjavi se</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container-fluid p-4">
            @yield('content')
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
