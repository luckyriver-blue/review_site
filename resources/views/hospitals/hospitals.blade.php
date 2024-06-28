<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>検索結果</title>

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
            <p>都道府県</p>
            <p>診療科</p>
            <p>病名</p>
            <p>フリーワード</p>
            <p>この条件で絞り込む</p>
            <p align=right>高評価順</p>
        </div>
        <hr>
        <div>
            <div class='hospitals'>
                @foreach ($hospitals as $hospital)
                    <div class='hospital'>
                        <h2 class='name'>
                            <a href="/hospitals/{{ $hopital->id }}">{{ $hospital->name }}</a>
                        </h2>
                        <h3>星　{{ $post->star }}</h3>
                        <h3>{{ $hospital->place }}</h3>
                        @if(!is_null($hospital_department_id))
                            @foreach ($hospital_departments as $hosital_department)
                                <h3>{{ $hospital_department->name }}</h3>
                            @endforeach
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
</html>
