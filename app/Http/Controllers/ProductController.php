<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Product Table 
    public function products(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Product::all();
                return DataTables::of($data)
                    ->addIndexColumn()

                    // ->addColumn('status', function ($row) {
                    //     return $row->status == 1 ? '<span class="badge badge-info">Active</span>' : '<span class="badge badge-dark">Block</span>';
                    // })

                    ->addColumn('status', function ($row) {
                        $status = $row->status ? 'On' : 'Off';
                        return '<button class="toggle-button btn btn-primary" data-id="'.$row->id.'" data-status="'.$row->status.'">'.$status.'</button>';
                    })

                    ->addColumn('is_featured', function ($row) {
                        return $row->is_featured == 1 ? '<span class="badge badge-primary">Featured</span>' : '<span class="badge badge-secondary">No-Featured</span>';
                    })

                    ->addColumn('product_img', function ($row) {
                        $images = json_decode($row->product_img, true);

                        if (!empty($images)) {
                            $html = '';
                            foreach ($images as $image) {
                                $html .= "<img src='$image' alt='Product image' width='40px' class='productimgPopup' height='40px'>&nbsp;";
                            }
                            return $html;
                        } else {
                            return "<img src='https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-7.gif' class='companyimgPopup' alt='https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-7.gif' width='70px' height='70px'>";
                        }
                    })


                    ->addColumn('checkbox', function ($row) {
                        return '<div class="dt-checkbox">
                        <input type="checkbox" id="example-select-all" class="sub_chk" data-id="' . $row->id . '">
                        <span class="dt-checkbox-label"></span>
                    </div>';
                    })
                    ->addColumn('action', function ($row) {

                        $btn = '
                        
                        <a class="btn btn-primary btn-sm" href="' . route('admin.editProductForm', $row->id) . '" >Edit</a>

                        <a class="btn btn-dark btn-sm" href="' . route('admin.viewProduct', $row->id) . '" >View</a>

                        <a class="btn btn-danger btn-sm" href="' . route('admin.productDelete', $row->id) . '" onclick="return confirm(`Are you sure delete this data`)">Delete</a>
                        ';

                        return $btn;
                    })
                    ->rawColumns(['action', 'status', 'is_featured', 'product_img', 'checkbox'])
                    ->make(true);
            }
            return view('adminPanel.product.index');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    public function toggleStatus(Product $item)
    {
        $item->update(['status' => !$item->status]);
        return response()->json(['message' => 'Status updated successfully']);
    }

    // VIEW PRODUCT DETAILS
    public function viewProduct($id)
    {
        $viewProduct = Product::find($id);
        return view('adminPanel.product.view', compact('viewProduct'));
    }

    // ADD PRODUCT FORM
    public function addProductForm()
    {
        $companies = Company::where(['status' => 1])->get();
        $categories = Category::where(['status' => 1])->get();
        return view('adminPanel.product.add', compact('companies', 'categories'));
    }

    // PRODUCT STORE FUNCTION
    public function productStore(Request $request)
    {
        try {

            $productStore = new Product();

            $productStore->company_id = $request->companyId;
            $productStore->category_id = $request->categoryId;

            $productStore->product_name = $request->product_name;
            $productStore->mrp = $request->product_mrp;
            $productStore->offer_price = $request->product_offerPrice;
            $productStore->product_desc = $request->product_desc;
            $productStore->is_featured = $request->has('is_feature') ? 1 : 0;
            $productStore->status = $request->status;


            $imageData = [];

            if ($request->hasFile('product_img')) {
                if ($images = $request->file('product_img')) {
                    foreach ($images as $image) {
                        $randStr = Str::random(5);
                        $destinationPath = 'backend/productImg/';
                        $productImage = $randStr . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();

                        $image->move($destinationPath, $productImage);

                        array_push($imageData, url($destinationPath . $productImage));
                    }
                }
                $productStore->product_img = json_encode($imageData);
            }
            $productStore->save();
            return redirect()->route('admin.products')->with('success', 'Product Add successfully done.!');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // PRODUCT EDIT FORM FUNCTION
    public function editProductForm($id)
    {
        $editProductForm = Product::find($id);
        $category = Category::where(['status' => 1])->get();
        $company = Company::where(['status' => 1])->get();
        return view('adminPanel.product.edit', compact('editProductForm', 'category', 'company'));
    }

    // PRODUCT EDIT TIME IMAGES DELETES FUNCTION
    public function productUpdateTimeDeleteImg(Request $request)
    {
        $deleteIMG = Product::find($request->id);
        if ($reqImg = $request->imagename) {
            $destination = "backend/productImg/";
            $oldImages = json_decode($deleteIMG->product_img);
            // Delete Image on folder
            if (!empty($oldImages)) {
                foreach ($oldImages as $oldImg) {

                    if ($oldImg == $reqImg) {
                        $oldImagePath = public_path($destination . basename($oldImg));

                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }
                // Delete Image on folder End

                // Delete image database
                if (($key = array_search($reqImg, $oldImages)) !== false) {
                    unset($oldImages[$key]);
                }
                // Delete image database end
                $newArr = array_values($oldImages);
                $deleteIMG->product_img = json_encode($newArr);
                $deleteIMG->update();
            }
            return response()->json(["msg" => 'success']);
        }
    }

    // PRODUCT UPDATE FUNCTION

    public function productUpdate(Request $request)
    {
        try {

            $productUpdate = Product::find($request->id);
            $productUpdate->company_id = $request->companyId;
            $productUpdate->category_id = $request->categoryId;
            $productUpdate->product_name = $request->product_name;
            $productUpdate->mrp = $request->product_mrp;
            $productUpdate->offer_price = $request->product_offerPrice;
            $productUpdate->product_desc = $request->product_desc;
            $productUpdate->is_featured = $request->has('is_feature') ? 1 : 0;
            $productUpdate->status = $request->status;

            // Storing image basenames in an array
            // $oldImageBasenames = [];
            // if ($productUpdate->product_img) {
            //     $oldImages = json_decode($productUpdate->product_img);
            //     foreach ($oldImages as $oldImage) {
            //         $oldImageBasenames[] = basename($oldImage);
            //     }
            // }

            $imageData = [];
            if ($request->hasFile('product_img')) {

                // // Unlink old images from the server
                // foreach ($oldImageBasenames as $oldImageBasename) {
                //     $destinationPath = public_path('backend/productImg/') . $oldImageBasename;
                //     if (file_exists($destinationPath)) {
                //         unlink($destinationPath);
                //     }
                // }

                if ($images = $request->file('product_img')) {
                    foreach ($images as $image) {
                        $randStr = Str::random(5);
                        $destinationPath = 'backend/productImg/';
                        $productImage = $randStr . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();

                        $image->move($destinationPath, $productImage);

                        array_push($imageData, url($destinationPath . $productImage));
                    }
                }
                $oldImages = json_decode($productUpdate->product_img);
                $newImages = array_merge($oldImages,$imageData);
                $productUpdate->product_img = json_encode($newImages);
            }

            $productUpdate->update();
            return redirect()->route('admin.products')->with('success', 'Product Update successfully done.!');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    // Product Delete Function 
    public function productDelete($id)
    {
        Product::find($id)->delete();
        return redirect()->route('admin.products')->with('delete', 'product delete successfully done.!');
    }

    // Product Delete (MULTIPLE) Function
    public function productDestroy(Request $request)
    {
        try {
            // echo '<pre>';
            // print_r($request->all());
            // echo '</pre>';

            $productIds = $request->input('ids');

            // Perform multiple delete using 'whereIn'
            Product::whereIn('id', $productIds)->delete();
            return response()->json(["msg" => "success"]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
