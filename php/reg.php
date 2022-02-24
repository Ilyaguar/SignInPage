<?php
    require "constants.php";

    $link = mysqli_connect($host, $user, $password, $database);

    if (!$link){
        echo "<p>Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error() . "</p>";
    }
    else {
        echo "<p>Соединение установлено успешно</p>";
    }


    $human = new User($_POST["email"], $_POST["password1"], $link, $_POST["login"], $_POST["password2"]);
    $result = $human->registration();

    if ($result == 0) {
        echo "<p>Ошибка</p>";
    }
    elseif ($result == 1){
        echo "<p>Успешная регистрация</p>";
    }
    elseif ($result == 2){
        echo "<p>Oшибка при выполнении SQL запроса</p>";
    }
    elseif ($result == 11){
        echo "<p>Пользователь с такой почтой существует</p>";
    }
    elseif ($result == 12){
        echo "<p>Пользователь с таким логином существует</p>";
    }
    elseif ($result == 13){
        echo "<p>Пароли не совпадают</p>";
    }
    else{
        echo "<p>Неизвестная ошибка</p>";
    }
?>