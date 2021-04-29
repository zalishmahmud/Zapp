@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="Aread">
                    <div class="Aread-header">{{ __('List a Area') }}</div>
    
                    <div class="Aread-body">
                       <form action="{{ route('Area.update', $area->id) }}" method="post">
                           @csrf
                           <label for="Areaname">Area Name:</label>
                           <input  id="Areaname" type="text" name="AreaName" class="form-control mb-2" value="{{ $area->name }}" placeholder="Enter Area name">
    
                         <button type="submit" class="btn btn-lg float-right btn-success mt-4">Update</button>
                       </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection