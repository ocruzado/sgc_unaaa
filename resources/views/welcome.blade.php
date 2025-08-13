<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SGC - Universidad Nacional Autónoma de Alto Amazonas </title>
 <link rel="icon" href="{{ asset('img/logo_unaaa.png') }}" type="image/png" />
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body, html {
            height: 100%;
            background: linear-gradient(120deg, #4A90E2, #50E3C2, #A0E7E5);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 15px;
            text-shadow: 1px 1px 5px rgba(0,0,0,0.3);
        }

        p {
            font-size: 18px;
            margin-bottom: 40px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }

        .btn-login {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 14px 40px;
            border: 2px solid white;
            border-radius: 30px;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-login:hover {
            background-color: white;
            color: #4A90E2;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        /* Logo circular */
        .logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px auto;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
            font-weight: bold;
            color: white;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }

    </style>
</head>
<body>
    <div class="content">
        <div class="logo">
            <img src="{{ asset('img/logo_unaaa.png') }}" alt="" style="max-width: 100%;border-radius: 50%;">
        </div>
        <h1>Sistema de Gestión de Calidad</h1>
        <p>Universidad Nacional Autónoma de Alto Amazonas</p>
        <a href="{{ route('login') }}" class="btn-login">Iniciar Sesión</a>
    </div>
</body>
</html>
