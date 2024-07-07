<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>トップ</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div>
            <p align=right>ログイン</p>
                <h1>病院口コミサイト</h1>
                <h2>
                    ホーム
                    検索
                    口コミを書く
                    マイページ
                </h2>
        <div>
        <hr>
        <div>
            <div class='search'>
                <form action="/hospitals" method="GET">
                    <input type="text" name="keyword" value="{{ $keyword }}" placeholder="病院名、場所、診療科で病院検索">
                    <input type="submit" value ="検索">
                </form>
            </div>
            <hr>
            <div class="star_hospitals">
                @foreach ($hospitals as $key => $hospital)
                    <h2 class='name'>
                            <a href="/hospitals/{{ $hospital->id }}">{{ $hospital->name }}</a>
                            <span>{{ $key + 1 }}位</span>
                    </h2>
                @endforeach
                <a href="/hospitals">・・・</a>
            </div>
        </div>
    </body>
</html>