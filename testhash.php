<?php


$t = time().rand(0,9);
echo $t.'<br/>';
echo md5($t).'<br/>';
echo sha1($t).'<br/>';
echo uniqid().'<br/>';
echo strrev(uniqid()).'<br/>';
echo crypt(uniqid(),'1').'<br/>';
include_once 'idea_abstraction.class.php';
for($i=0;$i<10;$i++){
	echo md5($i).'mmm<br/>';
}
?>