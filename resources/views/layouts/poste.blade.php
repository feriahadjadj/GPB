<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GPB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('img/logo.png')}}" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('simple-line-icons.css')}}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ asset('css/table_header_fixed.css') }}" rel="stylesheet"> --}}
    <!-- Scripts -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('fontawesome-free-5.12.0-web/css/all.min.css')}}">
</head>

<style>
    .content {
    margin-left: 300px; /* same as sidebar width */
    padding: 24px;
}

/* ======================================================
   DESIGN TOKENS
====================================================== */
:root {
    --primary: #0068FE;
    --primary-light: #4D95FE;
    --primary-dark: #004EBF;
    --secondary: #FDC90A;

    --g100: #F8F9FA;
    --g200: #E9ECEF;
    --g300: #DEE2E6;
    --g500: #6C757D;
    --g600: #495057;
    --g700: #343A40;
    --g800: #212529;

    --dracula: #2d3436;
    --white: #FFFFFF;
}

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
    background: var(--g100);
    color: var(--g800);
}

/* ======================================================
   APP SHELL
====================================================== */
.app {
    display: flex;
    min-height: 100vh;
}

/* ======================================================
   SIDEBAR
====================================================== */
/* PROFESSIONAL SIDEBAR */
/* ================== SIDEBAR ================== */
/* Sidebar Base */
.sidebar {
  width: 280px;
    height: 100vh; /* full viewport height */
    position: fixed; /* makes it fixed on screen */
    top: 0;
    left: 0; /* adjust if sidebar opens from left */
    z-index: 140; /* make sure it's above content */

    display: flex;
    flex-direction: column;
    font-family: 'Poppins', sans-serif;
    background-color: #212529; /* very dark base */
}

