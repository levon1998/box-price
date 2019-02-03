<div class="col-lg-12 col-sm-12 ">
    <h3 class="template-color">Мои Источники</h3><hr/><br/>

    @if (!empty($passiveIncome))
        @foreach ($passiveIncome as $key => $item)
            <hr/>
            <h3 class="text-left passive-income-history-title" data-toggle="collapse" data-target="#passiveIncome{{$item->id}}">{{ $item->title }} <i class="fa fa-chevron-{{ $item->id == 1 ? 'down' : 'left' }}" aria-hidden="true"></i></h3>
            <div id="passiveIncome{{$item->id}}" class="collapse {{$item->id == 1 ? 'in' : ''}}">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">срок</th>
                            <th class="text-center">Прошло</th>
                            <th class="text-center">Осталось</th>
                            <th class="text-center">Цена</th>
                            <th class="text-center">Прибыль</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (count($item->incomes()) > 0)
                        @foreach ($item->incomes() as $income)
                            <tr>
                                <td>{{ $income['duration'] }} дней </td>
                                <td>{{ $income['passed'] }} дней </td>
                                <td>{{ $income['left'] }} дней</td>
                                <td>{{ $income['price'] }} рублей</td>
                                <td>{{ $income['total_paid'] }} рублей</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5"><p>У вас пока нет источников.</p></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
</div>