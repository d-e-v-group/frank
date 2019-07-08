@layout('layouts/master')
<?php /* Template Name: Contacts */ ?>
@section('content')
	<?php while ( have_posts() ) : the_post(); ?>
    <div class="root barba-container" data-namespace="contacts" data-page-id="Contact" data-transition-in="contact_in" data-transition-out="contact_out" data-page-init="contact_init">
        <div class="main default-content">
            <div class="work-animated-background" style="display: none; background-color: #CBEEF4"></div>
            <section class="contact-section">
                <div class="container">
                    <div class="grid">
                        <div class="col-md-6 col-md-offset-3">
                            @if(get_field('hero_header'))
                                <div class="headline" data-big-header>
                                    <h1>{{ get_field('hero_header') }}</h1>
                                </div>
                            @endif
                        
                            <div class="contact-form"  data-appear-text>
                                {{ gravity_form( 1, false, false, false, '', false ) }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @if(get_field('location_header') || get_field('locations'))
                <section class="offices-section">
                    <div class="container">
                        <div class="grid">
                            <div class="col-md-3">
                                @if(get_field('location_header'))
                                    <h3 data-appear-text>{{ get_field('location_header') }}</h3>
                                @endif
                            </div>
                            <div class="col-md-9">
                                @if(get_field('locations'))
                                    @foreach((array)get_field('locations') as $location)
                                        <div class="row">
                                            <div class="top-block grid">
                                                <div class="col-sm-4">
                                                    @if($location['title'])
                                                        <h4 data-appear-text>{{ $location['title'] }}</h4>
                                                    @endif
                                                </div>
                                                <div class="col-sm-8">
                                                    <address data-appear-text>
                                                        @if($location['address_line_1'] || $location['address_line_2'])
                                                            <span>
                                                {{ $location['address_line_1'] }}
                                                                @if($location['address_line_1'] && $location['address_line_2'])
                                                                    <br>
                                                                @endif
                                                                {{ $location['address_line_2'] }}
                                            </span>
                                                        @endif
                                                        @if($location['email'])
                                                            <span><a href="mailto:{{ $location['email'] }}">{{ $location['email'] }}</a></span>
                                                        @endif
                                                        @if($location['phone'])
                                                            <span><a href="tel:{{ $location['phone'] }}">{{ $location['phone'] }}</a></span>
                                                        @endif
                                                    </address>
                                                </div>
                                            </div>
                                            @if($location['image'])
                                                <div class="img-holder" data-appear-text>
                                                    <div class="img">
                                                        {{ helper::image($location['image'], 'full') }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>


                </section>
            @endif
        </div>
    </div>
	<?php endwhile; ?>
@endsection