@layout('layouts/master')
<?php /* Template Name: About 2019 */ ?>
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container about-v2-page" data-namespace="about" data-page-id="About" data-transition-in="about_in" data-transition-out="about_out" data-page-init="about_init" >
    <div class="default-content {{ (get_field('hero_dynamic_background') !== 'none') ? ' has-dynamic-bg' : false }}">
        @if(get_field('hero_dynamic_background') !== 'none')
            <div class="work-animated-background {{ (get_field('hero_dynamic_background') !== 'none') ? ' dynamic-bg '.get_field('hero_dynamic_background') : false }}" {{ (get_field('hero_dynamic_background') !== 'none') ? ' style="background-color: #CBEEF4"' : false }}></div>
        @endif
        
        <section id="about-section-1" class="about-section" data-nav-dark data-dark>
            <div class="container">
                <div class="row about-section-wrapper">
                    <div class="col-md-8 col-sm-12 about-section__title">
                        <?php if (get_field('section_1_title')): ?>
                            <?php the_field('section_1_title'); ?>
                        <?php endif; ?>
                    </div>
            
                    <div class="col-md-4 col-sm-12 about-section__text">
                        <?php if (get_field('section_1_text')): ?>
                            <?php the_field('section_1_text'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <section id="about-section-2" class="about-section">
            <div class="container about-section-wrapper">
                <div class="col-md-12">
                    <div class="about-section__title">
                        <?php if (get_field('section_2_title')): ?>
                            <?php the_field('section_2_title'); ?>
                        <?php endif; ?>
                    </div>
            
                    <div class="about-section__text">
                        <?php if (get_field('section_2_text')): ?>
                            <?php the_field('section_2_text'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="about-section-3" class="about-section">
            <div class="container">
                <div class="row about-section-wrapper">
                    <div class="col-md-7 about-section__title">
                        <?php if (get_field('section_3_title')): ?>
                            <?php the_field('section_3_title'); ?>
                        <?php endif; ?>
                    </div>
            
                    <div class="col-md-5 about-section__text">
                        <?php if (get_field('section_3_text')): ?>
                            <?php the_field('section_3_text'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="about-section-4" class="about-section" data-dark>
            <div class="container">
                <div class="row about-section-wrapper">
                    <div class="col-md-7">
                        <div class="about-section__title">
                            <?php if (get_field('section_4_title')): ?>
                                <?php the_field('section_4_title'); ?>
                            <?php endif; ?>
                        </div>
                
                        <div class="about-section__text">
                            <?php if (get_field('section_4_text')): ?>
                                <?php the_field('section_4_text'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="ani-container col-md-5">
                        <div class="cover"></div>
                        <svg width="421px" height="446px" viewBox="0 0 421 446" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="About" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="About-Basic-State-v2-Annotated" transform="translate(-833.000000, -2465.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g id="MOD-04" transform="translate(0.000000, 2302.000000)">
                                        <g id="Group-4" transform="translate(833.000000, 163.000000)">
                                            <g id="Group-17" transform="translate(226.000000, 238.000000)">
                                                <path d="M77.198,108.132 C76.362,107.942 75.45,107.828 74.5,107.828 C69.256,107.828 66.064,111.552 66.064,117.518 L66.064,118.81 L61.656,118.81 L61.656,119.608 L66.064,119.608 L66.064,134.618 C66.064,136.48 65,137.126 63.67,137.202 L63.062,137.24 L63.062,138 L73.816,138 L73.816,137.24 L72.41,137.164 C70.928,137.088 70.016,136.176 70.016,134.618 L70.016,119.608 L75.754,119.608 L75.754,118.81 L71.992,118.81 C69.408,118.81 67.166,117.784 67.166,115.352 C67.166,112.73 69.408,111.362 72.79,111.362 C74.234,111.362 75.792,111.628 77.198,112.008 L77.198,108.132 Z M84.824,118.43 C79.276,118.43 75.438,122.724 75.438,128.462 C75.438,134.2 79.2,138.418 84.786,138.418 C90.372,138.418 94.172,134.162 94.172,128.386 C94.172,122.648 90.41,118.43 84.824,118.43 Z M85.622,137.886 C82.202,137.886 79.808,133.212 79.808,126.372 C79.808,121.584 81.366,118.924 84.026,118.924 C87.484,118.924 89.84,123.598 89.84,130.438 C89.84,135.264 88.32,137.886 85.622,137.886 Z M107.764,118.43 C105.218,118.43 102.938,120.558 101.608,124.89 L101.608,118.43 L94.958,119.76 L94.958,120.558 L95.452,120.558 C96.934,120.558 97.846,121.356 97.846,123.028 L97.846,134.656 C97.846,136.442 96.782,137.126 95.49,137.202 L94.806,137.24 L94.806,138 L105.218,138 L105.218,137.24 L104.192,137.202 C102.862,137.164 101.798,136.404 101.798,134.656 L101.798,125.27 C103.014,122.952 105.104,122.23 106.928,122.23 C107.65,122.23 108.448,122.344 109.284,122.572 L109.284,118.62 C108.752,118.506 108.22,118.43 107.764,118.43 Z M143.662,137.202 C142.294,137.126 141.268,136.48 141.268,134.656 L141.268,124.776 C141.268,120.634 139.254,118.43 135.758,118.43 C132.946,118.43 130.02,120.026 128.652,122.306 C128.12,119.836 126.182,118.43 123.446,118.43 C120.634,118.43 117.784,119.988 116.378,122.154 L116.378,118.43 L109.728,119.76 L109.728,120.558 L110.222,120.558 C111.704,120.558 112.616,121.356 112.616,123.028 L112.616,134.656 C112.616,136.48 111.552,137.126 110.26,137.202 L109.576,137.24 L109.576,138 L119.342,138 L119.342,137.24 L118.696,137.202 C117.214,137.126 116.568,136.252 116.568,134.656 L116.568,122.762 C117.594,121.47 119.456,120.482 121.166,120.482 C123.18,120.482 124.966,121.774 124.966,125.232 L124.966,134.656 C124.966,136.48 124.206,137.126 122.876,137.202 L122.23,137.24 L122.23,138 L131.654,138 L131.654,137.24 L131.046,137.202 C129.564,137.126 128.918,136.252 128.918,134.656 L128.918,122.762 C129.944,121.47 131.806,120.482 133.516,120.482 C135.53,120.482 137.316,121.774 137.316,125.232 L137.316,134.656 C137.316,136.48 136.518,137.126 135.188,137.202 L134.58,137.24 L134.58,138 L144.308,138 L144.308,137.24 L143.662,137.202 Z M164.702,136.29 C163.182,136.29 162.27,135.454 162.27,133.782 L162.27,118.43 L155.392,119.76 L155.392,120.558 L155.886,120.558 C157.406,120.558 158.318,121.394 158.318,123.066 L158.318,134.124 C157.026,135.454 155.582,136.214 153.986,136.214 C151.402,136.214 150.034,134.352 150.034,131.312 L150.034,118.43 L143.194,119.76 L143.194,120.558 L143.688,120.558 C145.208,120.558 146.082,121.394 146.082,123.066 L146.082,131.92 C146.082,135.91 148.286,138.418 151.706,138.418 C154.48,138.418 157.026,136.708 158.508,134.618 L158.508,138.418 L165.196,137.088 L165.196,136.29 L164.702,136.29 Z M168.3,113.452 L168.3,134.656 C168.3,136.48 167.236,137.126 165.944,137.202 L165.26,137.24 L165.26,138 L175.292,138 L175.292,137.24 L174.646,137.202 C173.164,137.126 172.252,136.252 172.252,134.656 L172.252,108.854 L165.412,110.184 L165.412,110.982 L165.906,110.982 C167.388,110.982 168.3,111.818 168.3,113.452 Z M193.596,136.898 C192.19,136.898 191.734,135.682 191.734,134.01 L191.734,124.13 C191.734,120.406 189.454,118.43 185.084,118.43 C180.41,118.43 177.028,120.596 176.382,125.004 L180.714,125.004 C181.056,120.862 182.614,118.924 185.122,118.924 C187.25,118.924 188.58,120.254 188.58,122.534 C188.58,125.346 186.604,126.448 184.248,127.246 L183.835831,127.37916 C180.367109,128.468071 176.116,129.094846 176.116,133.516 C176.116,136.366 177.94,138.418 181.018,138.418 C183.146,138.418 185.844,137.468 188.048,134.77 C188.276,137.05 189.378,138.418 191.468,138.418 C192.57,138.418 193.9,138.038 194.926,137.354 L194.926,136.632 C194.508,136.784 194.052,136.898 193.596,136.898 Z M187.744,134.238 C186.908,135.492 185.236,136.366 183.716,136.366 C181.588,136.366 180.372,134.656 180.372,132.186 C180.372,129.07 182.348,128.614 184.514,127.93 C185.806,127.512 186.87,127.132 187.744,126.296 L187.744,134.238 Z" id="formula"></path>
                                                <g id="Group" transform="translate(128.000000, 128.000000) rotate(45.000000) translate(-128.000000, -128.000000) translate(38.000000, 38.000000)">
                                                    <polygon id="Line-4" points="91 -1 89 -1 89 181 91 181"></polygon>
                                                    <polygon id="Line-4" transform="translate(90.000000, 90.000000) rotate(-90.000000) translate(-90.000000, -90.000000) " points="91 -1 89 -1 89 181 91 181"></polygon>
                                                </g>
                                            </g>
                                            <g id="Group-22" transform="translate(0.000000, 286.000000)">
                                                <path d="M31.972,74.43 C29.084,74.43 26.69,75.836 25.322,78.268 L25.322,74.43 L18.672,75.76 L18.672,76.558 L19.166,76.558 C20.648,76.558 21.56,77.356 21.56,79.028 L21.56,98.332 C21.56,100.118 20.496,100.802 19.204,100.878 L18.52,100.916 L18.52,101.638 L28.932,101.638 L28.932,100.916 L27.906,100.878 C26.424,100.84 25.512,99.852 25.512,98.332 L25.512,92.48 C26.918,93.544 28.59,94 30.414,94 C36.152,94 39.99,89.972 39.99,83.892 C39.99,78.306 36.722,74.43 31.972,74.43 Z M29.882,93.506 C27.906,93.506 26.386,92.366 25.512,90.618 L25.512,78.8 C26.652,77.394 28.134,76.824 29.768,76.824 C33.112,76.824 35.658,79.674 35.658,84.994 C35.658,90.048 33.302,93.506 29.882,93.506 Z M53.544,74.43 C50.998,74.43 48.718,76.558 47.388,80.89 L47.388,74.43 L40.738,75.76 L40.738,76.558 L41.232,76.558 C42.714,76.558 43.626,77.356 43.626,79.028 L43.626,90.656 C43.626,92.442 42.562,93.126 41.27,93.202 L40.586,93.24 L40.586,94 L50.998,94 L50.998,93.24 L49.972,93.202 C48.642,93.164 47.578,92.404 47.578,90.656 L47.578,81.27 C48.794,78.952 50.884,78.23 52.708,78.23 C53.43,78.23 54.228,78.344 55.064,78.572 L55.064,74.62 C54.532,74.506 54,74.43 53.544,74.43 Z M64.932,74.43 C59.384,74.43 55.546,78.724 55.546,84.462 C55.546,90.2 59.308,94.418 64.894,94.418 C70.48,94.418 74.28,90.162 74.28,84.386 C74.28,78.648 70.518,74.43 64.932,74.43 Z M65.73,93.886 C62.31,93.886 59.916,89.212 59.916,82.372 C59.916,77.584 61.474,74.924 64.134,74.924 C67.592,74.924 69.948,79.598 69.948,86.438 C69.948,91.264 68.428,93.886 65.73,93.886 Z M87.454,81.004 L91.786,81.004 C91.33,76.558 88.404,74.43 84.794,74.43 C79.55,74.43 75.484,79.028 75.484,85.146 C75.484,90.732 78.942,94.418 83.844,94.418 C87.834,94.418 90.608,91.91 91.558,87.92 L90.912,87.92 C89.81,90.086 87.644,91.074 85.402,91.074 C81.602,91.074 79.17,88.338 79.17,83.208 C79.17,78.496 81.26,74.924 84.034,74.924 C86.238,74.924 87.454,77.166 87.454,81.004 Z M101.16,94.418 C105.15,94.418 107.924,91.91 108.874,87.92 L108.228,87.92 C107.126,90.086 104.922,91.074 102.68,91.074 C98.804,91.074 96.486,88.186 96.486,83.474 L96.49075,83.2175 C96.4955,83.1225 96.505,83.018 96.524,82.904 L109.216,82.904 C109.102,77.774 106.822,74.43 102.262,74.43 C96.828,74.43 92.8,79.028 92.8,85.108 C92.8,90.732 96.258,94.418 101.16,94.418 Z M96.524,82.144 C96.866,77.774 98.918,74.924 101.312,74.924 C103.64761,74.924 104.753475,77.5281642 104.806031,81.3250215 L104.808,82.144 L96.524,82.144 Z M113.46,78.306 C113.46,76.33 114.904,74.924 116.918,74.924 C119.236,74.924 120.832,76.824 121.06,79.712 L125.392,79.712 C124.632,76.52 121.782,74.43 117.868,74.43 C113.992,74.43 110.99,76.444 110.99,80.168 C110.99,83.7920435 113.827681,85.0614159 116.704737,85.9941254 L118.668124,86.6106002 C120.9925,87.3585306 122.96,88.224 122.96,90.58 C122.96,92.556 121.554,93.924 119.388,93.924 C116.614,93.924 115.132,91.568 114.714,88.262 L110.382,88.262 C111.028,91.872 114.296,94.418 118.742,94.418 C122.732,94.418 125.544,92.29 125.544,88.642 C125.544,84.693234 122.213624,83.5086799 119.107163,82.5629209 L117.780392,82.1612346 C115.418578,81.4323875 113.46,80.6273529 113.46,78.306 Z M129.826,78.306 C129.826,80.5524706 131.660256,81.378872 133.919141,82.0904148 L135.897826,82.6936053 C138.875505,83.6220779 141.91,84.8727234 141.91,88.642 C141.91,92.29 139.098,94.418 135.108,94.418 C130.662,94.418 127.394,91.872 126.748,88.262 L131.08,88.262 C131.498,91.568 132.98,93.924 135.754,93.924 C137.92,93.924 139.326,92.556 139.326,90.58 C139.326,88.224 137.3585,87.3585306 135.034124,86.6106002 L133.070737,85.9941254 C130.193681,85.0614159 127.356,83.7920435 127.356,80.168 C127.356,76.444 130.358,74.43 134.234,74.43 C138.148,74.43 140.998,76.52 141.758,79.712 L137.426,79.712 C137.198,76.824 135.602,74.924 133.284,74.924 C131.27,74.924 129.826,76.33 129.826,78.306 Z" id="process"></path>
                                                <path d="M160,0 L160,160 L0,160 L0,0 L160,0 Z M158,2 L2,2 L2,158 L158,158 L158,2 Z" id="Rectangle-Copy-5"></path>
                                            </g>
                                            <path d="M5.81854249,188.681458 L5.81854249,190.681458 L11.8185425,190.681458 L11.8185425,188.681458 L5.81854249,188.681458 Z M17.8185425,188.681458 L17.8185425,190.681458 L23.8185425,190.681458 L23.8185425,188.681458 L17.8185425,188.681458 Z M29.8185425,188.681458 L29.8185425,190.681458 L35.8185425,190.681458 L35.8185425,188.681458 L29.8185425,188.681458 Z M41.8185425,188.681458 L41.8185425,190.681458 L47.8185425,190.681458 L47.8185425,188.681458 L41.8185425,188.681458 Z M53.8185425,188.681458 L53.8185425,190.681458 L59.8185425,190.681458 L59.8185425,188.681458 L53.8185425,188.681458 Z M65.8185425,188.681458 L65.8185425,190.681458 L71.8185425,190.681458 L71.8185425,188.681458 L65.8185425,188.681458 Z M77.8185425,188.681458 L77.8185425,190.681458 L83.8185425,190.681458 L83.8185425,188.681458 L77.8185425,188.681458 Z M89.8185425,188.681458 L89.8185425,190.681458 L95.8185425,190.681458 L95.8185425,188.681458 L89.8185425,188.681458 Z M101.818542,188.681458 L101.818542,190.681458 L107.818542,190.681458 L107.818542,188.681458 L101.818542,188.681458 Z M113.818542,188.681458 L113.818542,190.681458 L119.818542,190.681458 L119.818542,188.681458 L113.818542,188.681458 Z M125.818542,188.681458 L125.818542,190.681458 L131.818542,190.681458 L131.818542,188.681458 L125.818542,188.681458 Z M137.818542,188.681458 L137.818542,190.681458 L143.818542,190.681458 L143.818542,188.681458 L137.818542,188.681458 Z" id="Line-3-Copy-6" transform="translate(74.818542, 189.681458) rotate(90.000000) translate(-74.818542, -189.681458) "></path>
                                            <path d="M288.818542,188.681458 L288.818542,190.681458 L294.818542,190.681458 L294.818542,188.681458 L288.818542,188.681458 Z M300.818542,188.681458 L300.818542,190.681458 L306.818542,190.681458 L306.818542,188.681458 L300.818542,188.681458 Z M312.818542,188.681458 L312.818542,190.681458 L318.818542,190.681458 L318.818542,188.681458 L312.818542,188.681458 Z M324.818542,188.681458 L324.818542,190.681458 L330.818542,190.681458 L330.818542,188.681458 L324.818542,188.681458 Z M336.818542,188.681458 L336.818542,190.681458 L342.818542,190.681458 L342.818542,188.681458 L336.818542,188.681458 Z M348.818542,188.681458 L348.818542,190.681458 L354.818542,190.681458 L354.818542,188.681458 L348.818542,188.681458 Z M360.818542,188.681458 L360.818542,190.681458 L366.818542,190.681458 L366.818542,188.681458 L360.818542,188.681458 Z M372.818542,188.681458 L372.818542,190.681458 L378.818542,190.681458 L378.818542,188.681458 L372.818542,188.681458 Z M384.818542,188.681458 L384.818542,190.681458 L390.818542,190.681458 L390.818542,188.681458 L384.818542,188.681458 Z M396.818542,188.681458 L396.818542,190.681458 L402.818542,190.681458 L402.818542,188.681458 L396.818542,188.681458 Z M408.818542,188.681458 L408.818542,190.681458 L414.818542,190.681458 L414.818542,188.681458 L408.818542,188.681458 Z M420.818542,188.681458 L420.818542,190.681458 L426.818542,190.681458 L426.818542,188.681458 L420.818542,188.681458 Z" id="Line-3-Copy-7" transform="translate(357.818542, 189.681458) scale(-1, 1) rotate(90.000000) translate(-357.818542, -189.681458) "></path>
                                            <path d="M230,77 L230,79 L236,79 L236,77 L230,77 Z M242,77 L242,79 L248,79 L248,77 L242,77 Z M254,77 L254,79 L260,79 L260,77 L254,77 Z M266,77 L266,79 L272,79 L272,77 L266,77 Z M278,77 L278,79 L284,79 L284,77 L278,77 Z M290,77 L290,79 L296,79 L296,77 L290,77 Z M302,77 L302,79 L308,79 L308,77 L302,77 Z M314,77 L314,79 L320,79 L320,77 L314,77 Z M326,77 L326,79 L332,79 L332,77 L326,77 Z M338,77 L338,79 L344,79 L344,77 L338,77 Z M350,77 L350,79 L356,79 L356,77 L350,77 Z M362,77 L362,79 L368,79 L368,77 L362,77 Z" id="Line-3-Copy-7" transform="translate(299.000000, 78.000000) scale(-1, 1) rotate(146.000000) translate(-299.000000, -78.000000) "></path>
                                            <path d="M63.5,77 L63.5,79 L69.5,79 L69.5,77 L63.5,77 Z M75.5,77 L75.5,79 L81.5,79 L81.5,77 L75.5,77 Z M87.5,77 L87.5,79 L93.5,79 L93.5,77 L87.5,77 Z M99.5,77 L99.5,79 L105.5,79 L105.5,77 L99.5,77 Z M111.5,77 L111.5,79 L117.5,79 L117.5,77 L111.5,77 Z M123.5,77 L123.5,79 L129.5,79 L129.5,77 L123.5,77 Z M135.5,77 L135.5,79 L141.5,79 L141.5,77 L135.5,77 Z M147.5,77 L147.5,79 L153.5,79 L153.5,77 L147.5,77 Z M159.5,77 L159.5,79 L165.5,79 L165.5,77 L159.5,77 Z M171.5,77 L171.5,79 L177.5,79 L177.5,77 L171.5,77 Z M183.5,77 L183.5,79 L189.5,79 L189.5,77 L183.5,77 Z M195.5,77 L195.5,79 L201.5,79 L201.5,77 L195.5,77 Z" id="Line-3-Copy-8" transform="translate(132.500000, 78.000000) rotate(146.000000) translate(-132.500000, -78.000000) "></path>
                                            <path d="M221.14595,0.328905038 L222.133344,0.48718127 L221.816792,2.46197102 L220.829397,2.30369478 C219.571515,2.10206034 218.292395,2 217,2 L216,2 L216,4.21884749e-15 L217,4.21884749e-15 C218.398513,4.21884749e-15 219.783483,0.110506007 221.14595,0.328905038 Z M232.554654,5.16418732 L233.35554,5.76300513 L232.157904,7.36477569 L231.357019,6.76595789 C230.330267,5.99826083 229.24378,5.31365641 228.107857,4.71946792 L227.221763,4.2559622 L228.148775,2.48377435 L229.034869,2.94728007 C230.26557,3.59104594 231.442537,4.33266279 232.554654,5.16418732 Z M240.433943,14.7239422 L240.868161,15.6247503 L239.066544,16.4931852 L238.632327,15.5923771 C238.075565,14.4373433 237.426757,13.3290855 236.692877,12.2779227 L236.120428,11.4579827 L237.760308,10.3130838 L238.332757,11.1330238 C239.127736,12.2717009 239.830657,13.4723918 240.433943,14.7239422 Z M242.984296,26.9119051 L242.949823,27.9113107 L240.951012,27.8423655 L240.985484,26.8429598 C240.995154,26.5626181 241,26.2816054 241,26 C241,25.0081958 240.939894,24.0240771 240.820749,23.0511871 L240.699192,22.0586026 L242.684361,21.8154887 L242.805918,22.8080731 C242.934935,23.8615774 243,24.9268842 243,26 C243,26.3045938 242.994758,26.6085916 242.984296,26.9119051 Z M239.603974,38.8563104 L239.108809,39.7251092 L237.371211,38.734779 L237.866376,37.8659801 C238.500728,36.7529698 239.045092,35.5904233 239.493509,34.3885432 L239.843068,33.4516289 L241.716897,34.1507472 L241.367338,35.0876615 C240.881313,36.3903406 240.291357,37.6502536 239.603974,38.8563104 Z M231.122367,47.8337616 L230.283193,48.3776244 L229.195467,46.6992761 L230.034641,46.1554133 C231.110482,45.4581686 232.129289,44.6756254 233.080977,43.8160565 L233.823088,43.1457791 L235.163643,44.6300004 L234.421532,45.3002778 C233.390953,46.2311009 232.287613,47.0785737 231.122367,47.8337616 Z M219.328769,51.897064 L218.332689,51.9855253 L218.155767,49.993366 L219.151846,49.9049048 C220.435611,49.7908944 221.700208,49.5749491 222.936921,49.2602859 L223.906044,49.013707 L224.399202,50.9519525 L223.430079,51.1985313 C222.089741,51.5395604 220.719398,51.773563 219.328769,51.897064 Z M207.09422,50.0461363 L206.169742,49.6649002 L206.932215,47.8159448 L207.856692,48.1971809 C209.039313,48.6848702 210.261026,49.0773104 211.512145,49.3699164 L212.48587,49.5976465 L212.03041,51.5450951 L211.056685,51.317365 C209.700501,51.0001871 208.376133,50.5747714 207.09422,50.0461363 Z M197.060821,42.6871244 L196.418638,41.9205735 L197.951739,40.6362064 L198.593923,41.4027573 C199.417183,42.3854521 200.317794,43.3014091 201.286448,44.1411998 L202.042025,44.7962598 L200.731905,46.3074136 L199.976328,45.6523536 C198.92745,44.7430116 197.952275,43.7512202 197.060821,42.6871244 Z M191.599842,31.5773462 L191.386275,30.6004178 L193.340132,30.1732834 L193.553699,31.1502118 C193.82818,32.405781 194.202823,33.633037 194.673193,34.8223781 L195.040963,35.7522947 L193.18113,36.4878357 L192.813359,35.5579191 C192.303489,34.2687002 191.897366,32.9383205 191.599842,31.5773462 Z M191.904171,19.1790992 L192.16589,18.2139552 L194.096178,18.7373936 L193.834459,19.7025377 C193.50032,20.9347444 193.264678,22.19604 193.13089,23.4775833 L193.027058,24.4721781 L191.037869,24.2645146 L191.1417,23.2699198 C191.286644,21.8815189 191.542013,20.5146314 191.904171,19.1790992 Z M197.930772,8.32599801 L198.610703,7.59272267 L200.077254,8.95258633 L199.397322,9.68586166 C198.525427,10.6261604 197.729632,11.6345826 197.018333,12.7010957 L196.463476,13.5330415 L194.799585,12.4233275 L195.354442,11.5913818 C196.124823,10.4362816 196.986621,9.3442216 197.930772,8.32599801 Z M208.267551,1.50308971 L209.209485,1.16729147 L209.881081,3.05115934 L208.939147,3.38695758 C207.73073,3.81775675 206.560476,4.34503277 205.438546,4.9629882 L204.562625,5.4454427 L203.597716,3.69360063 L204.473637,3.21114613 C205.689418,2.5414975 206.957742,1.97003474 208.267551,1.50308971 Z M217.993841,-0.000231300107 L217.994305,1.9997687 L216.757701,2.00119676 L215.521575,2.02421441 L215.482493,0.0245962987 L216.737926,0.00129451363 L217.993841,-0.000231300107 Z" id="Oval"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>                    
                    </div>
                </div>
            </div>
        </section>

        <section id="about-section-5" class="about-section">
            <div id="change-slider">
                <div class="container">
                    <div class="col-12 img-container">
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/about_FC_ChangeSlider.svg' ?>">
                    </div>
                </div>

            </div>
            <div class="container">
                <div class="row about-section-wrapper">
                    <div class="col-md-8 about-section__title">
                        <?php if (get_field('section_5_title')): ?>
                            <?php the_field('section_5_title'); ?>
                        <?php endif; ?>
                    </div>
            
                    <div class="col-md-4 about-section__text" >
                        <?php if (get_field('section_5_text')): ?>
                            <?php the_field('section_5_text'); ?>
                        <?php endif; ?>       
                    </div>
                </div>
            </div>
        </section>

        <section id="about-section-6" class="about-section" data-dark>
            <div class="wwd-section-wrapper">
                <div class="wrap">
                    <div class="about-section__title">
                        <?php if (get_field('section_6_title')): ?>
                            <?php the_field('section_6_title'); ?>
                        <?php endif; ?>
                    </div>
            
                    <div class="about-section__text">
                        <?php if (get_field('section_6_text')): ?>
                            <?php the_field('section_6_text'); ?>
                        <?php endif; ?>
                    </div>           
                </div>

                <?php if( have_rows('what_we_do_sections') ): ?>
                <?php 
                $count = count(get_field('what_we_do_sections')); 
                $it = 1;
                ?>
                
                <div class="container">
                    <div class="wwd-capabilities">
                    <?php while( have_rows('what_we_do_sections') ): the_row(); 
                        $wwd_title = get_sub_field('this_is_a_text_field');
                        $wwd_text = get_sub_field('this_is_a_textarea_field');
                        ?>
                        
                            <?php 
                                if ($it == 1 || ($it == round($count / 2)+1)) {
                                    echo '<div class="wwd-col">';
                                }            
                            ?>
                            <div class="capability ">
                                <div class="title"><?php echo $wwd_title; ?></div>
                                <div class="text"><?php echo $wwd_text; ?></div>
                            </div>
                            <?php 
                                if ($it == round($count / 2) || ($it == $count))  {
                                    echo '</div>';
                                }                                
                            ?>
                    <?php 
                    $it++;
                    endwhile; 
                    ?>
                </div>
                </div>
                <?php endif; ?>
            </div>
        </section>        
                      
        <article class="page-about">
        </article>
        <div class="about-content">
            @if(!empty(get_field('flexible_content_sections')))
                @foreach(get_field('flexible_content_sections') as $section_index => $section)
                    @include('components/about/' . $section['acf_fc_layout'], ['section_index' => $section_index])
                @endforeach
            @endif
        </div>
    </div>
    @include('partials/cta/getstarted')
</div>
<?php endwhile; ?>

<script>
    jQuery(document).ready(function(){
        // jQuery('#header > .container').addClass('light-main');
        var wh = jQuery(window).height();

        jQuery('#about-section-3 .about-section__title p').html(function(){	
            var text= jQuery(this).text().split(' ');
            var last = text.pop();
            return text.join(" ") + (text.length > 0 ? ' <span class="last">'+last+'<span><strong></strong><strong></strong></span><span><strong></strong><strong></strong></span><span><strong></strong><strong></strong></span></span>' : last);   
        });
        var controller = new ScrollMagic.Controller({globalSceneOptions: {duration: 100}});

        var section4 = new ScrollMagic.Scene({
            triggerElement: jQuery('#about-section-4'),
            triggerHook: 'onEnter',
            offset: wh * 0.5
        })
        .on("enter", function (event) {
            jQuery('#about-section-4').addClass('animate');
        })
        .addTo(controller);

        var section5 = new ScrollMagic.Scene({
            triggerElement: jQuery('#about-section-5'),
            triggerHook: 'onEnter',
            offset: wh * 0.5
        })
        .on("enter", function (event) {
            jQuery('#about-section-5').addClass('animate');
        })
        .addTo(controller);

        
    })
</script>
@endsection

