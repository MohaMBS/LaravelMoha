<div class="table-responsive">
    <table class="table" id="cilientes-table">
        <thead>
            <tr>
                <th>Nom</th>
        <th>Cognom</th>
        <th>Nif</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cilientes as $ciliente)
            <tr>
                <td>{{ $ciliente->nom }}</td>
            <td>{{ $ciliente->cognom }}</td>
            <td>{{ $ciliente->nif }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cilientes.destroy', $ciliente->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cilientes.show', [$ciliente->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cilientes.edit', [$ciliente->id]) }}" class='btn btn-default btn-xs'>
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
