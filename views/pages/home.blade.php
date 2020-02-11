<?
/*
 * @var $news WP_Post[]
 */
?>
@extends('layouts.base')
@section('content')
    <section class="section-main-block">
        <div class="container">
            <div class="row">
                @foreach($blocks as $class=>$block)
                    <div class="col-lg-4 col-md-6">
                        <div class="main-block {{$class}}">
                            <div class="base-size text-uppercase">{{$block['title']}}</div>
                            <div class="text title-line-cap">{{$block['text']}}</div>
                            <a href="{{$block['link']}}" class="btn btn-outline-yellow b-sm">{{$block['btn']}}</a>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-4 col-12">
                    <form class="main-block consultation-block">
                        <div class="base-size text-uppercase black-color">@trans('Получить бесплатную консультацию')</div>
                        <div class="form-box">
                            <div class="form-group">
                                <div class="label">@trans('Имя')</div>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <div class="label">Email</div>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <div class="label">@trans('Телефон')</div>
                                <input type="tel" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <button class="btn btn-outline-yellow dark btn-shadow b-sm">@trans('Заказать звонок') <span class="spinner-border text-light"></span></button>
                        <input type="hidden" name="subject" value="Получить бесплатную консультацию">
                        <input type="hidden" name="action" value="mail">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="section-about">
        <div class="container">
            <h2 class="section-title">{{$about['title']}}</h2>
            <div class="row">
                <div class="col-lg-6 base-size about-text">{!! $about['text'] !!}
                    <a href="{{get_permalink(pll_get_post(12))}}"
                       class="link-more base-size mt-3"><span>@trans('Подробнее')</span><img
                                src="{{asset('img/icons/arrow-right-solid.svg')}}" class="ml-1" alt="right"></a>
                </div>
                <div class="col-lg-6">
                    <div class="owl-carousel owl-theme owl-about">
                        @foreach($about['gallery'] as $image)
                            <div class="clip-path-wrapper clip-shadow">
                                <img src="{{$image['url']}}" alt="{{$image['alt']}}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-advantages">
        <div class="container">
            <h2 class="section-title white-color">{{$advantages['title']}}</h2>
            <div class="row">
                @foreach($advantages['blocks'] as $block)
                    <div class="col-md-6 col-lg-4">
                        <div class="advantage-item">
                            <div class="d-flex align-items-center">
                                <div class="circle-icon">
                                    {!! $block['icon']?file_get_contents($block['icon']):'' !!}
                                </div>
                                <div class="second-title">{{$block['name']}}</div>
                            </div>
                            {!! $block['text'] !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="section-map">
        <div class="container">
            <h2 class="section-title">{{$statistics['title']}}</h2>
            <div class="statistics">
                @foreach($statistics['blocks'] as $block)
                    <div class="text-center">
                        <div class="statistics-title" data-count="{{$block['count']}}">0</div>
                        <div class="statistics-second-title">{{$block['name']}}</div>
                    </div>
                @endforeach
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 col-xl-7">
                    <img src="{{asset('img/map.svg')}}" class="img-fluid map-svg" alt="">
                </div>
                <div class="col-lg-6 col-xl-5">
                    <ul class="list-country">
                        @foreach($statistics['countries'] as $item)
                            <li><a href="{{$item['link']}}">{{$item['country']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="section-our-partner">
        <div class="container">
            <h2 class="section-title white-color">{{$partners['title']}}</h2>
            <div class="owl-carousel owl-theme owl-partner">
                @foreach($partners['gallery'] as $image)
                <div class="partner-item">
                        <img src="{{$image['url']}}" alt="{{$image['alt']}}">
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="section-review">
        <div class="container">
            <h2 class="section-title">{{$titles['reviews']}}</h2>
            <div class="row">
                @row('reviews',pll_get_post(46))
                @php  if (!get_sub_field('show_at_home')) continue; @endphp
                @include('home.review')
                @rowend
            </div>
            <div class="text-right">
                <a href="{{get_permalink(pll_get_post(46))}}" class="link-more mt-3">Просмотреть все отзывы<img
                            src="{{asset('img/icons/arrow-right-solid.svg')}}" alt="right" class="ml-1"></a>
            </div>
        </div>
    </section>
    <section class="section-last-news">
        <div class="container">
            <h2 class="section-title">{{$titles['news']}}</h2>
            <div class="row sm-inline-blocks">
                @php global $post; @endphp
                @foreach ($news as $post)
                    <div class="col-lg-4">
                        @include('articles.includes.item-other')
                    </div>
                @endforeach
                @reset_query
            </div>
            <div class="text-right">
                <a href="{{get_term_link(pll_get_term(1))}}" class="link-more mt-3">Просмотреть все новости <img
                            src="{{asset('img/icons/arrow-right-solid.svg')}}" class="ml-1" alt="right"></a>
            </div>
        </div>
    </section>
    <section class="section-contact">
        <div class="container">
            <h2 class="section-title white-color">{{$titles['contacts']}}</h2>
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-info">
                        <div class="item address">
                            <img src="{{asset('img/icons/map-point.svg')}}" alt="map">
                            <div>{!!$contacts['address']!!}</div>
                        </div>
                        <div class="item phone">
                            <img src="{{asset('img/icons/smartphone.svg')}}" alt="map">
                            <div>{!!$contacts['phones_uk']!!}</div>
                        </div>
                        <div class="item global-contact">
                            <img src="{{asset('img/icons/globus.svg')}}" alt="map">
                            <div>{!!$contacts['phones_world']!!}</div>
                        </div>
                        <div class="item skype">
                            <img src="{{asset('img/icons/skype-big.svg')}}" alt="map">
                            <div><a href="skype:@option('skype')">@option('skype')</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-4 mt-lg-0">
                    <img src="{{asset('img/contact.jpg')}}" alt="contact" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
@endsection
