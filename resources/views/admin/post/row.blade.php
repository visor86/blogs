<tr>
    <td data-order="{{ $post->date_from->timestamp }}">
        {{ $post->date_from->format('j-M-y g:ia') }}
    </td>
    <td>{{ $post->title }}</td>
    <td>{{ $post->subtitle }}</td>
    <td>
        <a href="/admin/post/{{ $post->id }}/edit"
           class="btn btn-xs btn-info">
            <i class="fa fa-edit"></i> Edit
        </a>
        <a href="{{ route('post', ['id' => $post->slug]) }}"
           class="btn btn-xs btn-warning">
            <i class="fa fa-eye"></i> View
        </a>
    </td>
</tr>