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
if ($mysqli->connect_errno) {
    die($mysqli->connect_error);
}

$mysqli->set_charset('utf8'); // 设置编码 防止乱码

// 注册
register($mysqli);
// 执行读取用户列表
// getUserList($mysqli);

//释放结果集
$mysqli->close();

// 用户注册
function register($mysqli){
    // user 用户信息表
    $sql = "insert into user(username,password) values(?,?)"; //插入数据
    $mysqli_stmt = $mysqli->prepare($sql); //准备预处理语句

    $username =$_POST["username"]; // 获取用户注册名
    $password =$_POST["password"]; // 获取用户注册密码

    //s 代表 string 类型
    $mysqli_stmt->bind_param('ss', $username, $password);
    //执行预处理语句
    if ($mysqli_stmt->execute()) { //执行成功
        echo $mysqli_stmt->insert_id; //程序成功，返回插入数据表的行 id
        // echo PHP_EOL; //程序成功，返回插入数据表的行 id
        // 提示注册成功
        // echo "<h1>注册成功！</h1>";
    } else {
        echo $mysqli_stmt->error; //执行失败，错误信息
    }
    //释放结果集
    $mysqli_stmt->free_result();
    // $mysqli_stmt->close();
}

