function hideBoxes() {
    $('.forms').hide();
}

function sendWeight() {
    var email = $('#email').val();
    var boxId = $('.forms:visible').attr('id');
    var date = boxId.replace('box-', '').replace('-form', '');
    var input = '#' + boxId.replace('-form', '') + '-input_selected';
    var weight = $(input).val();

    $.post('save.php', {email:email, weight:weight, date:date, sid:Math.random()}, function (response) {

        if (response.search('wrong') != -1) {
            return false;
        }

        var rawBoxId = $('.forms:visible').attr('id');
        var realBoxId = rawBoxId.replace('-form', '').replace('box-', '');
        $('#text-' + realBoxId).text(response);
        $('.forms').hide();
    });
}

$('.tx').keydown(function (elem) {
    if (elem.which == 13) {
        sendWeight();
    }

    if (elem.which == 27) {
        hideBoxes();
    }

});

$('.input_submit').click(function () {
    sendWeight();
});

$('.box').click(function () {
    hideBoxes();

    var text = $(this).text();
    var id = $(this).attr('id');
    $('#' + id + '-form').show();
    var input = '#' + id + '-input_selected';

    $(input).val($.trim(text));
    $(input).focus();

    if ($(input).val() == '...') {
        $(input).select();
    }

    $(input).click(function () {
        return false;
    });

    return false;
});

$('body').click(function () {
    hideBoxes();
});