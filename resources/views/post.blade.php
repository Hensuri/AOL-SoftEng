<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/post.css">
    <link rel="stylesheet" href="css/quiz.css">
    <link rel="stylesheet" href="css/home.css">
    @livewireStyles
    <title>News1</title>
</head>
<body>
  <x-navigationbar></x-navigationbar>
    
    <div class="container">
        <h1 class="headline">{{ $post->title }}</h1>
        <p class="subheadline">
            {{ $post->excerpt }}
        </p>

    <div class="author-section">
      <!-- <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Author" class="author-img"/> -->
       <div class="author-info">
        <p class="author-name">{{ $post->user->username }}</p>
        <p class="author-role">Admin</p>
        <p class="date">🕓 {{ \Carbon\Carbon::parse($post->created_at)->locale('id')->translatedFormat('l, j F Y') }}</p>
      </div>
    </div>

    <div class="article-image">
      <img src="{{ asset('/storage/'. $post->image) }}" alt="Cyberattack"/>
      {{-- <p class="caption">Patient data may have been exposed, analysts have warned. File pic: iStock</p> --}}
    </div>

    <div class="content">
        {!! nl2br(e($post->content)) !!}
    </div>
    <div class="kahoot-container">
        @livewire('quiz-game', ["post"=> $post])
    </div>
    
  </div>
  @livewireScripts

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