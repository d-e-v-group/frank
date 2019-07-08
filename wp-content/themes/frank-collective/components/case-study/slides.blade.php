@if($section['slides'])
	<?php
	/*$slides = [];
	foreach ((array)$section['slides'] as $slide){
		$slides[] = ['title' => $slide['caption'], 'image' => helper::imageURL($slide['image'], 'full'), ''];
	}*/
	$slideshow = [
		'title' => $section['slides'][0]['caption'],
		'slides' => (array)$section['slides']
	];
	?>
    <div class="container case-slideshow">
        <div data-appear-fade-in {{ ($section_id) ? 'id="'.$section_id.'"' : false }} {{ ($section_id) ? 'data-nav-section="'.$section_id.'"' : false }} {{ ($section['navigation_color'] === 'light') ? 'data-dark' : false }}>
            @include('partials/slideshow', ['data' => compact('slideshow')])
        </div>
    </div>
@endif