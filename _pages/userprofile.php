<form>
    <img class="img-profile" src="<?php echo $user_pic ?>"></br>
    Firstname: <label><?php echo $user->firstname() ?></label></br>
    Middlename:<label><?php echo $user->middlename() ?></label></br>
    Lastname:<label><?php echo $user->lastname() ?></label></br>
    User handle:<label><?php echo '@'.$user->username() ?></label></br>
    Projects:<label><?php echo '['.$user->projects().']'?></label></br>
</form>