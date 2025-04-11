<?php

namespace App\Http\Controllers;

use App\Exports\PromoExport;
use App\Models\Log;
use App\Models\Promo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PromoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $promos = Promo::select('id', 'title', 'code', 'value')->filter()->orderBy('id', 'desc')->paginate(25);

        return view('promos.index', compact('promos'));
    }

    public function new()
    {
        return view('promos.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'code' => 'required|max:255',
            'value' => 'required|numeric|min:0|max:100',
        ]);

        $promo = Promo::create([
            'title' => $request->title,
            'code' => $request->code,
            'value' => $request->value,
        ]);

        $text = ucwords(auth()->user()->name) . " created new Promo : " . $promo->title . ", datetime :   " . now();
        Log::create([
            'text' => $text,
        ]);

        return redirect()->route('promos')->with('success', 'Promo created successfully!');
    }

    public function edit(Promo $promo)
    {
        return view('promos.edit', compact('promo'));
    }

    public function update(Promo $promo, Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'code' => 'required|max:255',
            'value' => 'required|numeric|min:0|max:100',
        ]);

        $text = ucwords(auth()->user()->name) . ' updated Promo ' . $promo->title . ", datetime :   " . now();

        $promo->update([
            'title' => $request->title,
            'code' => $request->code,
            'value' => $request->value,
        ]);

        Log::create([
            'text' => $text,
        ]);

        return redirect()->route('promos')->with('warning', 'Promo updated successfully!');
    }

    public function destroy(Promo $promo)
    {
        if ($promo->can_delete()) {
            $text = ucwords(auth()->user()->name) . " deleted promo : " . $promo->title . ", datetime :   " . now();

            Log::create([
                'text' => $text,
            ]);
            $promo->delete();

            return redirect()->back()->with('error', 'Promo deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Unothorized Access...');
        }
    }

    public function export()
    {
        return Excel::download(new PromoExport, 'promos.xlsx');
    }
}
