@foreach ($coupons as $coupon)
	<tr>
		<td> {{ $coupon->id }} </td>
		<td> {{ $coupon->publication->title }} </td>
		<td> {{ $coupon->publication->description }} </td>
		
		<td vertical-align: middle;">@if($coupon->used) <i style = "color: #1ab394;" class="far fa-dot-circle fa-1x"></i>&nbsp; Utilizado @else <i  class="far fa-circle fa-1x"></i>&nbsp; No utilizado @endif</td>
		<td onclick="(function(e) { e.preventDefault(); e.stopPropagation(); })(event)">
            {!! Form::model($coupon, ['route' => ['admin.customerCoupon.destroy', $coupon->id]]) !!}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger" onclick="Customer.DeleteCustomerCoupon(this.parentNode)"><i class="fas fa-trash"></i></button>
            {!! Form::close() !!}
        </td>
	</tr>
@endforeach