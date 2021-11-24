$('.ajax_form').submit(function (e) {
    var form = $(this);
    var submit = form.find(".btn:submit");
    var text = submit.html();
    submit.prop('disabled', true);
    submit.html('<i class="fas fa-spinner fa-spin"></i> Wait...');
    $.ajax({
        dataType: "json",
        url: form.attr('action'),
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false
    }).done(function (data) {
        if (data.status === 'redirect' && data.showmessage === 'no') {
            window.location.replace(data.url);
        } else if (data.redirect === 'yes' && data.showmessage === 'yes') {
            $('#modalAjaxFormContent').html('<div class="alert alert-' + data.status + '" role="alert">' + data.message + '</div>');
            $('#modalAjaxForm').modal('show');

            $(document).on('hide.bs.modal', '#modalAjaxForm', function () {
                window.location.replace(data.url);
            });
        } else {
            $('#modalAjaxFormContent').html('<div class="alert alert-' + data.status + '" role="alert">' + data.message + '</div>');
            $('#modalAjaxForm').modal('show');
        }
    }).fail(function () {
        $('#modalAjaxFormContent').html('<div class="alert alert-danger" role="alert">An error occurred while uploading, please try again later.</div>');
        $('#modalAjaxForm').modal('show');
    }).always(function (data) {
        submit.html(text);
        submit.prop('disabled', false);
        if (data.reset === 'yes') {
            form.trigger("reset");
        }
    });

    return false;
});
