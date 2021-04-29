@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="housed card p-4">
                <h4 class="housed-header">{{ __('List a house to Rent') }}</h4>

                <div class="housed-body">
                    <form action="{{ route('house.store') }}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <label for="houseName">House Name:</label>
                        <input id="houseName" type="text" name="houseName" class="form-control mb-2"
                            placeholder="Enter House name">
                        <label for="houseDescription">Description:</label>
                        <input id="houseDescription" type="text" name="houseDescription" class="form-control mb-2"
                            placeholder="Enter House Description">
                        <label for="housePrice">House Price: (৳)</label>
                        <input id="housePrice" type="number" min="1000" max="99999" step="500" name="housePrice"
                            class="form-control mb-4" placeholder="15500">
                        <label for="houseImage">House Image: (৳)</label>
                        <input id="houseImage" type="file"  name="image"
                            class="form-control mb-4" >


                        @if (count($areas) > 0)
                            <label for="area">Area:</label>
                            <select name="area" class="form-control mb-3" id="area">
                                @foreach ($areas as $area)
                                @if ($area->id==1)
                                 
                                @else
                                <option value={{ $area->name }}>{{ $area->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <label for="Bedrooms">Bedrooms:</label>
                                <input type='number' class="form-control" min='1' classname='mr-2' list="bedroom" name="bedroom" id="bedroom">
    
                            </div>

                            <div class="col-md-6">
                                <label for="washroom" class="">Washroom:</label>
                                <input type='number' class="form-control" min='1' list="washroom" name="washroom" id="washroom">
     
                            </div>

                        </div>

                        
                        
                        
                        <button type="submit" class="btn btn-lg float-right btn-success mt-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection