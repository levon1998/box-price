$(document).ready(function () {
    buyBox();
});

// function to buy a new box
function buyBox() {
    $('.buy-box').click(function () {
        $.ajax({
            type: 'POST',
            url: buyUrl,
            data: {id: $(this).data('box-id')},
            dataType: 'json',
            success: function (result) {
                $('#buyModal').html('');
                $('#buyModal').append(result.body);
                $('#buyModal').modal('show');
                $('.user-balance').text(result.data.balance);
            }
        });
    });
}