<?php
    $login = filter_var(trim($_POST['user_login']),FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['user_pass']),FILTER_SANITIZE_STRING);

    $pass = md5($pass."i0b1tzvc7");
    
    require '../modules/connect.php';
    $mysql = connect();
    mysqli_set_charset($mysql, 'utf8');
    $result = $mysql -> query("SELECT * FROM `users` WHERE `user_login` = '$login' AND `user_pass` = '$pass'");
    $user = $result->fetch_assoc();
    // $vivod = "{$user['user_group']} - {$user['user_name']}";
    // setcookie('vivod', $vivod, time() + 3600 * 2, "/");
    // echo $vivod;

    if(empty($user) or count($user) == 0){
        setcookie('error_access',"Неверный логин или пароль",time()+1,"/profile.php");
    }
    setcookie('user', $user['user_name'], time() + 3600 * 2, "/");
    setcookie('login', $user['user_login'], time() + 3600 * 2, "/");
    setcookie('uId', $user['user_id'], time() + 3600 * 2, "/");
    $mysql -> close();
    header('Location: /profile.php');
?>