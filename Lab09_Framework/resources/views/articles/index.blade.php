@extends('layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')
<h2>Danh sách bài viết</h2>

<table border="1" cellspacing="0" cellpadding="8" style="width:100%;border-collapse:collapse;">
    <thead>
        <tr style="background-color:#f3f4f6;">
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Hình ảnh</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($articles as $a)
        <tr>
            <td>{{ $a->id }}</td>
            <td>{{ $a->title }}</td>
            <td style="text-align:center;">
                @if ($a->image_path)
                    <img src="{{ asset('storage/' . $a->image_path) }}" alt="Ảnh bài viết" width="120" style="border-radius:6px;">
                @else
                    <p><i>Không có ảnh</i></p>
                @endif
            </td>
            <td>
                <a href="{{ route('articles.show', $a->id) }}">Xem</a> |
                <a href="{{ route('articles.edit', $a->id) }}">Sửa</a> |
                <form action="{{ route('articles.destroy', $a->id) }}" method="post" style="display:inline;" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Xoá bài viết này?')">Xoá</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" style="text-align:center;">Chưa có bài viết.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@push('scripts')
<script>
    console.log('Articles index loaded');
</script>
@endpush
@endsection
