<?php
header('content-type:text/html;charset=utf-8'); // 设置编码 防止乱码
$severance = "127.0.0.1"; //域名
$username = "root"; //账户名
$password = "123"; //密码
$dbname = "demo02"; //数据库名
$port = "3308"; //数据库端口

// 创建连接
//实例化 mysqli 对象，连接 mysql 数据库
$mysqli = new mysqli($severance, $username, $password, $dbname, $port);
if ($mysqli->connect_errno) {   // 连接失败
    die($mysqli->connect_error);    // 输出错误信息
}

$mysqli->set_charset('utf8'); // 设置编码 防止乱码

// 登录
login($mysqli);

//释放结果集
$mysqli->close();

// 用户登录
function login($mysqli){
    // user 用户信息表
    $sql = "select * from user where username=? and password=?"; //查询数据
    $mysqli_stmt = $mysqli->prepare($sql); //准备预处理语句

    $username =$_POST["username"];
    $password =$_POST["password"];

    //s 代表 string 类型
    $mysqli_stmt->bind_param('ss', $username, $password);
    //执行预处理语句
    if ($mysqli_stmt->execute()) { //执行成功
        $result = $mysqli_stmt->get_result(); //获取查询执行结果
        // 获取结果集中的数据
        $row = $result->fetch_assoc(); // 返回结果集中的数
        if ($row) {
            echo "<script>alert('登录成功');</script>";
            // 跳转到
            echo "<script>location.href = '../../index.html';</script>";
        } else {
            echo "<script>alert('登录失败，请检查用户名或密码是否正确');</script>";
            // 跳转到
            echo "<script>location.href = '../../login.html';</script>";
        }
    } else {
        echo $mysqli_stmt->error; //执行失败，错误信息
    }
    //释放结果集
    $mysqli_stmt->free_result();
    // $mysqli_stmt->close();
}
?>