/* Header - same gradient as active nav item */
.sidebar-header {
    height: 80px;
    display: flex;
    align-items: center;
    padding: 0 24px;
    gap: 12px;
    font-size: 22px;
    font-weight: 700;
    background: linear-gradient(90deg, #0068FE 0%, #004EBF 100%); /* same as active */
    color: #FFFFFF;
    text-shadow: 0 1px 3px rgba(0,0,0,0.5);
}

/* Logo inside header */
.sidebar-header img {
    height: 42px;
    filter: brightness(1.2);
}

/* Navigation container */
.sidebar-nav {
    flex: 1;
    padding: 20px 0;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

/* Navigation links - default grey */
.sidebar-nav a {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 14px 24px;
    color: #CED4DA; /* grey text */
    font-size: 15px;
    font-weight: 500;
    text-decoration: none;
    background-color: #2d3436; /* dark grey card */
    transition: all 0.3s ease;
}

/* Hover effect - subtle */
.sidebar-nav a:hover {
    background-color: #343A40; /* slightly lighter grey */
    color: #FFFFFF;
}

/* Active link - matches header gradient */
.sidebar-nav a.active {
    background: linear-gradient(90deg, #0068FE 0%, #004EBF 100%);
    color: #FFFFFF;
}

/* Icons inside links */
.sidebar-nav a i {
    width: 22px;
    font-size: 18px;
}

/* Text inside links */
.sidebar-nav a span {
    flex: 1;
}

/* Mobile collapse */
@media (max-width: 992px) {
    .sidebar {
        position: fixed;
        left: -280px;
        top: 0;
        z-index: 50;
        transition: left 0.3s ease;
    }

    .sidebar.open {
        left: 0;
    }
}


/* ======================================================
   MAIN AREA
====================================================== */
.main {
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* ======================================================
   TOPBAR
====================================================== */
.topbar {
    height: 76px;
    background: rgba(255,255,255,.9);
    backdrop-filter: blur(14px);
    border-bottom: 1px solid var(--g200);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 32px;
    position: sticky;
    top: 0;
    z-index: 10;
}

.topbar-left {
    display: flex;
    align-items: center;
    gap: 16px;
}

.burger {
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
    display: none;
}

.page-title {
    font-size: 20px;
    font-weight: 600;
}

.topbar-right {
    display: flex;
    align-items: center;
    gap: 20px;
}
.topbar {
    height: 64px;
    background: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    border-bottom: 1px solid var(--g200);
}

/* RIGHT SIDE */
.topbar-right {
    display: flex;
    align-items: center;
    gap: 14px;
}

/* ICON BUTTONS */
.icon-btn {
    position: relative;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--g700);
    transition: background .2s;
}/* Topbar */
.topbar {
    height: 64px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 24px;
    background: #ffffff;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    position: sticky;
    top: 0;
    z-index: 100;
}

/* Left Section */
.topbar-left {
    display: flex;
    align-items: center;
    gap: 16px;
}

.project-name {
    font-size: 18px;
    font-weight: 600;
    color: #1E2A38;
}

/* Right Section */
.topbar-right {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-left: auto;
}

/* Burger */
.burger {
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
    color: #1E2A38;
    transition: transform 0.2s;
}
.burger:hover { transform: scale(1.1); }

/* Search Box */
.search-box {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #F1F3F5;
    padding: 6px 12px;
    border-radius: 12px;
    width: 220px;
}
.search-box input {
    border: none;
    outline: none;
    background: transparent;
    width: 100%;
    font-size: 14px;
}

/* Notifications */
.icon-btn {
    position: relative;
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #495057;
    transition: background 0.2s;
}
.icon-btn:hover { background: #F1F3F5; }
.badge {
    position: absolute;
    top: -4px;
    right: -4px;
    background: #fd0a0a;
    color: black;
    font-size: 10px;
    font-weight: 600;
    padding: 2px 6px;
    border-radius: 999px;
}

/* User Menu */
.user-menu {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px 12px;
    border-radius: 12px;
    cursor: pointer;
    transition: background 0.2s;
}
.user-menu:hover { background: #F1F3F5; }
.user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    font-weight: 600;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.user-name {
    font-size: 14px;
    font-weight: 500;
    color: #1E2A38;
}

/* Dropdown */
.user-menu .dropdown {
    display: none;
    position: absolute;
    top: 52px;
    right: 0;
    width: 240px;
    background: white;
    border-radius: 14px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.18);
    overflow: hidden;
}
.dropdown.show { display: block; }
.dropdown-header {
    padding: 16px;
    background: #F1F3F5;
    display: flex;
    flex-direction: column;
}
.dropdown-header span { font-size: 12px; color: #6C757D; }
.dropdown a {
    display: flex;
    gap: 10px;
    align-items: center;
    padding: 14px 16px;
    text-decoration: none;
    color: #495057;
    font-size: 14px;
    transition: background 0.2s;
}
.dropdown a:hover { background: #F8F9FA; }
.divider { height: 1px; background: #E9ECEF; }

/* Logo Right */
.topbar-logo {
    height: 36px;
    margin-left: 16px;
}


.icon-btn:hover {
    background: var(--g100);
}

.badge {
    position: absolute;
    top: 6px;
    right: 6px;
    background: var(--secondary);
    color: black;
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 999px;
}

/* USER MENU */
.user-menu {
    position: relative;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px 10px;
    border-radius: 12px;
    cursor: pointer;
}

.user-menu:hover {
    background: var(--g100);
}

/* AVATAR (INITIAL) */
.user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    font-weight: 600;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* DROPDOWN */
.user-menu .dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: 52px;
    width: 240px;
    background: white;
    border-radius: 14px;
    box-shadow: 0 20px 40px rgba(0,0,0,.18);
    overflow: hidden;
}

.user-menu .dropdown-header {
    padding: 16px;
    background: var(--g100);
    display: flex;
    flex-direction: column;
}

.user-menu .dropdown-header span {
    font-size: 12px;
    color: var(--g600);
}

.user-menu .dropdown a {
    padding: 14px 16px;
    display: flex;
    gap: 10px;
    align-items: center;
    color: var(--g800);
    text-decoration: none;
}

.user-menu .dropdown a:hover {
    background: var(--g100);
}

.user-menu .logout {
    color: #dc3545;
}

.divider {
    height: 1px;
    background: var(--g200);
}
/* Sidebar User Info */
.sidebar-user {
    padding: 24px;
    display: flex;
    flex-direction: column;
    align-items: center;
    border-bottom: 1px solid #2A3A50;
    background: #1E2A38;
}

.sidebar-user .user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    font-weight: 600;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
}

.sidebar-user .user-info {
    text-align: center;
}

.sidebar-user .user-info strong {
    display: block;
    font-size: 16px;
    color: white;
}

.sidebar-user .user-info span {
    font-size: 13px;
    color: #CED4DA;
}

/* Sidebar Footer (Profile + Logout) */
/* Sidebar Footer Fixed at Bottom */
.sidebar-footer {
    padding: 15px 20px;
    border-top: 1px solid rgba(255,255,255,.1);
    display: flex;
    flex-direction: column;
    gap: 10px;
}


.sidebar-footer a {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #CED4DA;
    text-decoration: none;
    font-size: 14px;
    padding: 8px;
    border-radius: 8px;
    transition: background .25s, color .25s;
}

.sidebar-footer a:hover {
    background: rgba(255,255,255,.08);
    color: white;
}

/* Topbar Logo */
.topbar-logo {
    height: 46px;
    margin-right: 12px;
}
@keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 0.2; }
    100% { opacity: 1; }
}
.blinking {
    animation: blink 1s infinite;
    box-shadow: 0 0 10px rgba(255, 0, 0, 0.7); /* Adds a glow to make it obvious */
}

/* SHOW */
.dropdown.show {
    display: block;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .search-box {
        display: none;
    }
}

/* SEARCH */
.search-box {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--g200);
    padding: 10px 14px;
    border-radius: 14px;
}

.search-box input {
    border: none;
    background: transparent;
    outline: none;
    width: 220px;
    font-size: 13px;
}

/* NOTIFICATIONS */
.notification {
    position: relative;
    font-size: 18px;
    cursor: pointer;
}

.notification span {
    position: absolute;
    top: -6px;
    right: -8px;
    background: var(--secondary);
    font-size: 10px;
    padding: 3px 6px;
    border-radius: 10px;
    font-weight: 600;
}

/* USER */
.user {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
}

.user img {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    border: 2px solid var(--primary-light);
}

.user span {
    font-size: 14px;
    font-weight: 500;
}

/* ======================================================
   CONTENT
====================================================== */
.content {
    padding: 10px;
}

/* DEMO CARDS */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(260px,1fr));
    gap: 24px;
}

