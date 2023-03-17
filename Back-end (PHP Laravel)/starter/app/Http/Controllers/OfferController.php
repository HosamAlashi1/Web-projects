<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    use OfferTrait;

    public function index()
    {
        $offerFromDB = Offer::paginate(5); // Offer >> name of modle
        return view('offers.index', ['offers' => $offerFromDB]);
    }

    public function create()
    {
        return view('offers.create');
    }

    public function store(OfferRequest $request)
    {
        $file_name = $this->saveImage($request->photo, 'images/offers');
        // ($requset -> photo) >> The selected image
        // 'images/offers' >> this path to storage images  

        // insert data
        Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'photo' => $file_name
        ]);

        return redirect()->back()->with(['success' => 'تم اضافة العرض بنجاح']);
        //with(['success' => 'تم اضافة العرض بنجاح']) >> this is session named success used in view page to show alert 
    }

    public function edit($offer_id)
    {
        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect()->back();

        Offer::select('id', 'name', 'price', 'details')->find($offer_id);
        return view('offers.edit', ['offer' => $offer]);
    }

    public function update(OfferRequest $request, $offer_id)
    {
        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect()->back();

        $offer->update([ // to upadte in data base 
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details
        ]);

        return redirect(route('offers.index'));
    }

    public function destroy($offer_id)
    {
        $offer = Offer::find($offer_id);
        if(!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

        $offer->delete();
        return redirect()->route('offers.index')->with(["success" => __('messages.offer deleted successfully')]);
    }
}
