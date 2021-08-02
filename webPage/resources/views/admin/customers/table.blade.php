@foreach($customers as $customer)

    <tr onclick="Customer.OnTbodyCustomerTable(this)">
        <td>{{ $customer->id }}</td>
        <td>{{ $customer->email }}</td>
        @if ($customer->customerProfile)
            <td>{{ $customer->customerProfile->first_name }}</td>
            <td>{{ $customer->customerProfile->last_name }}</td>
            <td>{{ $customer->customerProfile->tel }}</td>
        @else
            <td></td>
            <td></td>
            <td></td>
        @endif
        
        
        <td onclick="(function(e) { e.preventDefault(); e.stopPropagation(); })(event)">
            <button type="button" class="btn btn-default" onclick="Customer.ViewModal(this.parentNode.parentNode);"><i class="fas fa-eye"></i></button>
        </td>
        <td onclick="(function(e) { e.preventDefault(); e.stopPropagation(); })(event)">
            {!! Form::model($customer, ['route' => ['admin.customer.destroy', $customer->id]]) !!}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger" onclick="Customer.DeleteCustomer(this.parentNode)"><i class="fas fa-trash"></i></button>
            {!! Form::close() !!}
        </td>
    </tr>
@endforeach