@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">House Name</th>
                <th scope="col">House Price</th>
                
                <th scope="col">Area</th>
                <th scope="col">Transaction ID</th>                               
                <th scope="col">Date</th>
                <th scope="col">View House Info</th>
                <th scope="col">View Renter Info</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($pay as $row)
                <tr>
                    <td>{{ $row->house_name }}</td>
                    <td>{{ $row->housePrice }}</td>
                    <td>{{ $row->area }}</td>
                    <td>{{ $row->pay_id }}</td>                  
                    <td>{{ $row->updated_at }}</td>
                    <td><a href="{{ route('view.house',$row->house_id) }}"
                      class="btn btn-md btn-outline-success " type="button">View</a></td>
                    <td> <a href="{{ route('view.renterinfo',$row->id) }}" class="btn btn-outline-primary">view</a></td>
                  </tr>
                @endforeach

            </tbody>
          </table>
    </div>
@endsection