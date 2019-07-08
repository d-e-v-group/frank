@layout('layouts/master', ['headerCaseStudy' => true])
<?php /* Template Name: Case Study - Made In */ ?>
@section('content')
<?php 
    $intro = [
        'pagetitle' => 'Made In',
        'subtitle' => 'www.madeincookware.com',
        'h1' => 'Made for you, inspired by your bank account.',
        'content' => '<p>We created a leading cookware brand for the new home-cooking movement.</p>',
        'dark' => true,
    ];

    $subintro1 = [
        'h2' => 'Tools for a better cooking experience.',
        'textrow' => [
            [
                'subtitle' => 'Positioning',
                'content' => '<p>For when you’re ready to transition from parties to dinner-parties. Made-In is quality cookware for the millennial crowd who are about to start a new chapter of their life.</p><p>Why would you cook a $20 steak in a $9 pan - take your cookware seriously.</p>'
            ]
        ],
        'section_id' => 'section-1'
    ];

    $subintro2 = [
        'h2' => 'Made for you.',
        'textrow' => [
            [
                'subtitle' => 'Brand Concept',
                'content' => '<p>It all starts with the name. Made-In symbolizes the new home cooking movement and where and who is involved.</p><p>Bright and bold graphics and art direction give an accessible yet aspirational vibe to Made-In. We further developed the brand with a slew of educational graphics to help those new to cooking understand the benefits of stainless steel and to clear the hype that surrounds the cast iron trend.</p>'
            ]
        ],
        'section_id' => 'section-2'
    ];

    $subintro3 = [
        'h2' => 'A fresh shopping experience.',
        'textrow' => [
            [
                'subtitle' => 'Web Ux/ui',
                'content' => '<p>You can build your set over time, and test new products risk free with a 100 day free trial. Excuse us now, we must go work on our bananas foster.</p>'
            ]
        ],
        'section_id' => 'section-3'
    ];

    $subintro4 = [
        'h2' => 'A scalable brand.',
        'textrow' => [
            [
                'subtitle' => 'Brand Collateral',
                'content' => '<p>Would be great to show packaging, new products, the stamp on the pan, and any social content that is branded and follows the guidelines (again ask for permission from Chip and Jake)</p>'
            ]
        ],
        'section_id' => 'section-4'
    ];

    $media1 = [
        'image' => asset('images/img69.jpg'),
        'subtitle' => 'Product Benefits',
        'content' => '<p>Universal Lid lorem ipsum</p>',
    ];

    $media2 = [
        'image' => asset('images/img69.jpg'),
        'subtitle' => 'Pan Engravings',
        'content' => '<p>Cooking is all about mastering the basics. We wanted to help the average home chef learn essentials by engraving cheat sheets on the bottom of the cookware.</p>',
    ];

    $quote = [
        'title' => 'This is a quote from the client about working with Frank Collective.',
        'cite' => 'Client Name',
    ];

    $partners = [
        'guidetxt' => 'Selected Press (Click to view)',
        'logos' => [
            [
                'image' => asset('images/logo-time.png'),
                'size' => 174
            ],
            [
                'image' => asset('images/logo-epicurious.png'),
                'size' => 210
            ],
            [
                'image' => asset('images/logo-fast-company.png'),
                'size' => 210
            ],
            [
                'image' => asset('images/logo-ny-times.png'),
                'size' => 157
            ]
        ]
    ];

    $nav = [
    	'title' => 'Made In',
        'sections' => [
        	'Overview',
	        'Positioning',
        	'Brand Concept',
            'Web UX/UI',
            'Brand Collateral',
        ]
    ]
