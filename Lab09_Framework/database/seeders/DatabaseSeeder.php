<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        $author = User::updateOrCreate(
            ['email' => 'author@example.com'],
            [
                'name' => 'Author User',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );

        Article::updateOrCreate([
            'title' => 'Bài viết mẫu đầu tiên',
        ], [
            'body' => 'Đây là nội dung bài viết mẫu giúp bạn kiểm thử cơ chế phân quyền dựa trên tác giả.',
            'user_id' => $author->id,
        ]);

        Article::updateOrCreate([
            'title' => 'Bài viết của admin',
        ], [
            'body' => 'Bài viết này thuộc về tài khoản admin để kiểm tra quyền sửa xóa.',
            'user_id' => $admin->id,
        ]);
    }
}
