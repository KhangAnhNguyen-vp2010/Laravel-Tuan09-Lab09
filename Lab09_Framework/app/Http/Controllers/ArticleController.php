<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();
        // Xử lý ảnh (nếu có)
        if ($request->hasFile('image')) {
            // Lưu vào disk 'public' (đường dẫn: storage/app/public/articles/...)
            $path = $request->file('image')->store('articles', 'public');
            $data['image_path'] = $path; // lưu đường dẫn tương đối
        }
        Article::create($data);
        return redirect()->route('articles.index')
        ->with('success', 'Tạo bài viết thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Xem chi tiết bài viết ID: " . (int)$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            // Xoá ảnh cũ (nếu có)
            if (!empty($article->image_path) && Storage::disk('public')->exists($article->image_path)) {
                Storage::disk('public')->delete($article->image_path);
            }
            $data['image_path'] = $request->file('image')->store('articles', 'public');
        }
        $article->update($data);
        return redirect()->route('articles.index', $article)
        ->with('success', 'Cập nhật bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('articles.index')
->with('success', "Đã xoá bài viết #$id (demo).");
    }
}
