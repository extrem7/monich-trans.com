@extends('layouts.base')
@section('content')
    <main class="content">
        <div class="container">
            <div class="row services-list sm-inline-blocks">
                @php global $post  @endphp
                @foreach($services as $post)
                    <a href="@link" class="col-xl-3 col-lg-4 col-md-6 service-item">
                        <div class="service-icon"><img src="{{get_field('icon')}}" alt="@title"></div>
                        <div class="service-short-info">
                            <div class="base-size text-uppercase">@title</div>
                            <div class="service-text title-line-cap">@excerpt</div>
                            <span class="link-more regular-weight">
                            <span>@trans('Подробнее')</span>
                            <img src="{{asset('img/icons/arrow-right-solid.svg')}}" class="ml-1" alt="right">
                        </span>
                        </div>
                    </a>
                @endforeach
                @reset_query
            </div>
        </div>
        <section class="section-about-services">
            <div class="container">
                <div class="section-title">{!! get_field('subtitle') !!}</div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="dynamic-content base-size">@content</div>
                    </div>
                    <div class="col-lg-6 text-center mt-4 mt-lg-0">
                        {!!get_the_post_thumbnail($post->ID,'full',['class'=>'img-fluid'])!!}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
