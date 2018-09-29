@extends('frontend::layouts.layout')

@section('content')
    <div class="row">

        <div class="col-md-8">
            {{ $userInfo->name }}
        </div>
        {{--边栏--}}
        <div class="col-md-4">

        </div>
    </div>

@endsection


