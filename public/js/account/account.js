$(document).ready(function () {

    collapseSection();

    buyBox();

    openBox();

});

// function to collapse open and closed box section
function collapseSection() {
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
}

// function to buy a new box
function buyBox() {
    $('.buy-box').click(function () {
        $('button').prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: '/buy-new-box',
            data: {id: $(this).data('box-id')},
            dataType: 'json',
            success: function (result) {
                $('button').prop('disabled', false);
                $('#buyModal').html('');
                $('#buyModal').append(result.body);
                $('#buyModal').modal('show');
                $('.user-balance').text(result.data.balance);
                if ($('#closedBoxes').find('.services-list div').length == 0) {
                    $('#closedBoxes').find('h3').text('');
                    $('#closedBoxes').find('.services-list').append(result.data.box)
                }
            }
        });
    });
}

// function to open box
function openBox(){
    $(document).on('click', '.open-box', function () {
        $('button').prop('disabled', true);
        var boxId = $(this).data('box-id');
        $.ajax({
            type: 'POST',
            url: openBoxUrl,
            data: {id: boxId},
            dataType: 'json',
            success: function (result) {
                $('button').prop('disabled', false);
                $('#openModal').html('');
                $('#openModal').append(result.body);
                $('#openModal').modal('show');
                var cloned = $('.box-number-'+boxId).remove().clone();
                cloned.find('.open-box').remove();
                cloned.append('<span>Ваш Выигрыш '+result.data.price+',00 Рублей</span>');
                cloned.appendTo('.open-service-list');
                $('.user-balance').text(result.data.balance);
                if ($('#closedBoxes').find('.services-list div').length == 0) {
                    $('#closedBoxes').collapse();
                }
            }
        })
    })
}