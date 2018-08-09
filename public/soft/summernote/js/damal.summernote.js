$(document).ready(function () {
    $('.note-group-select-from-files').remove();
    var who = 0;
    $(document).on('click','button',function () {
        if ($(this).attr('data-original-title') == "Picture") {
            who = 1;
            $("#mediaModal").modal("show");
        }
    });

    /*$(document).on('click','.usethis',function () {
        var myval = $(this).attr('filename');
        var img = url+'damal/uploads/'+myval;
        if (who == 1){
            $('.note-image-url').val(img);
            $('.note-image-btn').removeClass('disabled');
            $('.note-image-btn').removeAttr('disabled');
            $('#mediaModal').modal('toggle');
            //$(".note-image-btn").trigger("click");
        }
    });*/
});