(function ($) {
    $.fn.damaltable = function (opt) {
        var settings = $.extend({
            goto        :   null,
            output      :   'output',
            pagination  :   null

        },opt);
        $(this).on('keyup',function () {
            var srctext = $(this).val();
            var goto = settings.goto;
            if (srctext != '') {
                $.ajax({
                    type: "POST",
                    data: {srctext: srctext, '_token': token},
                    url: goto,
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        //$('#'+output).text(data);
                        //setTimeout(function(){ $('#msg').text('') }, 3000);
                    }
                });
            }
        });
    }
}(jQuery));