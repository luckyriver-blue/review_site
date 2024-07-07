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
    </head>
    <x-app-layout>
        <x-slot name="header">
            口コミを書く
        </x-slot>
        <body class="antialiased">
            <div>
                <p>都道府県</p>
                <p>フリーワード</p>
                <p>この条件で絞り込む</p>
            </div>
            <hr>
            <div>
                <div class="hospitals">
                    @foreach ($hospitals as $hospital)
                        <div class="hospital">
                            <h2 class="name">
                                <a href="/posts/hospital/create/{{ $hospital->id }}">{{ $hospital->name }} {{ $hospital->place }}</a>
                            </h2>
                        </div>
                    @endforeach
                    <div class="paginate">
                        {{ $hospitals->links() }}
                    </div>
                </div>
                <hr>
                <div class="add_hospital">
                    <form action="/posts/hospital/create" method="POST">
                        @csrf
                        <table>
                            <tr class='name'>
                                <th>病院名</th>
                                <td>
                                    <input type="text" name="hospital[name]">
                                </td>
                            </tr>
                            <tr class="place">
                                <th>場所</th>
                                <td>
                                    <input type="text" name="hospital[place]">
                                </td>
                            </tr>
                        </table>
                        <input type="submit" value="病院を追加する"/>
                    </form>
                </div>
            </div>
        </body>
    </x-app-layout>
</html>
