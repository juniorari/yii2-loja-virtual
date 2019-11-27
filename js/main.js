$('.shopping').on('click', function (event) {
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        type: 'GET',
        dataType: "json",
        success: function (result) {
            if (result.count > 0) {
                $('#carrinho').removeClass('text-danger').addClass('' + result.color);
                $('#carrinho-total').text('  ' + result.count);
            }
        }
    });
});