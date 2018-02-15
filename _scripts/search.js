// COMPLETED: (Javascript - jQuery) auto-enable all sub-checkboxes when either 'All users' or 'All project' options is selected and disable parent when a child option is disabled -->
// COMPLETED: (Javascript - jQuery) function should check/uncheck all elements when all is checked/unchecked$(document).ready(function(){
function beforeUSubmit(element){
    var name = element.name;
    switch (name) {
        case 'uall':
            if(element.checked){
                $('#ostu').prop('checked', true);
                $('#olec').prop('checked', true);
            }else{
                $('#ostu').prop('checked', false);
                $('#olec').prop('checked', false);
            }
            break;
        default:
            var allChecked =    $("#olec").prop('checked') &&
                                $("#ostu").prop('checked');
            if(allChecked) $('#uall').prop('checked', true);
            else $('#uall').prop('checked', false);
            break;
    }
    document.search_form.submit();
}
function beforeWSubmit(element){
    var name = element.name;
    switch (name) {
        case 'pall':
            if(element.checked){
                $('#osrp').prop('checked', true);
                $('#oprj').prop('checked', true);
                $('#ores').prop('checked', true);
                $('#oid').prop('checked', true);
            }else{
                $('#osrp').prop('checked', false);
                $('#oprj').prop('checked', false);
                $('#ores').prop('checked', false);
                $('#oid').prop('checked', false);
            }
            break;
        default:
            var allChecked =    $("#osrp").prop('checked') &&
                                $("#oprj").prop('checked') &&
                                $("#ores").prop('checked') &&
                                $("#oid").prop('checked');
            if(allChecked) $('#pall').prop('checked', true);
            else $('#pall').prop('checked', false);
            break;
    }
    document.search_form.submit();
}