<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>口コミ作成の病院選択</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <link rel="stylesheet" href="{{ asset('css/hospital_select_create.css') }}">
    </head>
    <x-app-layout>
        <x-slot name="header">
            口コミを書く
        </x-slot>
        <body class="antialiased">
            <div class="color">
                <div class="hospitals">
                    <h2 class="select-hospital">病院を選択する</h2>
                    <br>
                    
                    <table>
                        @foreach ($hospitals as $hospital)
                        <tr class="hospital" align="left">
                            <th class="name">
                                <a href="/posts/hospital/create/{{ $hospital->id }}">{{ $hospital->name }}</a>
                            </th>
                            <td class="place">　{{ $hospital->place }}</td>
                        </tr>
                        @endforeach
                    </table>
                    
                    <div class="paginate">
                        <ul class="pagination">{{ $hospitals->links() }}</ul>
                    </div>
                </div>
                <hr>
                <div class="add_hospital">
                    <h2 class="add-hospital">病院を追加する</h2>
                    <br>
                    <form action="/posts/hospital/create" method="POST">
                        @csrf
                        <table>
                            <tr>
                                <th>病院名</th>
                                <td>
                                    <input type="text" name="hospital[name]" value="{{ old('hospital.name') }}" placeholder="例) 日本総合病院">
                                    <p class="name__error" style="color:red">{{ $errors->first('hospital.name') }}</p>
                                </td>
                            </tr>
                            <tr class="place">
                                <th>都道府県</th>
                                <td>
                                    <input type="text" name="hospital[place]" value="{{ old('hospital.place') }}" placeholder="例) 東京都">
                                    <p class="place__error" style="color:red">{{ $errors->first('hospital.place') }}</p>
                                </td>
                            </tr>
                        </table>
                        <input type="submit" value="病院を追加する" class="add"/>
                    </form>
                </div>
            </div>
        </body>
    </x-app-layout>
</html>
