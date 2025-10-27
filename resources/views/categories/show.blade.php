@extends('layouts.app')

@section('title', 'تفاصيل الفئة: ' . $category->name)

@section('content')

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
<div class="card">
    <div class="card-header">
        <h5>تفاصيل الفئة: {{ $category->name }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th>اسم الفئة:</th>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <th>الوصف:</th>
                        <td>{{ $category->description ?? 'لا يوجد وصف' }}</td>
                    </tr>
                    <tr>
                        <th>عدد المنتجات:</th>
                        <td>{{ $category->products_count }}</td>
                    </tr>
                    <tr>
                        <th>تاريخ الإضافة:</th>
                        <td>{{ $category->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($category->products_count > 0)
        <div class="mt-4">
            <h6>المنتجات في هذه الفئة:</h6>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم المنتج</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>تاريخ الإضافة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> تعديل
            </a>
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline ms-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                    <i class="fas fa-trash"></i> حذف
                </button>
            </form>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-2">
                <i class="fas fa-arrow-right"></i> رجوع
            </a>
        </div>
    </div>
</div>

    </div></div>
@endsection