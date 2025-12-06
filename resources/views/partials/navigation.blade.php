<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">storyspace.</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('books.index') }}">Produk Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tentang">Tentang Kami</a>
                </li>
            </ul>
            
            <ul class="navbar-nav ms-auto">
                <!-- Dark Mode Toggle -->
                <li class="nav-item d-flex align-items-center me-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="darkModeToggle">
                        <label class="form-check-label" for="darkModeToggle">
                            <small>Mode Gelap</small>
                        </label>
                    </div>
                </li>
                
                @auth
                    @if(auth()->user()->is_admin == true)
                    <li class="nav-item">
                        <a class="nav-link text-primary fw-bold" href="{{ route('admin.books.index') }}">
                            <i class="bi bi-speedometer2"></i> Admin Panel
                        </a>
                    </li>
                    @endif
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>