<div class="table-responsive">
    <table class="table" id="golosinas-table">
        <thead>
            <tr>
                <th>Sabor</th>
        <th>Calorias</th>
        <th>Precio</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($golosinas as $golosinas)
            <tr>
                <td>{{ $golosinas->sabor }}</td>
            <td>{{ $golosinas->calorias }}</td>
            <td>{{ $golosinas->precio }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['golosinas.destroy', $golosinas->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('golosinas.show', [$golosinas->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('golosinas.edit', [$golosinas->id]) }}" class='btn btn-default btn-xs'>
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
