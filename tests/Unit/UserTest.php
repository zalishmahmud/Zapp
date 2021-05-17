<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Auth;
class UserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRegister(){
        
        $data=['name'=>'Faisal','phone'=>'0183344332233','email'=>'faisal@gmail.com','password'=>'chikon619' ,'password_confirmation'=>'chikon619'];
        $response=$this->json('POST', '/register',$data);
       
        $this->assertDatabaseHas('users', [
            'email'=>'faisal@gmail.com'
        ]);
    }


    public function testLogin(){
        $data=['email'=>'arman@gmail.com','password'=>'12345678'];
        $response=$this->json('POST', '/login',$data);
        $this->assertEquals($data['email'],Auth::user()->email);
    }
}
