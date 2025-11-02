@extends('layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
    <h2>Danh sách bài viết</h2>

    @can('create', App\Models\Article::class)
        <a href="{{ route('articles.create') }}" style="padding:8px 12px;background:#2563eb;color:#fff;border-radius:6px;text-decoration:none;">
            + Thêm bài viết
        </a>
    @endcan
</div>

<table border="1" cellspacing="0" cellpadding="8" style="width:100%;border-collapse:collapse;">
    <thead>
        <tr style="background-color:#f3f4f6;">
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Tác giả</th>
            <th>Hình ảnh</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($articles as $a)
        <tr>
            <td>{{ $a->id }}</td>
            <td>
                <a href="{{ route('articles.show', $a) }}">{{ $a->title }}</a>
            </td>
            <td>{{ optional($a->user)->name ?? 'Không rõ' }}</td>
            <td style="text-align:center;">
                @if ($a->image_path)
                    <img src="{{ asset('storage/' . $a->image_path) }}" alt="Ảnh bài viết" width="120" style="border-radius:6px;">
                @else
                    <p><i>Không có ảnh</i></p>
                @endif
            </td>
            <td>
                <a href="{{ route('articles.show', $a) }}">Xem</a>

                @can('update', $a)
                    | <a href="{{ route('articles.edit', $a) }}">Sửa</a>
                @endcan

                @can('delete', $a)
                    |
                    <form action="{{ route('articles.destroy', $a) }}" method="post" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Xoá bài viết này?')">Xoá</button>
                    </form>
                @endcan
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align:center;">Chưa có bài viết.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
