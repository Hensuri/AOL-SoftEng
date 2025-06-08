<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload with Details</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/upload.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link  href="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" rel="stylesheet">
</head>
<body>
    <x-navigationbar></x-navigationbar>
     <div class="main-layout-wrapper">
        <div class="upload-container">
            <h2><i class="fas fa-cloud-upload-alt"></i>Admin Dashboard</h2>
            <form action="/admindashboard" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" name="title" id="title" placeholder="Masukkan Judul Berita">
                </div>

                <div class="form-group">
                    <label for="excerpt">SubJudul</label>
                    <textarea name="excerpt" id="excerpt" placeholder="Sub Judul Berita"></textarea>
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <textarea name="slug" id="slug" placeholder="Slug"></textarea>
                </div>

                <div class="form-group">
                    <label for="fileUploadInputTrigger">Gambar</label>
                    <div class="file-input-wrapper" onclick="document.getElementById('fileUploadInputTrigger')">
                        <input type="file" id="fileUploadInputTrigger" name="image" class="file-input">
                        <label for="fileUploadInputTrigger" class="file-label">
                            <i class="fas fa-folder-open"></i>
                            <span>Pilih Gambar </span>
                        </label>
                        <p id="file-name">Belum ada gambar dipilih</p>
                        <p class="file-info">Ukuran maks: 100GB</p>
                    </div>
                </div>
                
                <div id="uploadStatusContainer" class="upload-status" style="display: none;">
                    <div class="progress-bar-container">
                        <div id="progressBarFill" class="progress-bar-fill" style="width: 0%;">0%</div>
                    </div>
                    <p id="uploadStatusText" class="status-text">Mengunggah...</p>
                </div>


                <button type="submit" id="uploadButton" class="upload-button">
                    <i class="fas fa-upload"></i> Upload
                    <div id="uploadLoadingSpinner" class="loader" style="display: none; margin-left: 8px;"></div>
                </button>
            </form>
            <div id="formUploadMessage" class="upload-message" style="display:none;"></div>
        </div>

        <div class="table-container">
            <h2>Daftar Berita</h2>
            <div style="overflow-x: auto;"> <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Tgl Unggah</th>
                            <th>Author</th>
                            <th>Aksi</th>
                            
                        </tr>
                    </thead>
                    <tbody id="fileTableBody">
                        @foreach ($posts as $post)
                            <tr class="table-row-example">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{!! $post->excerpt !!} </td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->user->username }}</td>
                                <td class="action-buttons">
                                    <a href="{{ $post->slug }}" class="view-btn" title="View"><i class="fas fa-eye"></i></a>
                                    <a href="admindashboard/{{ $post->slug }}/edit" class="setting-btn" title="Setting"><i class="fas fa-cog"></i></a>
                                    <form action="/admindashboard/{{ $post->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="delete-btn" title="Hapus" onclick="return confirm('Are you Sure??')"><i class="fas fa-trash"></i></button>
                                    </form>
                                    <form action="/admindashboard/{{ $post->id }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <button class = "upload-btn" title="upload"><i class="fas fa-upload"></i></button>
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                        <tr id="emptyStateRow" style="display:none;"> <td colspan="7" style="text-align: center; padding: 20px 0; color: #999999;">
                                <i class="fas fa-folder-open" style="font-size: 30px; margin-bottom: 10px; display:block;"></i>
                                Belum ada file yang diunggah.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change',function(){
        fetch('/admindashboard/createSlug?title=' + title.value)
        .then(Response => Response.json())
        .then(data => slug.value = data.slug)
    });
    </script>
</body>
</html>