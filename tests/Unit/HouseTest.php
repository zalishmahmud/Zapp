<?php

namespace Tests\Unit;

use Tests\TestCase;
use Session;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\housesController;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class HouseTest extends TestCase
{
   use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
     public function testHouseStore(){
        $house = new housesController;
        $this->login(1);
        $request = new Request;
        $request->replace([
            'houseName'=>'testHouse',
            'houseDescription'=>'testing',
            'owner_id'=>1,
            'housePrice'=>1000,
            'area'=>'Banani',
            'bedroom'=>1,
            'washroom'=>4,
            'image'=>null
        ]);

        $house->store($request);
        $this->assertDatabaseHas('houses', [
            'houseName'=>'testHouse'
        ]);
        $this->assertDatabaseHas('houses', [
            'houseDescription'=>'testing'
        ]);
        $this->assertDatabaseHas('houses', [
            'owner_id'=>1
        ]);
        $this->assertDatabaseHas('houses', [
            'housePrice'=>1000
        ]);
        $this->assertDatabaseHas('houses', [
            'area'=>'Banani'
        ]);
        
        $this->assertDatabaseHas('houses', [
            'bedroom'=>1
        ]);
        $this->assertDatabaseHas('houses', [
            'washroom'=>4
        ]);

        
     }

     public function testDelete(){
        $this->login(1);
        $house = new housesController;
        $houseid=29;
        $response = $house->delete($houseid);
        $this->assertDatabaseMissing('houses', [
            'id'=>$houseid
        ]);
     }

     public function testFilter(){
         $pages = new PagesController;
         $request = new Request;
         $expected="Banani";
         $request->replace(['area'=>$expected]);

        $results= $pages->filter($request)['houses']->first();
        $this->assertEquals($results['area'], $expected,"actual value is not equals to expected");

     }


     public function testSentToRent(){
        $this->login(1);
        $houseid=29;
        $house = new housesController;
        $expectedStatus=1;
        $response = $house->sentToRent($houseid);
        $result= $house->houseinfo($houseid)['status'];
        $this->assertEquals($result,$expectedStatus);
     }


     public function testReturnFromRent(){
        $this->login(1);
        $houseid=29;
        $house = new housesController;
        $expectedStatus=0;
        $response = $house->retFromRent($houseid);
        $result= $house->houseinfo($houseid)['status'];
        $this->assertEquals($result,$expectedStatus);
     }

     protected function login($id){
        Session::start();
        $user = User::find($id);
        Auth::login($user);
     }

}
