```markdown
<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

# نظام إدارة المؤسسات (ERP) - Laravel

## 📋 وصف المشروع
نظام متكامل لإدارة المؤسسات مبني باستخدام Laravel 10، يتضمن إدارة المنتجات، الفئات، المستخدمين والإعدادات.

## 🚀 المميزات
- ✅ نظام مصادقة كامل (تسجيل دخول/تسجيل)
- ✅ لوحة تحكم تفاعلية
- ✅ إدارة المنتجات (CRUD)
- ✅ إدارة الفئات
- ✅ نظام رفع الصور
- ✅ بحث وتصفية متقدم
- ✅ إعدادات قابلة للتخصيص
- ✅ واجهة عربية متجاوبة
- ✅ تقارير وإحصائيات

## 🛠️ متطلبات التشغيل
- PHP 8.1 أو أعلى
- Composer
- MySQL 5.7 أو أعلى
- Node.js (لأصول前端)

## ⚡ التثبيت السريع

### 1. استنساخ المشروع
```bash
git clone https://github.com/your-username/erp-system.git
cd erp-system
```

### 2. تثبيت الاعتماديات
```bash
composer install
npm install
```

### 3. إعداد البيئة
```bash
cp .env.example .env
php artisan key:generate
```

### 4. تكوين قاعدة البيانات
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=erp_system
DB_USERNAME=root
DB_PASSWORD=
```

### 5. تشغيل التهجيرات والسيدر
```bash
php artisan migrate --seed
php artisan storage:link
```

### 6. بناء أصول前端
```bash
npm run build
```

### 7. تشغيل الخادم
```bash
php artisan serve
```

## 📁 هيكل المشروع
```
app/
├── Models/
│   ├── Product.php
│   └── Category.php
├── Http/Controllers/
│   ├── DashboardController.php
│   ├── ProductController.php
│   ├── CategoryController.php
│   └── SettingsController.php
resources/views/
├── layouts/
│   └── app.blade.php
├── products/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
├── categories/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
├── dashboard.blade.php
├── settings/
│   └── index.blade.php
└── welcome.blade.php
```

## 🗃️ نماذج البيانات

### المنتج (Product)
- الاسم
- الوصف
- الصورة
- السعر
- الكمية
- الفئة
- SKU

### الفئة (Category)
- الاسم
- الوصف

## 🌐 المسارات المتاحة

| المسار | الوصف | طريقة الطلب |
|--------|-------|-------------|
| `/` | الصفحة الرئيسية | GET |
| `/login` | تسجيل الدخول | GET/POST |
| `/register` | إنشاء حساب | GET/POST |
| `/dashboard` | لوحة التحكم | GET |
| `/products` | قائمة المنتجات | GET |
| `/products/create` | إضافة منتج | GET/POST |
| `/products/{id}` | عرض منتج | GET |
| `/products/{id}/edit` | تعديل منتج | GET/PUT |
| `/categories` | قائمة الفئات | GET |
| `/settings` | الإعدادات | GET/POST |

## 🔧 الأوامر المفيدة

### إعادة تعيين قاعدة البيانات
```bash
php artisan migrate:fresh --seed
```

### مسح الكاش
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### إنشاء مستخدم جديد
```bash
php artisan tinker
>>> User::create(['name'=>'Admin','email'=>'admin@erp.com','password'=>Hash::make('password')])
```

### تشغيل في وضع التطوير
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

## 🎯 الاستخدام

### 1. التسجيل والدخول
- انتقل إلى `/register` لإنشاء حساب جديد
- أو استخدم `/login` لتسجيل الدخول

### 2. إدارة الفئات
- انتقل إلى `/categories` لعرض الفئات
- انقر على "إضافة فئة جديدة" لإنشاء فئة

### 3. إدارة المنتجات
- انتقل إلى `/products` لعرض المنتجات
- استخدم شريط البحث للبحث عن منتجات
- استخدم التصفية حسب الفئة
- انقر على "إضافة منتج جديد" لإضافة منتج

### 4. الإعدادات
- انتقل إلى `/settings` لضبط إعدادات النظام
- يمكنك تغيير اسم الموقع، العملة، وغيرها

## 🔒 الأمان
- المصادقة المضمنة من Laravel
- حماية من هجمات CSRF
- التحقق من صحة البيانات
- حماية الملفات المرفوعة

## 🐛 استكشاف الأخطاء وإصلاحها

### مشكلة في الصلاحيات
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### مشكلة في التهجيرات
```bash
php artisan migrate:fresh
```

### مشكلة في التخزين
```bash
php artisan storage:link
```

## 🤝 المساهمة
1. Fork المشروع
2. إنشاء فرع للميزة (`git checkout -b feature/AmazingFeature`)
3. Commit التغييرات (`git commit -m 'Add some AmazingFeature'`)
4. Push إلى الفرع (`git push origin feature/AmazingFeature`)
5. فتح طلب دمج

## 📄 الرخصة
هذا المشروع مرخص تحت رخصة MIT - انظر ملف [LICENSE](LICENSE) للتفاصيل.

## 📞 الدعم
إذا واجهتك أي مشاكل، يمكنك:
1. فتح issue في GitHub
2. مراجعة documentation
3. التواصل عبر البريد الإلكتروني

---

<p align="center">
  تم البناء باستخدام ❤️ و <a href="https://laravel.com">Laravel</a>
</p>
```

هذا الملف README.md يحتوي على:

✅ **شعار Laravel الرسمي**  
✅ **وصف كامل للمشروع**  
✅ **المميزات**  
✅ **تعليمات التثبيت**  
✅ **هيكل المشروع**  
✅ **نماذج البيانات**  
✅ **المسارات المتاحة**  
✅ **أوامر مفيدة**  
✅ **دليل الاستخدام**  
✅ **استكشاف الأخطاء**  
✅ **معلومات الترخيص**  

