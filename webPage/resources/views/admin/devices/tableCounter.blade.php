<table id="table-counters-device" class="table-hover table">
    <tbody>
    <tr>
        <td>Mensajes asignados</td>
        <td>{{ $messages }}</td>
    </tr>

    {{-- <tr >
        <td>Cupones asignados</td>
        <td>{{ $coupons }}</td>
    </tr> --}}

    </tbody>
</table>

<a href="{{ route('admin.deviceMessages', $deviceID) }}" class="btn btn-primary pull-right">Administrar mensajes</a>

<div class="clearfix"></div>