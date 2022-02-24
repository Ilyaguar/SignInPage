<?php
    require "constants.php";

    $link = mysqli_connect($host, $user, $password, $database);

    if (!$link){
        echo "<p>Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error() . "</p>";
    }
    else {
        echo "<p>Соединение установлено успешно</p>";
    }


    $human = new User($_POST["email"], 0, $_POST["password"], $link, 0);
    $result = $human->autorization;

    if ($result == 0) {
        echo "Ошибка";
    }
    elseif ($result == 1){
        echo "Успешный вход";
    }
    elseif ($result == 2){
        echo "Oшибка при выполнении SQL запроса";
    }
    else{
        echo "Неизвестная ошибка";
    }
?>