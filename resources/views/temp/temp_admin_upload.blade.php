<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    {{-- Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>

    <style>
      trix-toolbar [data-trix-button-group="file-tools"]{
        display:none
      }
    </style>
</head>

    <title>Document</title>
</head>
<body>
    <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
<div class="min-h-full">
  <x-navbar></x-navbar>
  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <!-- Your content -->
      <!--This example requires updating your template:

        ```
        <html class="h-full bg-white">
        <body class="h-full">
        ```
        -->

        @if (session( )->has('success'))
          <div>
            {{ session('success') }}
          </div>
        @endif
        <div class="flex min-h-full flex-col justify-center px-10 py-15 lg:px-8">

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="/admindashboard" method="POST" enctype="multipart/form-data">
              @csrf
            <div>
                <label for="Title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                <div class="mt-2">
                <input type="text" name="title" id="title" autocomplete="Name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" value="{{ old('title') }}">
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
                <input type="text" name="slug" id="slug" autocomplete="slug" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" value="{{ old('slug') }}">
                </div>
            </div>
            
            <div class="mb-3">
              <label for="image" class="form-label">Upload Gambar</label>
              <input class="form-control" type="file" id="image" name="image">
            </div>

            <div>
              <label for="content" class="block text-sm/6 font-medium text-gray-900">Content</label>
              <input id="content" type="hidden" name="content">
              <trix-editor input="content"></trix-editor>
            </div>
            
            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Upload</button>
            </div>
            </form>

        </div>
        </div>

    </div>
  </main>
</div>

<script>
  const title = document.querySelector('#title');
  const slug = document.querySelector('#slug');

  title.addEventListener('change',function(){
    fetch('/admindashboard/createSlug?title=' + title.value)
      .then(Response => Response.json())
      .then(data => slug.value = data.slug)
  });

  document.addEventListener('trix-file-accept', function(e){
    e.preventDefault();
  });
</script>

</body>
</html>