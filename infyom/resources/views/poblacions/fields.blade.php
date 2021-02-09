<!-- Ciudad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ciudad', 'Ciudad:') !!}
    {!! Form::text('ciudad', null, ['class' => 'form-control','maxlength' => 150,'maxlength' => 150]) !!}
</div>

<!-- Poblacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('poblacion', 'Poblacion:') !!}
    {!! Form::number('poblacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Cp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cp', 'Cp:') !!}
    {!! Form::text('cp', null, ['class' => 'form-control','maxlength' => 10,'maxlength' => 10]) !!}
</div>