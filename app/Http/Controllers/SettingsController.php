<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        $settings = [
            'site_name' => config('app.name', 'نظام ERP'),
            'site_description' => Cache::get('site_description', ''),
            'contact_email' => Cache::get('contact_email', ''),
            'phone_number' => Cache::get('phone_number', ''),
            'address' => Cache::get('address', ''),
            'currency' => Cache::get('currency', 'SAR'),
            'items_per_page' => Cache::get('items_per_page', 10)
        ];

        return view('settings.index', compact('settings', 'user'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'currency' => 'required|string|max:10',
            'items_per_page' => 'required|integer|min:5|max:100'
        ]);

        // تحديث إعدادات التطبيق
        config(['app.name' => $request->site_name]);

        // حفظ الإعدادات في الكاش
        Cache::forever('site_description', $request->site_description);
        Cache::forever('contact_email', $request->contact_email);
        Cache::forever('phone_number', $request->phone_number);
        Cache::forever('address', $request->address);
        Cache::forever('currency', $request->currency);
        Cache::forever('items_per_page', $request->items_per_page);

        return redirect()->route('settings.index')
            ->with('success', 'تم حفظ الإعدادات بنجاح.');
    }
}