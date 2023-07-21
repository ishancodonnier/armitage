<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainCategory;

class MainCategoryController extends Controller
{
    public function index()
    {
        $pagetitle = 'Main Category';
        $main_category = MainCategory::get();
        return view('main_category.index', compact('pagetitle', 'main_category'));
    }

    public function create()
    {
        $pagetitle = 'Main Category Create';
        return view('main_category.create', compact('pagetitle'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'main_category_image' => 'nullable|image',
                'status' => 'required'
            ]);

            $data = [
                'title' => $request->title ?? '',
                'status' => $request->status ?? '',
                'image' => '',
            ];

            if ($request->file('main_category_image')) {
                $file = $request->file('main_category_image');
                $randomTime = str_shuffle(round(microtime(true)));
                $new_data['main_category_image'] = $randomTime . "." . $file->getClientOriginalExtension();
                $file->move('./../../allanArmitage/app_images/main_category_images/', $new_data['main_category_image']);

                $data['image'] = $new_data['main_category_image'];
            }

            MainCategory::create($data);

            return redirect()->route('main.category.index')->with('success', 'Main Category created successfully!');
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
        $pagetitle = 'Main Category Edit';
        $main_category = MainCategory::where('id', $id)->first();
        if (!$main_category) {
            return redirect()->route('main.category.index')->with('error', 'Main Category Not Found');
        }
        return view('main_category.edit', compact('pagetitle', 'main_category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $main_category = MainCategory::where('id', $id)->first();

            if (!$main_category) {
                return redirect()->route('main.category.index')->with('error', 'Main Category Not Found');
            }

            $request->validate([
                'title' => 'required',
                'main_category_image' => 'nullable|image',
                'status' => 'required'
            ]);

            $data = [
                'title' => $request->title ?? '',
                'status' => $request->status ?? '',
            ];

            if ($request->file('main_category_image')) {
                $fileToDelete = './../../allanArmitage/app_images/main_category_images/' . $main_category->image;

                if (file_exists($fileToDelete) && $main_category->image != null) {
                    unlink($fileToDelete);
                }

                $file = $request->file('main_category_image');
                $randomTime = str_shuffle(round(microtime(true)));
                $new_data['main_category_image'] = $randomTime . "." . $file->getClientOriginalExtension();
                $file->move('./../../allanArmitage/app_images/main_category_images/', $new_data['main_category_image']);

                $data['image'] = $new_data['main_category_image'];
            }

            $main_category->update($data);

            return redirect()->route('main.category.index')->with('success', 'MainCategory updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $main_category = MainCategory::where('id', $id)->first();
            $main_category->update([
                'is_delete' => true
            ]);
            return redirect()->route('main.category.index')->with('success', 'Main Category deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function restore($id)
    {
        try {
            $category = MainCategory::where('id', $id)->first();
            $category->update([
                'is_delete' => false
            ]);
            return redirect()->route('category.index')->with('success', 'Main Category restored successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
