@foreach($publications as $publication)
    <tr onclick="Publication.OnTbodyPublicationTable(this)">
        <td>{{ $publication->id }}</td>
        <td>{{ $publication->category->shortDescription }}</td>
        <td>{{ $publication->company->name }}</td>
        <td>{{ $publication->title }}</td>
        <td>{{ $publication->description }}</td>
        <td style="text-align: center; vertical-align: middle;">@if($publication->is_coupon) <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i> @endif</td>
        <td onclick="(function(e) { e.preventDefault(); e.stopPropagation(); })(event)">
            <button type="button" class="btn btn-default" onclick="Publication.ViewModal(this.parentNode.parentNode);"><i class="fas fa-eye"></i></button>
        </td>
        <td onclick="(function(e) { e.preventDefault(); e.stopPropagation(); })(event)">
            {!! Form::model($publication, ['route' => ['admin.publication.destroy', $publication->id]]) !!}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger" onclick="Publication.DeletePublication(this.parentNode)"><i class="fas fa-trash"></i></button>
            {!! Form::close() !!}
        </td>
    </tr>
@endforeach