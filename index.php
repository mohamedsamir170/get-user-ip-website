
<?php

    $db_server = "localhost";
    $db_user = "mohamed";
    $db_pass = "Mohamed@1234";
    $db_name = "demo_website_db";
    $conn = "";

    try{
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    }
    catch(mysqli_sql_exception){
        echo "failed to connect <br>";
    }

    echo "Hello World! <br>";

    $ip = $_SERVER['REMOTE_ADDR'];
    $time = date('Y-m-d H:i:s');

    $query = "SELECT * FROM users WHERE ip = '$ip'";
    $result = mysqli_query($conn,$query);
    if(mysqli_fetch_assoc($result) == 0)
    {
        $query2 = "INSERT INTO users (ip, date) VALUES ('$ip', '$time')";
        mysqli_query($conn,$query2);
        // echo "User Added <br>";
    }
    echo "Hello! Your IP address is $ip and the current time is $time.<br>";
    mysqli_close($conn);
?>