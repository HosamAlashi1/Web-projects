<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainCategory;
use App\Http\Requests\MainCategoryRequest;
use Illuminate\Support\Facades\DB;

class MainCategoriesController extends Controller
{

    public function index()
    {
        $default_lang = get_default_lang(); // helper method 
        $categories = MainCategory::where('translation_lang', $default_lang)->select()->get();
        return view('admin.main categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.main categories.create');
    }

    public function store(MainCategoryRequest $request)
    {
        try {
            $main_categories = collect($request->category);
            $filter = $main_categories->filter(function ($value, $key) {
                return $value['translation_lang'] == get_default_lang();
            });
            $default_category = array_values($filter->all())[0];

            if ($request->has('photo')) {
                $file_path = uploadImage('maincategoris', $request->photo);
            }

            DB::beginTransaction();
            $default_category_id = MainCategory::insertGetId([ // insertGetId >> same created but return the id for the item insert
                'translation_lang' => $default_category['translation_lang'],
                'translation_of' => 0,
                'name' => $default_category['name'],
                'slug' => $default_category['name'],
                'photo' => $file_path,
            ]);

            $categories = $main_categories->filter(function ($value, $key) {  // witout category default language
                return $value['translation_lang'] != get_default_lang();
            });

            if (isset($categories) && $categories->count()) {
                $categories_arr = [];
                foreach ($categories as $category) {
                    $categories_arr[] = [
                        'translation_lang' => $category['translation_lang'],
                        'translation_of' => $default_category_id,
                        'name' => $category['name'],
                        'slug' => $category['name'],
                        'photo' => $file_path,
                    ];
                }
                MainCategory::insert($categories_arr);
            }
            DB::commit();
            return redirect()->route('admin.main_categoris')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.main_categoris')->with(['error' => 'هناك خطأ حاول مجددا']);
        }
    }

    public function edit($id)
    {
        $main_category = MainCategory::with('categories')->select()->find($id);
        if (!$main_category)
            return redirect()->route('admin.main_categoris')->with(['error' => 'هذا القسم غير موجود']);
        return view('admin.main categories.edit', compact('main_category'));
    }

    public function update($id, MainCategoryRequest $request)
    {
        try {
            $main_category = MainCategory::find($id);
            if (!$main_category)
                return redirect()->route('admin.main_categoris')->with(['error' => 'هذا القسم غير موجود']);

            $category = array_values($request->category)[0];
            // this for checkbox 
            if (!$request->has('category.0.active')) {
                $request->request->add(['active' => 0]);
            } else {
                $request->request->add(['active' => 1]);
            }

            if ($request->has('photo')) {
                $file_path = uploadImage('maincategoris', $request->photo);
                MainCategory::where('id', $id)->update([
                    'photo' => $file_path
                ]);
            }

            MainCategory::where('id', $id)->update([
                'name' => $category['name'],
                'active' => $request->active,
            ]);
            return redirect()->route('admin.main_categoris')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.main_categoris')->with(['error' => 'هناك خطأ حاول مجددا']);
        }
    }
}
