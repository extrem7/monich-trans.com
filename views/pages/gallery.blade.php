<?
/* @var $galleries WP_Post[] */
global $post;
?>
@extends('layouts.base')
@section('content')
    <main class="content">
        <div class="container">
            <div class="row gallery-wrapper mob-inline-blocks">
                @foreach($galleries as $gallery)
                    @php $hidden = ($loop->index+1 > 9) @endphp
                    @php $photos = get_field('photos',$gallery->ID)  @endphp
                    <div class="col-lg-4 col-md-6 gallery-item {{$hidden ? 'item-to-load' : ''}}" {!!$hidden ? 'style="display:none"' : ''!!}>
                        <a href="{{$photos[0]['url']}}" data-fancybox="gallery-{{$gallery->post_name}}"
                           class="gallery-main-img d-block"
                           style="background-image: url('{{get_the_post_thumbnail_url($gallery->ID)}}')">
                            <div class="gallery-title"><span
                                        class="title-line-cap">{{get_the_title($gallery->ID)}}</span></div>
                        </a>
                        @php unset($photos[0])  @endphp
                        @foreach($photos as $photo)
                            <a href="{{$photo['url']}}" data-fancybox="gallery-{{$gallery->post_name}}" class="d-none">
                                <img src="{{$photo['url']}}" alt="{{$photo['alt']}}">
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>
            @if(count($galleries)>9)
                <div class="text-center">
                    <button class="btn btn-outline-yellow btn-shadow dark mw-230 load-items">@trans('Загрузить еще')</button>
                </div>
            @endif
        </div>
    </main>
@endsection
