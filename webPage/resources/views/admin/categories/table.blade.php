@foreach($categories as $category)
    <tr onclick="Category.OnTbodyCategoryTable(this)">
        <td>{{ $category->id }}</td>
        <td>{{ $category->shortDescription }}</td>
        <td>{{ $category->longDescription }}</td>
        
        <td onclick="(function(e) { e.preventDefault(); e.stopPropagation(); })(event)">
            <button type="button" class="btn btn-default" onclick="Category.ViewModal(this.parentNode.parentNode);"><i class="fas fa-eye"></i></button>
        </td>
        <td onclick="(function(e) { e.preventDefault(); e.stopPropagation(); })(event)">
            {!! Form::model($category, ['route' => ['admin.category.destroy', $category->id]]) !!}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger" onclick="Category.DeleteCategory(this.parentNode)"><i class="fas fa-trash"></i></button>
            {!! Form::close() !!}
        </td>
    </tr>
@endforeach