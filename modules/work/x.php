<?php
echo '<pre>';
echo var_dump($_POST);
echo '</pre>';

if($_POST['work_j_decision']){
	echo 'YES j<br />';
}

if($_POST['work_p_decision']){
	echo 'YES p<br />';
}

if($_POST['work_s_decision']){
	echo 'YES s<br />';
}

if($_POST['work_b_decision']){
	echo 'YES b<br />';
}

if($_POST['work_c_decision']){
	echo 'YES c<br />';
}

?>