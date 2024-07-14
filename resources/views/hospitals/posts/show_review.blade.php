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
        <link rel="stylesheet" href="{{ asset('css/show_review.css') }}">
    </head>
    <x-app-layout>
        <body class="antialiased">
            <div class="color">
                <h3>
                    <a href="javascript:history.back()" class="links">前のページに戻る</a>
                    &emsp;
                    <a href="/" class="links">トップへ</a> 
                    &emsp;
                    <a href="/posts/mypage/{{ Auth::user()->id }}" class="links">マイページへ</a> 
                </h3>
                <br>
                <div class='post', align=center>
                    @if (Auth::id() == $post->user->id)
                        <h2 class="hospital-name">{{ $post->hospital->name }}</h2>
                        <h3 class="post-title">口コミはマイページで編集・削除ができます</h3>
                    @else
                        <h2 class="hospital-name">{{ $post->hospital->name }}</h2>
                        <h2 class="post-title">
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
                    <div class="post-details">
                        <h3>投稿日　{{ $post->created_at->format('Y/m/d') }}　　{{ $post->helpfuls->count() }}人の参考になった</h3>
                        @if(!is_null($post->hospital_department_id))
                            <h3>{{ $post->hospital_department->name }}</h3>
                        @endif
                        @if(!is_null($post->disease))
                            <h3>{{ $post->disease }}</h3>
                        @endif
                        @if(!is_null($post->smooth_examination) || !is_null($post->smooth_hospitalization))
                            <h3 class="smooth">治療までのスムーズさ　</h3>
                        @endif
                        @if(!is_null($post->smooth_examination))
                            <h3 class="smooth-examination">診察まで{{ $post->smooth_examination }}日 </h3>
                        @endif
                        @if(!is_null($post->smooth_hospitalization))
                            <h3 class="smooth-hospitalization">入院・手術まで{{ $post->smooth_hospitalization }}日</h3>
                        @endif
                        <h3>★  {{ $post->star }}</h3>
                        @if(!is_null($post->body))
                            <p class="body-part">{{ $post->body }}</p>
                        @endif
                    </div>
                </div>
                <div class="helpful" align="right">
                    @if (Auth::id() != $post->user->id)
                        @if($post->is_liked())
                            <form action="/posts/unhelpful/{{ $post->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="helpful-button">参考になったを取り消す</button>
                            </form>
                        @else
                            <form action="/posts/helpful/{{ $post->id }}" method="POST">
                                @csrf
                                <button type="submit" class="helpful-button">参考になった</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </body>
    </x-app-layout>
</html>
