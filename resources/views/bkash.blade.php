@extends('layouts.app')
@section('content')
<div class="container">
    <div class="center">
        <button class="poibtn btn btn-md btn-success m-0" hidden id="clickButton" data-toggle="modal" data-target="#bkashModal">Pay with Bkash</button>
    </div>

    <div class="modal top fade" id="bkashModal">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body bkash-body p-0">
                    <img src="/bkash_payment_logo.png" class="img-fluid" alt="">
    
                   <div class="bkash-card m-3 p-4">
                       <p class="text-white">Merchant Id: Zapp LTD.</p>
                       <p class="text-white">Invoice No. XXXXXX</p>
                       <p class="text-white">Amount: {{ $house->housePrice }} ৳</p>
                   </div>
                   <div class="p-4">
                   <p class="text-center text-white"> Your bkash Number</p>
                   <input type="text" class="form-control bkash-input" placeholder="e.g.01XXXXXXXX" id="">
                   <div class="d-flex justify-content-between mx-3 mt-2">
                       <a href="{{ route('make.payment',$house->id) }}" class="btn text-white"> Proceed </a>
                       <a href="{{ route('view.house',$house->id) }}"   class="btn text-white">Close</a>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    window.onload = function(){
    var button = document.getElementById('clickButton');
    button.click();
}
</script>

@endsection
