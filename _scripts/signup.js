$(document).ready(function(){
    // signup page scripts
    $("#firstpasswd").keyup(function(){
        var value = $(this).val();
        if(value) $('#reenterpasswd').prop('disabled', false);
        else $('#reenterpasswd').prop('disabled', true);
    });
    $("#reenterpasswd").keyup(function(){
        var same_value = $(this).val() == $("#firstpasswd").val();
        if(same_value) $('#submit_signup').prop('disabled', false);
        else $('#submit_signup').prop('disabled', true);
    });
    // 
});
