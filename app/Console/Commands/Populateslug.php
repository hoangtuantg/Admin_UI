<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Populateslug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-slug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        DB::table('products')->get()->each(function ($product): void {
            $slug = Str::slug($product->name . '-' . $product->id);
            DB::table('products')->where('id', $product->id)->update(['slug' => $slug]);
            $this->info("Đã cập nhật slug cho sản phẩm: {$product->name}");
        });

        DB::table('categories')->get()->each(function ($category): void {
            $slug = Str::slug($category->name . '-' . $category->id);
            DB::table('categories')->where('id', $category->id)->update(['slug' => $slug]);
            $this->info("Đã cập nhật slug cho danh mục: {$category->name}");
        });

        DB::table('posts')->get()->each(function ($post): void {
            $slug = Str::slug($post->title . '-' . $post->id);
            DB::table('posts')->where('id', $post->id)->update(['slug' => $slug]);
            $this->info("Đã cập nhật slug cho bài viết: {$post->title}");
        });

        DB::table('orders')->get()->each(function ($order): void {
            $slug = Str::slug($order->code . '-' . $order->id);
            DB::table('orders')->where('id', $order->id)->update(['slug' => $slug]);
            $this->info("Đã cập nhật slug cho đơn hàng: {$order->code}");
        });
    }
}
