<div class="about-cryptency burger dark-template-bg" id="news">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-8 col-lg-offset-2  text-center">
                <h2 class="wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">Новости </h2><br /><br /><br />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <h2 class="wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">{{ $lastNews->title }}</h2>
                <div class="video mt6 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                    <div class="vide-frame" style="background-image: url('{{asset($lastNews->image)}}');"></div>
                </div>
            </div>

            {!! $lastNews->text !!}

        </div>
    </div>
</div>