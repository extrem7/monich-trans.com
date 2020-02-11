@extends('layouts.base')
@section('content')
    <main class="content">
        <div class="container">
            <div class="row articles">
                @while (have_posts())
                    @php the_post() @endphp
                    <div class="col-md-6">
                        @include('articles.includes.item')
                    </div>
                @endwhile
            </div>
            {!! app()->pagination() !!}
        </div>
    </main>
@endsection
