<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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
        <div class="flex min-h-full flex-col justify-center px-10 py-15 lg:px-8">

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="/register" method="POST">
              @csrf
            <div>
                <label for="Full Name" class="block text-sm/6 font-medium text-gray-900">Full Name</label>
                <div class="mt-2">
                <input type="text" name="name" id="name" autocomplete="Name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" value="{{ old('name') }}">
                </div>
                @error('name')
                  <div class='invalid-feedback'>
                    Please provide Full Name
                  </div>
                @enderror
            </div>

            <div>
                <label for="Username" class="block text-sm/6 font-medium text-gray-900">Username</label>
                <div class="mt-2">
                <input type="text" name="username" id="username" autocomplete="Username" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"value="{{ old('username') }}">
                </div>
                @error('username')
                  <div class='invalid-feedback'>
                    Please provide Username
                  </div>
                @enderror
            </div>

            <div>
                <div class="flex items-center justify-between">
                <label for="Email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                </div>
                <div class="mt-2">
                <input type="text" name="email" id="email" autocomplete="Email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" value="{{ old('email') }}">
                </div>
                @error('email')
                  <div class='invalid-feedback'>
                    Please provide Email
                  </div>
                @enderror
            </div>
            
            <div>
                <div class="flex items-center justify-between">
                <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                </div>
                <div class="mt-2">
                <input type="password" name="password" id="password" autocomplete="current-password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
                @error('password')
                  <div class='invalid-feedback'>
                    Please provide Password
                  </div>
                @enderror
            </div>

            <div>
                <div class="flex items-center justify-between">
                <label for="password" class="block text-sm/6 font-medium text-gray-900">Re-enter Password</label>
                </div>
                <div class="mt-2">
                <input type="password" name="password" id="password" autocomplete="current-password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
                @error('password')
                  <div class='invalid-feedback'>
                    Please provide Password
                  </div>
                @enderror
            </div>

            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
            </div>
            </form>

        </div>
        </div>

    </div>
  </main>
</div>

</body>
</html>