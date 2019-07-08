@layout('layouts/master')
<?php /* Template Name: About */ ?>
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="about" data-page-id="About" data-transition-in="about_in" data-transition-out="about_out" data-page-init="about_init">
    <div class="default-content {{ (get_field('hero_dynamic_background') !== 'none') ? ' has-dynamic-bg' : false }}">
        @if(get_field('hero_dynamic_background') !== 'none')
            <div class="work-animated-background {{ (get_field('hero_dynamic_background') !== 'none') ? ' dynamic-bg '.get_field('hero_dynamic_background') : false }}" {{ (get_field('hero_dynamic_background') !== 'none') ? ' style="background-color: #CBEEF4"' : false }}></div>
        @endif
        <article class="page-article">
            <div class="inner-wrap">
                <div class="container">
                    <div class="intro-block">
                        @if(get_field('hero_header'))
                            <div data-big-header>
                                <h1>{{ get_field('hero_header') }}</h1>
                            </div>
                        @endif
                        <div class="grid">
                            @if(get_field('hero_content'))
                            <div class="col-sm-8 col-lg-6">
                                <div class="intro-txt" data-appear-text>
                                    {{ get_field('hero_content') }}
                                </div>
                            </div>
                            @endif
                            @if(!empty(get_field('flexible_content_sections')))
                                <?php
                                    $sections = [];
                                    foreach(get_field('flexible_content_sections') as $section){
                                        $sections[] = ['section' => $section['acf_fc_layout'], 'label' => $section['menu_label']];
                                    }
                                ?>
                                @if(count($sections) > 0)
                                    <div class="col-sm-3 col-sm-offset-1">
                                        <nav class="page-nav" data-appear-group>
                                            @if(get_field('hero_page_nav_title'))
                                                <h6 class="title" data-appear-group-item>{{ get_field('hero_page_nav_title') }}</h6>
                                            @endif
                                            <ul>
                                            @foreach((array) $sections as $index => $item)
                                                @if($item['label'] !== '')
                                                <li data-appear-group-item>
                                                    <a href="#{{ $item['section'] }}-{{ $index }}">{{ $item['label'] }}</a>
                                                </li>
                                                @endif
                                            @endforeach
                                            </ul>
                                        </nav>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
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
@endsection