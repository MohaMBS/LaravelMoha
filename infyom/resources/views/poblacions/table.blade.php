<div class="table-responsive">
    <table class="table" id="poblacions-table">
        <thead>
            <tr>
                <th>Ciudad</th>
        <th>Poblacion</th>
        <th>Cp</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($poblacions as $poblacion)
            <tr>
                <td>{{ $poblacion->ciudad }}</td>
            <td>{{ $poblacion->poblacion }}</td>
            <td>{{ $poblacion->cp }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['poblacions.destroy', $poblacion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('poblacions.show', [$poblacion->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('poblacions.edit', [$poblacion->id]) }}" class='btn btn-default btn-xs'>
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
