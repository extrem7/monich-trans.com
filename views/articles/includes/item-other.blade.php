<article class="article-item">
    <a href="@link">
        @if (has_post_thumbnail())
            {{the_post_thumbnail('article', ['class' => 'article-img', 'alt' => get_the_title()])}}
        @else
            <img src="{{asset('img/404-img.jpg')}}" alt="no image" class="article-img">
        @endif
    </a>
    <div class="article-body">
        <a href="@link">
            <h3 class="base-size text-uppercase title-line">
                <span class="title-line-cap article-name">@title</span>
            </h3>
        </a>
        <div class="article-text title-line-cap">@excerpt</div>
        <div class="text-right">
            <a href="@link" class="read-more">@trans('Читать полностью')
                <img src="{{asset('img/icons/chevron-right-solid.svg')}}" alt="arrow-right"></a>
        </div>
    </div>
</article>
