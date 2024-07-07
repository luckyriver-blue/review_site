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
    <x-app-layout>
        <x-slot name="header">
            検索
        </x-slot>
        <body class="antialiased">
            <div>
                <div class='search'>
                    <form action="/hospitals" method="GET">
                        <div class="place">
                            <p>地名</p>
                            <input type="text" name="search_place" value="{{ $searchPlace }}">
                        </div>
                        <div class="hospital_department">
                            <p>診療科</p>
                            <select class="block mt-1 w-full" name="search_hospital_department">
                                <option value="">-未選択-</option>
                                @foreach ($hospital_departments as $hospital_department)
                                    <option value="{{ $hospital_department->id }}" {{ $searchHospital_Department == $hospital_department->id ? "selected" : "" }}>{{ $hospital_department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>フリーワード</p>
                        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="病院名、場所、診療科で検索">
                        <input type="submit" value ="この条件で検索">
                        <div class="sort" align="right">
                            <select class="block mt-1 w-full" name="sort_hospitals">
                                <option value="star" {{ $sortHospitals == "star" ? "selected" : "" }}>高評価順</option>
                                <option value="smooth" {{ $sortHospitals == "smooth" ? "selected" : "" }}>スムーズ順</option>
                            </select>
                        </div> 
                    </form>
                </div>
            </div>
            <hr>
            <div>
                <div class='hospitals'>
                    @foreach ($hospitals as $hospital)
                        <div class='hospital'>
                            <h2 class='name'>
                                <a href="/hospitals/{{ $hospital->id }}">{{ $hospital->name }}</a>
                            </h2>
                            <h3>★
                                @if (isset($averageStarsMap[$hospital->id]))
                                    {{ number_format($averageStarsMap[$hospital->id]->average_stars, 2) }}
                                @endif
                            </h3>
                            <h3>{{ $hospital->place }}</h3>
                            @if(!is_null($hospital->departments))
                                @foreach ($hospital->departments as $department)
                                    <h3>{{ $department->name }}</h3>
                                @endforeach
                            @endif
                            @if(isset($averageSmooth_ExaminationMap[$hospital->id]->average_smooth_examination) && isset($averageSmooth_HospitalizationMap[$hospital->id]->average_smooth_hospitalization))
                                <h3>治療までのスムーズさ</h3>
                            @endif
                            @if(isset($averageSmooth_ExaminationMap[$hospital->id]->average_smooth_examination))
                                <h3>診察まで{{ number_format($averageSmooth_ExaminationMap[$hospital->id]->average_smooth_examination, 2) }}日　</h3>
                            @endif
                            @if(isset($averageSmooth_HospitalizationMap[$hospital->id]->average_smooth_hospitalization))
                                <h3>入院・手術まで{{ number_format($averageSmooth_HospitalizationMap[$hospital->id]->average_smooth_hospitalization, 2) }}日</h3>
                            @endif
                            @if(isset($bodyPart[$hospital->id]))
                                <p>{{ $bodyPart[$hospital->id] }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class='paginate'>
                    {{ $hospitals->links() }}
                </div>
            </div>
        </body>
    </x-app-layout>
</html>
