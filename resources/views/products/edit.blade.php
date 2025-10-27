@extends('layouts.app')

@section('title', 'تعديل المنتج')

@section('styles')
<style>
    .image-preview {
        max-width: 200px;
        max-height: 200px;
        margin-top: 10px;
        border: 2px dashed #ddd;
        padding: 5px;
        border-radius: 5px;
    }
    .upload-area {
        border: 2px dashed #3498db;
        padding: 20px;
        text-align: center;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
    }
    .upload-area:hover {
        background-color: #f8f9fa;
    }
    .upload-area i {
        font-size: 48px;
        color: #3498db;
        margin-bottom: 10px;
    }
    .current-image {
        max-width: 200px;
        max-height: 200px;
        border: 2px solid #ddd;
        padding: 5px;
        border-radius: 5px;
        margin-bottom: 10px;
    }
</style>
@endsection

@section('content')


<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
<div class="card">
    <div class="card-header">
        <h5>تعديل المنتج: {{ $product->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم المنتج <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sku" class="form-label">رمز المنتج (SKU) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('sku') is-invalid @enderror" 
                               id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required>
                        @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">الوصف</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- حقل رفع الصورة -->
            <div class="mb-3">
                <label for="image" class="form-label">صورة المنتج</label>
                
                @if($product->image)
                    <div class="mb-3">
                        <p>الصورة الحالية:</p>
                        <img src="{{ $product->image_url }}" class="current-image" alt="{{ $product->name }}">
                    </div>
                @endif
                
                <div class="upload-area" onclick="document.getElementById('image').click()">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>انقر لتغيير صورة المنتج</p>
                    <small class="text-muted">الحد الأقصى لحجم الصورة: 2MB</small>
                </div>
                <input type="file" class="form-control d-none @error('image') is-invalid @enderror" 
                       id="image" name="image" accept="image/*" onchange="previewImage(this)">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <img id="imagePreview" class="image-preview" alt="معاينة الصورة" style="display: none;">
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="price" class="form-label">السعر <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" 
                               id="price" name="price" value="{{ old('price', $product->price) }}" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">الكمية <span class="text-danger">*</span></label>
                        <input type="number" min="0" class="form-control @error('quantity') is-invalid @enderror" 
                               id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">الفئة <span class="text-danger">*</span></label>
                        <select class="form-control @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" required>
                            <option value="">اختر الفئة</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> تحديث المنتج
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary ms-2">
                    <i class="fas fa-times"></i> إلغاء
                </a>
            </div>
        </form>
    </div>
</div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const file = input.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const priceInput = document.getElementById('price');
    const quantityInput = document.getElementById('quantity');
    
    [priceInput, quantityInput].forEach(input => {
        input.addEventListener('input', function() {
            if (this.value < 0) {
                this.value = 0;
            }
        });
    });
});
</script>
@endsection