@foreach($devices as $device)
    <tr onclick="Device.OnTbodyDeviceTable(this)">
        <td>{{ $device->id }}</td>
        <td>{{ $device->mac }}</td>      
        <td style="text-align: center; vertical-align: middle;">@if($device->status==1) <i class="fas fa-check-circle fa-2x"></i> @else <i class="far fa-circle fa-2x"></i> @endif</td>
        <td onclick="(function(e) { e.preventDefault(); e.stopPropagation(); })(event)">
            <button type="button" class="btn btn-default" onclick="Device.ViewModal(this.parentNode.parentNode);"><i class="fas fa-eye"></i></button>
        </td>
        <td onclick="(function(e) { e.preventDefault(); e.stopPropagation(); })(event)">
            {!! Form::model($device, ['route' => ['admin.device.destroy', $device->id]]) !!}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger" onclick="Device.DeleteDevice(this.parentNode)"><i class="fas fa-trash"></i></button>
            {!! Form::close() !!}
        </td>
    </tr>
@endforeach