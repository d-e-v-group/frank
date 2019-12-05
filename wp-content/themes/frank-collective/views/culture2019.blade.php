@layout('layouts/master')
<?php /* Template Name: Culture 2019 */ ?>
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root" class="culutre-v2-page" data-page-id="Culture" data-namespace="culture" data-transition-in="culture_2_in" data-transition-out="culture_2_out" data-page-init="culture_2_init">
    <div class="culture-wrap">
      <section id="culture-main" data-nav-dark data-dark>
        <div class="culture-message">
          <?php if (get_field('main_text')): ?>
            <h1><?php the_field('main_text'); ?></h1>
          <?php endif; ?>  
        
          <?php if (get_field('secondary_text')): ?>
            <?php the_field('secondary_text'); ?>
          <?php endif; ?>  

          <?php if (get_field('jobs_text')): ?>
            <h3><?php the_field('jobs_text'); ?></h3>
          <?php endif; ?>          

          <a href="#" class="jobs-link">jobs@frankcollective.com</a>
        </div>

        <div class="culture-images">
          
          <div data-tilt style="height: 300px; width: 200px;" class="culture-image culture-looper img-1" 
            data-frame-one="<?php echo get_template_directory_uri() . '/assets/culture-page/1/Adomas-Ladder.mp4' ?>" 
            data-frame-two="<?php echo get_template_directory_uri() . '/assets/culture-page/1/CJdog.png' ?>" 
            data-frame-three="<?php echo get_template_directory_uri() . '/assets/culture-page/1/Luke-Peleton.mp4' ?>">
            <img class="img-holder" style="display:none; position: absolute;  left: 0; top: 0; height: 100%; width: 100%; object-fit: cover;" src="">
            <video class="vid-holder" style="display:none; position: absolute; left: 0; top: 0; height: 100%; width: 100%; object-fit: cover;" src="" playsinline muted > 
          </div>

          <div data-tilt style="height: 300px; width: 392px;" class="culture-image culture-looper img-2" 
            data-frame-one="<?php echo get_template_directory_uri() . '/assets/culture-page/2/AshleyBook.mp4' ?>" 
            data-frame-two="<?php echo get_template_directory_uri() . '/assets/culture-page/2/LAOffice1.png' ?>" 
            data-frame-three="<?php echo get_template_directory_uri() . '/assets/culture-page/2/Mike1.png' ?>">
            <img class="img-holder" style="display:none; position: absolute;  left: 0; top: 0; height: 100%; width: 100%; object-fit: cover;" src="">
            <video class="vid-holder" style="display:none; position: absolute; left: 0; top: 0; height: 100%; width: 100%; object-fit: cover;" src="" playsinline muted > 
          </div>    


          <div data-tilt style="height: 300px; width: 392px;" class="culture-image culture-looper img-3" 
            data-frame-one="<?php echo get_template_directory_uri() . '/assets/culture-page/3/AnnieSophieTeaching.png' ?>" 
            data-frame-two="<?php echo get_template_directory_uri() . '/assets/culture-page/3/Jay-Phone.mp4' ?>" 
            data-frame-three="<?php echo get_template_directory_uri() . '/assets/culture-page/3/MikeJiffy1.mp4' ?>">
            <img class="img-holder" style="display:none; position: absolute;  left: 0; top: 0; height: 100%; width: 100%; object-fit: cover;" src="">
            <video class="vid-holder" style="display:none; position: absolute; left: 0; top: 0; height: 100%; width: 100%; object-fit: cover;" src="" playsinline muted > 
          </div>                    

        </div>
      </section>
    </div>
    @include('partials/cta/contact')
    @include('partials/modal')
</div>
<?php endwhile; ?>
@endsection

