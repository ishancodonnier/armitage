<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\CategoryItemSubcategory;

class ItemController extends Controller
{
    public function index()
    {
        $pagetitle = 'Item';
        $items = Item::with('categories')->with(['subCategories' => function ($subQuery) {
            $subQuery->with('category');
        }])->get();
        return view('item.index', compact('pagetitle', 'items'));
    }

    public function create()
    {
        $pagetitle = 'Item Create';
        $category = Category::where('status', 1)->get();
        return view('item.create', compact('pagetitle', 'category'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'website' => 'nullable',
                'description' => 'required',
                'category_id.*' => 'required',
                'sub_category_id.*' => 'nullable',
                'item_image.*' => 'required',
                'image_title.*' => 'nullable',
                'status' => 'required',
                'grown_for' => 'nullable',
                'botanical_name' => 'nullable',
            ]);

            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'website' => $request->website,
                'status' => $request->status,
                'grown_for' => $request->grown_for,
                'botanical_name' => $request->botanical_name,
            ];

            $item = Item::create($data);

            if ($request->file('item_image')) {
                foreach ($request->file('item_image') as $key => $image) {
                    $file = $image;
                    $randomTime = str_shuffle(round(microtime(true)));
                    $image_name = $randomTime . "." . $file->getClientOriginalExtension();
                    $file->move('./../../allanArmitage/app_images/item_images/', $image_name);

                    $image_data = [
                        'item_id' => $item->id,
                        'image' => $image_name,
                        'title' => $request->image_title[$key] ?? null,
                    ];
                    ItemImage::create($image_data);
                }
            }

            if (isset($request->new_category) && $request->new_category != null) {
                foreach ($request->new_category as $key => $value) {
                    $category = Category::where('title', $value)->first();
                    if (!$category) {
                        $category = Category::create([
                            'title' => $value,
                            'image' => null,
                            'status' => true,
                        ]);
                    }

                    if (isset($request->new_sub_category[$key]) && $request->new_sub_category[$key] != null) {
                        $sub_category = SubCategory::where('title', $request->new_sub_category[$key])->where('category_id', $category->id)->first();
                        if (!$sub_category) {
                            $sub_category = SubCategory::create([
                                'title' => $request->new_sub_category[$key],
                                'image' =>  null,
                                'category_id' => $category->id,
                                'status' => true,
                            ]);
                        }
                    }

                    $category_data = [
                        'category_id' => $category->id,
                        'sub_category_id' => $sub_category->id ?? null,
                        'item_id' => $item->id,
                    ];

                    CategoryItemSubcategory::create($category_data);
                }
            }

            if(isset($request->category_id) && $request->category_id != null) {
                foreach ($request->category_id as $key => $value) {

                    $category_data = [
                        'category_id' => $value,
                        'sub_category_id' => $request->sub_category_id[$key] ?? null,
                        'item_id' => $item->id,
                    ];

                    if (isset($request->new_sub_category[$key]) && $request->new_sub_category[$key] != null) {
                        $sub_category = SubCategory::where('title', $request->new_sub_category[$key])->where('category_id', $value)->first();
                        if (!$sub_category) {
                            $new_sub = SubCategory::create([
                                'title' => $request->new_sub_category[$key],
                                'image' =>  null,
                                'category_id' => $value,
                                'status' => true,
                            ]);

                            $category_data['sub_category_id'] = $new_sub->id;
                        } else {
                            $category_data['sub_category_id'] = $sub_category->id;
                        }
                    }

                    CategoryItemSubcategory::create($category_data);
                }
            }

            return redirect()->route('item.index')->with('success', 'Item created successfully!');
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
        $pagetitle = 'Item Edit';

        $item = Item::where('id', $id)->with(['categories', 'item_image'])->with(['subCategories' => function ($subQuery) {
            $subQuery->with('category');
        }])->first();

        if (!$item) {
            return redirect()->route('item.index')->with('error', 'Item Not Found');
        }

