<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Review;


class ReviewController extends Controller
{
    public function getReviews(){
        $reviews = Review::orderBy('show', 'asc')->orderBy('id', 'desc')->get();
        return $reviews;
    }
    public function reviewShow(Request $request){
        $review = Review::where('id', $request->reviewId)->first();
        $review->show = 1;
        $review->save();
    }
    public function reviewHide(Request $request){
        $review = Review::where('id', $request->reviewId)->first();
        $review->show = 0;
        $review->save();
    }
    public function reviewRemove(Request $request){
        $review = Review::where('id', $request->reviewId)->first();
        $review->delete();
    }
    public function saveReview(Request $request){
        $review = Review::where('id', $request->reviewToEdit['id'])->first();
        $review->text = $request->reviewToEdit['text'];
        $review->answer = $request->reviewToEdit['answer'];
        $review->save();
        // return $review;
    }
}
