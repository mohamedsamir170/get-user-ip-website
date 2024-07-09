
<?php

    $connect = mysqli_connect(
        'db', # service name
        'mohamed', # username
        'Mohamed@1234', # password
        'demo_website_db' # db table
    );
    echo "Hello World! <br>";

    $ip = $_SERVER['REMOTE_ADDR'];
    $time = date('Y-m-d H:i:s');

    $query = "SELECT * FROM users WHERE ip = '$ip'";
    $result = mysqli_query($connect,$query);
    if(mysqli_fetch_assoc($result) == 0)
    {
        $query2 = "INSERT INTO users (ip, date) VALUES ('$ip', '$time')";
        mysqli_query($connect,$query2);
        // echo "User Added <br>";
    }
    echo "Hello! Your IP address is $ip and the current time is $time.<br>";
    mysqli_close($connect);
?>
