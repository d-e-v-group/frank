@layout('layouts/master', ['headerCaseStudy' => true])
<?php /* Template Name: Case Study */ ?>
@section('content')
<?php 
    $intro = [
        'pagetitle' => 'Ladder',
        'subtitle' => 'www.weareladder.com',
        'h1' => 'Life is a workout.',
        'content' => '<p>We collaborated with a celebrity team of peak performers to create a high-end health and wellness brand based on their years of expertise.</p>',
        'dark' => true
    ];

    $subintro1 = [
        'h2' => 'A new kind of celebrity company.',
        'textrow' => [
            [
                'subtitle' => 'No endorsements — Celebrity Developed',
                'content' => '<p>Created by LeBron James, Cindy Crawford, Arnold Schwarzenegger, and Lindsey Vonn, it stems directly from their experiences performing at their peak for years. Specifically LeBron\'s infamous cramping issues after the NBA Finals in 2014 and the need to find the perfect formula to support peak perfomance at all times. TK TK TK</p>'
            ]
        ],
        'section_id' => 'section-1'
    ];

    $subintro2 = [
        'h2' => 'Premium health supplements built for the everyday grind.',
        'textrow' => [
            [
                'subtitle' => 'Positioning',
                'content' => '<p>No hype. No fads. No BS. Whatever greatness you’re looking to achieve, it is not instant nor something that is turned on or off. It is a dedication to working hard and smart. There is no magic pill.</p>'
            ]
        ],
        'section_id' => 'section-2'
    ];

    $subintro3 = [
        'h2' => 'It’s about what happens before and after the peaks that truly matter.',
        'textrow' => [
            [
                'subtitle' => 'Brand Concept',
                'content' => '<p>Everyone’s life energy exists on a spectrum — your peak performance is not instant or constant. It’s about what happens before and after the peaks that truly matter and that’s where Ladder steps in. This insight informed our logomark, gradients, and photography direction.</p>'
            ]
        ],
        'section_id' => 'section-3'
    ];

    $subintro4 = [
        'h2' => 'A scalable system for a complete health and wellness plan.',
        'textrow' => [
            [
                'subtitle' => 'Packaging',
                'content' => '<p>No hype. No fads. No BS. Whatever greatness you’re looking to achieve, it is not instant nor something that is turned on or off. It is a dedication to working hard and smart. There is no magic pill.</p>'
            ],
            [
                'subtitle' => 'Packaging Strategy',
                'content' => '<p>Single serving in a world of bulk – a system for success with nutrition supplements.</p>'
            ]
        ],
        'section_id' => 'section-4'
    ];

    $subintro5 = [
        'h2' => 'Everyday lifestyle.',
        'textrow' => [
            [
                'subtitle' => 'Photography',
                'content' => '<p>We created a real lifestyle of hard work in and out of the gym for everyone. </p>'
            ]
        ]
    ];

    $quote = [
        'title' => 'This is a quote from the client about working with Frank Collective.',
        'cite' => 'Client Name',
    ];

    $partners = [
        'guidetxt' => 'Selected Press (Click to view)',
        'logos' => [
            [
                'image' => asset('images/logo-wsj.svg'),
                'size' => 125
            ],
            [
                'image' => asset('images/logo-mens-health.png'),
                'size' => 195
            ],
            [
                'image' => asset('images/logo-refinery.png'),
                'size' => 156
            ],
            [
                'image' => asset('images/logo-runners.png'),
                'size' => 194
            ]
        ]
    ];

    $slideshow = [
        'title' => 'Photography',
        'slides' => [
            ['title' => '', 'image' => asset('images/img33.jpg')],
            ['title' => '', 'image' => asset('images/img33.jpg')],
            ['title' => '', 'image' => asset('images/lemon-perfect-img02.jpg')],
            ['title' => '', 'image' => asset('images/lemon-perfect-img02.jpg')],
            ['title' => '', 'image' => asset('images/img33.jpg')],
        ]
    ];

    $nav = [
    	'title' => 'Ladder',
        'sections' => [
        	'Overview',
	        'Celebrity Developed',
	        'Positioning',
        	'Brand Concept',
        	'Packaging'
        ]
    ]
