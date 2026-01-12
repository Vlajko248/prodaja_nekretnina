<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Prodaja nekretnina')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root { --sidebar-width: 240px; }
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: #f1f3f5;
            border-right: 1px solid #e9ecef;
        }
        .sidebar .nav-link { color: #212529; }
        .sidebar .nav-link.active {
            font-weight: 600;
            background: rgba(13,110,253,.10);
            border-radius: .5rem;
        }
    </style>
</head>
<body class="bg-white">

<div class="d-flex">

    {{-- Desktop sidebar --}}
    <aside class="sidebar d-none d-lg-flex flex-column p-3 position-sticky top-0">
        <h6 class="text-muted mb-3">Navigacija</h6>

        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}">Kontrolna tabla</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('kupci.*') ? 'active' : '' }}"
                   href="{{ route('kupci.index') }}">Kupci</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('nekretnine.*') ? 'active' : '' }}"
                   href="{{ route('nekretnine.index') }}">Nekretnine</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('prodaje.*') ? 'active' : '' }}"
                   href="{{ route('prodaje.index') }}">Prodaje</a>
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
    <main class="flex-grow-1">
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
                        <a class="nav-link {{ request()->routeIs('kupci.*') ? 'active' : '' }}"
                           href="{{ route('kupci.index') }}">Kupci</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('nekretnine.*') ? 'active' : '' }}"
                           href="{{ route('nekretnine.index') }}">Nekretnine</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('prodaje.*') ? 'active' : '' }}"
                           href="{{ route('prodaje.index') }}">Prodaje</a>
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
