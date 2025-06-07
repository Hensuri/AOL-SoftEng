<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" rel="stylesheet">
    <link rel="stylesheet" href="../../css/setting.css">
    <link rel="stylesheet" href="../../css/input_quiz.css">
    <link rel="stylesheet" href="../../css/home.css">
</head>
<body>
    <x-navigationbar></x-navigationbar>

  <div class="container">
        <div class="page-title">
            <h1>Edit Berita</h1>
        </div>
        @livewire('create-post-and-quiz-form', ["post"=> $post])
    </div>    
</body>
</html>