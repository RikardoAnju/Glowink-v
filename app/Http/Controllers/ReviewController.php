<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all();

        return response()->json([
            'data' => $reviews
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
            'id_produk' => 'required',
            'review' => 'required',
            'rating' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = $request->all();

        $review = Review::create($input);

        return response()->json([
            'message' => 'Review berhasil disimpan.',
            'data' => $review
        ]);
    }
    public function show (Review $review)
    {
        return response()->json([
            'data'=> $review
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
            'id_produk' => 'required',
            'review' => 'required',
            'rating' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = $request->all();

        $review->update($input);

        return response()->json([
            'message' => 'Review berhasil diperbarui.',
            'data' => $review
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        // Delete the image file if it exists
        if (File::exists(public_path($review->gambar))) {
            File::delete(public_path($review->gambar));
        }

        // Delete the review
        $review->delete();

        return response()->json([
            'message' => 'Review berhasil dihapus.'
        ]);
    }
}
