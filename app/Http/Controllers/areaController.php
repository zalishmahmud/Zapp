<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;

class areaController extends Controller
{
    public function store(Request $request){
        $this -> validate($request,[
            'AreaName'=>'required',
        ]);
        $area = new Area;
        $area->name=$request->input('AreaName');
        $area->save();
        return redirect()->route('show.Area');
    }

    public function edit($id){
        $area=Area::find($id);

        return view('AreaEdit', ['area'=>$area]);
}

public function update(Request $request, $id){
    $this -> validate($request,[
        'AreaName'=>'required',
    ]);
    $area =  Area::find($id);
    $area->name=$request->input('AreaName');
    $area->save();
    return redirect()->route('show.Area');

}
}
