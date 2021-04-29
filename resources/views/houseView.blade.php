@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('House Details') }}</div>

                    <div class="card-body">
                      <div class="imageView">
                        <img  src="/storage/uploads/{{ $house->picture }}" class="img-fluid houseimage" alt="House image">
                      </div>
                        <form action="" class="p-4 mb-4" method="post">
                            @csrf
                            <label for="housename">House Name:</label>
                            <input disabled id="houseName" type="text" name="houseName" value="{{ $house->houseName }}"
                                class="form-control mb-2" placeholder="Enter House name">
                            <label for="houseDescription">Description:</label>
                            <input disabled id="houseDescription" type="text" name="houseDescription"
                                value="{{ $house->houseDescription }}" class="form-control mb-2"
                                placeholder="Enter House Description">
                            <label for="housePrice">House Price: (৳)</label>
                            <input id="housePrice" type="number" min="1" disabled max="99999" step="0.1"
                                value="{{ $house->housePrice }}" name="housePrice" class="form-control mb-4"
                                placeholder="1555.15">

                            <label for="ownerContact">Owner Contact Number</label>
                            <input id="ownerContact" type="number"disabled
                                value="{{ $house->ownerContact }}" name="ownerContact" class="form-control mb-4"
                                >
                          <label for="area">Area:</label>
                            <input disabled id="area" disabled type="text" name="area" value="{{ $house->area }}"
                                class="form-control mb-2" placeholder="Enter House Description">



                            <label for="Bedroom">Bedrooms:</label>
                            <input disabled type='number' min='1' classname='mr-2' value="{{ $house->bedroom }}"
                                list="bedroom" name="bedroom" id="bedroom">

                            <label for="washroom" class="ml-3">Washroom:</label>
                            <input disabled type='number' min='1' list="bedrooms" name="washroom"
                                value="{{ $house->washroom }}" id="washroom">
                            
                            @if (Auth::check())
                            @if ($house->owner_id != Auth::id())
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('house.review',$house->id)}}" class="btn btn-lg float-left btn-warning mt-4"> Review </a>
                                @if ($house->status == 1)
                                    <a href="{{ route('paywith',$house->id) }}" class="btn btn-lg float-right btn-success mt-4"> Pay </a>
                                @endif
                            </div> 
                            @endif
                            @else
                            <div class="d-flex justify-content-between">
                              <a href="{{ route('house.review',$house->id)}}" disabled class="btn btn-lg float-left btn-warning mt-4"> Review </a>
                              <a href="/login" class="btn btn-lg float-left btn-warning mt-4" role="alert">Please Log in</a>
                              <a href="" disabled class="btn btn-lg float-right btn-success mt-4"> Pay </a>
                              
                            @endif







                        </form>
                    </div>
                </div>



{{-- tryyyyyyyyyyyyy reviw --}}


<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Fixed Top Navbar Example for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/review.css') }}" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    <div class="container ">
    
		<div class="row ">
			<div class="col-sm-3">
				<div class="rating-block">
					<h4>Average user rating</h4>
					<h2 class="bold padding-bottom-7">{{ $Counter['totalAvg'] }}<small>/ 5</small></h2>
                    @for ($i=1;$i<=round($Counter['totalAvg']);$i++)
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                      </button>
                    @endfor
                    @for ($i=round($Counter['totalAvg']);$i<5;$i++)
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                      </button>
                    @endfor
				</div>
			</div>
			<div class="col-sm-3">
				<h4>Rating breakdown</h4>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: {{ $Counter['5starPercent'] }}%">
							<span class="sr-only">{{ $Counter['5starPercent'] }}% Complete (danger)</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">{{ $Counter['5starCount'] }}</div>
				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: {{ $Counter['4starPercent'] }}%">
							<span class="sr-only">{{ $Counter['4starPercent'] }}% Complete (danger)</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">{{ $Counter['4starCount'] }}</div>
				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: {{ $Counter['3starPercent'] }}%">
							<span class="sr-only">{{ $Counter['3starPercent'] }}% Complete (danger)</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">{{ $Counter['3starCount'] }}</div>
				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: {{ $Counter['2starPercent'] }}%">
							<span class="sr-only">{{ $Counter['2starPercent'] }}% Complete (danger)</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">{{ $Counter['2starCount'] }}</div>
				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: {{ $Counter['1starPercent'] }}%">
							<span class="sr-only">{{ $Counter['1starPercent'] }}% Complete (danger)</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">{{ $Counter['1starCount'] }}</div>
				</div>
			</div>			
		</div>			
		
		<div class="row">
            @foreach ($reviews as $review )
            <div class="col-sm-7">
				<hr/>
				<div class="review-block">
					<div class="row">
						<div class="col-sm-3">
							<div class="review-block-name"><a href="#">{{ $review->username }}</a></div>
							<div class="review-block-date">{{ $review->updated_at }}</div>
						</div>
						<div class="col-sm-9">
							<div class="review-block-rate">
                                @for ($i = 0; $i < $review->rate; $i++)
                                <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                  </button>
                                @endfor

                                @for ($i = $review->rate; $i < 5; $i++)
                                    								<button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
								  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
								</button>
                                @endfor

							</div>
                            @if ($review->user_id==Auth::id())
                            <a href="{{ route('house.review',$house->id)}}" class="btn btn-sm float-right btn-warning mt-4"> Edit </a>
                            <a href="{{ route('house.review.delete',$review->id)}}" class="btn btn-sm float-right mr-2 btn-danger mt-4"> Delete </a>
                            @endif
                            
							<div class="review-block-title">{{ $review->comment }}</div>
						</div>
					</div>
					<hr/>
				</div>
			</div>
            @endforeach

		</div>
		
    </div> <!-- /container -->
                
            </div>


        </div>


          

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>





    </div>
@endsection
