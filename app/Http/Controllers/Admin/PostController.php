<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use DOMDocument;
use DOMXPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.pages.posts.index');
    }

    public function create()
    {
        return view('admin.pages.posts.create');
    }

    public function store(PostRequest $request)
    {

    }

    public function edit()
    {
        return view('admin.pages.posts.update');
    }


    public function update(PostRequest $request, string $id)
    {
        
    }

    public function delete(string $id)
    {
 
    }

    public function show($id)
    {
        return view('admin.pages.posts.detail');
    }
}
