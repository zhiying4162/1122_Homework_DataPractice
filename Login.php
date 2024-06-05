<?php
    	header("Content-Type:text/html; charset=utf-8");
        session_start();
        require_once 'DB_conn.php';
    
        $id= $_POST['id'];
        $pwd = $_POST['password'];
        
        $sql = "select name from students WHERE id = '$id' AND pwd = '$pwd'";
        $result = mysqli_query($link,$sql);

        if ($result) {
            // 檢查是否存在匹配的記錄
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                // 帳號和密碼匹配，允許進入
                echo $row['name']." 你好";
                $_SESSION['id'] = $id;
                echo 'button type="button" name="Rbutton" onclick="window.location.href=\'Examination.php\'">開始考試</button>';
            }
            else{
                // 帳號和密碼不匹配，拒絕進入
                echo "帳號或密碼錯誤，請重新輸入。<br/>";
                echo "<a href='login.html'>返回主頁";
            }
        }
        mysqli_close($link);
?>