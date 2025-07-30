<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <!-- Logo di kiri -->
    <a class="navbar-brand" href="#">
      <img src="/images/logoidproject.png" alt="ID Project Logo" class="h-10 mr-2">
    </a>

    <!-- Tombol toggle untuk mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu tengah dan tombol kanan -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Menu tengah -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="#">About us</a>
        </li>

        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <!-- Item menu lainnya -->
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('orderservice*') ? 'active' : '' }}"
              href="{{ auth()->check() ? route('orderservice.form') : route('login') }}"
              id="orderServiceLink">
              Order Service
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('customer.status') ? 'active' : '' }}"
              href="{{ auth()->check() ? route('customer.status') : route('login') }}"
              id="statusLink">
              Status
            </a>
          </li>
        </ul>
      </ul>

      <!-- Tombol login/logout di kanan -->
      <div class="d-flex">
        @auth
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline-light btn-sm" onclick="event.preventDefault(); this.closest('form').submit();">
            <i class="bi bi-box-arrow-right" style="font-size: 0.8rem;"></i>
            <span class="d-none d-sm-inline">Logout</span>
          </button>
        </form>
        @else
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">
          <i class="bi bi-box-arrow-in-right" style="font-size: 0.8rem;"></i>
          <span class="d-none d-sm-inline">Login</span>
        </a>
        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
          <i class="bi bi-person-plus" style="font-size: 0.8rem;"></i>
          <span class="d-none d-sm-inline">Register</span>
        </a>
        @endif
        @endauth
      </div>
    </div>
  </div>
</nav>
<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login Required</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>You need to login first to access this feature.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="{{ route('login') }}" class="btn btn-primary" id="loginRedirectBtn">Login Now</a>
      </div>
    </div>
  </div>
</div>