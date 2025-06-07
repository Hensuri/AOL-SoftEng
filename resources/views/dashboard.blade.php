<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="script.js"></script> 
    <title>Website 3.0</title>
</head>
<body>
    <input type="file" id="photo-upload" accept="image/*" style="display: none;">
    <x-navigationbar></x-navigationbar>

     <main class="content profile-container">
        <div class="profile-card">
            <div class="profile-avatar">
                <img src="{{ asset('/storage/'. auth()->user()->image) }}" id="mainProfileImage" alt="Foto Profil pengguna">
            </div>
            <div class="profile-username" id="mainUsername">{{ auth()->user()->username }}</div>
            <div class="email-username" id="mainEmail">{{ auth()->user()->email }}</div>
            <hr class="profile-divider">
            <div class="profile-info">
                <div class="profile-skor">
                    <p>Skor <span style="float: right;">{{ $totalScore }}</span></p>
                </div>
                <div class="create-on">
                    <p>Create On <span style="float: right;">{{ auth()->user()->created_at->format('d F Y') }}</span></p>
                </div>
            </div>
            <button id="openEditModalBtn" class="edit-profile-button">
                <i data-lucide="pencil"></i>
                Edit Profil
            </button>
        </div>
    </main>

<div id="editModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Profil Anda</h2>
                <button class="close-modal-btn" id="closeModalBtn">&times;</button>
            </div>
            <form id="editForm" action="/dashboard/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label class="form-label">Foto Profil</label>
                    <div class="image-upload-group">
                        <img src="../Photo/defaulphoto.jpg" id="imagePreview" alt="Pratinjau gambar">
                        <label for="fileUpload" class="custom-file-upload">Pilih File</label>
                        <input type="file" name="image" id="fileUpload" accept="image/*">
                    </div>
                </div>
                <div class="form-group">
                    <label for="usernameInput" class="form-label">Username</label>
                    <input type="text" name="username" id="usernameInput" class="form-input">
                </div>
                <div class="form-group">
                    <label for="emailInput" class="form-label">Email</label>
                    <input type="email" name="email" id="emailInput" class="form-input">
                </div>
                <div class="form-group">
                    <label for="passwordInput" class="form-label">Password</label>
                    <input type="password" name="password" id="passwordInput" class="form-input">
                </div>
                <div class="modal-actions">
                    <button type="button" id="cancelEditBtn" class="modal-button secondary">Batal</button>
                    <button type="submit" id="saveChangesBtn" class="modal-button primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
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
            
            const openModalBtn = document.getElementById('openEditModalBtn');
            const modal = document.getElementById('editModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const cancelEditBtn = document.getElementById('cancelEditBtn');
            const editForm = document.getElementById('editForm');
            
            
            const mainProfileImage = document.getElementById('mainProfileImage');
            const mainUsername = document.getElementById('mainUsername');
            const mainEmail = document.getElementById('mainEmail');

            
            const imagePreview = document.getElementById('imagePreview');
            const fileUpload = document.getElementById('fileUpload');
            const usernameInput = document.getElementById('usernameInput');
            const emailInput = document.getElementById('emailInput');

            let newImageObjectUrl = null;

            
            const openModal = () => {
                usernameInput.value = mainUsername.textContent;
                emailInput.value = mainEmail.textContent;
                imagePreview.src = mainProfileImage.src;
            
                modal.classList.add('active');
            };
            
            
            const closeModal = () => {
                modal.classList.remove('active');
               
                if(newImageObjectUrl) {
                    URL.revokeObjectURL(newImageObjectUrl);
                    newImageObjectUrl = null;
                }
                fileUpload.value = ''; 
            };

            
            openModalBtn.addEventListener('click', openModal);
            closeModalBtn.addEventListener('click', closeModal);
            cancelEditBtn.addEventListener('click', closeModal);
            
            
            modal.addEventListener('click', (e) => {
                if(e.target === modal) {
                    closeModal();
                }
            });

           
            fileUpload.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if(file) {
                    if(newImageObjectUrl) {
                        URL.revokeObjectURL(newImageObjectUrl);
                    }
                    newImageObjectUrl = URL.createObjectURL(file);
                    imagePreview.src = newImageObjectUrl;
                }
            });

            
            // editForm.addEventListener('submit', (e) => {
            //     e.preventDefault(); 

               
            //     mainUsername.textContent = usernameInput.value;
            //     mainEmail.textContent = emailInput.value;
            //     if(newImageObjectUrl) {
            //         mainProfileImage.src = newImageObjectUrl;
            //         newImageObjectUrl = null; 
            //     }

            //     closeModal(); 
            // });
        
        
    </script>

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