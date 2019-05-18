<?php
session_start();
var_dump($_SESSION);
if(empty($_SESSION['login'])&& empty($_SESSION['name'])) {
    if (!(empty($_COOKIE['login'])) &&  !(empty($_COOKIE['key']))) {
        //Пишем логин и ключ из КУК в переменные (для удобства работы):
        $login = $_COOKIE['login'];
        $key = $_COOKIE['key']; //ключ из кук (аналог пароля, в базе поле cookie)
        $xml = simplexml_load_file('php/users.xml');
        $state = 0;
        foreach ($xml as $user) {
            if (($user->login == $login) && ($user->cookie == $key)) {
                $name = $user->name;
                $login = $user->login;
                $state++;
                break;
            }
        }
        if ($state == 1) {
            //session_start();
            //Пишем в сессию информацию о том, что мы авторизовались:
            $_SESSION['name'] = (string)$name;
            $_SESSION['login'] = (string)$login;
        }
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manao</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php if (!isset($_SESSION['name'])){?>
<div id="registrationAuthorization">
    <button id="registrationButton">Регистрация</button>
    <button id="authorizationButton">Авторизации</button>
</div>
<div id="registration">
    <form id="fromReg" action="" method="post">
        <label for="loginRI">Логин:</label><br>
        <input  minlength="4" maxlength="15" name="loginRN" required id="loginRI" type="text"><br>
        <label for="passwordRI">Пароль:</label><br>
        <input minlength="6" maxlength="56" name="passwordRN" required id="passwordRI" type="password"><br>
        <label for="confirm_passwordRI">Повторите пароль:</label><br>
        <input required name="confirm_passwordRN" id="confirm_passwordRI" type="password"><br>
        <label for="emailRI">E-mail:</label><br>
        <input minlength="5" required type="email" name="emailRN" id="emailRI"><br>
        <label for="nameRI">Имя:</label><br>
        <input  minlength="2" maxlength="12" type="text" required name="nameRN" id="nameRI"><br>
        <input type="submit" id="AddUserI" name="AddUserN" value="Зарегистрироваться">
    </form>
</div>
<div id="authorization">
    <form action="" id="fromAut" method="post">
        <label for="loginAI">Логин:</label><br>
        <input minlength="4" maxlength="15"  name="loginAN" required id="loginAI" type="text"><br>
        <label for="passwordAI">Пароль:</label><br>
        <input minlength="6" maxlength="56" required id="passwordAI" name="passwordAN" type="password"><br>
        <input type="submit" value="Вход" id="CorrectUser">
    </form>
</div>
<?}else{
    echo 'Привет, '.$_SESSION['name'];
?>
    <form action="" method="post" id="exitForm">
        <input type="submit" value="Выход" id="exitButton">
    </form>
<?
}?>
<div id="resmess"></div>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>
