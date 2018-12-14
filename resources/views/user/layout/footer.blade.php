<footer class="footer t-burger dark-template-bg">
    <div class="container">
        <div class="row">
            <div class="subscribe-box col-sm-12 text-center">
                <h2 class="mb5 text-capitalize wow fadeInUp" data-wow-delay=".2s" data-wow-duration=".2s">Подпишись чтобы получить новости о новых обновлениях</h2>
                <form action="{{ url('/subscribe') }}" id="subscribe_now" class="subscribe-form wow fadeInUp" data-wow-delay=".7s" data-wow-duration=".7s" method="post">
                    {{ csrf_field() }}
                    <div id="mail-messages" class="notification subscribe"></div>
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="email" autocomplete="off" id="subscribe_email" class="subscribe-input" placeholder="Введите ваш электронный адрес" required>
                    <button type="submit" class="btn-alpha subscribe-btn" >Подписаться</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="text-center col-sm-12 mb1 wow fadeInUp" data-wow-delay=".8s" data-wow-duration=".5s">
                <p class="copyright">Copyright &copy; 2018</p>
            </div>
        </div>
    </div>
</footer>