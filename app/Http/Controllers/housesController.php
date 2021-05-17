<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\Area;
use Auth;

class housesController extends Controller
{
    public function store(Request $request){
        $this -> validate($request,[
            'houseName'=>'required',
            'housePrice'=>'required',
            'houseDescription'=>'required',
            'area'=>'required',
            'bedroom'=>'required',
            'washroom'=>'required',
        ]);
        $house = new House;
        if($request->hasfile('image')){
            $filenamewithExt=$request->file('image')->getClientOriginalName();
            $filename =pathinfo($filenamewithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path=$request->file('image')->storeAs('public/uploads',$fileNameToStore);
            $house->picture=$fileNameToStore;
        }
        else{
        $house->picture="Null";
        }
        $house->houseName=$request->input('houseName');
        $house->houseDescription=$request->input('houseDescription');
        $house->area=$request->input('area');
        $house->housePrice = $request->input('housePrice');
        $house->bedroom=$request->input('bedroom');
        $house->washroom=$request->input('washroom');
        $house->owner_id = Auth::id();
        $house->status=0;
        $house->ownerContact=Auth::user()->phone;
        $house->save();
        return redirect()->route('show.Myhouses');
    }

    public function edit($id){
        $house=House::find($id);
        $areas=Area::all();
        if($house->owner_id == Auth::id()){
        return view('houseEdit', ['house'=>$house],['areas'=>$areas]);
    }
    else{
        return "!!!!!!!!! UnAuthorized Access !!!!!!!!!!";
    }
    }
        public function update(Request $request,$id){
            $this -> validate($request,[
                'houseName'=>'required',
                'housePrice'=>'required',
                'houseDescription'=>'required',
                'area'=>'required',
                'bedroom'=>'required',
                'washroom'=>'required',
            ]);
        $house=House::find($id);
        if($house->owner_id == Auth::id()){
            $house->houseName=$request->input('houseName');
            $house->houseDescription=$request->input('houseDescription');
            $house->area=$request->input('area');
            $house->housePrice = $request->input('housePrice');
            $house->bedroom=$request->input('bedroom');
            $house->washroom=$request->input('washroom');
        $house->save();
        return redirect()->route('show.Myhouses');
        }
        else{
            return "!!!!!!!!! UnAuthorized Access !!!!!!!!!!";
        }
    }

    public function delete($id){
        $house=House::find($id);
        if($house->owner_id == Auth::id()){
            // dd(\File::exists(public_path('/storage/uploads/'.$house->picture)));
            if(\File::exists(public_path('/storage/uploads/'.$house->picture))){
                \File::delete(public_path('/storage/uploads/'.$house->picture));
              }
            $house->delete();
            return redirect()->route('show.Myhouses');
        }
        else{
            return "!!!!!!!!! UnAuthorized Access !!!!!!!!!!";
        }
    }


    public function sentToRent($id){
        $house=House::find($id);
        if($house->owner_id == Auth::id()){
       $house->status=1;
       $house->save();
       return redirect()->route('show.Myhouses');
    }
    else{
        return "!!!!!!!!! UnAuthorized Access !!!!!!!!!!";
    }


}


public function retFromRent($id){
    $house=House::find($id);
    if($house->owner_id == Auth::id()){
   $house->status=0;
   $house->save();
   return redirect()->route('show.Myhouses');
}
else{
    return "!!!!!!!!! UnAuthorized Access !!!!!!!!!!";
}


}

public function houseinfo($id){
    $house=House::find($id);
    return $house;
}

}
