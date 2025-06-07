<header>
        <Nav class="Logo">
            <a href="/" class="ButtonLogo">CyberNewsIndonesia</a>
        </Nav>
        <nav class="navigation">
            <a href="/about">About</a>
            <a href="/contact">Contact</a>   
            @auth
              <ion-icon name="person-circle-outline" id="profileBtn" class="btnprofile" onclick="toggleDropdown()"></ion-icon>
            @else
              <a href="/login" class="ButtonLogin">Login</a>
            @endauth
            
        </nav>
        @auth
          <div class="profile-dropdown" id="profileDropdown" role="menu">
                    <div class="dropdown-header">
                        <ion-icon name="person-circle-outline" class="avatar"></ion-icon>
                        <span class="username">{{ auth()->user()->username }}</span>
                    </div>
                    <ul>
                        <li><a href="/dashboard" class="dropdown-item" role="menuitem"> Dashboard</a></li>
                        <li><a href="/admindashboard" class="dropdown-item" role="menuitem">Upload News</a></li>
                        <li><a href="/leaderboard" class="dropdown-item" role="menuitem"> Leader Board</a></li>
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