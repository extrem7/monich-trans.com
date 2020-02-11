<?
global $post;
?>
@extends('layouts.base')
@section('content')
    <main class="content">
        <div class="container">
            <div class="row align-items-start reviews-list">
                @row('reviews')
                @php $hidden = (get_row_index() > get_field('limit')) @endphp
                <div class="col-md-6 review-item {{$hidden ? 'item-to-load' : ''}}" {!!$hidden ? 'style="display:none"' : ''!!}>
                    <div class="review-box">
                        <div class="second-title review-author"><span>{{get_sub_field('name')}}</span></div>
                        <div class="review-body">
                            <div class="review-country text-center">({{get_sub_field('country')}})</div>
                            <div class="d-flex align-items-center">
                                <div class="review-link-doc">
                                    <img src="{{asset('img/icons/document.svg')}}" alt="document">
                                    <a href="{{get_sub_field('photo')}}" class="link-doc"
                                       data-fancybox="review-1">@trans('Посмотреть оригинал отзыва')</a>
                                </div>
                                <div class="review-date">{{get_sub_field('date')}}</div>
                            </div>
                            <div class="review-text">{!! get_sub_field('text') !!}</div>
                        </div>
                    </div>
                </div>
                @rowend
            </div>
            <div class="text-center">
                <button class="btn btn-outline-yellow btn-shadow dark mw-230 load-items">@trans('Загрузить еще')</button>
            </div>
        </div>
    </main>
@endsection
