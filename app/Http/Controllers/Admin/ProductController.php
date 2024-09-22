<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Enums\Status;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.pages.products.index');
    }

    public function create()
    {
        return view('admin.pages.products.create');
    }

    public function store(ProductRequest $request)
    {

    }

    public function edit($id)
    {
        return view('admin.pages.products.update');
    }

    public function update(ProductRequest $request, string $id)
    {

    }

    public function delete(string $id)
    {

    }

    public function show($id)
    {
        return view('admin.pages.products.detail');
    }
}
