<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeaderBoard</title>
    <link rel="stylesheet" href="css/Main.css">
    <link rel="stylesheet" href="css/LeaderBoard.css">
</head>
<body>
    <header>
     <Nav class="Logo">
        <a href="/" class="ButtonLogo">CyberNewsIndonesia</a>
      </Nav>
    </header>

    <div class="main-container">

        <div class="profile-container">
            <h2>Top Players</h2>
            <div class="profile-list">
                <div class="profile-item">
                    <div class="profile-avatar-1">
                        <img src="{{ $users[1]->image }}" alt="">
                        <div class="medal medal-2nd">2nd</div>
                    </div>
                    <div class="profile-name">{{ $users[1]->username }}</div>
                    <div class="profile-score">{{ $users[1]->total_score }}</div>
                </div>
                <div class="profile-item">
                    <div class="profile-avatar-2">
                        <img src="{{ $users[0]->image }}" alt="">
                        <div class="medal medal-1st">1st</div>
                    </div>
                    <div class="profile-name">{{ $users[0]->username }}</div>
                    <div class="profile-score">{{ $users[0]->total_score }}</div>
                </div>
                <div class="profile-item">
                    <div class="profile-avatar-3">
                        <img src="{{ $users[2]->image }}" alt="">
                        <div class="medal medal-3rd">3rd</div>
                    </div>
                    <div class="profile-name">{{ $users[2]->username }}</div>
                    <div class="profile-score">{{ $users[2]->total_score }}</div>
                </div>
            </div>
        </div>

        <div class="table-container">
            <h2>Leader Board</h2>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users->skip(3) as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->total_score }}</td>
                        </tr>
                            
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>