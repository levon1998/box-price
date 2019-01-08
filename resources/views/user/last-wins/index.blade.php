@extends('user.layout.app')

@section('title')
    Box Price - Последние Выигрыши
@endsection

@section('content')
    <section>
        <div class="banner burger  align-item-center parallax" style="background-position-y: 0px;">
            <div class="container">
                <div class="row  text-center">
                    <h3>Последние Выигрыши</h3><br /><br />
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Ящик</th>
                                <th class="text-center">Имя Пользователя</th>
                                <th class="text-center">Сумма</th>
                                <th class="text-center">Дата Покупки</th>
                                <th class="text-center">Дата Открытия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($lastWins) && count($lastWins) > 0)
                                @foreach ($lastWins as $win)
                                    <tr>
                                        <td>{{ $win->name }}</td>
                                        <td>{{ $win->username }}</td>
                                        <td>{{ $win->price }}</td>
                                        <td>{{ $win->created_at }}</td>
                                        <td>{{ $win->opened_date }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5"><p>У вас пока нет выгрышов.</p></td>
                                </tr>
                            @endif
                        </tbody>
                    </table><br /><br />
                </div>
            </div>
        </div>
    </section>
@endsection