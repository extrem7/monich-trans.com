<?
global $post;
$q = 0;
?>
@extends('layouts.base')
@section('content')
    <main class="content">
        <div class="container">
            @row('sections')
            @php $section = get_row_index() @endphp
            <div class="faq-wrapper">
                <div class="section-title">{{get_sub_field('title')}}:</div>
                <div class="row" id="section-{{$section}}">
                    @row('qa')
                    @php $q++ @endphp
                    <div class="col-md-6">
                        <div class="faq-item">
                            <div class="faq-header">
                                <div class="base-size title-line">{{get_sub_field('q')}}</div>
                                <div class="faq-short title-line-cap">{{get_sub_field('a')}}</div>
                            </div>
                            <div id="question-{{$q}}" class="faq-body collapse"
                                 data-parent="#section-{{$section}}">
                                {{get_sub_field('a_full')}}
                            </div>
                            <button class="icon faq-open collapsed" data-toggle="collapse"
                                    data-target="#question-{{$q}}"
                                    aria-expanded="false">@trans('Читать полностью')
                                <img src="{{asset('img/icons/arrow-down.svg')}}" alt="arrow-down"></button>
                        </div>
                    </div>
                    @rowend
                </div>
            </div>
            @rowend
        </div>
    </main>
@endsection
