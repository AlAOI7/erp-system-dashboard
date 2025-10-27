<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

        public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string'
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'تم إضافة الفئة بنجاح.');
    }

    public function show(Category $category)
    {
        $category->load('products');
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string'
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'تم تحديث الفئة بنجاح.');
    }

    public function destroy(Category $category)
    {
        // التحقق من وجود منتجات مرتبطة بالفئة
        if ($category->products()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'لا يمكن حذف الفئة لأنها تحتوي على منتجات.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'تم حذف الفئة بنجاح.');
    }
}