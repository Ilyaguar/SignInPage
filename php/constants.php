<?php
    // Константы базы данных
    // define("DB_SERVER", "localhost");
    // define("DB_USER", "root");
    // define("DB_PASS", "");
    // define("DB_NAME", "users");

    $host = 'signInPage'; // адрес сервера 
    $database = 'test'; // имя базы данных
    $user = 'root'; // имя пользователя
    $password = ''; // пароль

    class User {
        // 0 – ошибка
        // 1 – успешно
        // 2 – ошибка при выполнении SQL запроса
        // 11 - Пользователь с такой почтой существует
        // 12 - Пользователь с таким логином существует
        // 13 - пароли не совпадают

        private $email, $login, $password, $password2, $link;

        public function __construct($email, $password, $link, $login = '', $password2 = '') {
            $this->email = strip_tags($email);
            $this->password = md5(strip_tags($password));
            $this->link = $link;
            $this->login = strip_tags($login);
            $this->password2 = md5(strip_tags($password2));
        }

        public function autorization(){
            $sql = "SELECT * FROM `test1` Where `email` = \"$this->email\""; // выбираем всех в таблице users
            $result = mysqli_query($this->link, $sql);

            if (!$result) {
                return 2;
            }
            else {
                $data = mysqli_fetch_row($result);
                if ($data[3] == $this->password) {
                    return 1;
                }
                else {
                    return 0;
                }
            }
            // закрываем подключение
            mysqli_close($this->link);
        }

        public function registration(){

            if ($this->password == $this->password2){

                $sql = "SELECT * FROM `test1` Where `email` = \"$this->email\"";
                $result = mysqli_query($this->link, $sql);

                if (!$result) {
                    return 2;
                }
                $row1 = mysqli_fetch_row($result);
        
                $sql = "SELECT * FROM `test1` Where `login` = \"$this->login\"";
                $result = mysqli_query($this->link, $sql);

                if (!$result) {
                    return 2;
                }
                $row2 = mysqli_fetch_row($result);

        
                if ($row1 == 0 && $row2 == 0) {
                    $sql = "INSERT INTO `test1`(`email`, `login`, `password`) VALUES (\"$this->email\",\"$this->login\",\"$this->password\")"; // выбираем всех в таблице users
                    var_dump($sql);
                    $result = mysqli_query($link, $sql);
        
                    if (!$result) {
                        return 2;
                    }
                    else {
                        return 1;
                    }
                }
                else{
                    if ($row1 > 0){
                        return 11;
                    }
                    else {
                        return 12;
                    }
                }
            } 
            else {
                return 13;
            }
        
            // закрываем подключение
            mysqli_close($this->link);
        }
    }
?>