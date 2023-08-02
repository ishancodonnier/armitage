<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\SideMenu;
use DateTime;

class SideMenuController extends Controller
{
    public function index()
    {
        $pagetitle = 'Side Menu';
        $side_menu = SideMenu::with(['category', 'item'])->get();
        return view('side_menu.index', compact('side_menu', 'pagetitle'));
    }

    public function create()
    {
        $pagetitle = 'Side Menu Create';
        $category = Category::where('status', 1)->where('is_delete', 0)->get();
        $item = Item::where('status', 1)->where('is_delete', 0)->get();
        return view('side_menu.create', compact('category', 'item', 'pagetitle'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                "category_type" => "required",
                "is_active" => "required",
                "category_id" => "required",
                "item_id" => "required",
                "sidemenu_name" => "required",
                "sidemenu_images" => "nullable"
            ]);

            $data = [
                'category_id' => $request->category_id,
                'item_id' => $request->item_id,
                'category_type' => $request->category_type,
                'main_category_id' => 0,
                'sidemenu_type' => 0,
                'sidemenu_name' => $request->sidemenu_name,
                'sidemenu_images' => '',
                'is_active' => $request->is_active,
                'is_delete' => 0,
                'created_date' => new DateTime(),
                'updated_date' => new DateTime(),
            ];

            if ($request->file('sidemenu_images')) {
                $file = $request->file('sidemenu_images');
                $randomTime = str_shuffle(round(microtime(true)));
                $new_data['sidemenu_images'] = $randomTime . "." . $file->getClientOriginalExtension();
                $file->move('./../../allanArmitage/app_images/sidemenu_images/', $new_data['sidemenu_images']);

                $data['sidemenu_images'] = $new_data['sidemenu_images'];
            } else {
                if ($request->category_id != 0 && $request->item_id == 0) {
                    $category = Category::where('id', $request->category_id)->first();

                    if($category->image) {
                        $sourceFilePath = './../../allanArmitage/app_images/category_images/' . $category->image;
                        $destinationFilePath = './../../allanArmitage/app_images/sidemenu_images/' . $category->image;

                        if (copy($sourceFilePath, $destinationFilePath)) {
                            $data['sidemenu_images'] = $category->image;
                        } else {
                            $data['sidemenu_images'] = '';
                        }
                    }
                } else {
                    $item = ItemImage::where('item_id', $request->item_id)->first();

                    if($item->image) {
                        $sourceFilePath = './../../allanArmitage/app_images/item_images/' . $item->image;
                        $destinationFilePath = './../../allanArmitage/app_images/sidemenu_images/' . $item->image;

                        if (copy($sourceFilePath, $destinationFilePath)) {
                            $data['sidemenu_images'] = $item->image;
                        } else {
                            $data['sidemenu_images'] = '';
                        }
                    }
                }
            }
            SideMenu::create($data);

            return redirect()->route('side.menu.index')->with('success', 'Side Menu created successfully!');
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
        $pagetitle = 'Side Menu Edit';
        $side_menu = SideMenu::where('id', $id)->with(['category', 'item'])->first();
        $category = Category::where('status', 1)->where('is_delete', 0)->get();
        $item = Item::where('status', 1)->where('is_delete', 0)->get();
        return view('side_menu.edit', compact('category', 'item', 'pagetitle', 'side_menu'));
    }

    public function update(Request $request, $id)
    {
        try {
            $side_menu = SideMenu::where('id', $id)->get();

            $request->validate([
                "category_type" => "required",
                "is_active" => "required",
                "category_id" => "required",
                "item_id" => "required
                ",
                "sidemenu_name" => "required",
                "sidemenu_images" => "nullable"
            ]);

            $data = [
                'category_id' => $request->category_id,
                'item_id' => $request->item_id,
                'category_type' => $request->category_type,
                'main_category_id' => 0,
                'sidemenu_type' => 0,
                'sidemenu_name' => $request->sidemenu_name,
                'sidemenu_images' => '',
                'is_active' => $request->is_active,
                'is_delete' => 0,
                'updated_date' => new DateTime(),
            ];

            $fileToDelete = './../../allanArmitage/app_images/sidemenu_images/' . $side_menu->image;

            if (file_exists($fileToDelete) && $side_menu->image != null) {
                unlink($fileToDelete);
            }

            if ($request->file('sidemenu_images')) {
                $file = $request->file('sidemenu_images');
                $randomTime = str_shuffle(round(microtime(true)));
                $new_data['sidemenu_images'] = $randomTime . "." . $file->getClientOriginalExtension();
                $file->move('./../../allanArmitage/app_images/sidemenu_images/', $new_data['sidemenu_images']);

                $data['sidemenu_images'] = $new_data['sidemenu_images'];
            } else {
                if ($request->category_id != 0 && $request->item_id == 0) {
                    $category = Category::where('id', $request->category_id)->first();

                    $sourceFilePath = './../../allanArmitage/app_images/category_images/' . $category->image;
                    $destinationFilePath = './../../allanArmitage/app_images/sidemenu_images/' . $category->image;

                    if (copy($sourceFilePath, $destinationFilePath)) {
                        $data['sidemenu_images'] = $category->image;
                    } else {
                        $data['sidemenu_images'] = '';
                    }
                } else {
                    $item = ItemImage::where('item_id', $request->item_id)->first();

                    $sourceFilePath = './../../allanArmitage/app_images/item_images/' . $item->image;
                    $destinationFilePath = './../../allanArmitage/app_images/sidemenu_images/' . $item->image;

                    if (copy($sourceFilePath, $destinationFilePath)) {
                        $data['sidemenu_images'] = $item->image;
                    } else {
                        $data['sidemenu_images'] = '';
                    }
                }
            }

            $side_menu->update($data);

            return redirect()->route('side.menu.index')->with('success', 'Side Menu updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $side_menu = SideMenu::where('id', $id)->first();
            $side_menu->update([
                'is_active' => false,
                'updated_date' => new DateTime(),
            ]);
            return redirect()->route('side.menu.index')->with('success', 'Side Menu Status Inactive!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function restore($id)
    {
        try {
            $side_menu = SideMenu::where('id', $id)->first();
            $side_menu->update([
                'is_active' => true,
                'updated_date' => new DateTime(),
            ]);
            return redirect()->route('side.menu.index')->with('success', 'Side Menu Status Active!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $side_menu = SideMenu::where('id', $id)->delete();
            return redirect()->route('side.menu.index')->with('success', 'Side Menu Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function check_unique_fields($category_type, $id)
    {
        $data['status'] = true;
        if($category_type == 0)
        {
            $category_side_menu = SideMenu::where('category_id', $id)->first();
            if($category_side_menu) {
                $data['status'] = false;
                $data['msg'] = "The Category Already Exist";
            }
        } else {
            $item_side_menu = SideMenu::where('item_id', $id)->first();
            if($item_side_menu) {
                $data['status'] = false;
                $data['msg'] = "The Item Already Exist";
            }
        }

        return response()->json($data, 200);
        exit();
    }
}
