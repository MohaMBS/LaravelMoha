<div class="table-responsive">
    <table class="table" id="coches-table">
        <thead>
            <tr>
                <th>Marca</th>
        <th>Modelo</th>
        <th>Fecha</th>
        <th>Id Cilinete</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($coches as $coche)
            <tr>
                <td>{{ $coche->marca }}</td>
            <td>{{ $coche->modelo }}</td>
            <td>{{ $coche->fecha }}</td>
            <td>{{ $coche->id_cilinete }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['coches.destroy', $coche->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('coches.show', [$coche->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('coches.edit', [$coche->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
