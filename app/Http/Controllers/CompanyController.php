<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    // Company Index view
    public function index(Request $request)
    {

        try {
            if ($request->ajax()) {
                $data = Company::all();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function ($row) {
                        return $row->status == 1 ? '<span class="badge badge-info">Active</span>' : '<span class="badge badge-dark">Block</span>';
                    })

                    ->addColumn('images', function ($row) {
                        return $row->images != null ? "<img src='$row->images' alt='$row->images' width='70px' class='companyimgPopup' height='70px'>" : "<img src='https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-7.gif' class='companyimgPopup' alt='https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-7.gif' width='70px' height='70px'>";
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

                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete-btn">Delete</a>
                        ';

                        return $btn;
                    })
                    ->rawColumns(['action', 'status', 'images', 'checkbox'])
                    ->make(true);
            }
            return view('adminPanel.company.index');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // COMPANY ADD FUNCTION
    public function addCompany(Request $request)
    {
        try {
            $addCompany = new Company();
            $addCompany->company_name = $request->company_name;
            $addCompany->status = $request->status;

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = 'backend/companyImg';
                $addCompany->images = url($destinationPath . "/" . $filename);
                $file->move($destinationPath, $filename);
            }

            $addCompany->save();
            return response()->json([
                'message' => "data add successfully."
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    //  Company Edit Function
    public function editCompany($id)
    {
        try {
            $editCompany = Company::find($id);

            return response()->json([
                'status' => 200,
                'editCompanyData' => $editCompany
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    //  Company Update Function

    public function updateCompany(Request $request)
    {
        try {
            $updateCompany = Company::find($request->id);
            $updateCompany->company_name = $request->companyName;
            $updateCompany->status = $request->status;
            // Delete previous image file
       
            if ($request->hasFile('photo')) {
                $destinationPath = 'backend/companyImg/';

                // Delete the old image file
                if ($updateCompany->images != null) {
                    $oldImagePath = public_path($destinationPath . basename($updateCompany->images));
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            
                $companyImg = $request->file('photo');
                $companyImgName = date('YmdHis') . '.' . $companyImg->getClientOriginalExtension();
                $companyImg->move(public_path($destinationPath), $companyImgName);
            
                $updateCompany->images = url($destinationPath . $companyImgName);
            }
            
            

            $success = $updateCompany->update();
            if ($success) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'faild']);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // Company delete function 

    public function deleteCompany(Request $request)
    {
        try {
            Company::find($request->id)->delete();
            return response()->json([
                "message" => "Company Data succssfully Delete.!"
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // Company Multiple Data delete function 
    public function multipleDeleteCompany(Request $request)
    {

        try {
            Company::whereIn('id', $request->ids)->delete();
            return response()->json(["msg" => "success"]);
        } catch (Exception $e) {
            //  dd($e->getMessage());
            return response()->json(["msg" => "faild"]);
        }
    }
}
