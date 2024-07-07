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
            <h3>
                <a href="/">トップに戻る</a> 
                <a href="/posts/mypage/{{ Auth::user()->id }}">マイページへ</a> 
            </h3>
            <br>
            <h2 align=center>{{ $post->hospital->name }}</h2>
            <div class='post', align=center>
                @if (Auth::id() == $post->user->id)
                    <h3>口コミはマイページで編集・削除ができます</h3>
                @else
                    <h2>
                        @if (!is_null($post->user->age))
                            {{ $post->user->age==8 ? $post->user->age . '0代以上':$post->user->age . '0代' }}
                        @endif
                        @if (!is_null($post->user->sex))
                            {{ $post->user->sex==1 ? '男性':'女性' }}
                        @endif
                        @if (!is_null($post->user->myself))
                            {{$post->user->myself==1 ? '本人':'本人でない' }}
                        @endif
                        @if (is_null($post->user->age) && is_null($post->user->sex) && is_null($post->user->myself))
                            口コミ
                        @else 
                            の口コミ
                        @endif
                    </h2>
                @endif
                <h3>投稿日　{{ $post->created_at->format('Y/m/d') }}　　{{ $post->helpfuls->count() }}人の参考になった</h3>
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
                <div class="helpful" align="right">
                    @if (Auth::id() != $post->user->id)
                        @if($post->is_liked())
                            <form action="/posts/unhelpful/{{ $post->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">参考になったを取り消す</button>
                            </form>
                        @else
                            <form action="/posts/helpful/{{ $post->id }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">参考になった</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
