$(document).ready(function() {
    $('#submit-review').click(function(e) {
        e.preventDefault();

        var formData = {
            _token: $('input[name=_token]').val(),
            name: $('#review-name').val(),
            email: $('#review-email').val(),
            subject: $('#review-subject').val(),
            rating: $('#review-rating').val(),
            message: $('#review-message').val(),
        };

        $.ajax({
            url: '{{ route("products.reviews.store", ["product" => $product->id]) }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                console.log(response);  // Debugging: Check the success response
                alert(response.success);
                $('#exampleModal').modal('hide');
                $('#review-form')[0].reset();
                $('#review-errors').hide();
            },
            error: function(response) {
                console.log(response);  // Debugging: Check the error response
                var errors = response.responseJSON.errors;
                var errorList = $('#review-errors ul');
                errorList.empty();
                $.each(errors, function(key, value) {
                    errorList.append('<li>' + value + '</li>');
                });
                $('#review-errors').show();
            }
        });
    });
});
