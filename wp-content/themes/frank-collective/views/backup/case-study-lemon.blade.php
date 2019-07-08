@layout('layouts/master', ['headerCaseStudy' => true])
<?php /* Template Name: Case Study - Lemon */ ?>
@section('content')
<?php 
    $intro = [
        'pagetitle' => 'Lemon Perfect',
        'subtitle' => 'www.lemonperfect.com',
        'h1' => 'Lemonize your life.™',
        'content' => '<p>Brought definition and clarity to a fonuders vision for a category defining brand. Created a singular identity and packaging to capture a loyal audience in a crowded field of competitors. </p>',
        'dark' => true,
    ];

    $subintro1 = [
        'h2' => 'Cold-Pressed Lemon Water',
        'textrow' => [
            [
                'subtitle' => 'Positioning',
                'content' => '<p>Lemon Perfect is the perfect jump-start for when you\'re thinking healthy.</p>'
            ]
        ],
        'section_id' => 'section-1'
    ];

    $subintro2 = [
        'h2' => 'Bottled, Saturday morning sunshine',
        'textrow' => [
            [
                'subtitle' => 'Brand Concept',
                'content' => '<p>Optimistic, energetic, Lemon yellow, bright outlook, LA cool, clear, honest, simple. TK TK TK.</p>'
            ]
        ],
        'section_id' => 'section-2'
    ];

    $subintro3 = [
        'h2' => 'Our Process',
        'textrow' => [
            [
                'subtitle' => 'Bottle Design',
                'content' => '<p>We worked to understand the category and determined that we will win in store first on the shelves.</p>'
            ]
        ],
        'section_id' => 'section-3'
    ];

    $subintro4 = [
        'h2' => 'We love lemons. It\'s that simple.',
        'textrow' => [
            [
                'subtitle' => 'Photography',
                'content' => '<p>Photo concept/art direction. Leveraging the bottle in photoshoot.</p>'
            ]
        ],
        'section_id' => 'section-4'
    ];

    $subintro5 = [
        'h2' => 'Bringing it to life through web.',
        'textrow' => [
            [
                'subtitle' => 'Web design',
                'content' => '<p>Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>'
            ]
        ],
        'section_id' => 'section-5'
    ];

    $subintro6 = [
        'h2' => 'Scaling the brand.',
        'textrow' => [
            [
                'subtitle' => 'Section Title',
                'content' => '<p>Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>'
            ]
        ],
        'section_id' => 'section-6'
    ];

    $subintro7 = [
        'h2' => 'Cohesive brand system headline.',
        'textrow' => [
            [
                'subtitle' => 'Brand System',
                'content' => '<p>Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>'
            ]
        ],
        'section_id' => 'section-7'
    ];

    $quote = [
        'title' => 'Frank’s ability to understand each brand’s identity and build a unique story overflowing with creative energy around it is why every creative agency search should begin — and end — with Frank Collective.',
        'cite' => 'Yanni Hufnagel, Founder of Lemon Perfect',
    ];

    $slideshow = [
        'title' => 'Photography',
        'slides' => [
            ['title' => '', 'image' => asset('images/img57.jpg')],
            ['title' => '', 'image' => asset('images/img58.jpg')],
            ['title' => '', 'image' => asset('images/img59.jpg')],
        ]
    ];

    $nav = [
    	'title' => 'Lemon Perfect',
        'navBlack' => true,
        'sections' => [
        	'Overview',
	        'Brand Strategy',
        	'Brand Indentity',
            'Packaging',
            'Photography',
        ]
    ]
?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="case_study" data-page-id="Case_study" data-transition-in="case_study_in" data-transition-out="case_study_out" data-page-init="case_study_init">
    @include('partials/case-study/case-nav', $nav)
    <div class="case-hero-banner" style="background-image: url('{{ asset('images/case-banner23.jpg') }}');" id="section-0" data-nav-section="section-0"></div>

    @include('partials/case-study/case-intro', $intro)

    <div class="case-visual" style="background-image: url('{{ asset('images/case-banner24.jpg') }}');" data-appear-text>
        <div class="container">
            <div class="grid">
                <div class="col-sm-6 col-sm-offset-6">
                    <span class="title">Cold-Pressed Lemon Water</span>
                    <h2>Blissfully refreshing.</h2>
                    <ul class="list-inline">
                        <li>5 Calories</li>
                        <li>0 Sugar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('partials/case-study/case-subintro', $subintro1)

    <div class="case-banner">
        <img src="{{ asset('images/case-banner25.jpg') }}" width="1440" alt="" data-appear-fade-in>
    </div>

    <div class="case-banner" style="background-color: #00b9e5;">
        <img src="{{ asset('images/case-banner26.jpg') }}" width="1440" alt="" data-appear-fade-in>
    </div>

    @include('partials/case-study/case-subintro', $subintro2)

    <div class="case-banner" style="background-color: #fee302;">
        <img src="{{ asset('images/case-banner27.jpg') }}" width="1440" alt="" data-appear-fade-in>
    </div>

    @include('partials/case-study/case-subintro', $subintro3)

    <div class="case-banner" style="background-color: #f86868;">
        <img src="{{ asset('images/case-banner28.jpg') }}" width="1440" alt="" data-appear-fade-in>
    </div>

    @include('partials/case-study/case-subintro', $subintro4)

    <div class="container case-slideshow">
        @include('partials/slideshow')
    </div>

    @include('partials/case-study/case-quote', $quote)

    @include('partials/case-study/case-subintro', $subintro5)

    <div class="case-display background-parallax" style="background-image: url('{{ asset('images/img60.jpg') }}');">
        <div class="container">
            <div class="case-display-wide" data-appear-text>
                <img src="{{ asset('images/img63.png') }}" alt="">
            </div>
            <div class="phone" data-appear-text>
                <img src="{{ asset('images/img64.png') }}" alt="">
            </div>
        </div>
    </div>

    @include('partials/case-study/case-subintro', $subintro6)

    <div class="case-banner" style="background-color: #00b1e3;">
        <img src="{{ asset('images/img61.jpg') }}" width="1440" alt="" data-appear-fade-in>
        <img src="{{ asset('images/img62.jpg') }}" width="1440" alt="" data-appear-fade-in>
    </div>

    @include('partials/case-study/case-subintro', $subintro7)

    <div class="case-banner ch-xmd" style="background-image: url('{{ asset('images/case-banner29.jpg') }}');" data-appear-fade-in></div>

    @include('partials/case-study/case-related')
</div>
<?php endwhile ?>
@endsection