.card {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 12px 40px rgba(0,0,0,.08);
}

.card h3 {
    margin: 0 0 8px;
    font-size: 16px;
}

.card p {
    margin: 0;
    color: var(--g600);
    font-size: 13px;
}

/* ======================================================
   RESPONSIVE
====================================================== */
@media (max-width: 992px) {
    .sidebar {
            position: fixed;      /* Fixes it on the screen */

        position: fixed;
        left: -280px;
        top: 0;
        height: 100%;
    }

    .sidebar.open {
        left: 0;
    }

    .burger {
        display: block;
    }

    .search-box {
        display: none;
    }
}

@media (max-width: 576px) {
    .topbar {
        padding: 0 16px;
    }

    .user span {
        display: none;
    }

    .content {
        padding: 20px;
    }
}
</style>
</head>

<body>

<div class="app">
    

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <!-- User Info (Sidebar Top) -->
        <div class="sidebar-user">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="user-info">
                <strong>{{ Auth::user()->name }}</strong>
                <span>{{ $projectName ?? 'GPB' }}</span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="sidebar-nav">
    <a href="{{ route('home') }}" class="{{ request()->segment(1) == 'home' ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i> Tableau de bord
            </a>

            @can('edit-users')
            <a href="{{ route('admin.users.index') }}" class="{{ request()->segment(2) == 'users' ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Gestion des utilisateurs
            </a>
            @endcan

            @can('edit-projet')
            <a href="{{ route('projet.gestionprojets',['id'=>Auth::user()->id,'finance'=>'tout','year'=>Carbon\Carbon::today()->year]) }}"
               class="{{ request()->segment(1) == 'projet' ? 'active' : '' }}">
                <i class="fa-solid fa-building"></i> Gestion des projets
            </a>
            @endcan

            @can('edit-users')
            <a href="{{ route('admin.finances.index') }}" class="{{ request()->segment(2) == 'finances' ? 'active' : '' }}">
                <i class="fa-solid fa-money-bill"></i> Financement
            </a>
            @endcan

            <a href="{{ route('annuaire') }}" class="{{ request()->segment(1) == 'annuaire' ? 'active' : '' }}">
                <i class="fa-solid fa-address-book"></i> Annuaire
            </a>

            <!-- Documentation -->
            @can('edit-users')
            <a href="{{ asset('files/ManualA.pdf') }}" target="_blank">
                <i class="fa-solid fa-file-alt"></i> Documentation
            </a>
            @elsecan('upw-role')
            <a href="{{ asset('files/ManualUPW.pdf') }}" target="_blank">
                <i class="fa-solid fa-file-alt"></i> Documentation
            </a>
            @elsecan('show-statistics')
            <a href="{{ asset('files/ManualADMIN.pdf') }}" target="_blank">
                <i class="fa-solid fa-file-alt"></i> Documentation
            </a>
            @endcan
        </nav>

        <!-- Profile & Logout (Fixed at bottom) -->
         <div class="sidebar-footer">
        <a href="{{ route('admin.users.show', Auth::user()->id) }}">
            <i class="fa fa-user"></i> Mon profil
        </a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out-alt"></i> Déconnexion
        </a>
        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
            @csrf
        </form>
    </div>

    </aside>
    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
