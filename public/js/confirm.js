$(document).ready(function () {
    setTimeout(function () {
        $('#confirmLoading').hide();
        $('.confirmedText').text("ваш аккаунт подтвержден");
        $('.loginBtn').show();
    }, 3000);
});