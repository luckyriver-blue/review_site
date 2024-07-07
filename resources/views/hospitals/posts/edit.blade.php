<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>口コミを編集する</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <link rel="stylesheet" href="{{ secure_asset('/css/create.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('/css/star.css') }}">
        
       
        
        
    </head>
    <x-app-layout>
        <x-slot name="header">
            マイページ
        </x-slot>
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
                <h2 align=center>口コミ編集✎</h2>
                <div class="enter_review">
                    <h2>{{ $post->hospital->name }}</h2>
                    <form action="/posts/{{ $post->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <table>
                            <tr class="myself">
                                <th>口コミを投稿するのは</th>
                                <td class="container">
                                    <select class="block mt-1 w-full" name="post[myself]">
                                        <option align=center value="">-未選択-</option>
                                        <option value="1" {{ $post->myself =="1"? "selected" : "" }}>本人</option>
                                        <option value="2" {{ $post->myself =="2"? "selected" : "" }}>本人でない</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="hospital_department">
                                <th>診療科</th>
                                <td class="container">
                                    <select class="block mt-1 w-full" name="post[hospital_department_id]">
                                        <option value="">-未選択-</option>
                                        @foreach ($hospital_departments as $hospital_department)
                                            <option value="{{ $hospital_department->id }}" {{ $post->hospital_department_id == $hospital_department->id ? "selected" : "" }}>{{ $hospital_department->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class="desease">
                                <th>病名</th>
                                <td>
                                    <input type="text" name="post[desease]" value="{{ $post->desease ?? "" }}"/>
                                    <p class="desease__error" style="color:red">{{ $errors->first('post.desease') }}</p>
                                </td>
                            </tr>
                            <tr class="smooth">
                                <th>治療までのスムーズさ</th>
                                <td>診察まで
                                <input type="number" name="post[smooth_examination]" value="{{ $post->smooth_examination ?? "" }}"/>
                                日　
                                入院・手術まで
                                <input type="number" name="post[smooth_hospitalization]" value="{{ $post->smooth_hospitalization ?? "" }}"/>
                                日*</td>
                            </tr>
                            <tr class="star">
                                <th>評価（必須）</th>
                                <td>
                                    <div class="rate-form">
                                        <input id="star5" type="radio" name="post[star]" value="5" {{ $post->star =="5"? "checked" : "" }}><label for="star5">★</label>
                                        <input id="star4" type="radio" name="post[star]" value="4" {{ $post->star =="4"? "checked" : "" }}><label for="star4">★</label>
                                        <input id="star3" type="radio" name="post[star]" value="3" {{ $post->star =="3"? "checked" : "" }}><label for="star3">★</label>
                                        <input id="star2" type="radio" name="post[star]" value="2" {{ $post->star =="2"? "checked" : "" }}><label for="star2">★</label>
                                        <input id="star1" type="radio" name="post[star]" value="1" {{ $post->star =="1"? "checked" : "" }}><label for="star1">★</label>
                                    </div>
                                    <p class="star__error" style="color:red">{{ $errors->first('post.star') }}</p>
                                </td>
                            </tr>
                        </table>
                        
                        <div class="body">
                            <h3>口コミ</h3>
                            <textarea name="post[body]">{{ $post->body ?? "" }}</textarea>
                            <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                        </div>
                        <p>＊治療までのスムーズさを比較するための項目です。</p>
                        <p>　例えば診察は、初診で連絡してからだいたい何日後に予約が取れたか（当日受付なら０日）</p>
                        <p>　入院・手術は入院又は入院・手術の予定が、その方針が決まってからだいたい何日後入ったか</p>
                        <input type="submit" value="更新する"/>
                    </form>
                </div>
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $post->id }})">口コミを削除する</button>
                </form>
            </div>
            <script>
                function deletePost(id) {
                    'use strict'
                    
                    if(confirm('削除すると復元できません。\n本当に削除しますか？'))　{
                        document.getElementById(`form_${id}`).submit();
                    }
                }
            </script>
        </body>
    </x-app-layout>
</html>
