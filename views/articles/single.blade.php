<? /*
 * @var $posts WP_Post[]
 */ ?>
@extends('layouts.base')
@section('content')
    @php global $post @endphp
    <main class="content">
        <div class="container">
            <article class="article">
                <div class="article-title section-title size30 title-line">@title</div>
                <div class="dynamic-content article-text">
                    @content
                </div>
            </article>
        </div>
        <section class="section-last-news">
            <div class="container">
                <h2 class="section-title">@trans('Новости')</h2>
                <div class="row sm-inline-blocks">
                    @foreach ($posts as $post)
                        <div class="col-lg-4">
                            @include('articles.includes.item-other')
                        </div>
                    @endforeach
                </div>
                <div class="text-right">
                    <a href="{{get_category_link(1)}}" class="link-more mt-3">@trans('Просмотреть все новости') <img
                                src="{{asset('img/icons/arrow-right-solid.svg')}}" class="ml-1" alt="right"></a>
                </div>
            </div>
        </section>
    </main>
@endsection
