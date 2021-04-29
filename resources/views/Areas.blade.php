@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="Aread">
                <div class="Aread-header">{{ __('List a Area') }}</div>

                <div class="Aread-body">
                   <form action="{{ route('Area.store') }}" method="post">
                       @csrf
                       <label for="Areaname">Area:</label>
                       <input  id="Areaname" type="text" name="AreaName" class="form-control mb-2" placeholder="Enter Area">
                      <button type="submit" class="btn btn-lg float-right btn-success mt-4">Submit</button>
                   </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (count($areas)>0)
                @foreach ($areas as $area)
                    <div class="Aread p-4 m-2">
                        <h4>{{ $area->name }}</h4>
                        <a href="{{ route('Area.edit', $area->id) }}" class="btn btn-md btn-info text-white" type="button">Edit</a>
                    </div>
                @endforeach
                
            @else
            <div class="Aread p-4 m-2">
                <h4>No Areas</h4>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection