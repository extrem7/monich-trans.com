<ul class="language-menu">
    @foreach($languages as $lang)
        <li class="{{implode(' ',$lang['classes'])}}"><a href="{{$lang['url']}}">{{$lang['slug']}}</a></li>
    @endforeach
</ul>
