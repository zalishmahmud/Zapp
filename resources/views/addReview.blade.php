@extends('layouts.app');
@section('content')
    <link rel="stylesheet" href="{{ asset('css/rating.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <div class="container container1">
      
        <form action="{{ route('house.review.store',$house_id) }}" method="POST">
            @csrf
        <div class="star-widget">
            <input type="radio" value="5"  name="rate" id="rate-5">
            <label for="rate-5" class="fas fa-star"></label>
            <input type="radio" value="4"  name="rate" id="rate-4">
            <label for="rate-4" class="fas fa-star"></label>
            <input type="radio" value="3"  name="rate" id="rate-3">
            <label for="rate-3" class="fas fa-star"></label>
            <input type="radio" value="2"  name="rate" id="rate-2">
            <label for="rate-2" class="fas fa-star"></label>
            <input type="radio" value="1" name="rate" id="rate-1">
            <label for="rate-1" class="fas fa-star"></label>
            <header></header>
                <div class="textarea">
                    <textarea cols="30" id="comment" name="comment" placeholder="Describe your experience.."></textarea>
                    <!-- Due to more textarea tags I got a problem So I've changed the textarea tag to textare. Please correct it. -->

                    <br />

                </div>
                <button type="submit" class="btn btn-lg float-right btn-success mt-4">Submit</button>
            </form>
        </div>
    {{-- <script>
        const btn = document.querySelector("button");
        const post = document.querySelector(".post");
        const widget = document.querySelector(".star-widget");
        const editBtn = document.querySelector(".edit");
        btn.onclick = () => {
            widget.style.display = "none";
            post.style.display = "block";
            editBtn.onclick = () => {
                widget.style.display = "block";
                post.style.display = "none";
            }
            return false;
        }

    </script> --}}


@endsection
