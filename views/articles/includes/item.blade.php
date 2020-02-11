<article class="article-item box-shadow">
    @if (has_post_thumbnail())
        {{the_post_thumbnail('article', ['class' => 'article-img', 'alt' => get_the_title()])}}
    @else
        <img src="{{asset('img/404-img.jpg')}}" alt="no image" class="article-img">
    @endif
    <h2 class="base-size text-uppercase title-line-cap article-name">@title</h2>
    <div class="text-center">
        <a href="@link" class="btn btn-yellow btn-shadow mw-230">@trans('Прочитать новость')</a>
    </div>
</article>
