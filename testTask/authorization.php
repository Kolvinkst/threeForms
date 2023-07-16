<?php
$loginOrTel = $_POST['logOrTel'];
$parolj = $_POST['passw'];
$mobitel = $_POST['phone'];
if (isset($_POST['formSubmit'])) {
$mysqli = new mysqli("localhost", "root", "", "testTask");
if(empty($loginOrTel) || empty($parolj)) {
	echo "Заполните все поля!";
}
else {
$query="SELECT * FROM users WHERE (login='$loginOrTel' OR telephone='$loginOrTel') AND BINARY password='$parolj'"; //Запрос на наличие записи с логином и паролем
$result=$mysqli->query($query);
if (mysqli_num_rows($result)) {
header("location: user_account.html"); //Переход в случае ввода верных логина и пароля
}
else {
header("Location: index.html"); // Перенаправление на главную
}
$mysqli->close();
}
}
?>