@layout('layouts/master')
<?php /* Template Name: Home2020*/ ?>
@section('body-class', 'page-homepage')
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="homepage" data-page-id="Homepage" data-transition-in="homepage_in" data-transition-out="homepage_out" data-page-init="homepage_init">
    <div class="hp-slider">
        <?php while( have_rows('slide') ): the_row(); 
            $slideImg = get_sub_field('slide_image');
            $slideVideo = get_sub_field('slide_video');
            $client = get_sub_field('client_name');
            $tagline = get_sub_field('client_tagline');
            $textColor = get_sub_field('text_color');
            $textShadow = get_sub_field('text_shadow');
        ?>
            <div class="hp-slide">
                @if($slideImg)
                    <img src={{$slideImg}} />
                @endif
                @if($slideVideo)
                    <video id="home-page-video" autoplay playsinline muted loop class="video">
                        <source src={{ $slideVideo }} type="video/mp4">
                    </video>
                @endif
                <div class="hp-slide-text-{{$textColor}} <?php if ($textShadow == true)  echo 'hp-slide-text-shadow' ?>">
                    <h2><?php echo $client; ?> </h2>
                    <h3><?php echo $tagline; ?> </h3>
                </div>
            </div>
        <?php endwhile; ?>                
    </div>
</div>
<?php endwhile; ?>
@endsection

