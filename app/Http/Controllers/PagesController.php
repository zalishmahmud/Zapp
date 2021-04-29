<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\House;
use App\Area;
use App\Review;
use App\Payment;
use App\User;
use Illuminate\Support\Facades\Hash;
class PagesController extends Controller
{
    public function myHouseList(){
        $houses=House::all()->where('owner_id',Auth::id());
        $areas=Area::all();
        return view('MyHouse',['houses'=>$houses],['areas'=>$areas]);
    }

    
    public function areaList(){
        $areas= Area::all();
        return view('Areas',['areas'=>$areas]);
    }

    public function availableHouses(){
        $houses=House::all()->where('owner_id', '!=', auth()->id())->where('status',1);
        $areas = Area::all();
        if(count($areas)==0){
            $areasArray=  array(
                'All',
                "Banani",
                "Banglamotor",
                "Bangshal",
                "Cantonment",
                "Chaukbazar",
                "Demra",
                "Dhamrai",
                "Dohar",
                "Hazaribagh",
                "Jatrabari",
                "Kafrul",
                "Kamrangircha",
                "Keraniganj",
                "Khilkhet",
                "Kotwali",
                "Mogbazar",
                "Mohakhali",
                "Nawabganj",
                "Paltan",
                "Purbachal",
                "Ramna",
                "Savar",
                "Shajahanpur",
                "Sutrapur",
                "Tejgaon",
                "Tongi",
                "Wari"
                );
                foreach ($areasArray as $value) {
                    $area = new Area;
                    $area->name=$value;
                    $area->save();
                  }
                $area=Area::all()->where('name','All')->first();
                $area->id=1;
                $area->save();

}
        $selectedId=1;
        return view('availableHouses',['houses'=>$houses,'areas'=>$areas,'selectedId'=>$selectedId]);
    }

    public function addHouse(){
        $areas=Area::all();
        return view('addHouse',['areas'=>$areas]);
    }

    public function viewHouse($id){
        $house=House::find($id);
        $review=Review::all()->where('house_id',$id);
        $totalCount=count($review);
        $star5Count=count(($review->where('rate',5)));
        $star4Count=count(($review->where('rate',4)));
        $star3Count=count(($review->where('rate',3)));
        $star2Count=count(($review->where('rate',2)));
        $star1Count=count(($review->where('rate',1)));
        if($totalCount==0){
            $data = array(
                "totalCount"=>$totalCount,
                "5starCount" =>$star5Count,
                "4starCount" =>$star4Count,
                "3starCount" =>$star3Count,
                "2starCount" =>$star2Count,
                "1starCount" =>$star1Count,
                "5starPercent"=>0,
                "4starPercent"=>0,
                "3starPercent"=>0,
                "2starPercent"=>0,
                "1starPercent"=>0,
                "totalAvg"=>0.00,
              );
        }
        else{
            $data = array(
                "totalCount"=>$totalCount,
                "5starCount" =>$star5Count,
                "4starCount" =>$star4Count,
                "3starCount" =>$star3Count,
                "2starCount" =>$star2Count,
                "1starCount" =>$star1Count,
                "5starPercent"=>((($star5Count)/$totalCount)*100),
                "4starPercent"=>((($star4Count)/$totalCount)*100),
                "3starPercent"=>((($star3Count)/$totalCount)*100),
                "2starPercent"=>((($star2Count)/$totalCount)*100),
                "1starPercent"=>((($star1Count)/$totalCount)*100),
                "totalAvg"=>number_format((float)((($star1Count)+($star2Count*2)+($star3Count*3)+($star4Count*4)+($star5Count*5))/$totalCount), 2, '.', '')
    
              );
        }

        return view('houseView',['house'=>$house,'reviews'=>$review,'Counter'=>$data]);
    }
    public function Review($id){
        $review=Review::where('house_id',$id)->where('user_id',Auth::id())->get();
        if(count($review)<1){
            return view('addreview',['house_id'=>$id]);
        }
        else{
            // return $review[1];
            return view('EditReview',['house_id'=>$id,'review'=>$review]);
        }
    }


    public function payment($house_id){
        $token = random_bytes(10);
        $token = bin2hex($token);
        $token=strtoupper($token);
        $payment=Payment::where('pay_id',$token)->get();
        while (count($payment)>0) {
            $token = random_bytes(10);
            $token = bin2hex($token);
            $token=strtoupper($token);
            $payment=Payment::where('pay_id',$token);
        }
        
        $house=House::find($house_id);
        if($house->status==1){
            $pay=new Payment;
            $pay->pay_id=$token;
            $pay->renter_id=Auth::id();
            $pay->house_name=$house->houseName;
            $pay->area=$house->area;
            $pay->owner_id=$house->owner_id;
            $pay->bedroom=$house->bedroom;
            $pay->washroom=$house->washroom;
            $pay->houseDescription=$house->houseDescription;
            $pay->housePrice=$house->housePrice;
            $pay->house_id=$house_id;
            $pay->save();
            $house->status=0;
            $house->save();
            return view('payment',['pay_id'=>$token]);
        }
        else{
            return view('paymentError',['pay_id'=>'payment Error!']);
        }

    }

    public function paymentHistory(){
        $pay=Payment::all()->where('renter_id',Auth::id());
        return view('paymentHistory',['pay'=>$pay]);
    }

    public function rentHistory(){
        $pay=Payment::all()->where('owner_id',Auth::id());
        return view('renthistory',['pay'=>$pay]);
    }
    public function owner($id){
        $pay = Payment::find($id);
        if($pay->renter_id==Auth::id()){
            $user = User::find($pay->owner_id);
            return view('OwnerInfo',['user'=>$user]);
        }
    }

    public function renter($id){
        $pay = Payment::find($id);
        if($pay->owner_id==Auth::id()){
            $user = User::find($pay->renter_id);
            return view('OwnerInfo',['user'=>$user]);
        }
    }

    public function paywith($id){
        $house=House::find($id);
        return view('bkash',['house'=>$house]);
    }

    public function filter(Request $request){
        $area = $request->input('area');
        if($area=='All'){
            return redirect()->route('home');
        }
        else{
            $houses=House::all()->where('owner_id', '!=', auth()->id())->where('status',1)->where('area',$area);
            $areas=Area::all();
            $areaId=Area::where('name',$area)->get();
            $areaId= $areaId[0]->id;
            return view('availableHouses',['houses'=>$houses,'areas'=>$areas,'selectedId'=>$areaId]);           
        }
    }

    public function search(Request $request){
        $search = $request->input('search');
        $selectedId=1;
        $areas = Area::all();
        if($search==null){
            $houses=House::all()->where('owner_id', '!=', auth()->id())->where('status',1);

            return view('availableHouses',['houses'=>$houses,'areas'=>$areas,'selectedId'=>$selectedId]);
            
        }
        $houses = House::query()
            ->where('owner_id', '!=', auth()->id())
            ->where('status',1)
            ->where('houseName', 'LIKE', "%{$search}%")
            ->orWhere('area', 'LIKE', "%{$search}%")
            ->get();

       
        return view('availableHouses',['houses'=>$houses,'areas'=>$areas,'selectedId'=>$selectedId]);
    }

}