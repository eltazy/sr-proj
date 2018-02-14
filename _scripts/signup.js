// Associate page elements
var fst_pwd = document.getElementById('firstpasswd');
var sec_pwd = document.getElementById('reenterpasswd');
var btn_submit = document.getElementById('submit_signup');

sec_pwd.onkeyup = function() {
    if (fst_pwd.value == sec_pwd.value) btn_submit.style.disabled = false;
}
btn_submit.onsubmit = function() {}