@extends('frontend::layouts.layout')

@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="ads-banner">

                    </div>
                    {{--文章--}}
                    <div class="post-content">
                        <div class="post-tab">

                        </div>
                        {{--文章列表--}}
                        <div class="post-list">
                            <ul>
                                <li>
                                    <div class="post">
                                        <a class="" href="" target="_blank">
                                            <div class="post-cover">
                                                <img class="post-img" src="{{ asset('frontend/assets/images/1.jpg') }}">
                                            </div>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                {{--边栏--}}
                <div class="col-lg-4 sidebar">
                    <h1>边栏</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
