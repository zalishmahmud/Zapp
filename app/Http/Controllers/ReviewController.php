<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Review;
use App\User;
use App\House;
class ReviewController extends Controller
{
    public function store(Request $request,$house_id){
        $this -> validate($request,[
            'comment'=>'required',
            'rate'=>'required',
        ]);
        $review=Review::all()->where('house_id',$house_id)->where('user_id',Auth::id());
        if(count($review)<1){
        $user=User::find(Auth::id());
        $house= House::find($house_id);
        if($house->owner_id==Auth::id()){
            return "UnAuthorized";
        }
        else{
        $review = new Review;
        $review->comment=$request->input('comment');
        $review->rate=$request->input('rate');
        $review->house_id=$house_id;
        $review->user_id=Auth::id();
        $review->username=$user->name;
        $review->save();
        return redirect()->route('view.house',$house_id);
        }
    }
    }


    public function update(Request $request,$house_id,$review_id){
        $this -> validate($request,[
            'comment'=>'required',
            'rate'=>'required',
        ]);
        $house= House::find($house_id);
        $user=User::find(Auth::id());
        if($house->owner_id==Auth::id()){
            return "UnAuthorized";
        }
        else{
            $review = Review::find($review_id);
            if($review->user_id == Auth::id()){
                $review->comment=$request->input('comment');
                $review->rate=$request->input('rate');
                $review->house_id=$house_id;
                $review->user_id=Auth::id();
                $review->username=$user->name;
                $review->save();
                return redirect()->route('view.house',$house_id);
            }
            else{
                return 'UnAuthorized';
            }

        }

    }


    public function delete($id){
        $review = Review::find($id);
        $house_id=$review->house_id;
        if($review->user_id == Auth::id()){
            $review->delete();
            return redirect()->route('view.house',$house_id);
        }
    }

    public function reviewInfor($id){
        $review = Review::find($id);
        return $review;

    }
}
