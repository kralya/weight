 function hideBoxes() {
        $('.box').show();
        $('.active').remove();
    }

    $('.box').click(function () {
        hideBoxes();

        var text = $(this).text();
        $(this).before('<div class="active"> <input type="text" id="input_selected" value="' + $.trim(text) + '"/> <input type="submit" class="input_submit" value="Save"/></div>');
        $(this).hide();

        $('#input_selected').click(function () {
            return false;
        });

        $('.input_submit').click(function () {
            var email = $('#email').val();
            var weight = $('#input_selected').val();
            var boxId = $('.box:hidden').attr('id');
            var date = boxId.replace('box-','');

            $.post('save.php', {email: email, weight: weight, date: date, sid:Math.random()}, function (response) {

                if(response.search('wrong') != -1){
                    return false;
                }

                $('#'+boxId).text(response);
            });

        });

        return false;
    });

    $('body').click(function () {
        hideBoxes();
    });