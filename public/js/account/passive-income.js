$(document).ready(function () {

    buyPassiveIncome();

    collapseSection();

});

function buyPassiveIncome() {
    $('.buy-passive-income').click(function () {
        var countBlock = $(this).closest('.passive_income_block').find('.passive_income_count');
        $('button').prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: '/buy-passive-income',
            data: {id: $(this).data('id')},
            dataType: 'json',
            success: function (result) {
                $('button').prop('disabled', false);
                $('#buyModal').html('');
                $('#buyModal').append(result.body);
                $('#buyModal').modal('show');
                if (result.status) {
                    $(countBlock).text(parseInt($(countBlock).text()) + 1);
                }
                $('.user-balance').text(result.data.balance);
            }
        });
    });
}

// function to collapse open and closed box section
function collapseSection() {
    $(".passive-income-history-title").on('click', function(){
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