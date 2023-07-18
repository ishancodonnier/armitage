<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Models\CategoryMainCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $pagetitle = 'Category';
        $category = Category::with('main_category')->get();
        return view('category.index', compact('pagetitle', 'category'));
    }

    public function create()
    {
        $pagetitle = 'Category Create';
        $main_category = MainCategory::where('status', 1)->get();
        return view('category.create', compact('pagetitle', 'main_category'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'category_image' => 'nullable|image',
                'main_category_id.*' => 'nullable',
                'status' => 'required'
            ]);

            $data = [
                'title' => $request->title,
                'status' => $request->status,
            ];

            if ($request->file('category_image')) {
                $file = $request->file('category_image');
                $randomTime = str_shuffle(round(microtime(true)));
                $new_data['category_image'] = $randomTime . "." . $file->getClientOriginalExtension();
                $file->move(public_path('images/category_images/'), $new_data['category_image']);
                $data['image'] = $new_data['category_image'];
            }

            $category = Category::create($data);
            $category->main_category()->attach($request->main_category_id);

            return redirect()->route('category.index')->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $pagetitle = 'Category Edit';
        $category = Category::where('id', $id)->with('main_category')->first();
        if(!$category) {
            return redirect()->route('category.index')->with('error', 'Category Not Found');
        }
        $main_category = MainCategory::where('status', 1)->get();
        return view('category.edit', compact('pagetitle', 'category', 'main_category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::where('id', $id)->first();

            if(!$category) {
                return redirect()->route('category.index')->with('error', 'Category Not Found');
            }

            $data = $request->validate([
                'title' => 'required',
                'category_image' => 'nullable|image',
                'main_category_id.*' => 'nullable',
                'status' => 'required'
            ]);

            if ($request->file('category_image')) {
                $fileToDelete = public_path('images/category_images/') . $category->image;

                if (file_exists($fileToDelete) && $category->image != null) {
                    unlink($fileToDelete);
                }

                $file = $request->file('category_image');
                $randomTime = str_shuffle(round(microtime(true)));
                $new_data['category_image'] = $randomTime . "." . $file->getClientOriginalExtension();
                $file->move(public_path('images/category_images/'), $new_data['category_image']);

                $data['image'] = $new_data['category_image'];
            }

            $category->main_category()->sync($request->main_category_id);
            $category->update($data);

            return redirect()->route('category.index')->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::where('id', $id)->first();
            $category->update([
                'is_delete' => true
            ]);
            return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function restore($id)
    {
        try {
            $category = Category::where('id', $id)->first();
            $category->update([
                'is_delete' => false
            ]);
            return redirect()->route('category.index')->with('success', 'Category restored successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
