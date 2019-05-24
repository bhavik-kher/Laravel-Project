<header class="header">
  <!-- Main Navbar-->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <!-- Navbar Brand -->
      <div class="navbar-header d-flex align-items-center justify-content-between">
        <!-- Navbar Brand --><a href="{{url('/')}}" class="navbar-brand">{{config('app.name') }}</a>
        <!-- Toggle Button-->
        <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
      </div>
      <!-- Navbar Menu -->
      <div id="navbarcollapse" class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          @if (Auth::guest())
              <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
              <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
          @else
          <li class="nav-item"><a href="{{url('/articles')}}" class="nav-link @if(Request::path() == 'articles') {{'active'}} @endif">MyArticles</a>
          </li>
          <li class="nav-item"><a href="{{url('/articles/create')}}" class="nav-link @if(Request::path() == 'articles/create') {{'active'}} @endif ">Create Article</a>
          </li>
              <li class="dropdown nav-item">
                  <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-expanded="false">
                      {{ Auth::user()->first_name }} <span class="caret"></span>
                  </a>

                  <ul class="dropdown-menu" role="menu">
                      <li class="nav-item">
                        <li class="nav-item"><a href="{{route('user.profile.edit')}}" class="nav-link">Settings</a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('logout') }}" class="nav-link"
                              onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                              Logout
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                      </li>
                  </ul>
              </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
</header>