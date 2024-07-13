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
        <link rel="stylesheet" href="{{ asset('css/top.css') }}">
    </head>
    <x-app-layout>
        <x-slot name="header">
            トップ
        </x-slot>
        <body class="antialiased">
            <div class="color">
                <div class='search'>
                    <form action="/hospitals" method="GET">
                        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="病院名、場所、診療科で病院を検索" class="search-box">
                        <input type="submit" value ="検索" class="search-botton">
                    </form>
                </div>
                <hr>
                <div class="star_hospitals">
                    <h1 class="ranking-title">評価が高い病院ランキング</h1>
                    @foreach ($hospitals as $key => $hospital)
                        <div class="@if ($key === 0) gold @elseif ($key === 1) silver @elseif ($key === 2) bronze @endif">
                            <a href="/hospitals/{{ $hospital->id }}" >
                            <h2 class="hospital">{{ $hospital->name }}</h2>
                            <p>
                            ★
                            @if (isset($hospital->average_stars))
                                {{ number_format($hospital->average_stars, 2) }}
                            @endif
                            </p>
                            <br>
                            <p class="number">{{ $key + 1 }}位</p>
                            </a>
                        </div>
                    @endforeach
                    <a href="/hospitals" style="font-size: 30px;">・・・</a>
                </div>
            </div>
        </body>
    </x-app-layout>
</html>
