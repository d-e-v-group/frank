<?php
$intro = [
	'pagetitle' => get_field('brand_name'),
	'subtitle' => $section['website'],
	'link' => $section['website_url'],
	'h1' => $section['header'],
	'content' => $section['content'],
	'dark' => ($section['navigation_color']) ? true : false,
    'section_title' => $section_id
];
?>

@include('partials/case-study/case-intro', $intro)
