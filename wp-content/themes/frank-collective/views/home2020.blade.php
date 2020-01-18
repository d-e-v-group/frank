@layout('layouts/master')
<?php /* Template Name: Home2020*/ ?>
@section('body-class', 'page-homepage')
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="homepage" data-page-id="Homepage" data-transition-in="homepage_in" data-transition-out="homepage_out" data-page-init="homepage_init">
    <div class="hp-slider">
        <?php while( have_rows('slide') ): the_row(); ?>
            <?php
                $client = get_sub_field('client_name');
                $tagline = get_sub_field('client_tagline');
                $textColor = get_sub_field('text_color');
                $textShadow = get_sub_field('text_shadow');
            ?>
            <?php while( have_rows('desktop_asset_type') ): the_row(); ?>
                <?php
                    $slideDeskImg = get_sub_field('desktop_slide_image');
                    $slideDeskVid = get_sub_field('desktop_slide_video');
                ?>
            <?php endwhile; ?>
            <?php while( have_rows('mobile_asset_type') ): the_row(); ?>
                <?php
                    $slideMobileImg = get_sub_field('mobile_slide_image');
                    $slideMobileVid = get_sub_field('mobile_slide_video');
                ?>
            <?php endwhile; ?>
            <div class="hp-slide">
                <!-- Show video or image, on desktop or mobile, per CMS -->
                @if($slideDeskImg)
                    <img class="dt-asset" src="" data-desktop-asset={{ $slideDeskImg }} />
                @elseif ($slideDeskVid)
                    <video id="home-page-video" autoplay playsinline muted loop class="video dt-asset" src="" data-desktop-asset={{ $slideDeskVid }}></video>    
                @endif
                @if($slideMobileImg)
                    <img class="mob-asset" src="" data-mobile-asset={{ $slideMobileImg }} />
                @elseif ($slideMobileVid)
                    <video id="home-page-video" autoplay playsinline muted loop class="video mob-asset" src="" data-mobile-asset={{ $slideMobileVid }} >
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

