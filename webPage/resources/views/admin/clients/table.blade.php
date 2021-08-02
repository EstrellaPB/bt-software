@foreach($clients as $client)
    <tr onclick="Client.OnTbodyClientTable(this)">
        <td>{{ $client->id }}</td>
        <td>{{ $client->name }}</td>
        <td>{{ $client->city }}</td>
        <td>{{ $client->state }}</td>
        <td style="text-align: center; vertical-align: middle;">@if($client->companyDetail->is_premium) <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i> @endif</td>
        <td style="text-align: center; vertical-align: middle;">@if($client->companyDetail->is_active) <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i> @endif</td>

        <td onclick="(function(e) { e.preventDefault(); e.stopPropagation(); })(event)">
            <button type="button" class="btn btn-default" onclick="Client.ViewModal(this.parentNode.parentNode);"><i class="fas fa-eye"></i></button>
        </td>
        <td onclick="(function(e) { e.preventDefault(); e.stopPropagation(); })(event)">
            {!! Form::model($client, ['route' => ['admin.client.destroy', $client->id]]) !!}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger" onclick="Client.DeleteClient(this.parentNode)"><i class="fas fa-trash"></i></button>
            {!! Form::close() !!}
        </td>
    </tr>
@endforeach