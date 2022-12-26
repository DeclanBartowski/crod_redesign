$(document).on('click', '[data-show-more-wrap]', function () {
    var btn = $(this);
    var page = btn.attr('data-next-page');
    var id = btn.attr('data-show-more-wrap');
    var bx_ajax_id = btn.attr('data-ajax-id');

    var data = {
        bxajaxid: bx_ajax_id
    };
    data['PAGEN_' + id] = page;

    $.ajax({
        type: "GET",
        url: window.location.href,
        data: data,
        timeout: 3000,
        success: function (data) {
            $('#ajaxHtml').html(data);
            $("#btn_" + bx_ajax_id).remove();
            $('.ajax_append_content').append($('#ajaxHtml').find('.ajax_append_content').html());
            $('.cstm_pagen_ajax').after($('#ajaxHtml').find('.page-actions-box'));
        }
    });
});


$(document).on('click', '[data-show-more]', function () {
    var btn = $(this);
    var page = btn.attr('data-next-page');
    var id = btn.attr('data-show-more');
    var bx_ajax_id = btn.attr('data-ajax-id');

    var data = {
        bxajaxid: bx_ajax_id
    };
    data['PAGEN_' + id] = page;

    $.ajax({
        type: "GET",
        url: window.location.href,
        data: data,
        timeout: 3000,
        success: function (data) {
            $("#btn_" + bx_ajax_id).remove();
            $('.ajax_append_content').append($(data).find('.ajax_append_content').html());
            $('.ajax_append_content').after($(data).find('.page-actions-box'));
        }
    });
});

$(document).ready(function () {

    var text = document.getElementById("linkPage");

    /* сохраняем кнопку в переменную btn */
    var btn = document.getElementById("copyLink");

    /* вызываем функцию при нажатии на кнопку */
    btn.onclick = function () {
        console.log(text);
        text.select();
        document.execCommand("copy");
    }
});


$(document).on('click', '.js-field-file .js-file-button', function () {
    $(this).parent().find('input').click();
    return false;
})

$(document).on('change', '.js-field-file input[type=file]', function () {
    let fileName = ('' + $(this).val());
    if (fileName.length > 30) {
        fileName = fileName.substring(0, 15) + '...';
    }
    if (fileName == "") {
        fileName = $(this).parent().find('.js-file-button').find('.button-title').attr('data-title');
        $(this).parent().removeClass('active').find('.js-file-button').find('.button-title').html('');
    } else {
        $(this).parent().addClass('active').find('.js-file-button').find('.button-title').html(fileName);
    }
})


$(document).ready(function () {

    $('.form-select').select2({
        placeholder: $(this).attr('data-placeholder'),
        allowClear: true
    });
})

$(document).on('click', '[data-add-row]', function () {
    $('.cstmaddRow').append($('#copy').html());
});

$(document).on('click', '[data-remove-row]', function () {
    $(this).parents('.cstmrow').remove();
});


$(document).on('click', '[data-upload]', function () {
    $('#submitForm').submit();
})

function openModal(popupCurrent) {
    $('.popup-outer-box').removeClass('active');
    $('body').addClass('popup-open');
    $('.popup-outer-box[id="' + popupCurrent + '"]').addClass('active');
    return false;
}


$(document).on('submit', '#submitForm', function () {

    let component = $(this).data('component');
    let action = $(this).data('action');
    let redirect = $(this).data('redirect');
    let formData = new FormData(this);
    BX.ajax.runComponentAction(component,
        action, {
            mode: 'class',
            data: formData,
        })
        .then(function (response) {
                openModal('popup-message01');
                $('.cstmaddRow').html('');
                $('[data-add-row]').click();
            }, function (response) {
                $('[data-error-text]').html(response.errors[0].message);
                openModal('popup-error');
            }
        );


    return false;
})

$(document).on('click', '.js-popup-close', function () {
    $('body').removeClass('popup-open');
    $('.popup-outer-box').removeClass('active');
    return false;
})

$(document).on('change', '[data-reload]', function (){

    $(this).parents('form').submit();
})

