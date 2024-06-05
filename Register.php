<?php
    require_once "DB_conn.php";

    $ID = $_POST['id'];
    $pwd =  $_POST['password'];
    $name = $_POST['name'];

    $sql = "insert into students values ('$ID' , '$pwd' , '$name')";

    $result = mysqli_query($link,$sql);

    if($result){
        echo '<form action="register.php">';
        echo "<h1>註冊成功</h1>";
        echo "<p>帳號：$ID</p>";
        echo "<p>密碼：$pwd</p>";
        echo "<p>名字：$name</p>";
        echo '<button type="button" onclick="window.location.href=\'Login.html\'">返回登入頁面</button>';
        echo '<button type="button" onclick="window.location.href=\'Register.html\'">返回註冊頁面</button>';
        echo '</form>';
    }
    else{
        echo "註冊失敗：" . mysqli_error($link);
    }
        
    mysqli_close($link); 
?>