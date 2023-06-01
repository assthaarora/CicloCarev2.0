<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed"
                href="{{route('home')}}">
                <i class="bi bi-menu-button-wide"></i><span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('chatify')}}">
                <i class="bi bi-layout-text-window-reverse"></i><span>Message</span>
            </a>
        </li><!-- End Tables Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed"  href="{{route('order_management')}}">
                <i class="bi bi-journal-text"></i><span>Orders</span>
            </a>
        </li><!-- End Forms Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed"  href="{{route('patient_profile.index')}}">
                <i class="bi bi-circle"></i><span>Account Details</span>
            </a>
        </li><!-- End Tables Nav -->
    </ul>
</aside>
