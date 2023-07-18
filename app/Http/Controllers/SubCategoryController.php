<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $pagetitle = 'Sub Category';
        $sub_category = SubCategory::with('category')->get();
        return view('sub_category.index', compact('pagetitle', 'sub_category'));
    }

    public function create()
    {
        $pagetitle = 'Sub Category Create';
        $category = Category::where('status', 1)->get();
        return view('sub_category.create', compact('pagetitle', 'category'));
    }

    public function store(Request $request)
    {

        try {
            $request->validate([
                'title' => 'required',
                'category_id.*' => 'required',
                'sub_category_image' => 'nullable|image',
                'status' => 'required'
            ]);

            $new_image = '';
            if ($request->file('sub_category_image')) {
                $file = $request->file('sub_category_image');
                $randomTime = str_shuffle(round(microtime(true)));
                $new_data['sub_category_image'] = $randomTime . "." . $file->getClientOriginalExtension();
                $file->move(public_path('images/sub_category_images/'), $new_data['sub_category_image']);
                $new_image = $new_data['sub_category_image'];
            }

            foreach($request->category_id as $value) {
                $data = [
                    'title' => $request->title,
                    'image' =>  $new_image,
                    'category_id' => $value,
                    'status' => $request->status,
                ];
                SubCategory::create($data);
            }


            return redirect()->route('sub.category.index')->with('success', 'Sub Category created successfully!');
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
        $pagetitle = 'Sub Category Edit';
        $sub_category = SubCategory::where('id', $id)->first();
        if(!$sub_category) {
            return redirect()->route('sub.category.index')->with('error', 'Sub Category Not Found');
        }
        $category = Category::where('status', 1)->get();
        return view('sub_category.edit', compact('pagetitle', 'category', 'sub_category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $sub_category = SubCategory::where('id', $id)->first();

            if(!$sub_category) {
                return redirect()->route('category.index')->with('error', 'Sub Category Not Found');
            }

            $data = $request->validate([
                'title' => 'required',
                'category_id' => 'required',
                'sub_category_image' => 'nullable|image',
                'status' => 'required'
            ]);

            $category = Category::where('id', $data['category_id'])->first();
            if(!$category){
                return back()->with('error', 'Category Not Found');
            }

            if ($request->file('sub_category_image')) {
                $sub_category_image = SubCategory::where('image', $sub_category->image)->count();
                if($sub_category_image <= 1) {
                    $fileToDelete = public_path('images/sub_category_images/') . $sub_category->image;
                    if (file_exists($fileToDelete) && $sub_category->image != null) {
                        unlink($fileToDelete);
                    }
                }
                $file = $request->file('sub_category_image');
                $randomTime = str_shuffle(round(microtime(true)));
                $new_data['sub_category_image'] = $randomTime . "." . $file->getClientOriginalExtension();
                $file->move(public_path('images/sub_category_images/'), $new_data['sub_category_image']);
                $data['image'] = $new_data['sub_category_image'];
            }

            $sub_category ->update($data);

            return redirect()->route('sub.category.index')->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $sub_category = SubCategory::where('id', $id)->first();
            $sub_category->update([
                'is_delete' => true
            ]);
            return redirect()->route('sub.category.index')->with('success', 'Sub Category deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function restore($id)
    {
        try {
            $sub_category = SubCategory::where('id', $id)->first();
            $sub_category->update([
                'is_delete' => false
            ]);
            return redirect()->route('sub.category.index')->with('success', 'Sub Category restored successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
