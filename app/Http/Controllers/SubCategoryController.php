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
        $sub_category = SubCategory::with('category')->orderBy('id', 'desc')->get();
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

            $category_ids = $request->category_id;
            $sub_category = SubCategory::where('title', $request->title)->whereIn('category_id', $category_ids)->get();
            foreach($sub_category as $sub) {
                if (($key = array_search($sub->category_id, $category_ids)) !== false) {
                    unset($category_ids[$key]);
                }
            }

            $new_image = '';
            if ($request->file('sub_category_image')) {
                $file = $request->file('sub_category_image');
                $randomTime = str_shuffle(round(microtime(true)));
                $new_data['sub_category_image'] = $randomTime . "." . $file->getClientOriginalExtension();
                $file->move('./../../allanArmitage/app_images/sub_category_images/', $new_data['sub_category_image']);
                $new_image = $new_data['sub_category_image'];
            }
            if(count($category_ids) > 0) {
                foreach($category_ids as $value) {
                    $data = [
                        'title' => $request->title ?? '',
                        'image' =>  $new_image ?? '',
                        'category_id' => $value ?? '',
                        'status' => $request->status ?? '',
                    ];
                    SubCategory::create($data);
                }
            } else {
                return back()->with('error', 'Sub Category already exist.');
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

            if($sub_category->category_id != $request->category_id) {
                $category = Category::where('id', $request->category_id)->with('sub_category')->first();
                foreach($category->sub_category as $sub) {
                    if($sub->title == $request->title) {
                        return back()->with('error', 'Sub Category already exist.');
                    }
                }
            }

            if($sub_category->title != $request->title) {
                $exist_sub_category = SubCategory::where('category_id', $request->category_id)->where('title', $request->title)->first();
                if($exist_sub_category) {
                    return back()->with('error', 'Sub Category already exist with same category.');
                }
            }

            $request->validate([
                'title' => 'required',
                'category_id' => 'required',
                'sub_category_image' => 'nullable|image',
                'status' => 'required'
            ]);

            $data = [
                'title' => $request->title ?? '',
                'category_id' => $request->category_id ?? '',
                'status' => $request->status ?? '',
            ];

            $category = Category::where('id', $data['category_id'])->first();
            if(!$category){
                return back()->with('error', 'Category Not Found');
            }

            if ($request->file('sub_category_image')) {
                $sub_category_image = SubCategory::where('image', $sub_category->image)->count();
                if($sub_category_image <= 1) {
                    $fileToDelete = './../../allanArmitage/app_images/sub_category_images/' . $sub_category->image;
                    if (file_exists($fileToDelete) && $sub_category->image != null) {
                        unlink($fileToDelete);
                    }
                }
                $file = $request->file('sub_category_image');
                $randomTime = str_shuffle(round(microtime(true)));
                $new_data['sub_category_image'] = $randomTime . "." . $file->getClientOriginalExtension();
                $file->move('./../../allanArmitage/app_images/sub_category_images/', $new_data['sub_category_image']);
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
