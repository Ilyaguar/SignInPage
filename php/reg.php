<?php
    require "constants.php";

    $link = mysqli_connect($host, $user, $password, $database);

    if (!$link){
        echo "<p>Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error() . "</p>";
    }
    else {
        echo "<p>Соединение установлено успешно</p>";
    }


    $human = new User($_POST["email"], $_POST["login"], $_POST["password"], $link, $_POST["password2"]);
    $result = $human->registration();

    if ($result == 0) {
        echo "Ошибка";
    }
    elseif ($result == 1){
        echo "Успешная регистрация";
    }
    elseif ($result == 2){
        echo "Oшибка при выполнении SQL запроса";
    }
    elseif ($result == 11){
        echo "Пользователь с такой почтой существует";
    }
    elseif ($result == 12){
        echo "Пользователь с таким логином существует";
    }
    elseif ($result == 13){
        echo "Пароли не совпадают";
    }
    else{
        echo "Неизвестная ошибка";
    }
?>