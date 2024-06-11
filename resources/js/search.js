$(document).ready(function() {
    $('#search-form').submit(function(e) {
        e.preventDefault();

        let key = $('#search-key').val();
        let companies = $('#search-companies').val();
        let price_min = $('#price_min').val();
        let price_max = $('#price_max').val();
        let stock_min = $('#stock_min').val();
        let stock_max = $('#stock_max').val();

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: {
                key: key,
                companies: companies,
                price_min: price_min,
                price_max: price_max,
                stock_min: stock_min,
                stock_max: stock_max,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#search-results').html($(response).find('#search-results').html());
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
});
