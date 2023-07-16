<?php
$newName = $_POST['newName'];
$newMobitel = $_POST['newMobitel'];
$newPoshta = $_POST['newPoshta'];
$stari_parolj = $_POST['oldPassw'];
$novi_parolj = $_POST['newPassw'];
$repNewPassw = $_POST['repNewPassw'];
if (isset($_POST['formSubmit'])) {
$mysqli = new mysqli("localhost", "root", "", "testTask");
if(empty($newName) || empty($newMobitel) || empty($newPoshta) || empty($stari_parolj) || empty($novi_parolj) || empty($repNewPassw)) {
	echo "Заполните все поля!";
}
else {
$query="UPDATE users SET name='$newName', telephone='$newMobitel', email='$newPoshta', password='$novi_parolj' WHERE password='$stari_parolj'";
$mysqli->query($query);
$mysqli->close();
echo "Данные успешно изменены на новые!";
}
}

?>