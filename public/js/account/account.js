$(document).ready(function () {
    $(".boxCollapse").on('click', function(){
        var icon = $(this).find('i');
        if (icon.hasClass('fa-chevron-left')) {
            icon.removeClass('fa-chevron-left');
            icon.addClass('fa-chevron-down');
        } else {
            icon.addClass('fa-chevron-left');
            icon.removeClass('fa-chevron-down');
        }
    });

    $('.open-box').on('click', function () {
        var boxId = $(this).data('box-id');
        $.ajax({
            type: 'POST',
            url: openBoxUrl,
            data: {id: boxId},
            dataType: 'json',
            success: function (result) {
                $('#openModal').html('');
                $('#openModal').append(result.body);
                $('#openModal').modal('show');
                var cloned = $('.box-number-'+boxId).remove().clone();
                cloned.find('.open-box').remove();
                cloned.append('<span>Ваш Выигрыш '+result.data.price+',00 Рублей</span>');
                cloned.appendTo('.open-service-list');
                $('.user-balance').text(result.data.balance)
            }
        })
    })
});