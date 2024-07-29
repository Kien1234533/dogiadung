<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@700&display=swap" rel="stylesheet">
    <style>
        #adminpage {
            font-family: 'Sora', sans-serif;
            position: fixed;
            inset: 0;
            background: #223353;
            /* background: linear-gradient(45deg, #efefef 25%, rgba(239, 239, 239, 0) 25%, rgba(239, 239, 239, 0) 75%, #efefef 75%, #efefef), linear-gradient(45deg, #efefef 25%, rgba(239, 239, 239, 0) 25%, rgba(239, 239, 239, 0) 75%, #efefef 75%, #efefef); */
        }

        #adminpage .admin_content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 80px 30px;
            background: #ffffffe1;
            border-radius: 20px;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }

        #adminpage .admin_content .admin_content-title {
            text-transform: uppercase;
            font-size: 35px;
            color: #000;
            text-align: center;
            margin-bottom: 50px;
        }

        #adminpage .admin_content .admin_content-form {
            width: 100%;
        }


        #adminpage .admin_content .admin_content-form .form-group {
            position: relative;
            margin-bottom: 30px;

        }

        #adminpage .admin_content .admin_content-form .form-group i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #000;

        }

        #adminpage .admin_content .admin_content-form .form-group input {
            width: 300px;
            outline: none;
            background: #ffffff19;
            padding: 10px;
            border-radius: 10px;
            color: #000;
            border: none;
            font-family: 'Sora', sans-serif;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        #adminpage .admin_content .admin_content-form .form-group input::placeholder {
            color: #000;
            font-family: 'Sora', sans-serif;

        }

        #adminpage .btn-login {
            font-family: 'Sora', sans-serif;
            text-align: center;
            padding: 5px 40px;
            display: inline-block;
            border: none;
            outline: none;
            color: #fff;
            width: 100%;
            font-size: 18px;
            border-radius: 7px;
            margin: 20px 0 0;
            cursor: pointer;
            background: #000;
            text-transform: uppercase;
            transition: 0.4s;
            border: 1px solid #000;

        }

        #adminpage .btn-login:hover {
            background: transparent;
            color: #000;
            transition: 0.4s;
        }
    </style>
</head>

<body>
    <div class="admin" id="adminpage">
        <div class="admin_content">
            <div class="admin_content-title">SHOP.CO </div>
            <form action="" method="POST" class="admin_content-form">
                <div class="form-group">
                    <input type="text" placeholder="Username">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Password">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
