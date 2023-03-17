<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\MainCategory;
use App\Models\Vendor;
use App\Notifications\VendorCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class VendorsController extends Controller
{

    public function index()
    {
        $vendors = Vendor::selection()->paginate(PAGINATION_COUNT);
        return view('admin.vendors.index', compact('vendors'));
    }

    public function create()
    {
        $categories = MainCategory::where('translation_of', 0)->active()->get();
        return view('admin.vendors.create', compact('categories'));
    }

    public function store(VendorRequest $request)
    {

        try {
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);

            if ($request->has('logo')) {
                $file_path = uploadImage('vendors', $request->logo);
            }
            $vendor = Vendor::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'active' => $request->active,
                'category_id' => $request->category_id,
                'password' => $request->password, // note : exist accessor for password in Vendoer model
                'logo' => $file_path,
            ]);
            Notification::send($vendor,new VendorCreated($vendor));
            return redirect()->route('admin.vendors')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.vendors')->with(['error' => 'هناك خطأ حاول مجددا']);
        }
    }

    public function edit($id)
    {
       try {
        $categories = MainCategory::where('translation_of', 0)->active()->get();
        $vendor = Vendor::selection()->find($id);
        if (!$vendor)
            return redirect()->route('admin.vendors')->with(['error' => 'هذا المتجر غير موجود']);
        return view('admin.vendors.edit',compact('vendor','categories'));
       } catch (\Exception $ex) {
        return redirect()->route('admin.vendors')->with(['error' => 'هناك خطأ حاول مجددا']);
       }
    }

    public function update($id,VendorRequest $request)
    {
        try {
            $vendoer = Vendor::find($id);
            if (!$vendoer) {
                return redirect()->route('admin.vendoers.edit', $id)->with(['error' => 'هذا المتجر غير موجودة']);
            }
            // this for checkbox 
            if (!$request->has('active')) {
                $request->request->add(['active' => 0]);
            }
            DB::beginTransaction();
            // this for update image 
            if ($request->has('logo')) {
                $file_path = uploadImage('vendors', $request->logo);
                Vendor::where('id', $id)->update([
                    'logo' => $file_path
                ]);
            }

            $data = $request->except('_token','id','logo','password');

            if ($request->has('password')) {
                $data['password'] = $request->password;
            }
            Vendor::where('id',$id)->update($data);
            DB::commit();
            return redirect()->route('admin.vendors')->with(['success' => 'تم تحديث المتجر بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.venders')->with(['error' => 'هناك خطأ يرجى المحاولة مجددا']);
        }
    }

    public function changeStatus()
    {
    }
}
