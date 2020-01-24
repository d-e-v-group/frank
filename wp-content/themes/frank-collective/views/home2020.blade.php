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
                $clientLink = get_sub_field('link');
            ?>
            <?php while( have_rows('desktop_asset_type') ): the_row(); ?>
                <?php
                    $slideDeskAssetType = get_sub_field('desktop_asset');
                    $slideDeskImg = get_sub_field('desktop_slide_image');
                    $slideDeskVid = get_sub_field('desktop_slide_video');
                ?>
                
            <?php endwhile; ?>
            <?php while( have_rows('mobile_asset_type') ): the_row(); ?>
                <?php
                    $slideMobileAssetType = get_sub_field('mobile_asset');
                    $slideMobileImg = get_sub_field('mobile_slide_image');
                    $slideMobileVid = get_sub_field('mobile_slide_video');
                ?>
            <?php endwhile; ?>
            <div class="hp-slide">
                <!-- Show video or image, on desktop or mobile, per CMS -->
                
                <a href="{{$clientLink}}">
                    
                    @if($slideDeskAssetType == 'image') 
                        <img class="dt-asset" src="" data-desktop-asset={{ $slideDeskImg }} />
                    @elseif ($slideDeskAssetType == 'video')
                        <video id="home-page-video" autoplay playsinline muted loop class="video dt-asset" src="" data-desktop-asset={{ $slideDeskVid }}></video>    
                    @endif

                    @if($slideMobileAssetType == 'image') 
                        <img class="mob-asset" src="" data-mobile-asset={{ $slideMobileImg }} />
                    @elseif ($slideMobileAssetType == 'video') 
                        <video id="home-page-video" autoplay playsinline muted loop class="video mob-asset" src="" data-mobile-asset={{ $slideMobileVid }} >
                        </video>    
                    @endif
                </a>
                <div class="container hp-slide-text-{{$textColor}} <?php if ($textShadow == true)  echo 'hp-slide-text-shadow' ?>">
                    <div class="hp-slide-client-info">    
                        <h2>{{ $client }}</h2>
                        <h3>{{ $tagline }}</h3>
                    </div>
                    <div class="pag-contain"></div>  
                </div>
                
            </div>
        <?php endwhile; ?>  
                    
    </div>
</div>
<?php endwhile; ?>
@endsection

