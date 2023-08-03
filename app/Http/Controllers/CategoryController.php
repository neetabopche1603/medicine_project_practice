<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Category::all();
                return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('status', function ($row) {
                        return $row->status == 1 ? '<span class="badge badge-info">Active</span>' : '<span class="badge badge-dark">Block</span>';
                    })

                    ->addColumn('images', function ($row) {
                        return $row->image != null ? "<img src='$row->image' alt='$row->image' width='70px' class='companyimgPopup' height='70px'>" : "<img src='https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-7.gif' class='companyimgPopup' alt='https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-7.gif' width='70px' height='70px'>";
                    })


                    ->addColumn('checkbox', function ($row) {
                        return '<div class="dt-checkbox">
                        <input type="checkbox" id="example-select-all" class="sub_chk" data-id="' . $row->id . '">
                        <span class="dt-checkbox-label"></span>
                    </div>';
                    })
                    ->addColumn('action', function ($row) {

                        $btn = '
                        
                        <a href="javascript:void(0)" data-toggle="tooltip" data-target="#editDataForm"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-success editBtn">
                        Edit
                        </a>

                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteBtn">Delete</a>
                        ';

                        return $btn;
                    })
                    ->rawColumns(['action', 'status', 'images', 'checkbox'])
                    ->make(true);
            }
            return view('adminPanel.category.index');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // Store category Function
    public function categoryStore(Request $request)
    {
        try {
            $categoryStore = new Category();
            $categoryStore->category = $request->category_name;
            $categoryStore->status = $request->status;

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = 'backend/categoryImg';
                $categoryStore->image = url($destinationPath . "/" . $filename);
                $file->move($destinationPath, $filename);
            }
            $categoryStore->save();
            return response()->json([
                'message' => "data add successfully."
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // category Edit Function
    public function categoryEdit($id)
    {
        try {
            $categoryEdit = Category::find($id);
            return response()->json([
                'msg' => "Show data Edit Time",
                'status' => 200,
                'editCategoryData' => $categoryEdit
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // category Update Function
    public function categoryUpdate(Request $request)
    {
        // echo "<pre>";
        //     print_r($request->all());
        //     echo "</pre>";
        //     die();
        try {
            $categoryUpdate = Category::find($request->id);
            $categoryUpdate->category = $request->category_name;
            $categoryUpdate->status = $request->status;

            // Delete previous image file

            if ($request->hasFile('photo')) {
                $destinationPath = 'backend/categoryImg/';
                // Delete the old image file
                if ($categoryUpdate->image != null) {
                    $oldImagePath = public_path($destinationPath . basename($categoryUpdate->image));
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $companyImg = $request->file('photo');
                $companyImgName = date('YmdHis') . '.' . $companyImg->getClientOriginalExtension();
                $companyImg->move(public_path($destinationPath), $companyImgName);

                $categoryUpdate->image = url($destinationPath . $companyImgName);
            }

            $success = $categoryUpdate->update();
            if ($success) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'faild']);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // category Delete Function
    public function categoryDelete(Request $request)
    {
        try {
            Category::find($request->id)->delete();
            return response()->json([
                "message" => "Category Data succssfully Delete.!"
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // Company Multiple Data delete function 
    public function multipleDeleteCategory(Request $request)
    {
        try {
            Category::whereIn('id', $request->ids)->delete();
            return response()->json(["msg" => "success"]);
        } catch (Exception $e) {
            //  dd($e->getMessage());
            return response()->json(["msg" => "faild"]);
        }
    }
}
