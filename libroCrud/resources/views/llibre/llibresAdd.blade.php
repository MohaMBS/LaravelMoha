<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                    <form action="{{route("storeLLibre")}}" method="post">
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
                            <th scope="col"><input type="text" name="nombre" id=""></th>
                            <th scope="col"><input type="text" name="resumen" id=""></th>
                            <th scope="col"><input type="text" name="npagina" id=""></th>
                            <th scope="col"><input type="text" name="edicion" id=""></th>
                            <th scope="col"><input type="text" name="autor" id=""></th>
                            <th scope="col"><input type="text" name="precio" id=""></th>
                        </tr>
                        <tr>
                            @foreach ($errors->all() as $error)
                                <th style="color:red;">{{ $error }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            <th colspan="6"> <input type="submit" style="color:green;background-color:black;" value="ADD"><button style="background-color:black;"><a  href="{{ url("llibres")}}">Ver libros</a></button> </th>
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