<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title text-center">{{ $header }}</h4>
        </div>
        <div class="modal-body text-center" style="background: #363636;">
            <img src="{{ $image }}" width="195px" height="195px" />
            <p>{{ $content }}</p>
        </div>
        <div class="modal-footer text-center">
            @if ($status == 'OK')
                <a class="btn btn-white" href="{{ url('/my-boxes') }}">Мои ящики</a>
                <button type="button" class="btn btn-alpha text-center" data-dismiss="modal">Купить еще</button>
            @elseif ($status == 'BALANCE')
                <a class="btn btn-white" href="{{ url('/up-balance') }}">Пополнить балансе</a>
            @elseif ($status == 'OPEN_STATE')
                <button type="button" class="btn btn-alpha text-center" data-dismiss="modal">Закрыть</button>
            @else
                <button type="button" class="btn btn-alpha text-center" data-dismiss="modal">Купить еще</button>
            @endif
        </div>
    </div>
</div>