?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="case_study" data-page-id="Case_study" data-transition-in="case_study_in" data-transition-out="case_study_out" data-page-init="case_study_init">
    @include('partials/case-study/case-nav', $nav)
    <div class="case-hero-banner" style="background-image: url('{{ asset('images/case-banner01.jpg') }}');" id="section-0" data-nav-section="section-0" data-dark></div>

    @include('partials/case-study/case-intro', $intro)

    @include('partials/case-study/case-subintro', $subintro1)

    <div class="case-gal">
        <div class="container">
            <ul class="list">
                <li style="margin-top: 10.5%; left: -5.4%; width: 46%;" data-appear-fade-in><img src="{{ asset('images/img28.jpg') }}" width="599" alt=""></li>
                <li class="text-box" style="margin-top: 16%; width: 25%;" data-appear-fade-in>
                    We Are <br> ladder
                </li>
                <li style="left: 5.4%; width: 29%;" data-appear-fade-in><img src="{{ asset('images/img29.jpg') }}" width="381" alt=""></li>
                <li style="margin-top: 14%; margin-bottom: 68px; width: 41%;" data-appear-fade-in><img src="{{ asset('images/img30.jpg') }}" width="530" alt=""></li>
                <li style="left: -14.4%; width: 30.6%;" data-appear-fade-in>
                    <img src="{{ asset('images/img31.jpg') }}" width="398" alt="" data-appear-fade-in>
                    <span class="by" data-appear-fade-in>Celebrity photos by Eric Ray Davidson</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="case-banner ch-lg" data-appear-fade-in>
        <video autoplay muted loop playsinline class="video">
          <source src="{{ asset('/images/black-and-white-video-computer.mp4') }}" type="video/mp4">
        </video>
    </div>

    <!-- <div class="case-banner ch-lg" style="background-image: url('{{ asset('images/case-banner02.jpg') }}');"></div> -->

    @include('partials/case-study/case-subintro', $subintro2)

    <div class="case-banner ch-lg" style="background-image: url('{{ asset('images/case-banner03.jpg') }}');" data-appear-fade-in></div>

    @include('partials/case-study/case-quote', $quote)

    @include('partials/case-study/case-subintro', $subintro3)
    <div data-dark>
        <div class="case-banner ch-lg" style="background-image: url('{{ asset('images/case-banner04.jpg') }}');" data-appear-fade-in ></div>

        <div class="case-banner-wrap">
            <div class="case-banner ch-sm cw-half" style="background-image: url('{{ asset('images/case-banner05.jpg') }}');" data-appear-fade-in></div>
            <div class="case-banner ch-sm cw-half" style="background-image: url('{{ asset('images/case-banner06.jpg') }}');" data-appear-fade-in></div>
        </div>
    </div>

    @include('partials/case-study/case-subintro', $subintro4)

    <div class="case-banner ch-xl" style="background-image: url('{{ asset('images/case-banner07.jpg') }}');" data-appear-fade-in></div>

    <div class="case-banner ch-lg" style="background-image: url('{{ asset('images/case-banner08.jpg') }}');" data-appear-fade-in></div>

    <div class="case-banner-wrap" data-appear-block="fade-in">
        <div class="case-banner ch-md cw-half" style="background-image: url('{{ asset('images/case-banner09.jpg') }}');"></div>
        <div class="case-banner ch-md cw-half" style="background-image: url('{{ asset('images/case-banner10.jpg') }}');"></div>
    </div>

    <div class="case-banner ch-sm" style="background-image: url('{{ asset('images/case-banner11.jpg') }}');" data-appear-fade-in></div>

    @include('partials/case-study/case-subintro', $subintro5)

    <div class="container case-slideshow">
        @include('partials/slideshow')
    </div>

    @include('partials/case-study/case-partners', $partners)

    @include('partials/case-study/case-related')
</div>
<?php endwhile ?>
@endsection