<section class="section-service-advantages">
    <div class="container">
        <div class="row">
            @foreach($advantages as $advantage)
                <div class="col-md-4">
                    <div class="advantage-item white-color">
                        <div class="circle-icon"><img src="{{$advantage['icon']}}" alt="icon"></div>
                        <h3 class="second-title">{{$advantage['name']}}</h3>
                        <div class="small-size">{{$advantage['text']}}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
