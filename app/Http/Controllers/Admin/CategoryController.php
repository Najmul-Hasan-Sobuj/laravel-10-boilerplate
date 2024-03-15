<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.categories.index', [
            'categories' => Category::with('children')->whereNull('parent_id')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->buildCategories(Category::active()->get());
        $categoriesOptions = $this->buildCategoriesOptions($categories);

        return view('admin.pages.categories.create', [
            'categoriesOptions' => $categoriesOptions,
        ]);
    }

    private function buildCategories($categories, $parentId = null)
    {
        $result = [];

        foreach ($categories as $category) {
            if ($category->parent_id == $parentId) {
                $children = $this->buildCategories($categories, $category->id);

                if ($children) {
                    $category->children = $children;
                }

                $result[] = $category;
            }
        }

        return $result;
    }

    private function buildCategoriesOptions($selectedId = null, $excludeId = null, $parentId = null, $prefix = '')
    {
        $categories = Category::active()->where('parent_id', $parentId)->where('id', '!=', $excludeId)->get();
        $options = '';

        foreach ($categories as $category) {
            $selected = $category->id == $selectedId ? 'selected' : '';
            $options .= '<option value="' . $category->id . '" ' . $selected . '>' . $prefix . $category->name . '</option>';
            $options .= $this->buildCategoriesOptions($selectedId, $excludeId, $category->id, $prefix . '--');
        }

        return $options;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.pages.categories.show', [
            'category' => Category::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $categoriesOptions = $this->buildCategoriesOptions($category->parent_id, $category->id);

        return view('admin.pages.categories.edit', [
            'category' => $category,
            'categoriesOptions' => $categoriesOptions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        Category::findOrFail($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::findOrFail($id)->delete();
    }
}
