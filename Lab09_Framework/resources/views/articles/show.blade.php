@extends('layouts.app')
@section('title', 'Chi tiết bài viết')
@section('content')
    <article>
        <header style="margin-bottom:16px;">
            <h2>{{ $article->title }}</h2>
            <p>Đăng bởi <strong>{{ optional($article->user)->name ?? 'Không rõ' }}</strong> vào {{ $article->created_at->format('d/m/Y H:i') }}</p>
        </header>

        @if ($article->image_path)
            <div style="margin-bottom:16px;">
                <img src="{{ asset('storage/' . $article->image_path) }}" alt="Ảnh bài viết" style="max-width:100%;border-radius:8px;">
            </div>
        @endif

        <div style="white-space:pre-line; margin-bottom:24px;">
            {{ $article->body }}
        </div>

        <div style="display:flex;gap:8px;">
            @can('update', $article)
                <a href="{{ route('articles.edit', $article) }}" style="padding:8px 12px;background:#2563eb;color:#fff;border-radius:6px;text-decoration:none;">Sửa bài viết</a>
            @endcan

            @can('delete', $article)
                <form action="{{ route('articles.destroy', $article) }}" method="post" onsubmit="return confirm('Bạn chắc chắn muốn xoá bài viết này?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="padding:8px 12px;background:#dc2626;color:#fff;border:none;border-radius:6px;cursor:pointer;">Xoá bài viết</button>
                </form>
            @endcan

            <a href="{{ route('articles.index') }}" style="padding:8px 12px;border-radius:6px;border:1px solid #cbd5f5;text-decoration:none;">← Quay lại danh sách</a>
        </div>
    </article>
@endsection
