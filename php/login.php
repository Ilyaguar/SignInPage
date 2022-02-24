<?php
    require "constants.php";

    $link = mysqli_connect($host, $user, $password, $database);

    if (!$link){
        echo "<p>Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error() . "</p>";
    }
    else {
        echo "<p>Соединение установлено успешно</p>";
    }


    $human = new User($_POST["email"], $_POST["password"], $link);
    $result = $human->autorization();

    if ($result == 0) {
        echo "<p>Ошибка</p>";
    }
    elseif ($result == 1){
        echo "<p>Успешный вход</p>";
    }
    elseif ($result == 2){
        echo "<p>Oшибка при выполнении SQL запроса</p>";
    }
    else{
        echo "<p>Неизвестная ошибка</p>";
    }
?>