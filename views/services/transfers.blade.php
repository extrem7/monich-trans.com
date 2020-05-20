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
        <section class="section-country-select">
            <div class="container">
                <h2 class="section-title">{!! get_field('countries_title') !!}</h2>
                <div class="base-size mb-0 mb-md-5">(@trans('выберите страну из списка'))</div>
                <div class="row selected-country sm-inline-blocks">
					@php global $post  @endphp
					@foreach($ukraine as $post)
					<div class="col-lg-3 col-md-4">
						@php $flag = get_field('country_from') == 'ua' ? 'uk.jpg' : 'ru.jpg' @endphp
						@include('services.includes.country')
					</div>
					@endforeach
					@reset_query
                </div>
            </div>
        </section>
        @include('services.includes.advantages')
        <section class="section-country-select">
            <div class="container">
                <h2 class="section-title">{!! get_field('countries_title_second') !!}</h2>
                <div class="base-size mb-0 mb-md-5">(@trans('выберите страну из списка'))</div>
                <div class="row selected-country sm-inline-blocks">
                        @php global $post  @endphp
                        @foreach($russia as $post)
						<div class="col-lg-3 col-md-4">
							@php $flag = get_field('country_from') == 'ua' ? 'uk.jpg' : 'ru.jpg' @endphp
							@include('services.includes.country')
						</div>
                        @endforeach
                        @reset_query
                </div>
            </div>
        </section>
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
