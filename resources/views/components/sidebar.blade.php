<nav id="sidebar" class="bg-success text-white">
    <div class="text-center min-h-75 d-inline-flex align-items-center justify-content-center">
        <a href="{{ route('home') }}" class="fw-bold px-3 text-decoration-none text-white">
            <h3 class="">Hospital</h3>
        </a>
    </div>
    <hr class="my-0">
    <ul class="nav d-flex flex-column">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.contacts.index') }}" class="nav-link text-white">Contacts</a>
        </li>
    </ul>
</nav>