        $category = Category::where('status', 1)->get();
        return view('item.edit', compact('pagetitle', 'category', 'item'));
    }

    public function update(Request $request, $id)
    {
        try {
            $item = Item::where('id', $id)->first();

            if (!$item) {
                return redirect()->route('item.index')->with('error', 'Item Not Found');
            }

            $request->validate([
                'title' => 'required',
                'website' => 'nullable',
                'description' => 'required',
                'category_id.*' => 'required',
                'sub_category_id.*' => 'nullable',
                'item_image.*' => 'nullable',
                'image_title.*' => 'nullable',
                'status' => 'required',
                'grown_for' => 'nullable',
                'botanical_name' => 'nullable',
            ]);

            $data = [
                'title' => $request->title ?? '',
                'description' => $request->description ?? '',
                'website' => $request->website ?? '',
                'status' => $request->status ?? '',
                'grown_for' => $request->grown_for ?? '',
                'botanical_name' => $request->botanical_name ?? '',
            ];

            CategoryItemSubcategory::where('item_id', $item->id)->delete();
            if (isset($request->new_category) && $request->new_category != null) {
                foreach ($request->new_category as $key => $value) {
                    $category = Category::where('title', $value)->first();
                    if (!$category) {
                        $category = Category::create([
                            'title' => $value ?? '',
                            'image' => '',
                            'status' => true,
                        ]);
                    }

                    if (isset($request->new_sub_category[$key]) && $request->new_sub_category[$key] != null) {
                        $sub_category = SubCategory::where('title', $request->new_sub_category[$key])->where('category_id', $category->id)->first();
                        if (!$sub_category) {
                            $sub_category = SubCategory::create([
                                'title' => $request->new_sub_category[$key] ?? '',
                                'image' => '',
                                'category_id' => $category->id ?? '',
                                'status' => true,
                            ]);
                        }
                    }

                    $category_data = [
                        'category_id' => $category->id ?? '',
                        'sub_category_id' => $sub_category->id ?? '',
                        'item_id' => $item->id ?? '',
                    ];

                    CategoryItemSubcategory::create($category_data);
                }
            }

            if(isset($request->category_id) && $request->category_id != null) {
                foreach ($request->category_id as $key => $value) {

                    $category_data = [
                        'category_id' => $value ?? '',
                        'sub_category_id' => $request->sub_category_id[$key] ?? '',
                        'item_id' => $item->id ?? '',
                    ];

                    if (isset($request->new_sub_category[$key]) && $request->new_sub_category[$key] != null) {
                        $sub_category = SubCategory::where('title', $request->new_sub_category[$key])->where('category_id', $value)->first();
                        if (!$sub_category) {
                            $new_sub = SubCategory::create([
                                'title' => $request->new_sub_category[$key] ?? '',
                                'image' =>  '',
                                'category_id' => $value ?? '',
                                'status' => true,
                            ]);

                            $category_data['sub_category_id'] = $new_sub->id ?? '';
                        } else {
                            $category_data['sub_category_id'] = $sub_category->id ?? '';
                        }
                    }

                    CategoryItemSubcategory::create($category_data);
                }
            }

            $item_image = ItemImage::where('item_id', $item->id)->get();

            if ($request->image_title) {
                foreach ($item_image as $key => $i_img) {
                    $i_img->update([
                        'title' => $request->image_title[$key] ?? '',
                    ]);
                }
            }

            if ($request->file('item_image')) {
                foreach ($item_image as $i_img) {
                    $fileToDelete = './../../allanArmitage/app_images/item_images/' . $i_img->image;
                    if (file_exists($fileToDelete)) {
                        unlink($fileToDelete);
                    }
                    $i_img->delete();
                }

                foreach ($request->file('item_image') as $key => $image) {
                    $file = $image;
                    $randomTime = str_shuffle(round(microtime(true)));
                    $image_name = $randomTime . "." . $file->getClientOriginalExtension();
                    $file->move('./../../allanArmitage/app_images/item_images/', $image_name);

                    $image_data = [
                        'item_id' => $item->id ?? '',
                        'image' => $image_name ?? '',
                        'title' => $request->image_title[$key] ?? '',
                    ];
                    ItemImage::create($image_data);
                }
            }

            $item->update($data);

            return redirect()->route('item.index')->with('success', 'Item updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $item = Item::where('id', $id)->first();
            $item->update([
                'is_delete' => true
            ]);
            return redirect()->route('item.index')->with('success', 'Item deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show_sub_category_select($category_id)
    {
        try {
            $sub_category = SubCategory::where('category_id', $category_id)->where('status', 1)->get();

            if ($sub_category->toArray()) {
                $result['data'] = $sub_category->toArray();
                $result['status'] = 1;
                $result['msg'] = "Sub Category Found";
            } else {
                $result['data'] = [];
                $result['status'] = 0;
                $result['msg'] = "No Sub Category Found";
            }

            return response()->json($result, 200);
            exit();
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function delete_image_from_item($item_id, $image_id) {
        try {
            ItemImage::where('id', $image_id)->where('item_id', $item_id)->delete();
            $result['status'] = 1;
            $result['msg'] = "Image deleted successfully";
            return response()->json($result, 200);
            exit();
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
