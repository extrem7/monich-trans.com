<div class="col-md-6 mt-3">
    <div class="media-block">
        @row('social_networks', 'option')
        <a href="{{get_sub_field('link')}}" target="_blank"> <img src="{{get_sub_field('icon')}}" alt="social-icon"></a>
        @rowend
    </div>
</div>
