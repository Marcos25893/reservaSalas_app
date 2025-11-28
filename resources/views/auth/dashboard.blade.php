<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex justify-content-between bg-warning" style="width: 100vw; height: 10vh;">
    <div class="ps-2">

    </div>

    <div class="pt-3 text-dark">
        <h1>Restaurante</h1>
    </div>

    <div class="dropdown pe-2 pt-4">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            email
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="">Cerrar Sesión</a></li>
        </ul>
    </div>

</div>

<div >


    <div class="m-auto mt-4" style="width: 70vw; height: 70vh;">
        <h1 class="text-center mb-5">Salas</h1>

        <form action="" method="post" class="d-flex">
            <legend>Filtrar:</legend>
            <select class="form-select me-2" aria-label="Default select example" name='Capacidad'>
                <option selected >Capacidad</option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
            </select>

            <select class="form-select me-2" aria-label="Default select example" name='Ubicacion'>
                <option selected >Ubicacion</option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
            </select>

            <select class="form-select me-2" aria-label="Default select example" name='Equipamiento'>
                <option selected >Equipamiento</option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
            </select>

            <input class="btn btn-primary" type="submit" value="Filtrar">
        </form>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Imagen</th>
                <th scope="col">Capacidad</th>
                <th scope="col">Ubicacion</th>
                <th scope="col">Equipamiento</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            {{--
            @foreach($salas as $sala)
                <tr>
                    <td>{{$sala->imagen}}</td>
                    <td>{{$sala->capacidad}}</td>
                    <td>{{$sala->ubicacion}}</td>
                    <td>{{$sala->equipamiento}}</td>
                    <td>

                        <a href="{{route('salas.show', $sala->id)}}" class="btn btn-success m-1">Ver</a>

                    </td>
                </tr>
            @endforeach
            --}}
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
