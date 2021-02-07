<!-- Marca Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('marca', 'Marca:') !!}
    {!! Form::textarea('marca', null, ['class' => 'form-control']) !!}
</div>

<!-- Modelo Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('modelo', 'Modelo:') !!}
    {!! Form::textarea('modelo', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::text('fecha', null, ['class' => 'form-control','id'=>'fecha']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Id Cilinete Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_cilinete', 'Id Cilinete:') !!}
    {!! Form::number('id_cilinete', null, ['class' => 'form-control']) !!}
</div>