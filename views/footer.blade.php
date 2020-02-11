<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-5 text-center text-md-left">
                <img src="{{asset('img/logo.svg')}}" class="logo-footer" alt="logo-footer">
                <address>
                    {!! $copyright !!}
                    <br><br>
                    EORI: @option('eori')
                </address>
                <div class="phone-footer">
                    @row('footer_phones','option')
                    @php $phone = get_sub_field('phone')  @endphp
                    <a href="{{tel($phone)}}">{{$phone}}</a>
                    @rowend
                </div>
            </div>
            <div class="col-lg-6 col-md-7 mt-4 mt-md-0">
                <div class="d-flex justify-content-between">
                    <div class="column">
                        <div class="title-footer">@trans('Услуги компании')</div>
                        <? wp_nav_menu([
                            'theme_location' => 'services',
                            'container' => null,
                            'menu_class' => ''
                        ]); ?>
                    </div>
                    <div class="column">
                        <div class="title-footer">@trans('Перевозки с Европы')</div>
                        <? wp_nav_menu([
                            'theme_location' => 'transfers',
                            'container' => null,
                            'menu_class' => ''
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3 text-center text-md-left">{{$copyrightBottom}}</div>
            @include('includes.social')
        </div>
    </div>
</footer>
