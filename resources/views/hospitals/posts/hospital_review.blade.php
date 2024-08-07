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
        <link rel="stylesheet" href="{{ asset('css/hospital.review.css') }}">
    </head>
    <x-app-layout>
        <x-slot name="header">
            検索
        </x-slot>
        <body class="antialiased">
            <div class="color">
                <div>
                    <div class="hospital">
                        <h1 class="hospital-name">{{ $hospital->name }}</h1>
                        <p>📍{{ $hospital->place }}</p>
                    </div>
                    <hr>
                    <div class="search">
                        <h3 class="search-title">検索条件</h3>
                        <form action="/hospitals/{{ $hospital->id }}" method="GET">
                            <div class="hospital_department">
                                <p>診療科</p>
                                <select class="block mt-1" name="search_hospital_department">
                                    <option value="">-未選択-</option>
                                    @foreach ($hospital_departments as $hospital_department)
                                        <option value="{{ $hospital_department->id }}" {{ $searchHospital_Department == $hospital_department->id ? "selected" : "" }}>{{ $hospital_department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="keyword">
                                <p>フリーワード</p>
                                <input type="text" name="keyword" value="{{ $keyword }}" placeholder="診療科、病名などで検索" class="search-box">
                                <input type="submit" value ="この条件で検索" class="search-button">
                            </div>
                            <div class="sort" align="right">
                                <select class="sort-button" name="sort_posts">
                                    <option value="helpful" {{ $sortPosts == "helpful" ? "selected" : "" }}>参考になった順</option>
                                    <option value="new" {{ $sortPosts == "new" ? "selected" : "" }}>新着順</option>
                                </select>
                            </div> 
                        </form>
                    </div>
                </div>
                <hr>
                <div class="result-posts">
                    <h3 class="title">{{ $hospital->name }}の口コミ一覧</h3>
                    <div class='posts'>
                        @if ($posts->isEmpty())
                            <p>該当する投稿がありませんでした。</p>
                        @endif
                        @foreach ($posts as $post)
                            <div class='post'>
                                <h2 class='post-title'>
                                    <a href="/posts/{{ $post->id }}">
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
                                    </a>
                                </h2>
                                <h3 class="date">投稿日　{{ $post->created_at->format('Y/m/d') }}　　{{ $post->helpfuls->count() }}人の参考になった</h3>
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
                                <h3>★ {{ $post->star }}</h3>
                                @if(!is_null($post->body))
                                    <p class="body-part">{{ $post->body }}</p>
                                @endif
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
                        @endforeach
                    </div>
                    <div class='paginate'>
                        <ul class="pagination">{{ $posts->appends(request()->query())->links() }}</ul>
                    </div>
                </div>
            </div>
        </body>
    </x-app-layout>
</html>
