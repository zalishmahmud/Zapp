<?php

namespace Tests\Unit;

use Tests\TestCase;
use Session;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ReviewController;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class ReviewTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testStoreReview()
    {
        $review = new ReviewController;
        $this->login(1);
        $request = new Request;
        $request->replace([
            'comment'=>'TestComment',
            'rate'=>2,
        ]);
        $houseid=27;
        $response=$review->store($request,$houseid);
        $this->assertDatabaseHas('reviews', [
            'comment'=>'TestComment'
        ]);
    }


    public function testDelete(){
        $this->login(1);
        $house = new ReviewController;
        $reviewid=24;
        $response = $house->delete($reviewid);
        $this->assertDatabaseMissing('reviews', [
            'id'=>$reviewid
        ]);
     }
    protected function login($id){
        Session::start();
        $user = User::find($id);
        Auth::login($user);
     }
}
