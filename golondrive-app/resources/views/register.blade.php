<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <style>
        /* Reseteo básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #a77adf, #668dd1);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            color: #333;
            padding: 30px 25px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #a77adf;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #a77adf;
            box-shadow: 0 0 8px rgba(106, 17, 203, 0.3);
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background: linear-gradient(135deg, #a77adf, #668dd1);
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #a77adf, #668dd1);
        }

        .text-center {
            margin-top: 20px;
            font-size: 14px;
        }

        .text-center a {
            color: #6a11cb;
            text-decoration: none;
            font-weight: bold;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Crear Cuenta</h1>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        
        <form action="/register" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre de Usuario</label>
                <input type="text" id="name" name="name" placeholder="Ingresa tu nombre" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Crea una contraseña" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite tu contraseña" required>
            </div>
            <button type="submit">Registrarse</button>
        </form>
        <div class="text-center">
            <p>¿Ya tienes una cuenta? <a href="/login">Inicia sesión</a></p>
        </div>
    </div>
</body>
</html>
