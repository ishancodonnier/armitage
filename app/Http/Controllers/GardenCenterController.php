<?php

namespace App\Http\Controllers;

use App\Models\GardenCenter;
use Illuminate\Http\Request;
use App\Models\GardenCenterImage;
use DateTime;
use App\Models\Region;
use App\Models\States;
use App\Models\Country;

class GardenCenterController extends Controller
{
    public function index()
    {
        $pagetitle = 'Garden Center';
        $garden_center = GardenCenter::get();
        return view('garden_center.index', compact('pagetitle', 'garden_center'));
    }

    public function create()
    {
        $pagetitle = 'Garden Center Create';
        $region = Region::get();
        $states = States::get();
        $country = Country::get();
        return view('garden_center.create', compact('pagetitle', 'region', 'states', 'country'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'garden_name' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zipcode' => 'required',
                'garden_image.*' => 'required',
                'status' => 'required',
                'webside' => 'nullable',
                'email' => 'nullable',
                'mobile_number' => 'nullable',
                'description' => 'nullable',
                'region' => 'nullable',
                'garden_image_title.*' => 'nullable',
            ]);

            $data = [
                'garden_name' => $request->garden_name ?? '',
                'description' => $request->description ?? '',
                'address' => $request->address ?? '',
                'mobile_number' => $request->mobile_number ?? '',
                'city' => $request->city ?? '',
                'state' => $request->state ?? '',
                'contrary' => $request->contrary ?? '',
                'zipcode' => $request->zipcode ?? '',
                'email' => $request->email ?? '',
                'webside' => $request->webside ?? '',
                'region' => $request->region ?? '',
                'longitude' => $request->longitude ?? '',
                'latitude' => $request->latitude ?? '',
                'created_date' => new DateTime(),
                'updated_date' => new DateTime(),
                'status' => $request->status,
            ];

            $garden_center = GardenCenter::create($data);

            if ($request->file('garden_image')) {
                foreach ($request->file('garden_image') as $key => $image) {
                    $file = $image;
                    $randomTime = str_shuffle(round(microtime(true)));
                    $image_name = $randomTime . "." . $file->getClientOriginalExtension();
                    $file->move('./../../allanArmitage/app_images/center_garden_image/', $image_name);

                    $image_data = [
                        'garden_center_id' => $garden_center->garden_center_id,
                        'image' => $image_name,
                        'caption' => $request->garden_image_title[$key] ?? '',
                        'favorite' => 0,
                        'created_date' => new DateTime(),
                        'updated_date' => new DateTime()
                    ];
                    GardenCenterImage::create($image_data);
                }
            }

            return redirect()->route('garden.center.index')->with('success', 'Garden Center created successfully!');
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
        $garden_center = GardenCenter::where('garden_center_id', $id)->with('garden_center_image')->first();
        if (!$garden_center) {
            return redirect()->route('garden.center.index')->with('error', 'Garden Center Not Found');
        }
        $pagetitle = 'Garden Center Edit';
        $region = Region::get();
        $states = States::get();
        $country = Country::get();
        return view('garden_center.edit', compact('pagetitle', 'region', 'states', 'country', 'garden_center'));
    }

    public function update(Request $request, $id)
    {
        try {
            $garden_center = GardenCenter::where('garden_center_id', $id)->first();

            if (!$garden_center) {
                return redirect()->route('garden.center.index')->with('error', 'Garden Center Not Found');
            }

            $request->validate([
                'garden_name' => 'required',
                'webside' => 'nullable',
                'email' => 'nullable',
                'mobile_number' => 'nullable',
                'latitude' => 'required',
                'longitude' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zipcode' => 'required',
                'region' => 'nullable',
                'description' => 'nullable',
                'garden_image.*' => 'required',
                'garden_image_title.*' => 'nullable',
                'status' => 'required',
            ]);

            $data = [
                'garden_name' => $request->garden_name ?? '',
                'description' => $request->description ?? '',
                'address' => $request->address ?? '',
                'mobile_number' => $request->mobile_number ?? '',
                'city' => $request->city ?? '',
                'state' => $request->state ?? '',
                'contrary' => '',
                'zipcode' => $request->zipcode ?? '',
                'email' => $request->email ?? '',
                'webside' => $request->webside ?? '',
                'region' => $request->region ?? '',
                'longitude' => $request->longitude ?? '',
                'latitude' => $request->latitude ?? '',
                'updated_date' => new DateTime(),
                'status' => $request->status,
            ];

            $garden_center_image = GardenCenterImage::where('garden_center_id', $garden_center->garden_center_id )->get();

            if ($request->garden_image_title) {
                foreach ($garden_center_image as $key => $i_img) {
                    $i_img->update([
                        'title' => $request->garden_image_title[$key] ?? '',
                    ]);
                }
            }

            if ($request->file('garden_image')) {
                foreach ($garden_center_image as $cg_img) {
                    $fileToDelete = './../../allanArmitage/app_images/center_garden_image/' . $cg_img->image;
                    if (file_exists($fileToDelete)) {
                        unlink($fileToDelete);
                    }
                    $cg_img->delete();
                }

                foreach ($request->file('garden_image') as $key => $image) {
                    $file = $image;
                    $randomTime = str_shuffle(round(microtime(true)));
                    $image_name = $randomTime . "." . $file->getClientOriginalExtension();
                    $file->move('./../../allanArmitage/app_images/center_garden_image/', $image_name);

                    $image_data = [
                        'garden_center_id' => $garden_center->garden_center_id,
                        'image' => $image_name,
                        'caption' => $request->garden_image_title[$key] ?? null,
                        'favorite' => 0,
                        'created_date' => new DateTime(),
                        'updated_date' => new DateTime()
                    ];
                    GardenCenterImage::create($image_data);
                }
            }

            $garden_center->update($data);

            return redirect()->route('garden.center.index')->with('success', 'Garden Center updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $garden_center = GardenCenter::where('id', $id)->first();
            $garden_center->update([
                'is_delete' => true
            ]);
            return redirect()->route('garden.center.index')->with('success', 'Garden Center deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function restore($id)
    {
        try {
            $garden_center = GardenCenter::where('id', $id)->first();
            $garden_center->update([
                'is_delete' => false
            ]);
            return redirect()->route('garden.center.index')->with('success', 'Garden Center restored successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function delete_image_from_garden_center($garden_center_id, $garden_image_id) {
        try {
            GardenCenterImage::where('garden_center_image_id', $garden_image_id)->where('garden_center_id', $garden_center_id)->delete();
            $result['status'] = 1;
            $result['msg'] = "Image deleted successfully";
            return response()->json($result, 200);
            exit();
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
