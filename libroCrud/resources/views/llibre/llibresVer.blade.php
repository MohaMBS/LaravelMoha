<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>llibres</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style>
    .mx-auto {
        display: flex;  /*display: flex; el cual vuelve al contenedor un elemento flex*/
        
        align-items: center;  /*justify-content: center; le decimos a los elementos del contenedor flex que se ubiquen al centro del eje principal eje horizontal*/
        
        justify-content: center; /*align-items: center; estamos diciendo que queremos que los elementos dentro del contenedor flex se ubiquen en el centro del eje secundario eje vertical*/
        
        min-height: 100vh;  /*min-height: 100vh; que significa tome como altura mínima del contenedor el total del alto de la ventana del navegador web utilizado.*/
        }
        body{
            background-color:#343A40;
            text-align: center;
        }
    </style>
</head>
<body>
@auth
    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
@endauth
<div class="container">
	<div class="row">
		<div class="mx-auto">
			<div class="">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOM</th>
                            <th scope="col">RESUMEN</th>
                            <th scope="col">Nº PAGINAS</th>
                            <th scope="col">EDICION</th>
                            <th scope="col">AUTOR</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col" colspan="2"> <a style="color:green;" href="{{url("addLlibres")}}">ADD</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($llibres as $inf)
                        <tr>
                            <th scope="row">{{ $inf->id }}</th>
                            <th>{{ $inf->nombre }}</th>
                            <th>{{ $inf->resumen }}</th>
                            <th>{{ $inf->npagina }}</th>
                            <th>{{ $inf->edicion }}</th>
                            <th>{{ $inf->autor }}</th>
                            <th>{{ $inf->precio }}</th>
                            <th><a style="color:yellow;" href="{{url('editLlibre')}}/{{ $inf->id }}">EDIT</a></th>
                            <th><a style="color:red;" href="{{url('delLlibre')}}/{{ $inf->id }}">DELTE</a></th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
		</div>
	</div>
</div>

</body>
</html>