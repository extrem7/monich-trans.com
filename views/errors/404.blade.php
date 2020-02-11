@extends('layouts.base')
@section('content')
    <main class="content">
        <div class="container">
            <div class="text-center">
                <div class="error-title">404</div>
                <div class="section-title mt-2">@trans('Эта страница недоступна')</div>
                <div class="mt-3">@trans('Возможно, вы  воспользовались недействительной ссылкой или страница была удалена.')</div>
                <a href="{{get_bloginfo('url')}}" class="btn btn-yellow mw-230 mt-4">@trans('На главную')</a>
            </div>
        </div>
    </main>
@endsection
