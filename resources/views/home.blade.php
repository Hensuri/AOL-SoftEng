<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <script src="script.js"></script> 
    <title>Website 2.0</title>
</head>
<body>
<x-navigationbar></x-navigationbar>
  <div class="news-section">
    @foreach ($posts as $post)
    <div class="secondary-news">
      <div class="news-item">
        <img src="{{ asset('/storage/'. $post->image) }}" class="news-icon">
        <div class="news-content">
          <a href="{{ $post->slug }}" class="news1">
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->excerpt }}</p>
          </a>
        </div>
      </div>
    </div>
    @endforeach
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