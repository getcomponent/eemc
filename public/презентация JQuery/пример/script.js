$(function() {
    //по нажатию на кнопку
    /*$('.fix').on('click', function() {
        //убираем ИКГ
        $('.graphics').hide();
        //исправляем ошибку (выбрав первый предмет)
        $('.main-block p:first').text('ПССИП');
        //после философии добавляем экономику
        $('.main-block').append('<p class="economy">Экономика</p>');
        //выделим экономику другим цветом
        $('.economy').css('background-color', '#78e08f');
        //заблокируем кнопку
        $(this).attr('disabled', true);
    });*/

    /*$('div').on('click', 'button', function() {
        alert('Как сдать экзамен по экономике?!?!?');
    });*/

    var number = 0;
    $('.fix').on('click', function() {
        $('.main-block p').each(function() {
            $(this).prepend(++number + ' ');
        });
        $(this).attr('disabled', true);
    });
});