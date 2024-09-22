@extends('admin.layouts.master')

@section('page-header')
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Bảng điều khiển
            </h4>
        </div>
    </div>

    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="#" class="breadcrumb-item"><i class="ph-house"></i></a>
                <span class="breadcrumb-item active">Bảng điều khiển</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-content')
<style>
    .card {
        overflow: hidden;
    }

    .darker-bg {
        background-color: rgba(0, 0, 0, 0.1);
        padding: 10px;
        margin-left: -1rem;
        margin-right: -1rem;
        margin-bottom: -1rem;
    }

    .darker-bg a {
        text-decoration: none;
    }
</style>
<div class="content">
    <div class="row">

        <div class="col-lg-3">
            <div class="card bg-pink text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h1 class="mb-0">10</h1>
                            <div>Sản phẩm</div>
                        </div>
                        <div>
                            <i class="ph-tote-simple fs-1" style="transform: scale(2.9); margin-right: 20px; color: rgba(255, 255, 255, 0.5);"></i>
                        </div>
                    </div>
                    <div class="darker-bg mt-auto">
                        <a href="" class="text-white d-flex justify-content-between align-items-center">
                            <span>Xem chi tiết</span>
                            <i class="ph-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h1 class="mb-0">10</h1>
                            <div>Danh mục</div>
                        </div>
                        <div>
                            <i class="ph-stack fs-1" style="transform: scale(2.9); margin-right: 20px; color: rgba(255, 255, 255, 0.5);"></i>
                        </div>
                    </div>
                    <div class="darker-bg mt-auto">
                        <a href="" class="text-white d-flex justify-content-between align-items-center">
                            <span>Xem chi tiết</span>
                            <i class="ph-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card bg-teal text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h1 class="mb-0">10</h1>
                            <div>Bài viết</div>
                        </div>
                        <div>
                            <i class="ph-newspaper fs-1" style="transform: scale(2.9); margin-right: 20px; color: rgba(255, 255, 255, 0.5);"></i>
                        </div>
                    </div>
                    <div class="darker-bg mt-auto">
                        <a href="" class="text-white d-flex justify-content-between align-items-center">
                            <span>Xem chi tiết</span>
                            <i class="ph-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h1 class="mb-0">10</h1>
                            <div>Đơn hàng</div>
                        </div>
                        <div>
                            <i class="ph-shopping-bag fs-1" style="transform: scale(2.9); margin-right: 20px; color: rgba(255, 255, 255, 0.5);"></i>
                        </div>
                    </div>
                    <div class="darker-bg mt-auto">
                        <a href="" class="text-white d-flex justify-content-between align-items-center">
                            <span>Xem chi tiết</span>
                            <i class="ph-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Thống kê đơn hàng</h5>
            </div>
            <div class="card-body">
                <canvas id="orderChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h5>Thống kê doanh thu theo tháng</h5>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>



@endsection