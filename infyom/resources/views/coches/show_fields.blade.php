<!-- Marca Field -->
<div class="col-sm-12">
    {!! Form::label('marca', 'Marca:') !!}
    <p>{{ $coche->marca }}</p>
</div>

<!-- Modelo Field -->
<div class="col-sm-12">
    {!! Form::label('modelo', 'Modelo:') !!}
    <p>{{ $coche->modelo }}</p>
</div>

<!-- Fecha Field -->
<div class="col-sm-12">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{{ $coche->fecha }}</p>
</div>

<!-- Id Cilinete Field -->
<div class="col-sm-12">
    {!! Form::label('id_cilinete', 'Id Cilinete:') !!}
    <p>{{ $coche->id_cilinete }}</p>
</div>

