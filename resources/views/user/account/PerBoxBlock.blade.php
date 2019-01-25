<div class="service-box box-number-{{$boxUser->id}}">
    <img src="{{ asset($box->image_source) }}" class="box-image-size img-responsive" alt="image_source">
    <span>{{$box->name}}</span>
    <span>{{ $box->description }}</span>
    <button class="btn-alpha mt2 open-box redirect-btn" data-box-id="{{$boxUser->id}}">Открыть</button>
</div>