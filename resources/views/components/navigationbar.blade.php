<header>
        <Nav class="Logo">
            <a href="/" class="ButtonLogo">CyberNewsIndonesia</a>
        </Nav>
        <nav class="navigation">
            <a href="/about">About</a>
            <a href="/contact">Contact</a>
            <a href="/leaderboard">Leaderboard</a>   
            @auth
              <img src="{{ asset('/storage/'. auth()->user()->image) }}"  class="btnprofile" id="profileBtn" onclick="toggleDropdown()">
            @else
              <a href="/login" class="ButtonLogin">Login</a>
            @endauth
            
        </nav>
        @auth
          <div class="profile-dropdown" id="profileDropdown" role="menu">
                    <div class="dropdown-header">
                        <img src="{{ asset('/storage/'. auth()->user()->image) }}"  class="avatar">
                        <span class="username">{{ auth()->user()->username }}</span>
                    </div>
                    <ul>
                        <li><a href="/dashboard" class="dropdown-item" role="menuitem"> Dashboard</a></li>
                        @can("admin")
                          <li><a href="/admindashboard" class="dropdown-item" role="menuitem">Upload News</a></li>
                        @endcan
                        {{-- <li><a href="/leaderboard" class="dropdown-item" role="menuitem"> Leader Board</a></li> --}}
                    </ul>
                    <div class="dropdown-divider"></div>
                    <form action="/logout" method="POST">
                      @csrf
                      <ul>
                        <li>
                          <button href="index.html" class="dropdown-item" role="menuitem">
                            Sign Out
                          </button>
                        </li>
                      </ul>
                    </form>
                    
                </div>
        @endauth
        
    </header>