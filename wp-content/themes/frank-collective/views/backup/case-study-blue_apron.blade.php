@layout('layouts/master', ['headerCaseStudy' => true])
<?php /* Template Name: Case Study - Blue Apron */ ?>
@section('content')
<?php 
    $intro = [
        'pagetitle' => 'Blue Apron',
        'subtitle' => 'www.blueapron.com',
        'h1' => 'Bringing out the inner chef.',
        'content' => '<p>We created an iconic brand, in turn creating an entirely new category TK TK TK.</p>',
        'dark' => true
    ];

    $subintro1 = [
        'h2' => 'Appetite appeal is king.',
        'textrow' => [
            [
                'subtitle' => 'Positioning',
                'content' => '<p>Come together and learn to cook amazing, healthy meals at home with the best ingredients TK TK TK.</p>'
            ]
        ],
        'section_id' => 'section-1'
    ];

    $subintro2 = [
        'h2' => 'Brand concept headline.',
        'textrow' => [
            [
                'subtitle' => 'Brand Concept',
                'content' => '<p>Make cooking easy, accessible, and fun in your own home. Everyone is now their own home chef. We created a fun, bright graphics system that scaled well to both print, web, and packaging. Including the now iconic blue apron logo mark.</p>'
            ]
        ],
        'section_id' => 'section-2'
    ];

    $subintro3 = [
        'h2' => 'A walking billboard.',
        'textrow' => [
            [
                'subtitle' => 'Packaging',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel finibus est. Donec sit amet odio tempus, vehicula augue nec, consequat diam. Morbi in consectetur orci. Integer vestibulum mi laoreet.</p>'
            ]
        ],
        'section_id' => 'section-3'
    ];

    $subintro4 = [
        'h2' => 'Designing a cohesive brand system.',
        'textrow' => [
            [
                'subtitle' => 'Brand Identity',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel finibus est. Donec sit amet odio tempus, vehicula augue nec, consequat diam. Morbi in consectetur orci. Integer vestibulum mi laoreet.</p>'
            ]
        ],
        'section_id' => 'section-4'
    ];

    $subintro5 = [
        'h2' => 'Defining new UX best practices.',
        'textrow' => [
            [
                'subtitle' => 'Web ux/ui',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel finibus est. Donec sit amet odio tempus, vehicula augue nec, consequat diam. Morbi in consectetur orci. Integer vestibulum mi laoreet.</p>'
            ]
        ],
        'section_id' => 'section-5'
    ];

    $quote = [
        'title' => 'This is a quote from the client about working with Frank Collective.',
        'cite' => 'Client Name',
    ];

    $partners = [
        'guidetxt' => 'Selected Press (Click to view)',
        'logos' => [
            [
                'image' => asset('images/logo-forbes.svg'),
                'size' => 209
            ],
            [
                'image' => asset('images/logo-techcrunch.svg'),
                'size' => 132
            ],
            [
                'image' => asset('images/logo-inc.svg'),
                'size' => 174
            ]
        ]
    ];

    $nav = [
    	'title' => 'Blue Apron',
        'sections' => [
        	'Overview',
	        'Positioning',
	        'Brand Concept',
        	'Packaging',
        	'Brand Indentity',
            'Web UX/UI'
        ]
    ]
?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="case_study" data-page-id="Case_study" data-transition-in="case_study_in" data-transition-out="case_study_out" data-page-init="case_study_init">
    @include('partials/case-study/case-nav', $nav)
    <div class="case-hero-banner" style="background-image: url('{{ asset('images/banner-blue-apron.jpg') }}');" id="section-0" data-nav-section="section-0" data-dark></div>

    @include('partials/case-study/case-intro', $intro)

    <div class="case-banner ch-xmd" style="background-image: url('{{ asset('images/case-banner19.jpg') }}');" data-appear-fade-in></div>

    @include('partials/case-study/case-subintro', $subintro1)

    <div class="case-gal" style="margin-top: 72px;">
        <div class="container">
            <ul class="list" data-appear-block="fade-in">
                <li style="left: 8.5%; width: 32.3%; margin-bottom: -10.4%; z-index: 1;"><img src="{{ asset('images/img41.jpg') }}" width="420" alt=""></li>
                <li style="margin-top: -0.6%;; left: -14.6%; width: 33%;"><img src="{{ asset('images/img42.png') }}" width="427" alt=""></li>
                <li style="left: -5.5%; width: 100%;"><img src="{{ asset('images/img43.jpg') }}" width="1300" alt=""></li>
                <li style="margin-top: 6.2%; width: 41%;"><img src="{{ asset('images/img44.jpg') }}" width="530" alt=""></li>
                <li style="margin-top: 14%; left: 5.4%; width: 54.6%;"><img src="{{ asset('images/img45.jpg') }}" width="710" alt=""></li>
                <li style="width: 20%; height: 60px;"></li>
                <li style="margin-top: -4.5%; left: 5.4%; width: 54.6%;"><img src="{{ asset('images/img46.jpg') }}" width="710" alt=""></li>
            </ul>
        </div>
    </div>

    @include('partials/case-study/case-subintro', $subintro2)

    @include('partials/case-study/case-quote', $quote)

    @include('partials/case-study/case-subintro', $subintro3)

    <div class="case-banner-wrap">
        <div class="cw-3-1">
            <div class="case-banner ch-half" style="background-image: url('{{ asset('images/img47.jpg') }}');" data-appear-fade-in></div>
            <div class="case-banner ch-half" style="background-image: url('{{ asset('images/img48.jpg') }}');" data-appear-fade-in></div>
        </div>
        <div class="cw-3-2 ch-xmd case-banner" style="background-image: url('{{ asset('images/img49.jpg') }}');" data-appear-fade-in></div>
    </div>

    @include('partials/case-study/case-subintro', $subintro4)

    <div class="case-banner ch-md" style="background-image: url('{{ asset('images/case-banner20.jpg') }}');" data-appear-fade-in></div>

    <div class="case-film">
        <div class="row">
            <ul style="transform: translateX(-247px);" data-appear-block>
                <li><img src="{{ asset('images/img50.jpg') }}" alt=""></li>
                <li><img src="{{ asset('images/img51.jpg') }}" alt=""></li>
                <li><img src="{{ asset('images/img52.jpg') }}" alt=""></li>
                <li><img src="{{ asset('images/img50.jpg') }}" alt=""></li>
            </ul>
        </div>
        <div class="row">
            <ul style="transform: translateX(-389px);" data-appear-block>
                <li><img src="{{ asset('images/img53.jpg') }}" alt=""></li>
                <li><img src="{{ asset('images/img54.jpg') }}" alt=""></li>
                <li><img src="{{ asset('images/img55.jpg') }}" alt=""></li>
                <li><img src="{{ asset('images/img53.jpg') }}" alt=""></li>
            </ul>
        </div>
    </div>

    <div class="case-visual" style="background: url('{{ asset('images/pattern01.jpg') }}') repeat;">
        <div class="container" data-appear-text>
            <img src="{{ asset('images/img56.jpg') }}" alt="" class="shadow">
        </div>
    </div>

    @include('partials/case-study/case-subintro', $subintro5)

    <div class="case-banner ch-xl" style="background-image: url('{{ asset('images/case-banner21.jpg') }}');" data-appear-fade-in></div>

    <div class="case-banner ch-lg" style="background-image: url('{{ asset('images/case-banner22.jpg') }}');" data-appear-fade-in></div>

    @include('partials/case-study/case-partners', $partners)

    @include('partials/case-study/case-related')
</div>
<?php endwhile ?>
@endsection