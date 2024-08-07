<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>口コミを書く</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <link rel="stylesheet" href="{{ asset('css/create.css') }}">
        <link rel="stylesheet" href="{{ asset('css/star.css') }}">
        
       
        
        
    </head>
    <x-app-layout>
        <x-slot name="header">
            口コミを書く
        </x-slot>
        <body class="antialiased">
            <div class="color">
                <h2 align=center class="title">口コミ✎</h2>
                <form action="/posts" method="POST">
                    @csrf
                    <div class="enter_review">
                        <h2 class="hospital">{{ $hospital->name }}</h2>
                        <table>
                            <tr class="myself">
                                <th>口コミを投稿するのは</th>
                                <td class="container">
                                    <select class="block mt-1" name="post[myself]">
                                        <option align=center value="">-未選択-</option>
                                        <option value="1">本人</option>
                                        <option value="2">本人でない</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="hospital_department">
                                <th>診療科</th>
                                <td class="container">
                                    <select class="block mt-1" name="post[hospital_department_id]">
                                        <option value="">-未選択-</option>
                                        @foreach ($hospital_departments as $hospital_department)
                                            <option value="{{ $hospital_department->id }}">{{ $hospital_department->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class="disease">
                                <th>病名</th>
                                <td>
                                    <input type="text" name="post[disease]" placeholder="インフルエンザ" value="{{ old('post.disease') }}"/>
                                    <p class="disease__error" style="color:red">{{ $errors->first('post.disease') }}</p>
                                </td>
                            </tr>
                            <tr class="smooth">
                                <th>治療までのスムーズさ＊</th>
                                <td>診察まで
                                <input type="number" name="post[smooth_examination]"/>
                                日　
                                入院・手術まで
                                <input type="number" name="post[smooth_hospitalization]"/>
                                日</td>
                            </tr>
                            <tr class="star">
                                <th>評価（必須）</th>
                                <td>
                                    <div class="rate-form">
                                        <input id="star5" type="radio" name="post[star]" value="5"><label for="star5">★</label>
                                        <input id="star4" type="radio" name="post[star]" value="4"><label for="star4">★</label>
                                        <input id="star3" type="radio" name="post[star]" value="3"><label for="star3">★</label>
                                        <input id="star2" type="radio" name="post[star]" value="2"><label for="star2">★</label>
                                        <input id="star1" type="radio" name="post[star]" value="1"><label for="star1">★</label>
                                    </div>
                                    <p class="star__error" style="color:red">{{ $errors->first('post.star') }}</p>
                                </td>
                            </tr>
                        </table>
                        <div class="body">
                            <h3 class="body-name">口コミ</h3>
                            <textarea name="post[body]" placeholder="ホームページ上から予約ができました。診察も丁寧でした。" class="body-box">{{ old('post.body') }}</textarea>
                            <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                        </div>
                        <p class="explanation">＊治療までのスムーズさを比較するための項目です。</p>
                        <p class="explanation">　例えば診察は、初診で連絡してからだいたい何日後に予約が取れたか（当日受付なら０日）</p>
                        <p class="explanation">　入院・手術は入院又は入院・手術の予定が、その方針が決まってからだいたい何日後入ったか</p>
                        <input type="hidden" name="post[hospital_id]" value="{{ $hospital->id }}">
                    </div>
                    <div class="button">
                        <input type="submit" value="口コミを投稿する" class="post-button"/>
                    </div>
                </form>
            </div>
        </body>
    </x-app-layout>
</html>
