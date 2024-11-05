<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <style>
        body {
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #a2e9d2;
            padding: 15px;
            border-radius: 8px;
        }
        h3 {
            text-align: center;
        }
        .button-container {
            display: flex;
            justify-content: center;
        }
        .form-group {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }
        .form-group label {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h3>Login</h3>
        <form action="" method="POST"> 
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" value="" class="tf" required />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" value="" class="tf" required />
            </div>
            <div class="button-container">
                <input type="submit" name="OK" value="OK" /> 
                <input type="reset" name="reset" value="Reset" />
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $connection = mysqli_connect("localhost", "root", "", "DULIEU") 
        or die("Kết nối thất bại: " . mysqli_connect_error());

        $name = mysqli_real_escape_string($connection, $_POST['username']); 
        $pass = mysqli_real_escape_string($connection, $_POST['password']);

        $sql = "SELECT * FROM admin WHERE username='$name' AND password='$pass'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: trangchinh.php");
            exit();
        } else {
            echo "<script>alert('Thông tin đăng nhập sai!');</script>";
        }

        mysqli_free_result($result);
        mysqli_close($connection);
    }
    ?>
</body>
</html>
