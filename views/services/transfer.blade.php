@extends('layouts.base')
@section('content')
    <main class="content">
        <section class="section-shipping-service">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 to">
                        <div class="country-way-box">
                            <div class="way">
                                <div class="flag">{!!get_the_post_thumbnail($post->ID,'full')!!}</div>
                                <div class="d-flex align-items-center justify-content-center"><img src="{{asset('img/icons/arrow-white.svg')}}" class="way-arrow" alt=""></div>
                                <div class="flag"><img src="{{asset('img/'.$flag)}}" alt="flag"></div>
                            </div>
                            <div class="way-title">@trans('Перевозки с') <span class="bold-weight">{{$country}}</span></div>
                            <div>{!! get_field('block_left') !!}</div>
                            <button class="btn btn-outline-yellow mw-230" data-toggle="modal" data-target="#order">@trans('Расчитать стоимость')</button>
                        </div>
                        <div class="dynamic-content">{!! get_field('text_left') !!}</div>
                    </div>
                    <div class="col-md-6 from">
                        <div class="country-way-box">
                            <div class="way">
                                <div class="flag">{!!get_the_post_thumbnail($post->ID,'full')!!}</div>
                                <div class="d-flex align-items-center justify-content-center"><img src="{{asset('img/icons/arrow-white-transform.svg')}}" class="way-arrow" alt=""></div>
                                <div class="flag"><img src="{{asset('img/'.$flag)}}" alt="flag"></div>
                            </div>
                            <div class="way-title">@trans('Перевозки в') <span class="bold-weight">{{$countryTo}}</span></div>
                            <div>{!! get_field('block_right') !!}</div>
                            <button class="btn btn-outline-yellow mw-230" data-toggle="modal" data-target="#order">@trans('Расчитать стоимость')</button>
                        </div>
                        <div class="dynamic-content">{!! get_field('text_right') !!}</div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
