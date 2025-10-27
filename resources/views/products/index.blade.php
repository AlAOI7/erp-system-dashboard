@extends('layouts.app')

@section('title', 'إدارة المنتجات')

@section('content')

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>إدارة المنتجات</h4>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> إضافة منتج جديد
    </a>
</div>

<!-- نموذج البحث والتصفية -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('products.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="search" class="form-label">بحث</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="ابحث بالاسم أو SKU">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">الفئة</label>
                        <select class="form-control" id="category_id" name="category_id">
                            <option value="">جميع الفئات</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="status" class="form-label">الحالة</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">جميع الحالات</option>
                            <option value="in_stock" {{ request('status') == 'in_stock' ? 'selected' : '' }}>متوفر</option>
                            <option value="low_stock" {{ request('status') == 'low_stock' ? 'selected' : '' }}>كمية محدودة</option>
                            <option value="out_of_stock" {{ request('status') == 'out_of_stock' ? 'selected' : '' }}>غير متوفر</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">بحث</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($products->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>السعر</th>
                        <th>الكمية</th>
                        <th>الفئة</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                      <td>
    @if($product->getImageUrl())
        <img src="{{ $product->getImageUrl() }}" alt="{{ $product->name }}" 
             style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
    @else
        <div style="width: 50px; height: 50px; background: #eee; display: flex; align-items: center; justify-content: center; border-radius: 5px;">
            <i class="fas fa-image text-muted"></i>
        </div>
    @endif
</td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                                {{ $product->name }}
                            </a>
                            <br>
                            <small class="text-muted">{{ $product->sku }}</small>
                        </td>
                        <td>{{ number_format($product->price, 2) }} ر.س</td>
                        <td>
                            <span class="badge {{ $product->quantity > 10 ? 'bg-success' : ($product->quantity > 0 ? 'bg-warning' : 'bg-danger') }}">
                                {{ $product->quantity }}
                            </span>
                        </td>
                        <td>
                            @if($product->category)
                                <span class="badge bg-info">{{ $product->category->name }}</span>
                            @else
                                <span class="badge bg-secondary">غير مصنف</span>
                            @endif
                        </td>
                        <td>
                            @if($product->quantity > 10)
                                <span class="badge bg-success">متوفر</span>
                            @elseif($product->quantity > 0)
                                <span class="badge bg-warning">كمية محدودة</span>
                            @else
                                <span class="badge bg-danger">غير متوفر</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info" title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')" title="حذف">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <p class="mb-0">عرض {{ $products->firstItem() }} - {{ $products->lastItem() }} من أصل {{ $products->total() }} منتج</p>
            </div>
            {{ $products->links() }}
        </div>
        @else
        <div class="text-center py-4">
            <i class="fas fa-box fa-3x text-muted mb-3"></i>
            <p class="text-muted">لا توجد منتجات حالياً</p>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة أول منتج
            </a>
        </div>
        @endif
    </div>
</div>
    </div></div>
@endsection