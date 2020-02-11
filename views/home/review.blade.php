<div class="col-md-6 review-item">
    <div class="review-box">
        <div class="second-title">{{get_sub_field('name')}}</div>
        <div class="review-country">({{get_sub_field('country')}})</div>
        <div class="review-text title-line-cap">{!! get_sub_field('text') !!}</div>
        <div class="d-flex align-items-center">
            <div class="review-link-doc">
                <img src="{{asset('img/icons/document.svg')}}" alt="document">
                <a href="{{get_sub_field('photo')}}" class="link-doc"
                   data-fancybox="review-1">@trans('Посмотреть оригинал отзыва')</a>
            </div>
            <div class="review-date">{{get_sub_field('date')}}</div>
        </div>
    </div>
</div>
