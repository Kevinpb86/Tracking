<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoItemApiController extends Controller
{
    /**
     * Display a listing of DO Items.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $doItems = DoItem::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data DO Item berhasil diambil',
            'data' => $doItems
        ], 200);
    }

    /**
     * Store a newly created DO Item via API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vbeln' => 'required|string|max:255',
            'posnr' => 'required|string|max:255',
            'matnr' => 'required|string|max:255',
            'arktx' => 'nullable|string',
            'ifimg' => 'required|numeric',
            'vrkme' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $doItem = DoItem::create($validator->validated());

            return response()->json([
                'success' => true,
                'message' => 'Data DO Item berhasil disimpan',
                'data' => $doItem
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified DO Item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $doItem = DoItem::find($id);

        if (!$doItem) {
            return response()->json([
                'success' => false,
                'message' => 'Data DO Item tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data DO Item berhasil diambil',
            'data' => $doItem
        ], 200);
    }

    /**
     * Update the specified DO Item via API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $doItem = DoItem::find($id);

        if (!$doItem) {
            return response()->json([
                'success' => false,
                'message' => 'Data DO Item tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'vbeln' => 'sometimes|required|string|max:255',
            'posnr' => 'sometimes|required|string|max:255',
            'matnr' => 'sometimes|required|string|max:255',
            'arktx' => 'nullable|string',
            'ifimg' => 'sometimes|required|numeric',
            'vrkme' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $doItem->update($validator->validated());

            return response()->json([
                'success' => true,
                'message' => 'Data DO Item berhasil diupdate',
                'data' => $doItem
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengupdate data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified DO Item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $doItem = DoItem::find($id);

        if (!$doItem) {
            return response()->json([
                'success' => false,
                'message' => 'Data DO Item tidak ditemukan'
            ], 404);
        }

        try {
            $doItem->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data DO Item berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
