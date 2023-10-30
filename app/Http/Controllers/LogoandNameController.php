<?php

namespace App\Http\Controllers;

use App\Models\LogoandName;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Storage;

class LogoandNameController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $logoAndNameDataClass = new LogoandName();
        $logoAndNameData = $logoAndNameDataClass->logoAndNameData();

        return view('Pos.logoandname', [
            'logoandname' => $logoAndNameData,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $logoandname = LogoandName::find($id);
        if ($logoandname) {
            $extension = "https://kyawswar.s3.ap-southeast-1.amazonaws.com/";
            $logoandname->update([
                'business_name' => $request->business,
            ]);

            if ($request->hasFile('logo')) {
                $extension = $request->file('logo')->extension();
                $filename = time() . '.' . $request->file('logo')->getClientOriginalName() . $extension;
                $path3 = 'Logo/' . $filename;
                $file = Storage::disk('spaces')->put($path3, file_get_contents($request->file('logo')->getRealPath()), 'public');
                $linkpath = "https://sks.sgp1.digitaloceanspaces.com/Logo/";
                $logo = $linkpath . $filename;
                $logoandname->update([
                    'logo' => $logo,
                ]);
            }
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
