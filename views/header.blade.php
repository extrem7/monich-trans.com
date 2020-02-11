@php
    if (!is_404()){
    $headerCLass = is_front_page()?'header-main':'header-page';
    }
@endphp
<header class="header {{$headerCLass}}"
        @if(!(is_front_page()||is_404()))style="background-image: url('{{$background}}')"@endif>
    <div class="header-top">
        <div class="container">
            <a href="{{get_bloginfo('url')}}" class="logo">@icon(logo)</a>
            <nav class="menu-container">
                <button class="close-btn icon"><img src="{{asset('img/icons/close.svg')}}" alt="close"></button>
                <? wp_nav_menu([
                    'theme_location' => 'header',
                    'container' => null,
                    'menu_class' => 'menu'
                ]); ?>
                @include('includes.languages')
            </nav>
            <div class="d-flex">
                <div class="feedback-box">
                    <div class="phone">
                        <img src="{{asset('img/icons/phone'.(is_404()?'-black.svg':'.svg'))}}" alt="phone">
                    </div>
                    <div class="feedback-info">
                        <div class="info">
                            <div><img src="{{asset('img/icons/viber.svg')}}" alt="viber"> <a
                                        href="{{tel($viber)}}">{{$viber}}</a></div>
                            <div><img src="{{asset('img/icons/whatsapp.svg')}}" alt="whatsapp"><a
                                        href="{{tel($whatsapp)}}">{{$whatsapp}}</a></div>
                            <div><img src="{{asset('img/icons/skype.svg')}}" alt="skype"><a
                                        href="skype:@option('skype')">@option('skype')</a></div>
                            <div><img src="{{asset('img/icons/email.svg')}}" alt="email"><a
                                        href="mailto:@option('email')">@option('email')</a>
                            </div>
                        </div>
                    </div>
                </div>
                @include('includes.languages')
            </div>
            <button class="mobile-btn" id="mobile-btn"><span></span><span></span><span></span></button>
        </div>
    </div>
    @if(!is_404())
        <div class="container container-height">
            @if(is_front_page())
                <div class="home-banner-text page-banner">
                    <div class="light-weight base-size">{!! get_field('subtitle') !!}</div>
                    <div class="page-title">{!! $title !!}</div>
                    <div class="base-size page-sub-title">{!! $text !!}</div>
                    <a href="" data-toggle="modal" data-target="#order"
                       class="btn btn-yellow">@trans('Заказать перевозку')</a>
                </div>
            @else
                <div class="page-banner">
                    <div class="page-title">{!! $title !!}</div>
                    <div class="base-size page-sub-title">{!! $text !!}</div>
                </div>
                {{breadcrumbs()}}
            @endif
        </div>
    @endif
</header>

