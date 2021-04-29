@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit House') }}</div>
    
                    <div class="card-body">
                        <form action="{{ route('house.update',$house->id) }}" method="post">
                            @csrf
                            <label for="housename">House Name:</label>
                            <input  id="houseName" type="text" name="houseName" value="{{ $house->houseName }}"class="form-control mb-2" placeholder="Enter House name">
                            <label for="houseDescription">Description:</label>
                            <input  id="houseDescription" type="text" name="houseDescription" value="{{ $house->houseDescription }}" class="form-control mb-2" placeholder="Enter House Description">
                            <label for="housePrice">House Price (৳): </label>
                            <input  id="housePrice" type="number" min="1000" max="99999" step="500" value="{{ $house->housePrice }}" name="housePrice" class="form-control mb-4" placeholder="15500">
                         
                             
     
                             @if (count($areas)>0)
                             <label for="area">Area:</label>
                             <select name="area" id="area" value="{{ $house->area }}">
                             @foreach ($areas as $area)
                             @if ($area->id==1)
                                 
                             @else
                             <option value={{ $area->name }}>{{ $area->name }}</option>
                             @endif
                             
                              @endforeach
                             </select>
                              @endif
                            
     
     
     
                            <label for="Bedroom">Bedrooms:</label>
                             <input type='number' min='1' classname='mr-2' value="{{ $house->bedroom }}" list="bedroom" name="bedroom" id="bedroom">
     
                             <label for="washroom" class="ml-3">Washroom:</label>
                             <input type='number'min='1' list="bedrooms" name="washroom" value="{{ $house->washroom }}" id="washroom">
     
                            <button type="submit" class="btn btn-lg float-right btn-success mt-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection