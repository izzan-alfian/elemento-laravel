<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        <li class="sidebar-item mt-2">
            <a class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-home"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item mt-2">
            <a class="sidebar-link {{ request()->is('magic-card', 'magic-card/*') ? 'active' : '' }}" href="{{ route('magic-card') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-flag"></i>
                </span>
                <span class="hide-menu">Magic Card</span>
            </a>
        </li>
        <li class="sidebar-item mt-2">
            <a class="sidebar-link {{ request()->is('modul', 'modul/*') ? 'active' : '' }}" href="{{ route('modul') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-book"></i>
                </span>
                <span class="hide-menu">Modul</span>
            </a>
        </li>
        <li class="sidebar-item mt-2">
            <a class="sidebar-link {{ request()->is('quiz', 'quiz/*') ? 'active' : '' }}" href="{{ route('quiz') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-pencil"></i>
                </span>
                <span class="hide-menu">Quiz</span>
            </a>
        </li>
        <li class="sidebar-item mt-2">
            <a class="sidebar-link {{ request()->is('feedback', 'feedback/*') ? 'active' : '' }}" href="{{ route('feedback') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-files"></i>
                </span>
                <span class="hide-menu">Feedback</span>
            </a>
        </li>
        <li class="sidebar-item mt-2">
            <a class="sidebar-link text-danger" href="{{ route('login') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-logout"></i>
                </span>
                <span class="hide-menu">Log out</span>
            </a>
        </li>
    </ul>
</nav>
