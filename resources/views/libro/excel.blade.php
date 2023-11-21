<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X_UA_Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

<style>
h1{
    color: blue;
}
</style>
</head>
<body>
    <h1 class="text-center" >Lista De Libros</h1><br>
    <table class="table table-striped">
    
                                <thead class="thead-dark" style="text-align: center ;font: size 20px; background-color: bisque">
                                    <tr>
										<th>Categoria</th>
										<th>Nombre</th>
                                        <th>Descripcion</th>
                                    </tr>
                                </thead>
    </br>

                                <tbody class='text-left'>
                                    @foreach ($libros as $libro)
                                        <tr>
											<td>{{ $libro->categoria->nombre}}</td>
											<td>{{ $libro->nombre }}</td>
                                            <td>{{ $libro->descripcion}}</td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
</body>
</html>