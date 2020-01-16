<footer id="footer">
    <div class="container">
        <div class="grid-flex">
            <div class="col-xs-6 col-sm-1 col foot-logo">
                <a href="/" class="logo">
                    <!-- @include('partials/image', ['image' => get_field('footer_logo', 'options')]) -->
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 600 600" style="enable-background:new 0 0 600 600;" xml:space="preserve">
                    <style type="text/css">
                    .st0{fill:#1D1D1E;}
                    </style>
                    <title>FC-Mono-Black</title>
                    <path class="st0" d="M554,78.4c-8.8,1.5-54.2,9.4-88.5,9.4c-66.9,0-131.9-34.5-206.3-34.5c-93.2,0-133.6,44.8-133.6,79.7
                    c0,26.2,30,57.9,82.3,57.9c59.5,0,94.3-20.1,125.3-52.3h-55.1c-19.4,27.6-34.2,33.4-56.4,33.4c-63.4,0-52.5-99.6,52.2-99.6
                    c40.2,0,109.3,26.7,164.5,32.7c2.7,0.3,5.2,0.5,7.7,0.7c-27.4,17.2-50.2,46.5-72,97l-8.9,20.6c-1,2.4-2,4.8-3,7.2l-0.4,0.2
                    c-24.6-4.9-51.8-4.3-76.1,5c-16-12.5-40.9-22.7-70.6-22.7c-89.5,0-154.6,90.5-154.6,171.1c0,96.3,80,162.3,173.1,162.3
                    c113.1,0,165-91.2,207.5-190.7h-20.3c-17.2,38-39.2,75.5-67.8,103.3s-63.8,46.2-107.5,46.2c-71.9,0-129.8-54.6-129.8-136
                    c0-69.5,49.6-135,109.5-135c10.7-0.2,21.2,3.3,29.7,9.9c2.9,2.1,3.5,6,1.4,8.9c-0.1,0.2-0.3,0.4-0.4,0.6
                    c-22.9,24.8-19.5,60.1,7,60.1c20,0,40.2-24.7,38.2-53.8c6.6-7.4,21.9-15,37.3-15c7.7,0,20.6,2.2,29.9,4.3c0.6,0.1,1,0.8,0.9,1.4
                    c-0.1,0.4-0.4,0.7-0.8,0.9c-4.4,1.6-8.7,3.5-12.9,5.6c-4.2,2-7.5,5.5-9.2,9.8c-7,16.8-14.9,36.7-20.6,49.8
                    c-31.1,71.2-52.3,118.6-82.3,118.6c-31.8,0-32-48.4-18.3-79.4H169c-9.9,52,24.3,98.2,75.4,98.2c68.2,0,108.1-69.6,132.3-126
                    c5.8-13.4,18.1-42.6,29.5-69.5c9.9,2.3,19.9,4.1,30,5.4c24.6,2.7,9.5,34,8.5,35.8l0,0h20.5l37.4-87.6h-20.5c0,0-10.7,33.8-42.7,33.8
                    c-7.9,0-16.6-1.3-26.1-3.4l-0.2-0.3l5.2-12.3l13.6-32c19.5-46,46.3-91.3,67.8-93.8h0.4c28.2-2.1,13.6,34.1,13.6,34.1h20.5l26.2-61.3
                    L554,78.4z"/>
                    </svg>
                </a>
            </div>
            @if(get_field('sap_title', 'options') || get_field('sap_items', 'options'))
            <div class="col-xs-12 col-sm-2 col foot-sap">
                @if(get_field('sap_title', 'options'))
                <h5>{{ get_field('sap_title', 'options') }}</h5>
                @endif
                @if(get_field('sap_items', 'options'))
                <ul class="links">
                    @foreach((array) get_field('sap_items', 'options') as $item)
                    <li>
                        @if($item['type'] !== 'text')
                        <a href="{{ $item['link'] }}" class="{{ $item['type'] === 'email' ? 'email' : false }}" {{ $item['type'] === 'link' ? 'target="_blank"' : false }}>
                        @endif
                            {{ $item['label'] }}
                        @if($item['type'] !== 'text')
                        </a>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
            @endif
            @if(get_field('footer_addresses', 'options'))
                @foreach((array) get_field('footer_addresses', 'options') as $address)
                    <div class="col-xs-6 col-sm-2 col foot-address">
                        @if($address['title'])
                        <h5>{{ $address['title'] }}</h5>
                        @endif
                        @if($address['lines'])
                        <address>
                            @if($address['google_map_link'])
                                <a href="{{ $address['google_map_link'] }}" target="_blank">
                            @endif
                            @foreach((array) $address['lines'] as $index => $line)
                                @if($index > 0)
                                    <br/>
                                @endif
                                {{ $line['line'] }}
                            @endforeach
                            @if($address['google_map_link'])
                                </a>
                            @endif
                        </address>
                        @endif
                        @if($address['phone'])
                            <a href="tel:{{ $address['phone'] }}">{{ $address['phone'] }}</a>
                        @endif
                    </div>
                @endforeach
            @endif
            <div class="col-xs-6 col-sm-1 col foot-links">
                <?php $args = [
                    'theme_location' => 'footer_links',
                    'container' => false,
                    'container_class' => false,
                    'menu_class' => 'footer-links',
                    'menu_id' => false
                ]; ?>
                {{ wp_nav_menu($args) }}
            </div>
        </div>

        <div class="footer-bottom">
            @if(get_field('footer_copyright', 'options'))
            <div class="copyright">{{ get_field('footer_copyright', 'options') }}</div>
            @endif
        </div>
    </div>
</footer>