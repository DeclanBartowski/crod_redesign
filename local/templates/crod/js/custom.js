$(document).on('click', '[data-show-more-wrap]', function(){
    var btn = $(this);
    var page = btn.attr('data-next-page');
    var id = btn.attr('data-show-more-wrap');
    var bx_ajax_id = btn.attr('data-ajax-id');

    var data = {
        bxajaxid:bx_ajax_id
    };
    data['PAGEN_'+id] = page;

    $.ajax({
        type: "GET",
        url: window.location.href,
        data: data,
        timeout: 3000,
        success: function(data) {
            $('#ajaxHtml').html(data);
            $("#btn_"+bx_ajax_id).remove();
            $('.ajax_append_content').append($('#ajaxHtml').find('.ajax_append_content').html());
            $('.cstm_pagen_ajax').after($('#ajaxHtml').find('.page-actions-box'));
        }
    });
});


$(document).on('click', '[data-show-more]', function(){
    var btn = $(this);
    var page = btn.attr('data-next-page');
    var id = btn.attr('data-show-more');
    var bx_ajax_id = btn.attr('data-ajax-id');

    var data = {
        bxajaxid:bx_ajax_id
    };
    data['PAGEN_'+id] = page;

    $.ajax({
        type: "GET",
        url: window.location.href,
        data: data,
        timeout: 3000,
        success: function(data) {
            $("#btn_"+bx_ajax_id).remove();
            $('.ajax_append_content').append($(data).find('.ajax_append_content').html());
            $('.ajax_append_content').after($(data).find('.page-actions-box'));
        }
    });
});
