<a href="@link" class="country-way-item">
    <div class="way-box">
        <div class="flag">
            {!!get_the_post_thumbnail()!!}
        </div>
        <div class="way-arrow-box">
            <img src="{{asset('img/icons/arrow-black.svg')}}" alt="arrow" class="way-arrow">
            <img src="{{asset('img/icons/arrow-black-transform.svg')}}" alt="arrow"
                 class="way-arrow">
        </div>
        <div class="flag"><img src="{{asset('img/'.$flag)}}" alt="country"></div>
    </div>
    <div class="text-center">@trans('Перевозки с (в)') <span class="bold-weight">{{get_field('country')}}</span></div>
</a>
