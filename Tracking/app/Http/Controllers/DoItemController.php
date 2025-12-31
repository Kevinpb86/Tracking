<?php

namespace App\Http\Controllers;

use App\Models\DoItem;
use Illuminate\Http\Request;

class DoItemController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('scm.do_item_input');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vbeln' => 'required|string|max:255',
            'posnr' => 'required|string|max:255',
            'matnr' => 'required|string|max:255',
            'arktx' => 'nullable|string',
            'ifimg' => 'required|numeric',
            'vrkme' => 'required|string|max:255',
        ]);

        DoItem::create($validated);

        return redirect()->route('scm.do-item.input')->with('success', 'Data DO Item berhasil disimpan!');
    }
}
