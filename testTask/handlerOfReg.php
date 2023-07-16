<?php
function translit($s) {
  $s = (string) $s; // преобразуем в строковое значение
  $s = trim($s); // убираем пробелы в начале и конце строки
  $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
  $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
  return $s; // возвращаем результат
}

$name = $_POST['name'];
$mobitel = $_POST['mobitel'];
$mail = $_POST['poshta'];
$passw = $_POST['passw'];
$repPassw = $_POST['repPassw'];
$login = translit($name) . '_' . rand(1, 9999999) . '@' . 'socnet' . '.' .'nk'; //Генерация логина



if (isset($_POST['formSubmit'])) {
  $mysqli = new mysqli("localhost", "root", "", "testTask"); //Подключение к БД
if($mysqli->connect_error){
    die("Ошибка: " . $mysqli->connect_error);
}
$query_mail = "SELECT * FROM users WHERE email ='$mail'"; //Проверка на наличие существующей почты
$result_mail = $mysqli->query($query_mail);
if ($result_mail) {
  if (mysqli_num_rows($result_mail) > 0) {
    die("Ошибка! Аккаунт с такой почтой уже существует!");
  }
}

$query_tel = "SELECT * FROM users WHERE telephone ='$mobitel'"; //Проверка на наличие существующего номера
$result_tel = $mysqli->query($query_tel);
if ($result_tel) {
  if (mysqli_num_rows($result_tel) > 0) {
    die("Ошибка! Аккаунт с таким номером телефона уже существует!");
  }
}

$query_login = "SELECT * FROM users WHERE login ='$login'"; //Проверка на наличие существующего логина
$result_login = $mysqli->query($query_login);
if ($result_login) {
  if (mysqli_num_rows($result_login) > 0) {
    die("Ошибка! Аккаунт с таким логином уже существует!");
  }
}
if ($passw != $repPassw) { //Проверка на правильность повторения пароля
  die("Ошибка! Пароли в полях ввода различаются!");
}
  $sql = "INSERT INTO users (name, telephone, email, password, login) VALUES ('$name', '$mobitel', '$mail', '$passw', '$login')"; //Запрос на добавление нового пользователя
  if($mysqli->query($sql)) {
    echo "Вы зарегистрированы!, Ваш логин: $login";
  } else {
    echo "Ошибка: " . $mysqli->error;
  }
  $mysqli->close();
}
?>