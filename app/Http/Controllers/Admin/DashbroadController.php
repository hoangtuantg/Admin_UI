<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;

use Illuminate\Support\Facades\DB;

class DashbroadController extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard.index');
    }

}
