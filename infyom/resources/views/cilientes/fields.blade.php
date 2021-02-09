<!-- Nom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nom', 'Nom:') !!}
    {!! Form::text('nom', null, ['class' => 'form-control','maxlength' => 150,'maxlength' => 150]) !!}
</div>

<!-- Cognom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cognom', 'Cognom:') !!}
    {!! Form::text('cognom', null, ['class' => 'form-control','maxlength' => 150,'maxlength' => 150]) !!}
</div>

<!-- Nif Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nif', 'Nif:') !!}
    {!! Form::text('nif', null, ['class' => 'form-control','maxlength' => 9,'maxlength' => 9]) !!}
</div>