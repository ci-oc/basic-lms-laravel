function active_percentage() {
    var value = document.querySelector('[name="activate_plagiarism"]:checked')
    if (value)
        $("#Percentage").show();
    else
        $("#Percentage").hide();

}

var rangeSlider = function () {
    var slider = $('.range-slider'),
        range = $('.range-slider__range'),
        value = $('.range-slider__value');

    slider.each(function () {

        value.each(function () {
            var value = $(this).prev().attr('value');
            $(this).html(value);
        });

        range.on('input', function () {
            $(this).next(value).html(this.value);
        });
    });
};

rangeSlider();

$('.timepicker').datetimepicker({

    format: 'HH:mm:ss'

});

var dateToday = new Date();
$(function () {
    $('#datetimepicker3').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        minDate: dateToday
    });
});
$(function () {
    $('#datetimepicker4').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        minDate: dateToday
    });
});