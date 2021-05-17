<?php

namespace Tests\Unit;

use Tests\TestCase;
use Session;
use App\User;
use Auth;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Http\Controllers\PagesController;

class PaymentTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testPaymentHistory()
    {
        $renter_id=6;
        $this->login($renter_id);
        $pages= new PagesController;
        $expectedPaymentID='D219E68A030ED23F8837';
        $paymentHistoryID= $pages->paymentHistory()['pay']->first()['pay_id'];
        $this->assertEquals($paymentHistoryID, $expectedPaymentID,"actual value is not equals to expected");
    }
    public function testRentHistory()
    {
        $owner_id=8;
        $this->login($owner_id);
        $pages= new PagesController;
        $expectedPaymentID='D219E68A030ED23F8837';
        $paymentHistoryID= $pages->rentHistory()['pay']->first()['pay_id'];
        $this->assertEquals($paymentHistoryID, $expectedPaymentID,"actual value is not equals to expected");
    }

    public function testingRentAndOwnerHistroy(){
        $renter_id=6;
        $this->login($renter_id);
        $pages= new PagesController;
        $RenterpaymentHistoryID= $pages->paymentHistory()['pay']->first()['pay_id'];

        $owner_id=8;
        $this->login($owner_id);
        $pages= new PagesController;
        $OwnerpaymentHistoryID= $pages->rentHistory()['pay']->first()['pay_id'];

        $this->assertEquals($RenterpaymentHistoryID, $OwnerpaymentHistoryID,"actual value is not equals to expected");
    }


    protected function login($id){
        Session::start();
        $user = User::find($id);
        Auth::login($user);
     }
}
