<nav class="navbar navbar-expand-md navbar-light navbar-light-custom fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/ayam3.png" alt="Hens Care" width="120">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link active" href="/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/dokumentasi">Dokumentasi</a>
                </li>
            </ul>

            {{-- Logout Button --}}
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>