<div>

    {{-- Flash Messages --}}
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="save" enctype="multipart/form-data">
            <div>
                <label for="Title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                <div class="mt-2">
                <input type="text" wire:change="generateSlug" wire:model="title" id="title" autocomplete="Name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" value="{{ old('title') }}">
                </div>
                @error('title')
                  <div class='invalid-feedback'>
                    Please provide Title
                  </div>
                @enderror
            </div>

            <div>
                <label for="Slug" class="block text-sm/6 font-medium text-gray-900">Slug</label>
                <div class="mt-2">
                    <input type="text" wire:model="slug" id="slug" autocomplete="slug" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" value="{{ old('slug') }}">
                </div>
                @error('slug')
                  <div class='invalid-feedback'>
                    Please provide Title
                  </div>
                @enderror
            </div>

            <div class="mb-3">
              <label for="image" class="form-label">Upload Gambar</label>
              <input type="file" id="image" wire:model="image">
              @error('image') <span class="error">{{ $message }}</span> @enderror
            </div>

            {{-- <div class="mb-3">
              <label for="content" class="block text-sm/6 font-medium  text-gray-900">Content</label>
              <input wire:model="content" id="content" type="hidden" value="{{ old('content') }}">
              <trix-editor x-on:trix-change="console.log($event.target.value)"></trix-editor>
              @error('content') <span class="error">{{ $message }}</span> @enderror
            </div> --}}

            <div class="form-group">
                <label for="content">Isi Berita</label>
                <textarea name="content" id="content" wire:model.defer="content" class="form-control"></textarea>
            </div>

            {{-- <div>
                <label for="content" class="block text-sm/6 font-medium text-gray-900">content</label>
                <div class="mt-2">
                    <input type="text" wire:model.defer="content" id="content" autocomplete="content" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" value="{{ old('content') }}">
                </div>
                @error('content')
                  <div class='invalid-feedback'>
                    Please provide Title
                  </div>
                @enderror
            </div> --}}
    

        {{-- Loop Through Questions --}}

        @foreach ($questions as $index => $q)
            <div class="mb-6 p-4 border border-gray-300 rounded shadow-sm">
                <h2 class="text-lg font-bold mb-3">Pertanyaan {{ $index + 1 }}</h2>

                <div class="mb-2">
                    <input
                        type="text"
                        wire:model.defer="questions.{{ $index }}.question"
                        placeholder="Tulis pertanyaan"
                        class="w-full border p-2 rounded"
                    >
                </div>

                <div class="grid grid-cols-2 gap-3 mb-2">
                    <input type="text" wire:model.defer="questions.{{ $index }}.a" placeholder="Jawaban A" class="border p-2 rounded">
                    <input type="text" wire:model.defer="questions.{{ $index }}.b" placeholder="Jawaban B" class="border p-2 rounded">
                    <input type="text" wire:model.defer="questions.{{ $index }}.c" placeholder="Jawaban C" class="border p-2 rounded">
                    <input type="text" wire:model.defer="questions.{{ $index }}.d" placeholder="Jawaban D" class="border p-2 rounded">
                </div>

                <div>
                    <input
                        type="text"
                        wire:model.defer="questions.{{ $index }}.correct"
                        placeholder="Jawaban yang benar"
                        class="w-full border p-2 rounded"
                    >
                </div>
                <button type="button" wire:click="deleteQuestion({{ $index }})" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Hapus Pertanyaan
                </button>
            </div>
        @endforeach

        {{-- Buttons --}}
        <div class="flex gap-2">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Upload
            </button>

            <button type="button" wire:click="addQuestion" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Pertanyaan
            </button>
        </div>
    </form>
</div>

<script type="text/javascript" src="/js/trix.js"></script>

<script>
  const title = document.querySelector('#title');
  const slug = document.querySelector('#slug');

  title.addEventListener('change', function () {
    fetch('/admindashboard/createSlug?title=' + title.value)
        .then(response => response.json())
        .then(data => {
            slug.value = data.slug;
            @this.set('slug', data.slug); // ← trigger Livewire update
        });
});

</script>