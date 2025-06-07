<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/post.css">
    <link rel="stylesheet" href="css/quiz.css">
    @livewireStyles
    <title>News1</title>
</head>
<body>
    <header>
        <Nav class="Logo">
        <a href="index.html" class="ButtonLogo">CyberNewsIndonesia</a>
        </Nav>
    </header>
    
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
</body>
</html>