@extends('layouts.app')

@section('title', 'الإعدادات')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>إعدادات النظام</h5>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <h6>الإعدادات العامة</h6>
                    
                    <div class="mb-3">
                        <label for="site_name" class="form-label">اسم الموقع</label>
                        <input type="text" class="form-control @error('site_name') is-invalid @enderror" 
                               id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" required>
                        @error('site_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="site_description" class="form-label">وصف الموقع</label>
                        <textarea class="form-control @error('site_description') is-invalid @enderror" 
                                  id="site_description" name="site_description" rows="3">{{ old('site_description', $settings['site_description']) }}</textarea>
                        @error('site_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="currency" class="form-label">العملة</label>
                        <select class="form-control @error('currency') is-invalid @enderror" 
                                id="currency" name="currency" required>
                            <option value="SAR" {{ old('currency', $settings['currency']) == 'SAR' ? 'selected' : '' }}>ريال سعودي (SAR)</option>
                            <option value="USD" {{ old('currency', $settings['currency']) == 'USD' ? 'selected' : '' }}>دولار أمريكي (USD)</option>
                            <option value="EUR" {{ old('currency', $settings['currency']) == 'EUR' ? 'selected' : '' }}>يورو (EUR)</option>
                        </select>
                        @error('currency')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <h6>إعدادات العرض</h6>
                    
                    <div class="mb-3">
                        <label for="items_per_page" class="form-label">عدد العناصر في الصفحة</label>
                        <input type="number" class="form-control @error('items_per_page') is-invalid @enderror" 
                               id="items_per_page" name="items_per_page" 
                               value="{{ old('items_per_page', $settings['items_per_page']) }}" min="5" max="100" required>
                        @error('items_per_page')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <h6 class="mt-4">معلومات الاتصال</h6>
                    
                    <div class="mb-3">
                        <label for="contact_email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                               id="contact_email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']) }}">
                        @error('contact_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">رقم الهاتف</label>
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" 
                               id="phone_number" name="phone_number" value="{{ old('phone_number', $settings['phone_number']) }}">
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">العنوان</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="2">{{ old('address', $settings['address']) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary">حفظ الإعدادات</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary ms-2">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection