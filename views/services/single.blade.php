@extends('layouts.base')
@section('content')
    <main class="content">
        <div class="container">
            <div class="dynamic-content first-service-text-block">@content</div>
            <div class="text-center">
                <button class="btn btn-yellow btn-shadow mw-230 mb-5" data-toggle="modal" data-target="#order">
                    @trans('Заказать услугу')
                </button>
            </div>
        </div>
        <section class="section-service-text">
            <div class="container">
                <div class="section-title">{!! get_field('subtitle') !!}</div>
                <div class="dynamic-content">{!! get_field('section') !!}</div>
            </div>
        </section>
       @include('services.includes.advantages')
        <section class="section-about-service">
            <div class="container">
                <div class="section-title">@title</div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="dynamic-content">{!! get_field('short_text') !!}</div>
                    </div>
                    <div class="col-lg-6 text-center mt-4 mt-lg-0">
                        <div class="clip-path-wrapper clip-shadow">
                            {!!get_the_post_thumbnail($post->ID,'full',['class'=>'img-fluid'])!!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
