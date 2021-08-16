@if(auth()->user()->id == 2)
<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($exam->title, 47) }}</td>

    <td class="text-center">
        @if($exam->is_published =='1')
            <span class="badge" style="background-color: #419645">{{$exam->is_published ? 'Yes' : 'No'}}</span>
        @elseif($exam->is_published =='0')
            <span class="badge" style="background-color: #f44336">{{$exam->is_published ? 'Yes' : 'No'}}</span>
        @endif    </td>
    <td class="text-right">
        <a href="{{route('exam.edit', $exam->slug)}}" class="btn btn-flat btn-primary btn-xs" title="edit">
            <i class="glyphicon glyphicon-edit"></i>
        </a>
        <a href="{{ route('exam.destroy', $exam->id) }}">
        <button type="button" 
            class="btn btn-flat btn-danger btn-xs item-delete" title="delete">
            <i class="glyphicon glyphicon-trash"></i>
        </button>
    </td>
</tr>
@elseif($exam->user->id == auth()->user()->id)
<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($exam->title, 47) }}</td>

    <td class="text-center">
        @if($exam->is_published =='1')
            <span class="badge" style="background-color: #419645">{{$exam->is_published ? 'Yes' : 'No'}}</span>
        @elseif($exam->is_published =='0')
            <span class="badge" style="background-color: #f44336">{{$exam->is_published ? 'Yes' : 'No'}}</span>
        @endif    </td>
    <td class="text-right">
        <a href="{{route('exam.edit', $exam->slug)}}" class="btn btn-flat btn-primary btn-xs" title="edit">
            <i class="glyphicon glyphicon-edit"></i>
        </a>
        <a href="{{ route('exam.destroy', $exam->id) }}">
        <button type="button" 
            class="btn btn-flat btn-danger btn-xs item-delete" title="delete">
            <i class="glyphicon glyphicon-trash"></i>
        </button>
    </td>
</tr>
    
@endif

