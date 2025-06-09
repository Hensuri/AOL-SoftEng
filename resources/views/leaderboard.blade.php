<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeaderBoard</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/LeaderBoard.css">
</head>
<body>
    <x-navigationbar></x-navigationbar>

    <div class="main-container">

        <div class="profile-container">
            @if ($users->count() == 0)
                
                <h2>Data Kosong</h2>
            @else
                <h2>Top Players</h2>
                <div class="profile-list">
                @if ($users->count() >= 2)
                    <div class="profile-item">
                    <div class="profile-avatar-1">
                        <img src="{{ asset('/storage/'. $users[1]->image) }}" alt="">
                        <div class="medal medal-2nd">2nd</div>
                    </div>
                    <div class="profile-name">{{ $users[1]->username }}</div>
                    <div class="profile-score">{{ $users[1]->total_score }}</div>
                    </div>
                @endif
                @if ($users->count() >= 1)
                    <div class="profile-item">
                    <div class="profile-avatar-2">
                        <img src="{{ asset('/storage/'. $users[0]->image) }}" alt="">
                        <div class="medal medal-1st">1st</div>
                    </div>
                    <div class="profile-name">{{ $users[0]->username }}</div>
                    <div class="profile-score">{{ $users[0]->total_score }}</div>
                    </div>
                @endif
                
                @if ($users->count() >= 3)
                   <div class="profile-item">
                    <div class="profile-avatar-3">
                        <img src="{{ asset('/storage/'. $users[2]->image) }}" alt="">
                        <div class="medal medal-3rd">3rd</div>
                    </div>
                    <div class="profile-name">{{ $users[2]->username }}</div>
                    <div class="profile-score">{{ $users[2]->total_score }}</div>
                    </div> 
                @endif
                
            </div>
            @endif
            
        </div>
        @if ($users->count() >= 4)
            <div class="table-container">
                <h2>Leaderboard</h2>
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users->skip(3) as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->total_score }}</td>
                            </tr>
                                
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        
    </div>
    <script>
          window.onload = function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            } else {
                console.error("Pustaka Lucide tidak terdefinisi ketika window.onload dijalankan. Periksa pemuatan skrip.");
            }
            const profileBtn = document.getElementById('profileBtn');
            const profileDropdown = document.getElementById('profileDropdown');
            if (profileBtn && profileDropdown) {
                profileBtn.addEventListener('click', function(event) {
                    event.stopPropagation();        
                    const isExpanded = profileBtn.getAttribute('aria-expanded') === 'true' || false;
                    profileBtn.setAttribute('aria-expanded', !isExpanded);
                    profileDropdown.classList.toggle('active');
                    profileBtn.classList.toggle('active'); 
                });   
                document.addEventListener('click', function(event) {
                    if (profileDropdown.classList.contains('active')) {
                        if (!profileDropdown.contains(event.target) && !profileBtn.contains(event.target)) {
                            profileDropdown.classList.remove('active');
                            profileBtn.classList.remove('active');
                            profileBtn.setAttribute('aria-expanded', 'false');
                        }
                    }
                });
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        if (profileDropdown.classList.contains('active')) {
                            profileDropdown.classList.remove('active');
                            profileBtn.classList.remove('active');
                            profileBtn.setAttribute('aria-expanded', 'false');
                        }
                    }
                });
            } else {
                console.error("Tombol profil atau elemen dropdown tidak ditemukan.");
            }
        };
    </script>
</body>
</html>