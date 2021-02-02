<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        th{
            color:white;
        }
    </style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="mx-auto">
			<div class="">
                <table class="table table-dark">
                    <form action="{{route("saveLLibre")}}" method="post">
                    @csrf
                    <thead>
                        <tr>
                        
                            <th scope="col">NOM</th>
                            <th scope="col">RESUMEN</th>
                            <th scope="col">Nº PAGINAS</th>
                            <th scope="col">EDICION</th>
                            <th scope="col">AUTOR</th>
                            <th scope="col">PRECIO</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <input type="hidden" name="id" value="{{ $llibre->id }}">
                            <th scope="col"><input type="text" name="nombre" value="{{ $llibre->nombre }}"></th>
                            <th scope="col"><input type="text" name="resumen" value="{{ $llibre->resumen }}"></th>
                            <th scope="col"><input type="text" name="npagina" value="{{ $llibre->npagina }}"></th>
                            <th scope="col"><input type="text" name="edicion" value="{{ $llibre->edicion }}"></th>
                            <th scope="col"><input type="text" name="autor" value="{{ $llibre->autor }}"></th>
                            <th scope="col"><input type="text" name="precio" value="{{ $llibre->precio }}"></th>
                        </tr>
                        <tr>
                            @error('nombre')
                                <th style="color:red;">{{ $error }}</th>
                            @enderror
                            @error('resumen')
                                <th style="color:red;">{{ $error }}</th>
                            @enderror
                            @error('npagina')
                                <th style="color:red;">{{ $error }}</th>
                            @enderror
                            @error('edicion')
                                <th style="color:red;">{{ $error }}</th>
                            @enderror
                            @error('autor')
                                <th style="color:red;">{{ $error }}</th>
                            @enderror
                            @error('precio')
                                <th style="color:red;">{{ $error }}</th>
                            @enderror
                        </tr>
                        <tr>
                            <th colspan="6"> <input type="submit" style="color:green;background-color:black;" value="UPDATE"> <button style="background-color:black;"><a  href="{{ url("llibres")}}">Ver libros</a></button>
                            @error('id')
                                <p style="color:red;">Fallo al guardad, vuelva a intentar.</p>
                            @enderror</th>
                        </tr>
                        
                    </tbody>
                 </form>
                </table>
            </div>
		</div>
	</div>
</div>
</body>
</html>
</body>
</html>