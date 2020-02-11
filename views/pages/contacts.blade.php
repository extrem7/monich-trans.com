@extends('layouts.base')
@section('content')
    <main class="content">
        <section class="section-contact-info">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 clip-path-wrapper clip-shadow">
                        <div class="box-contact">
                            <div class="contact-info">
                                <div class="item address">
                                    <img src="{{asset('img/icons/map-point-black.svg')}}" alt="map">
                                    <div>{!! get_field('address') !!}</div>
                                </div>
                                <div class="item phone">
                                    <img src="{{asset('img/icons/smartphone-black.svg')}}" alt="map">
                                    <div>{!! get_field('phones_uk') !!}</div>
                                </div>
                                <div class="item global-contact">
                                    <img src="{{asset('img/icons/globus-black.svg')}}" alt="map">
                                    <div>{!! get_field('phones_world') !!}</div>
                                </div>
                                <div class="item skype">
                                    <img src="{{asset('img/icons/skype-big-black.svg')}}" alt="map">
                                    <div><a href="skype:@option('skype')">@option('skype')</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 dynamic-content base-size">{!!get_field('text_right')!!}</div>
                    <div class="col-xl-6 dynamic-content base-size mt-5">{!!get_field('text_left')!!}</div>
                    <div class="col-xl-6 mt-5">
                        <div class="clip-path-wrapper clip-shadow text-center">
                            <img src="{{asset('img/about_services.jpg')}}" alt="service" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-contact-form">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-title mb-4">@trans('У Вас остались вопросы?')</h2>
                    <div>@trans('Мы с нетерпением ждем вашего обращения:')</div>
                </div>
                <form class="contact-form">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="form-group">
                            <img src="{{asset('img/icons/user.svg')}}" class="icon-control" alt="name">
                            <input type="text" class="form-control material-style" name="name" placeholder="@trans('Имя')"
                                   required>
                        </div>
                        <div class="form-group">
                            <img src="{{asset('img/icons/envelope.svg')}}" class="icon-control" alt="email">
                            <input type="email" class="form-control material-style" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <img src="{{asset('img/icons/telephone.svg')}}" class="icon-control" alt="phone">
                            <input type="text" class="form-control material-style" name="phone" placeholder="@trans('Телефон')"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <img src="{{asset('img/icons/document.svg')}}" class="icon-control" alt="comment">
                        <textarea id="" rows="1" class="form-control material-style" name="comment"
                                  placeholder="@trans('Текст сообщения')"></textarea>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-yellow mw-230 btn-shadow">@trans('Задать вопрос')
                            <span class="spinner-border text-light"></span>
                        </button>
                        <input type="hidden" name="subject" value="У Вас остались вопросы?">
                        <input type="hidden" name="action" value="mail">
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
