@extends('layouts.app')
@section('content')
<div class="container">
    <div class="" style="margin-left:40%">
        <form class="form-inline " method="get" action="{{ route('house.search') }}">
            <input class="form-control mr-sm-2" type="search" placeholder="House Name or Area" aria-label="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>

    <div class="d-flex justify-content-between">
        <h4 class="mt-4">Available House For Rent</h4>
        <div class="mt-4">
            <form action="{{ route('house.filter') }}" method="POST">
                @csrf
                <select name="area" id="area">
                    @foreach ($areas as $area)
                    @if ($selectedId==$area->id)
                    <option selected value="{{ $area->name }}">{{ $area->name }}</option>
                    @else
                    <option value="{{ $area->name }}">{{ $area->name }}</option>
                    @endif
                    
                    @endforeach
                    
                </select>
                <button class="btn btn-outline-primary">
                    Filter
                </button>
            </form>
        </div>
    </div>
    <div class="row">
        @if (count($houses)>0)
        @foreach ($houses as $house )
        <div class="col-md-4 mt-3">
            <div class="card ">
                <div class="card-header">
                    <b>{{ $house->houseName }}</b>
                </div>
                
                <img  height="350" width="auto" src="/storage/uploads/{{ $house->picture }}" alt="House image">
                <div class="d-flex justify-content-between">
                    <div class="bg-light p-2 m-1">
                        <div class="d-flex">
                            <img src="/bedroom.png" class="img-fluid mr-2" alt="bedroom">
                            <h4>{{ $house->bedroom }}</h4>
                        </div>
                    </div>

                    <div class="bg-light p-2 m-1">
                        <div class="d-flex">
                            <img src="/toilet.png" class="img-fluid mr-2" alt="washroom">
                            <h4>{{ $house->washroom }}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted"><b>Area: </b>{{ $house->area }}</small>
                </div>



                <div class="card-footer">
                    <small class="text-muted"><b>Price:
                        </b>{{ $house->housePrice }} ৳</small>
                </div>

                <div class="card-footer">
                    <a href="{{ route('view.house',$house->id) }}"
                        class="btn btn-md btn-primary float-right text-white" type="button">View</a>
                </div>

            </div>
        </div>
            
        @endforeach
            
        @else
            <h3>No available houses</h3>
        @endif
    </div>
</div>

@endsection