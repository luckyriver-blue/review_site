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
        <link rel="stylesheet" href="{{ asset('css/hospitals.css') }}">
    </head>
    <x-app-layout>
        <x-slot name="header">
            検索
        </x-slot>
        <body class="antialiased">
            <div class="color">
                <div class='search'>
                    <form action="/hospitals" method="GET">
                        <div class="place">
                            <p>都道府県</p>
                            <input type="text" name="search_place" value="{{ $searchPlace }}">
                        </div>
                        <div class="hospital_department">
                            <p>診療科</p>
                            <select class="block mt-1" name="search_hospital_department">
                                <option value="">-未選択-</option>
                                @foreach ($hospital_departments as $hospital_department)
                                    <option value="{{ $hospital_department->id }}" {{ $searchHospital_Department == $hospital_department->id ? "selected" : "" }}>{{ $hospital_department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>フリーワード</p>
                        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="病院名、場所、診療科で検索" class="search-box">
                        <input type="submit" value ="この条件で検索" class="search-button">
                        <div class="sort" align="right">
                            <select class="sort-button" name="sort_hospitals">
                                <option value="star" {{ $sortHospitals == "star" ? "selected" : "" }}>高評価順</option>
                                <option value="smooth" {{ $sortHospitals == "smooth" ? "selected" : "" }}>スムーズ順</option>
                            </select>
                        </div> 
                    </form>
                </div>
                <hr>
                <div class="result-hospitals">
                    <div class='hospitals'>
                        @if ($hospitals->isEmpty())
                            <p>該当する病院がありませんでした。</p>
                        @endif
                        @foreach ($hospitals as $hospital)
                            <div class='hospital'>
                                <h2 class='name'>
                                    <a href="/hospitals/{{ $hospital->id }}">{{ $hospital->name }} ({{ $hospital->place }})</a>
                                </h2>
                                <h3>★
                                    @if (isset($hospital->average_stars))
                                        {{ number_format($hospital->average_stars, 2) }}
                                    @endif
                                </h3>
                                <p>
                                    @if(!is_null($hospital->departments))
                                        @foreach ($hospital->departments as $department)
                                            {{ $department->name }}@if (!$loop->last), @endif
                                        @endforeach
                                    @endif
                                </p>
                                @if(isset($hospital->average_smooth_examination) || isset($hospital->average_smooth_hospitalization))
                                    <h3 class="smooth">治療までのスムーズさ　</h3>
                                @endif
                                @if(isset($hospital->average_smooth_examination))
                                    <h3 class="smooth-examination">診察まで{{ number_format($hospital->average_smooth_examination, 2) }}日 </h3>
                                @endif
                                @if(isset($hospital->average_smooth_hospitalization))
                                    <h3 class="smooth-hospitalization">入院・手術まで{{ number_format($hospital->average_smooth_hospitalization, 2) }}日</h3>
                                @endif
                                @if(isset($bodyPart[$hospital->id]))
                                    <p class="body-part">{{ $bodyPart[$hospital->id] }}</p>
                                @endif
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div class='paginate'>
                        <ul class="pagination">{{ $hospitals->appends(request()->query())->links() }}</ul>
                    </div>
                </div>
            </div>
        </body>
    </x-app-layout>
</html>
