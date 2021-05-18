<?php


use Tests\TestCase;
use Session;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ReviewController;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RouteTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testHomeRoute()
    {
        $this->get('/home')
        ->assertStatus(200);
    }


    public function testProtectedRoute(){
        $this->get('/myhouses')
        ->assertStatus(302);
    }

    public function testLoggedinRoute(){
        $this->login(1);

        $this->get('/myhouses')
        ->assertStatus(200);
    }


    public function testReviewRoute()
    {   $this->login(1);
        $response = $this->get('/review/25');
        $response = $this->getResponseData($response,'review')[0];
        $this->assertDatabaseHas('reviews', [
            'comment'=>$response->comment,
            'rate'=>$response->rate,
        ]);

        $this->assertDatabaseHas('reviews', [
            'rate'=>$response->rate,
        ]);

        $this->assertDatabaseHas('reviews', [
            'username'=>$response->username,
        ]);
    }

    public function testViewHouseRoute(){
        $response=$this->get('/house/28');
        $response=$this->getResponseData($response,'house');
        $this->assertDatabaseHas('houses', [
            'houseName'=>$response->houseName,
        ]);

        $this->assertDatabaseHas('houses', [
            'houseDescription'=>$response->houseDescription,
        ]);

        $this->assertDatabaseHas('houses', [
            'housePrice'=>$response->housePrice,
        ]);

        $this->assertDatabaseHas('houses', [
            'housePrice'=>$response->housePrice,
        ]);
    }

    public function testupdateMyhouseRoute(){
        $this->login(1);
        $response=$this->postJson('/myhouses/update/29', [
        'houseName'=>'Test',
        'housePrice'=>2000,
        'houseDescription'=>'testing',
        'area'=>'Banani',
        'bedroom'=>5,
        'washroom'=>2,]);
        $this->assertDatabaseHas('houses', [
            'houseName'=>'Test'
        ]);

        $this->assertDatabaseHas('houses', [
            'housePrice'=>2000
        ]);

        $this->assertDatabaseHas('houses', [
            'houseDescription'=>'testing'
        ]);

        $this->assertDatabaseHas('houses', [
            'area'=>'Banani'
        ]);

        $this->assertDatabaseHas('houses', [
            'bedroom'=>5
        ]);

        $this->assertDatabaseHas('houses', [
            'washroom'=>2
        ]);
    
    }

    public function testDelhouseRoute(){
        $this->login(1);
        $this->get('/myhouses/delete/29');
        $this->assertDatabaseMissing('houses', [
            'id'=>29
        ]);
    }

    public function testMakePaymentRoute(){
        $this->login(1);
        $this->get('/payment/26')
        ->assertStatus(200);
    }

    public function testPaymentHistoryRoute(){
        $this->login(1);
        $this->get('paymentHistory')
        ->assertStatus(200);
    }
    public function testRenterinfoRoute(){
        $this->login(4);
        $response = $this->get('/getrenterinfo/23');
        $response = $this->getResponseData($response,'user')->first();
        $this->assertEquals($response->name, "Zalish Mahmud");

    }


    public function testOwnerinfoRoute(){
        $this->login(1);
        $response = $this->get('/getownerinfo/23');
        $response = $this->getResponseData($response,'user');
        $this->assertEquals($response->name, "Biash");

    }


    protected function getResponseData($response, $key){
        $content = $response->getOriginalContent();
        $content = $content->getData();
       return $content[$key];
    
    }

    protected function login($id){
        Session::start();
        $user = User::find($id);
        Auth::login($user);
     }
}