?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="case_study" data-page-id="Case_study" data-transition-in="case_study_in" data-transition-out="case_study_out" data-page-init="case_study_init">
    @include('partials/case-study/case-nav', $nav)
    <div class="case-hero-banner" style="background-image: url('{{ asset('images/case-banner30.jpg') }}');" id="section-0" data-nav-section="section-0" data-dark></div>

    @include('partials/case-study/case-intro', $intro)

    <div class="case-banner ch-lg" style="background-image: url('{{ asset('images/case-banner31.jpg') }}');" data-appear-fade-in></div>

    @include('partials/case-study/case-subintro', $subintro1)

    <div class="case-banner-wrap" data-appear-block="fade-in">
        <div class="case-banner ch-xs cw-half" style="background-image: url('{{ asset('images/img65.jpg') }}');"></div>
        <div class="case-banner ch-xs cw-half" style="background-image: url('{{ asset('images/img66.jpg') }}');"></div>
        <div class="case-banner ch-xs cw-half" style="background-image: url('{{ asset('images/img67.jpg') }}');"></div>
        <div class="case-banner ch-xs cw-half" style="background-image: url('{{ asset('images/img68.jpg') }}');"></div>
    </div>

    @include('partials/case-study/case-media', $media1)

    <div class="case-banner ch-xmd" style="background-image: url('{{ asset('images/case-banner32.jpg') }}');" data-appear-fade-in></div>

    @include('partials/case-study/case-quote', $quote)

    @include('partials/case-study/case-subintro', $subintro2)

    <div class="case-banner ch-md" style="background-image: url('{{ asset('images/case-banner33.jpg') }}');" data-appear-fade-in></div>

    <div class="case-banner" style="background-color: #fff;">
        <img src="{{ asset('images/case-banner34.jpg') }}" width="1440" alt="" data-appear-fade-in>
    </div>

    @include('partials/case-study/case-media', $media2)

    @include('partials/case-study/case-subintro', $subintro3)

    <div class="case-gal">
        <div class="container">
            <ul class="list" data-appear-block="fade-in">
                <li style="margin-top: -7.7%; margin-left: -11%; width: 22.1%;"><img src="{{ asset('images/img76.png') }}" alt=""></li>
                <li style="margin-top: 5%; margin-left: 1%; width: 30.4%;"><img src="{{ asset('images/img77.png') }}" alt=""></li>
                <li style="margin-top: -1%; margin-right: -12%; margin-bottom: -8.8%; width: 68.6%; z-index: 1;"><img src="{{ asset('images/img78.png') }}" alt=""></li>
            </ul>
        </div>
    </div>

    <div class="case-display-a">
        <div class="container" data-appear-text>
            <img src="{{ asset('images/img70.jpg') }}" alt="">
        </div>
    </div>

    @include('partials/case-study/case-subintro', $subintro4)

    <div class="case-banner-wrap" data-appear-block="fade-in">
        <div class="case-banner ch-xs cw-half" style="background-image: url('{{ asset('images/img71.jpg') }}');"></div>
        <div class="case-banner ch-xs cw-half" style="background-image: url('{{ asset('images/img72.jpg') }}');"></div>
    </div>

    <div class="case-banner" style="background-color: #f4f4f4;">
        <img src="{{ asset('images/img73.jpg') }}" width="1440" alt="" data-appear-fade-in>
    </div>

    <div class="case-banner-wrap" data-appear-block="fade-in">
        <div class="case-banner ch-xmd cw-half" style="background-image: url('{{ asset('images/img74.jpg') }}');"></div>
        <div class="case-banner ch-xmd cw-half" style="background-image: url('{{ asset('images/img75.jpg') }}');"></div>
    </div>

    <div class="case-film alt-a">
        <div class="row">
            <ul style="transform: translateX(-247px);" data-appear-block>
                <li><img src="{{ asset('images/img79.png') }}" alt=""></li>
                <li><img src="{{ asset('images/img80.png') }}" alt=""></li>
                <li><img src="{{ asset('images/img81.png') }}" alt=""></li>
                <li><img src="{{ asset('images/img82.png') }}" alt=""></li>
                <li><img src="{{ asset('images/img81.png') }}" alt=""></li>
            </ul>
        </div>
        <div class="row">
            <ul style="transform: translateX(-389px);" data-appear-block>
                <li><img src="{{ asset('images/img83.png') }}" alt=""></li>
                <li><img src="{{ asset('images/img84.png') }}" alt=""></li>
                <li><img src="{{ asset('images/img85.png') }}" alt=""></li>
                <li><img src="{{ asset('images/img86.png') }}" alt=""></li>
                <li><img src="{{ asset('images/img84.png') }}" alt=""></li>
                <li><img src="{{ asset('images/img84.png') }}" alt=""></li>
            </ul>
        </div>
    </div>

    @include('partials/case-study/case-partners', $partners)

    @include('partials/case-study/case-related')
</div>
<?php endwhile ?>
@endsection