<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>病院の口コミ一覧</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <x-app-layout>
        <x-slot name="header">
            病院の口コミ
        </x-slot>
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
            <div>
                <h2>総合病院</h2>
                <p>場所</p>
                <h3>条件</h3>
                <p>診療科</p>
                <p>フリーワード</p>
                <p>この条件で絞り込む</p>
                <p align=right>参考になった順</p>
            </div>
            <hr>
            <div>
                <h3>口コミ一覧</h3>
                <div class='posts'>
                    @foreach ($posts as $post)
                        <div class='post'>
                            <h2 class='title'>
                                <a href="/posts/{{ $post->id }}">〇〇の口コミ</a>
                            </h2>
                            <h3>投稿日　{{ $post->created_at->format('Y/m/d') }}　　{{ $post->helpful }}人の参考になった</h3>
                            <br>
                            @if(!is_null($post->hospital_department_id))
                                <h3>{{ $post->hospital_department->name }}</h3>
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
                    @endforeach
                </div>
                <div class='paginate'>
                    {{ $posts->links() }}
                </div>
            </div>
        </body>
    </x-app-layout>
</html>