<header class="topbar">
    <div class="topbar-left">
        <!-- Burger menu for sidebar toggle -->
        <button class="burger" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- Project Name / Workspace -->
        <div class="project-name">{{ $projectName ?? 'GPB' }}</div>
    </div>

    <div class="topbar-right">
        <!-- Search -->
        <div class="search-box">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="Rechercher…">
        </div>

   <!-- Notifications -->
<a href="{{ route('projet.notifications') }}" class="icon-btn" id="notification-bell">
    <i class="fa fa-bell"></i>
    <span id="notification-badge" class="badge {{ App\User::getNbNotifications() > 0 ? 'blinking' : '' }}" style="background-color: red; color: white;">
        {{ App\User::getNbNotifications() }}
    </span>
</a>


        <!-- User Menu -->
        

        <!-- Logo Right-Aligned -->
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="topbar-logo">
    </div>
</header>



        <!-- CONTENT -->
          <main class="content">
            @yield('content')
        </main>

    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
}
</script>
<script src="{{ asset('dist/script.min.js')}}"></script>
<script>
    $(function() {
        $('#results').DataTable({

            "language": {
                "url": "{{asset('dist/dataTables.fr.json')}}"
            }

        })
    });
   function removedrop(){

    $('.dropdown-menu').removeClass('show');
   }
    function showdrop(){

      //  var ele = document.getElementById('d');
        var ele2 =$('#d')[0];


        if(ele2.classList.contains('show')){

            $('.dropdown-menu').removeClass('show');

        }else{

            $('.dropdown-menu').addClass('show');
        }

    }

</script>

<script>
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
  }, 2000);
  
  </script>
  <script>
    
function toggleAdminMenu() {
    const dropdown = document.querySelector('.user-menu .dropdown');
    dropdown.classList.toggle('show');
}

// Close dropdown if clicked outside
document.addEventListener('click', function(e) {
    const userMenu = document.querySelector('.user-menu');
    const dropdown = document.querySelector('.user-menu .dropdown');
    
    if (!userMenu.contains(e.target)) {
        dropdown.classList.remove('show');
    }
});
</script>
<script>
// Check if there are new notifications and add the blinking effect
document.addEventListener('DOMContentLoaded', function() {
    const badge = document.getElementById('notification-badge');
    const bell = document.getElementById('notification-bell');
    
    if (!badge) return;

    const currentCount = parseInt(badge.textContent.trim());
    const lastSeenCount = sessionStorage.getItem('lastSeenNotificationCount');

    // Only blink if there are notifications AND the count is higher than what we last saw
    if (currentCount > 0 && (!lastSeenCount || currentCount > parseInt(lastSeenCount))) {
        badge.classList.add('blinking');
    } else {
        badge.classList.remove('blinking');
    }

    // When the bell is clicked, save the current count so we stop blinking
    bell.addEventListener('click', function() {
        sessionStorage.setItem('lastSeenNotificationCount', currentCount);
        badge.classList.remove('blinking');
    });
});

</body>
</html>
