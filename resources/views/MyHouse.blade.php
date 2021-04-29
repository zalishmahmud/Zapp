@extends('layouts.app')
@section('content')
    <div class="container">



        
        <div class="d-flex justify-content-between">
            <h4 class="mt-4">My House List</h4>
            <a href="{{ route('house.add') }}" class="btn btn-lg btn-info mb-4" > Add</a>
        </div>
        <div class="row">
            @if (count($houses)>0)
            @foreach ($houses as $house )
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header">
                        {{ $house->houseName }}
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
                        <a href="{{ route('house.edit', $house->id) }}"
                            class="btn btn-md btn-info text-white" type="button">Edit</a>
                        <a href="{{ route('house.delete', $house->id) }}"
                            class="btn btn-md btn-danger text-white" type="button">Delete</a>
                    @if ($house->status==0)
                    <a href="{{ route('house.sentRent', $house->id) }}"
                        class="btn btn-md btn-success text-white" value="Sent to Rent" type="button">Sent to Rent</a>
                    @else
                    <a href="{{ route('house.fromRent', $house->id) }}"
                        class="btn btn-md btn-warning text-white" type="button">Cancel Rent</a>
                    @endif
                    <a href="{{ route('view.house',$house->id) }}"
                        class="btn btn-md btn-primary text-white" type="button">View</a>
                    </div>

                </div>
            </div>
                
            @endforeach
                
            @else
                <h4> No House Available.</h4>
            @endif
        </div>
    </div>

    @endsection
