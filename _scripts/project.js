// New project scripts
// AJAX call for autocomplete 
$(document).ready(function(){
    $("#topics").keyup(function(){
        $.ajax({
            type: "POST",
            url: "_scripts/readtopics.php",
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#topics").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data){
                $("#topic_suggestion_box").show();
                $("#topic_suggestion_box").html(data);
                $("#topics").css("background","#FFF");
            }
        });
    });
    $("#coauthors").keyup(function(){
        $.ajax({
            type: "POST",
            url: "_scripts/readusers.php",
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#coauthors").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data){
                $("#user_suggestion_box").show();
                $("#user_suggestion_box").html(data);
                $("#coauthors").css("background","#FFF");
            }
        });
    });
});
//To select username
function selectTopic(val){
    var user = $("#topics").val();
    var n = user.lastIndexOf(';');
    var t = user.substr(0, n);
    if(val=='nouser') t ? $("#topics").val(t + ';') : $("#topics").val('');
    else t ? $("#topics").val(t + ';' +val + ';') : $("#topics").val(val + ';');
    $("#topic_suggestion_box").hide();
    $("#topics").focus();
}
function selectUser(val){
    var user = $("#coauthors").val();
    var n = user.lastIndexOf(';');
    var t = user.substr(0, n);
    if(val=='nouser') t ? $("#coauthors").val(t + ';') : $("#coauthors").val('');
    else t ? $("#coauthors").val(t + ';' +val + ';') : $("#coauthors").val(val + ';');
    $("#user_suggestion_box").hide();
    $("#coauthors").focus();
}