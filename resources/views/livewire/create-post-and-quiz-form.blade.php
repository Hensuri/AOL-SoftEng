<div>
    <form wire:submit="save" enctype="multipart/form-data">
        <div>
            <div class="form-group">
                <label for="title">Judul berita</label>
                <input type="text" wire:model="title" id="title" class="form-control" required value="{{ old('title')}}">
            </div>

            <div class="form-group">
                <label for="excerpt">Sub Judul</label>
                <input type="text" wire:model="excerpt" id="excerpt" class="form-control" required value="{{ old('excerpt')}}">
            </div>
                    
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" wire:model="slug" id="slug" class="form-control"  required value="{{ old('slug') }}">
            </div>

            {{-- <div class="form-group">
                <label for="imageInput">Gambar utama</label>
                    <div id="uploadArea" class="upload-area">
                            <div class="upload-text">
                                <label for="imageInput">
                                    <span>Unggah Gambar</span>
                            </label>
                            <input type="file" name="imageInput" id="imageInput" accept="image/*" style="display: none;">
                        </div>
                    </div>
            </div> --}}

            <div class="form-group">
                <label for="content">Isi Berita</label>
                <textarea id="content" wire:model="content" class="form-control" required value="{{ old('content')}}"></textarea>
            </div>

            @foreach ($questions as $index => $q)
                <div wire:key="question-{{ $index }}" class="mb-6 p-4 border border-gray-300 rounded shadow-sm">
                    <div class="main-container">
                    <div class="editor-view" class="editor-view">
                        <h2 class="text-lg font-bold mb-3">Pertanyaan {{ $loop->iteration }}</h2>
                            <div class="form-group">
                            <label for="question-input">Text Pertanyaan</label>
                            <textarea type="text" wire:model="questions.{{ $index }}.question" id="question-input" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Opsi Jawaban Yang Benar</label>
                            <div class="option-group">
                                <div class="form-control">
                                    <input wire:model="questions.{{ $index }}.a" type="text" id="opsion1-input" placeholder="Opsi 1 (Merah ▲)">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="option-group">
                                <div class="form-control">
                                    <input wire:model="questions.{{ $index }}.b"type="text" id="opsion2-input" placeholder="Opsi 2 (biru ◆)">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="option-group">
                                <div class="form-control">
                                    <input wire:model="questions.{{ $index }}.c" type="text" id="opsion3-input" placeholder="Opsi 3 (kuning ●)">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="option-group">
                                <div class="form-control">
                                    <input wire:model="questions.{{ $index }}.d"type="text" id="opsion4-input" placeholder="Opsi 4 (hijau ■)">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="option-group">
                                <div class="form-control">
                                    <input wire:model="questions.{{ $index }}.correct" type="text" id="correct-answer" placeholder="Opsi Jawaban Yang Benar {1,2,3,4}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="editor-action">
                            <button type="button" wire:click="deleteQuestion({{ $index }})" id="delete-question-btn" class="action-button delete-btn">Hapus pertanyaan</button>
                            <button type="button" wire:click="addQuestion" id="add-question-btn" class="action-button add-btn">Tambah Pertanyaan Baru</button>
                        </div>
                    </div>
                </div>       
                </div>
            @endforeach
            <div class="btn-container">
                <button type="submit" class="btn">Submit</button>
            </div>
        </div>
    </form>
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function () {
            fetch('/admindashboard/createSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => {
                    slug.value = data.slug;
                    @this.set('slug', data.slug);
                });
        });

    </script>
</div>
