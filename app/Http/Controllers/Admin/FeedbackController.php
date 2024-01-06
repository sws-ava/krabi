<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Feedback;

class FeedbackController extends Controller
{
    public function getFeedbacks(){
        $feedbacks = Feedback::orderBy('isRead', 'asc')->orderBy('id', 'desc')->get();
        return $feedbacks;
    }
    public function feedbackReaded(Request $request){
        $feedback = Feedback::where('id', $request->feedbackId)->first();
        $feedback->isRead = 1;
        $feedback->save();
    }
    public function feedbackNotReaded(Request $request){
        $feedback = Feedback::where('id', $request->feedbackId)->first();
        $feedback->isRead = 0;
        $feedback->save();
    }
    public function feedbackRemove(Request $request){
        $feedback = Feedback::where('id', $request->feedbackId)->first();
        $feedback->delete();
    }
    // public function getUnreadedFeedbacksAndReviews(){
    //     $feedbacks = Feedback::where('isRead', 0)->get();
    //     // return $feedbacks->count();
    //     return 1;
    // }
    
}
