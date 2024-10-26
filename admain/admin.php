<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            font-family: 'Cairo', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            width: 100%;
            margin-bottom: 5px;
            color: #333;
            font-weight: 600;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        input[type="text"]:focus, input[type="email"]:focus {
            outline: none;
            border-color: #007bff;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        @media (max-width: 480px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            input[type="text"], input[type="email"] {
                font-size: 14px;
            }

            button {
                padding: 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <main>
        <?php
        session_start();
       
        $host="localhost:3309";
        $username="root";
        $password="";
        $dbname="task";

        $conn = mysqli_connect($host, $username, $password, $dbname);

        if (!$conn) {
            echo "<p class='alert'>لم يتم الاتصال بقاعدة البيانات</p>";
        }

        @$ADemail = $_POST['email'];
        @$ADpassword = $_POST['password'];
        @$ADadd = $_POST['add'];

        if (isset($ADadd)) {
            if (empty($ADemail) || empty($ADpassword)) {
                echo '<p class="alert">الرجاء ادخال البريد الالكتروني و كلمة السر</p>';
            } else { 
                $query = "SELECT * FROM admin WHERE EMAIL = '$ADemail' AND PASSWORD = '$ADpassword'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['EMAIL'] = $ADemail;
                    header("Refresh:2; url=admainbanel.php");
                    exit();
                } else {
                    echo '<p class="alert">ليس مسموح لك دخول هذه الصفحة، سوف يتم تحويلك الى المتجر</p>';
                    header("REFRESH:2; URL=../index.php");
                }
            }
        }
        ?>
        <div class="container">
            <h1>تسجيل الدخول</h1>
            <h3>هذه الصفحة مخصصة للإداري فقط</h3>
            <form action="admin.php" method="post">
                <label for="em">البريد الالكتروني</label>
                <input type="email" name="email" id="em" placeholder="أدخل بريدك الإلكتروني">
                <br>
                <label for="pass">الرقم السري</label>
                <input type="text" name="password" id="pass" placeholder="أدخل كلمة السر">
                <br>
                <button type="submit" name="add">تسجيل الدخول</button>
            </form>
        </div>
    </main>
</body>
</html>
