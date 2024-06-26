<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>マイページ</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            <link rel="stylesheet" href="{{ secure_asset('/css/create.css') }}">
            th {
                white-space: nowrap;
                
            }
        </style>
    </head>
    <x-app-layout>
        <x-slot name="header">
            マイページ
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
                <h1>プロフィール</h1>
                <form action="/posts/mypage" method="POST">
                    @csrf
                    
                    <table>
                        <tr class="sex">
                            <th>性別</th>
                            <td class="container">
                                <select class="block mt-1 w-full" name="user[sex]">
                                    <option align=center value="">-未選択-</option>
                                    <option value="1" {{ $user->sex =="1"? "selected" : "" }}>男性</option>
                                    <option value="2" {{ $user->sex =="2"? "selected" : "" }}>女性</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="age">
                            <th>年齢</th>
                            <td class="container">
                                <select class="block mt-1 w-full" name="user[age]">
                                    <option align=center value="">-未選択-</option>
                                    <option value="1" {{ $user->age =="1"? "selected" : "" }}>10代</option>
                                    <option value="2" {{ $user->age =="2"? "selected" : "" }}>20代</option>
                                    <option value="3" {{ $user->age =="3"? "selected" : "" }}>30代</option>
                                    <option value="4" {{ $user->age =="4"? "selected" : "" }}>40代</option>
                                    <option value="5" {{ $user->age =="5"? "selected" : "" }}>50代</option>
                                    <option value="6" {{ $user->age =="6"? "selected" : "" }}>60代</option>
                                    <option value="7" {{ $user->age =="7"? "selected" : "" }}>70代</option>
                                    <option value="8" {{ $user->age =="8"? "selected" : "" }}>80才以上</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" value="プロフィールを更新する"/>
                </form>
                <br>
                
                
                <div class='post'>
                    <h1>投稿した口コミ</h1>
                    @foreach($posts as $post)
                        <h2>{{ $post->hospital->name }}</h2>
                        <h3>投稿日　{{ $post->created_at->format('Y/m/d') }}　　{{ $post->helpful }}人の参考になった</h3>
                        @if(!is_null($post->hospital_department))
                            <h3>{{ $post->hospital_department }}科</h3>
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
                        <br>
                    @endforeach
                </div>
            </div>
        </body>
    </x-app-layout>
</html>
