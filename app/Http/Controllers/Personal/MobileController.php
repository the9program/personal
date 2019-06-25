<?php

namespace App\Http\Controllers\Personal;

use App\Http\Requests\Personal\Real\MobileRequest;
use App\Phone;
use App\Http\Controllers\Controller;

class MobileController extends Controller
{
    public function index()
    {

        return view('real.mobile',[
            'mobiles' => auth()->user()->real->phones
        ]);

    }

    public function show(Phone $phone)
    {
        dd($phone);
    }

    public function create()
    {

    }

    public function store(MobileRequest $request)
    {
        $mobile = Phone::create(['phone' => $request->mobile]);

        $mobile->attach(auth()->user()->real->id,['default' => true]);

        session()->flash('success', 'Votre numero mobile a bien été ajouté');

        return back();
    }

    public function update(MobileRequest $request,Phone $phone)
    {

        $phone->update(['phone' => $request->mobile]);

        session()->flash('success', 'Votre numero mobile a bien mis à jour');

        return back();

    }

    public function destroy(Phone $phone)
    {

        $phones = auth()->user()->real->phones;

        foreach ($phones as $phone) {

            auth()->user()->real->phones()->updateExistingPivot($phone->id, ['default' => false]);

        }

        auth()->user()->real->detach($phone->id);

        $phone->delete();

        return back();

    }

    public function primary(Phone $phone)
    {

        $phones = auth()->user()->real->phones;

        foreach ($phones as $phone) {

            auth()->user()->real->phones()->updateExistingPivot($phone->id, ['default' => false]);

        }

        auth()->user()->real->phones()->updateExistingPivot($phone->id, ['default' => true]);

        return back();
    }
}
