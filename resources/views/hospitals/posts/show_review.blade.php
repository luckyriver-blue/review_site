<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>口コミの詳細画面</title>

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
                <h2>ホーム
                    検索
                    口コミを書く
                    マイページ
                </h2>
        <div>
            <hr>
            <h2>総合病院</h2>
            <br>
            <h3>
                <a href="/">トップに戻る</a> 
                <a href="/posts/mypage/{{ Auth::user()->id }}">マイページへ</a> 
            </h3>
            <div class='post', align=center>
                <h2>〇〇の口コミ</h2>
                <h3>投稿日　{{ $post->created_at->format('Y/m/d') }}　　{{ $post->helpful }}人の参考になった</h3>
                @if(!is_null($post->hospital_department_id))
                    <h3>{{ $post->hospital_department->name }}科</h3>
                @endif
                @if(!is_null($post->desease))
                    <h3>{{ $post->desease }}</h3>
                @endif
                @if(!is_null($post->smooth_examination) && !is_null($post->smooth_hospitalization))
                    <h3>治療までのスムーズさ</h3>
                @endif
                @if(!is_null($post->smooth_examination))
                    <h3>診察まで{{ $post->smooth_examination }}日　</h3>
                @endif
                @if(!is_null($post->smooth_hospitalization))
                    <h3>入院・手術まで{{ $post->smooth_hospitalization }}日</h3>
                @endif
                <h3>評価　{{ $post->star }}</h3>
                @if(!is_null($post->body))
                    <p>{{ $post->body }}</p>
                @endif
                <p align=right>参考になった</p>
            </div>
        </div>
    </body>
</html>
