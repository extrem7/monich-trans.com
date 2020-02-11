<!doctype html>
<html lang="{{get_bloginfo('language')}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{!!wp_get_document_title()!!}</title>
    @yield('header')
    {{wp_head()}}
</head>
<body {{body_class()}} >
@include('header')
@yield('content')
@include('footer')
@include('includes.modals.order')
@include('includes.modals.success')
{{wp_footer()}}
</body>
</html>
