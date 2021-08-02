@foreach ($publications as $publication)
	<tr>
		<td> {{ $publication->id }} </td>
		<td> {{ $publication->category->shortDescription }} </td>
		<td> {{ $publication->title }} </td>
		<td> {{ $publication->description }} </td>

		
		<td style="text-align: center; vertical-align: middle;">@if($publication->is_coupon) <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i> @endif</td>
		
	</tr>
@endforeach