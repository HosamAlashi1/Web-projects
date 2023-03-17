<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;

class LanguagesController extends Controller
{

    public function index()
    {
        // select() >> local scope
        $languages = Language::select()->paginate(PAGINATION_COUNT);
        return view('admin.languages.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function store(LanguageRequest $request)
    {
        try {
            Language::create($request->except(['_token']));
             // this for checkbox 
            if (!$request->has('active')) {
                $request->request->add(['active' => 0]);
            }
            return redirect()->route('admin.languages')->with(['success' => 'تم حفظ اللغة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطأ يرجى المحاولة مجددا']);
        }
    }

    public function edit($id)
    {
        // selcet() >> local scope
        $language = Language::select()->find($id);
        if (!$language) {
            return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة غير موجودة']);
        }
        return view('admin.languages.edit', compact('language'));
    }

    public function update($id, LanguageRequest $request)
    {
        try {
            $language = Language::find($id);
            if (!$language) {
                return redirect()->route('admin.languages.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
            // this for checkbox 
            if (!$request->has('active')) {
                $request->request->add(['active' => 0]);
            }
 
            $language->update($request->except(['_token']));

            return redirect()->route('admin.languages')->with(['success' => 'تم تحديث اللغة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطأ يرجى المحاولة مجددا']);
        }
    }

    public function destroy($id)
    {
        try {
            $language = Language::find($id);
            if (!$language) {
                return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة غير موجودة']);
            }
            $language->delete();
            return redirect()->route('admin.languages')->with(['success' => 'تم حذف اللغة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطأ يرجى المحاولة مجددا']);
        }
    }
}
