$(document).ready(function(){
    // upload page scripts
    $("#file1").on("change", function() {
        $("#progress-group").show();
        var fd = new FormData();
        fd.append("file", $("input[type=file]").get(0).files[0]);
        // document.upload_file.submit();

        $.ajax({
            url: '.',
            type: 'POST',
            processData: false,
            data: fd,
            xhr: function() {
                var xhr = $.ajaxSettings.xhr();
                xhr.upload.addEventListener("progress", function(ev) {
                    // if(ev.total <= 10000000){
                        $('#big-size-error').hide();
                        $('#lb-processed').html(ev.loaded/1000 | 0);
                        $("#lb-total").html(ev.total/1000 | 0);
                        $('#lb-percent').html((ev.loaded/(ev.total/100)) | 0);
                        $('#prog').val((ev.loaded/(ev.total/100)) | 0);
                        if(ev.loaded/(ev.total/100) >= 100)
                            $('#btn_upload').prop("disabled", false);
                    // }
                    // else $('#big-size-error').show();
                }, false);
                return xhr;
            }
        });
    });
});
