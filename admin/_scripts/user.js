$(document).ready(function(){
    // signup page scripts
    $("#delete").on("click", function(){
        alert("Are you sure you want to delete this User?");
        document.user_actions.submit();
    });
    $("#update").on("click", function(){
        document.user_actions.submit();
    });
    // 
});
