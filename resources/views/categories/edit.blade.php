@extends('layouts.app')

@section('title', 'تعديل الفئة')

@section('content')


<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
<div class="card">
    <div class="card-header">
        <h5>تعديل الفئة: {{ $category->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">اسم الفئة</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">الوصف</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">تحديث الفئة</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-2">إلغاء</a>
            </div>
        </form>
    </div>
</div>
    </div></div>
@endsection