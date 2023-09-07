      <!-- Navigation-->
      <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.html">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    @if (Auth::check())

                    @endif
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="about.html">About</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="post.html">Sample Post</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="contact.html">Contact</a></li>
                    @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link px-lg-3 py-3 py-lg-4 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(Auth::user()->admin)
                          <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a></li>
                          @endif
                          <li><a class="dropdown-item" href="{{ url('/my-posts') }}">My Posts</a></li>
                          <li><a class="dropdown-item" href="{{ url('/add-post') }}">Add Post</a></li>
                          <li><hr class="dropdown-divider"></li>

                          <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>

                          <form method="POST" action="{{ route('logout') }}">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <li><button class="dropdown-item" type="submit">Logout</button></li>
                            </form>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
