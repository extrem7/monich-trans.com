@extends('layouts.base')
@section('content')
    <main class="content">
        <section class="section-about-company container">
            <div class="row">
                <div class="col-12">
                    <h1 class="section-title title-line size30">{{get_field('text_title')}}</h1>
                    <div class="about-company dynamic-content">@content</div>
                </div>
            </div>
        </section>
        <section class="section-we-propose bg-dark-yellow">
            <div class="container">
                <h2 class="section-title size30">{{get_field('blocks_title')}}</h2>
                <div class="row propose">
                    @row('blocks')
                    <div class="col-lg-4 col-md-6">
                        <div class="item box-shadow">
                            <img src="{{get_sub_field('image')}}" alt="1">
                            <div class="propose-body">
                                <div class="item-label">{{get_sub_field('name')}}</div>
                                {{get_sub_field('text')}}
                            </div>
                        </div>
                    </div>
                    @rowend
                </div>
            </div>
        </section>
    </main>
@endsection
