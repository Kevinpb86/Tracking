<?php

namespace App\Http\Controllers;

use App\Models\DoItem;
use Illuminate\Http\Request;

class DoItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('scm.daftar-do');
    }

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
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoItem $doItem)
    {
        return view('scm.do_item_edit', compact('doItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DoItem $doItem)
    {
        $validated = $request->validate([
            'vbeln' => 'required|string|max:255',
            'posnr' => 'required|string|max:255',
            'matnr' => 'required|string|max:255',
            'arktx' => 'nullable|string',
            'ifimg' => 'required|numeric',
            'vrkme' => 'required|string|max:255',
        ]);

        $doItem->update($validated);

        return redirect()->route('scm.do-item.index')->with('success', 'Data DO Item berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoItem $doItem)
    {
        $doItem->delete();

        return redirect()->route('scm.do-item.index')->with('success', 'Data DO Item berhasil dihapus!');
    }
}
