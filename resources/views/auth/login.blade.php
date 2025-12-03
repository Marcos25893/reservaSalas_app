<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reegister</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
<div  class="d-flex justify-content-center mt-5" style="height: 100vh;">
    <div class="d-flex flex-column align-items-center bg-secondary bg-opacity-25 border border-secondary pt-5 rounded" style="width: 25vw; height: 50vh;">
        <div class="d-flex align-items-center mb-5">
            <h1>Login</h1>
        </div>

        <div class="ms-5" >
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control " required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Registrarme
                </button>
            </form>
            <p class="text-center mt-3">
                ¿No tienes cuenta? <a class="text-info text-decoration-none" href="{{route('register')}}">Crear Cuenta</a>
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
