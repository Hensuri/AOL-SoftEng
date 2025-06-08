<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>about</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/about.css">
</head>
<body>
  <x-navigationbar></x-navigationbar>
  
  <div class="container">
    <h1>About Us</h1>
    <p>
      Website cyberNewsIndonesia adalah sebuah platform digital yang dirancang untuk memberikan informasi, edukasi, dan layanan terkait keamanan siber di lingkungan Indonesia. 
      Website ini bertujuan untuk meningkatkan kesadaran masyarakat tentang pentingnya perlindungan data pribadi, ancaman siber, serta langkah-langkah pencegahan yang dapat diambil oleh individu maupun institusi. 
      Konten di dalamnya mencakup berita terkini seputar insiden siber di Indonesia, panduan keamanan digital, serta layanan pelaporan kejahatan siber yang bekerja sama dengan lembaga resmi seperti BSSN (Badan Siber dan Sandi Negara) dan Kepolisian Republik Indonesia. 
      Dengan adanya website ini, diharapkan masyarakat Indonesia menjadi lebih waspada dan terampil dalam menghadapi tantangan dunia digital yang terus berkembang.
    </p>
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

