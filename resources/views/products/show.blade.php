@extends('layouts.app')

@section('title', 'تفاصيل المنتج: ' . $product->name)

@section('content')


<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

<div class="card">
    <div class="card-header">
        <h5>تفاصيل المنتج: {{ $product->name }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
        <div class="col-md-4">
    @if($product->getImageUrl())
        <img src="{{ $product->getImageUrl() }}" alt="{{ $product->name }}" 
             class="img-fluid rounded">
    @else
        <div class="text-center py-4 bg-light rounded">
            <i class="fas fa-image fa-3x text-muted mb-3"></i>
            <p class="text-muted">لا توجد صورة</p>
        </div>
    @endif
</div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>اسم المنتج:</th>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <th>رمز المنتج (SKU):</th>
                                <td>{{ $product->sku }}</td>
                            </tr>
                            <tr>
                                <th>الوصف:</th>
                                <td>{{ $product->description ?? 'لا يوجد وصف' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>السعر:</th>
                                <td>{{ number_format($product->price, 2) }} ر.س</td>
                            </tr>
                            <tr>
                                <th>الكمية المتاحة:</th>
                                <td>
                                    <span class="badge {{ $product->quantity > 10 ? 'bg-success' : ($product->quantity > 0 ? 'bg-warning' : 'bg-danger') }}">
                                        {{ $product->quantity }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>الفئة:</th>
                                <td>{{ $product->category->name ?? 'غير مصنف' }}</td>
                            </tr>
                            <tr>
                                <th>تاريخ الإضافة:</th>
                                <td>{{ $product->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> تعديل
            </a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline ms-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                    <i class="fas fa-trash"></i> حذف
                </button>
            </form>
            <a href="{{ route('products.index') }}" class="btn btn-secondary ms-2">
                <i class="fas fa-arrow-right"></i> رجوع
            </a>
        </div>
    </div>
</div>

    </div></div>
@endsection