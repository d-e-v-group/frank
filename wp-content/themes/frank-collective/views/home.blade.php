@layout('layouts/master')
<?php /* Template Name: Home */ ?>
@section('body-class', 'page-homepage')
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="homepage" data-page-id="Homepage" data-transition-in="homepage_in" data-transition-out="homepage_out" data-page-init="homepage_init">
    <div class="nav-hero" id="homepage-background">
        <div class="nav-hero-content" >
            <div class="container">
                <div class="bg-stretch">
                    <span data-srcset="{{ helper::imageURL(get_field('background_image'), 'full') }}"></span>
                    @if(get_field('background_video'))
                        <div class="video-wrap">
                            <video id="home-page-video" autoplay playsinline muted loop class="video {{ get_field('video_start_time') ? 'video-has-offset' : false }}">
                                <source src="{{ get_field('background_video') }}" type="video/mp4">
                            </video>
                        </div>
                        @if(get_field('video_start_time'))
                            <script>
                                window.home_video_offests = {{ json_encode((array)get_field('video_start_time')) }};
                                var video = document.getElementsByClassName('video-has-offset');
                                if (video.length){
                                    document.getElementById('home-page-video').addEventListener('loadedmetadata', function() {
                                        if(typeof window.home_video_offests !== 'undefined' && window.home_video_offests.length){
                                            var rand = window.home_video_offests[Math.random() * window.home_video_offests.length >> 0]
                                            console.log('home video start time', rand.time);
                                            if(parseInt(rand.time) > 0){
                                                this.currentTime = parseInt(rand.time);
                                            }
                                        }
                                    }, false);
                                }
                            </script>
                        @endif
                    @endif
                </div>
                @if(get_field('menu_items'))
                    <div class="nav-links">
                        @foreach((array) get_field('menu_items') as $item)
                            @if($item['label'])
                                <div class="nav-link">
                                    <a href="{{ $item['page'] }}">{{ $item['label'] }}</a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>
@endsection