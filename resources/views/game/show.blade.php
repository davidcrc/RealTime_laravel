@extends('layouts.app')

@push('styles')
<style type="text/css">
    
    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to{
            transform: rotate(360deg);
        }
    }

    .refresh{
        animation: rotate 1.5s linear infinite;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Game') }}</div>

                <div class="card-body">
                    <div class="text-center">
                        <img id="circle"  width="250" height="250" src="{{asset('img/circle.png')}}" alt="img ruleta">

                        <p id="winner" class="display-1 d-none text-primary">10</p>
                    </div>

                    <hr>

                    <div class="text-center">
                        <label for="" class="fornt-weight-bold h5" >Your bet</label>

                        <select name="" id="bet" class="custom-selected col-auto" >
                            <option value="" selected>Not in</option>

                            @foreach (range(1,12) as $number)
                                <option> {{$number}} </option> 
                            @endforeach
                        </select>

                        <hr>

                        <p class="fornt-weight-bold h5" >Remaining Time</p>
                        <p id="timer" class="h5 text-danger" >Waiting to start </p>

                        <hr>

                        <p id="result" class="h1"></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection