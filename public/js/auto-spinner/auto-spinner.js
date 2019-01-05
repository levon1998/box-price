$(document).ready(function () {
    buySpinner();
});

// function to buy a new spinner
function buySpinner() {
    $(document).on('click', '.buy-spinner', function () {
        var spinnerId = $(this).data('spinner-id');
        var nextSpinnerId = $(this).data('spinner-id')+1;
        $.ajax({
            type: 'POST',
            url: buyUrl,
            data: {id: $(this).data('spinner-id')},
            dataType: 'json',
            success: function (result) {
                $('#buyModal').html('');
                $('#buyModal').append(result.body);
                $('#buyModal').modal('show');

                if (result.status == 'OK') {
                    $('.spinner'+spinnerId).find('.buy-spinner').remove();
                    $('.spinner'+spinnerId).append("<button class='btn-alpha mt2 redirect-btn'>Куплено</button>");
                    $('.spinner'+nextSpinnerId).append(result.data.nextButton);
                    $('.user-balance').text(result.data.balance);
                }
            }
        });
    });
}