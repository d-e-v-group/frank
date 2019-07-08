@layout('layouts/master', ['headerCaseStudy' => true])
<?php /* Template Name: Case Study - Lola */ ?>
@section('content')
<?php 
    $intro = [
        'pagetitle' => 'Lola',
        'subtitle' => 'www.mylola.com',
        'h1' => 'Periods are a fact of life.',
        'content' => '<p>We worked with the founders of Lola: Alex Friedman and Jordana Kier to clarify the visual and verbal identity. TK TK TK</p>',
        'dark' => true
    ];

    $subintro1 = [
        'h2' => 'TKTKTK A woman\'s reproductive cycle is real.',
        'textrow' => [
            [
                'subtitle' => 'Positioning',
                'content' => '<p>Lola uses relatable language and straightforward photography, showing real women holding feminine products. Lorem ipsum</p>'
            ]
        ],
        'section_id' => 'section-1'
    ];

    $subintro2 = [
        'h2' => 'Getting real about the female reproductive cycle.',
        'textrow' => [
            [
                'subtitle' => 'Brand Concept',
                'content' => '<p>Collaborating with the founders and surveying the competitive landscape we saw two trends on opposite ends of the spectrum; big companies that wanted to \'hide\' your period in a field of flowers and pink; and younger companies that wanted you to know at all moments that you were having yours. We decided to say no thanks to either and instead got real about the female reproductive cycle.</p>'
            ]
        ],
        'section_id' => 'section-2'
    ];

    $subintro3 = [
        'h2' => 'Bringing it to life through web.',
        'textrow' => [
            [
                'subtitle' => 'Web Design',
                'content' => '<p>Lorem ipsum lorem ipsum  lorem ipsum  lorem ipsum lorem ipsum  lorem ipsum  lorem ipsum</p>'
            ]
        ],
        'section_id' => 'section-3'
    ];

    $subintro4 = [
        'h2' => 'A fresh modern lens.',
        'textrow' => [
            [
                'subtitle' => 'Photography',
                'content' => '<p>Lorem ipsum lorem ipsum  lorem ipsum  lorem ipsum lorem ipsum  lorem ipsum  lorem ipsum</p>'
            ]
        ],
        'section_id' => 'section-4'
    ];

    $subintro5 = [
        'h2' => 'Scaling the brand.',
        'textrow' => [
            [
                'subtitle' => 'Section Title',
                'content' => '<p>Lorem ipsum lorem ipsum  lorem ipsum  lorem ipsum lorem ipsum  lorem ipsum  lorem ipsum</p>'
            ]
        ],
        'section_id' => 'section-5'
    ];

    $subintro6 = [
        'h2' => 'Unifying all communications',
        'textrow' => [
            [
                'subtitle' => 'Section Title',
                'content' => '<p>Lorem ipsum lorem ipsum  lorem ipsum  lorem ipsum lorem ipsum  lorem ipsum  lorem ipsum</p>'
            ]
        ],
        'section_id' => 'section-6'
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
        'title' => 'Lola Photography',
        'slides' => [
            ['title' => '', 'image' => asset('images/img38.jpg')],
            ['title' => '', 'image' => asset('images/img39.jpg')],
            ['title' => '', 'image' => asset('images/img40.jpg')],
            ['title' => '', 'image' => asset('images/img38.jpg')],
            ['title' => '', 'image' => asset('images/img39.jpg')],
        ]
    ];

    $nav = [
    	'title' => 'Ladder',
        'sections' => [
        	'Overview',
	        'Brand Strategy',
	        'Brand Identity',
        	'Packaging',
        	'Photography'
        ]
    ]
?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="case_study" data-page-id="Case_study" data-transition-in="case_study_in" data-transition-out="case_study_out" data-page-init="case_study_init">
    @include('partials/case-study/case-nav', $nav)
    <div class="case-hero-banner" style="background-image: url('{{ asset('images/case-banner12.jpg') }}');" id="section-0" data-nav-section="section-0" data-dark></div>

    @include('partials/case-study/case-intro', $intro)

    <div class="case-banner ch-lg" style="background-image: url('{{ asset('images/case-banner13.jpg') }}');" data-appear-fade-in></div>

    @include('partials/case-study/case-subintro', $subintro1)

    <div class="case-banner-wrap" data-appear-block="fade-in">
        <div class="case-banner ch-xs cw-half" style="background-image: url('{{ asset('images/img34.jpg') }}');"></div>
        <div class="case-banner ch-xs cw-half" style="background-image: url('{{ asset('images/img35.jpg') }}');"></div>
        <div class="case-banner ch-xs cw-half" style="background-image: url('{{ asset('images/img36.jpg') }}');"></div>
        <div class="case-banner ch-xs cw-half" style="background-image: url('{{ asset('images/img37.jpg') }}');"></div>
    </div>

    @include('partials/case-study/case-quote', $quote)

    @include('partials/case-study/case-subintro', $subintro2)

    <div class="case-banner ch-xl" style="background-image: url('{{ asset('images/case-banner17.jpg') }}');" data-appear-fade-in></div>

    @include('partials/case-study/case-subintro', $subintro3)

    <div class="case-banner ch-xl" style="background-image: url('{{ asset('images/case-banner14.jpg') }}');" data-appear-fade-in></div>

    @include('partials/case-study/case-subintro', $subintro4)

    <div class="container case-slideshow" data-appear-fade-in>
        @include('partials/slideshow')
    </div>

    @include('partials/case-study/case-subintro', $subintro5)

    <div class="case-banner ch-xl" style="background-image: url('{{ asset('images/case-banner15.jpg') }}');" data-appear-fade-in></div>

    <div class="case-banner ch-lg" style="background-image: url('{{ asset('images/case-banner16.jpg') }}');" data-appear-fade-in></div>

    @include('partials/case-study/case-subintro', $subintro6)
    
    <div class="case-banner ch-lg" style="background-image: url('{{ asset('images/case-banner16.jpg') }}');" data-appear-fade-in></div>

    @include('partials/case-study/case-related')
</div>
<?php endwhile ?>
@endsection