<footer id="footer">
    <div class="container">
        <div class="grid-flex">
            <div class="col-xls-6 col-sm-3">
	            <?php $args = [
		            'theme_location' => 'footer_nav',
		            'container' => false,
		            'container_class' => false,
		            'menu_class' => 'footer-nav',
		            'menu_id' => false
	            ]; ?>
                {{ wp_nav_menu($args) }}
            </div>
            @if(get_field('sap_title', 'options') || get_field('sap_items', 'options'))
            <div class="col-xls-6 col-sm-3 col">
                @if(get_field('sap_title', 'options'))
                <h5>{{ get_field('sap_title', 'options') }}</h5>
                @endif
                @if(get_field('sap_items', 'options'))
                <ul class="links">
                    @foreach((array) get_field('sap_items', 'options') as $item)
                    <li>
                        @if($item['type'] !== 'text')
                        <a href="{{ $item['link'] }}" class="link-u {{ $item['type'] === 'email' ? 'email' : false }}" {{ $item['type'] === 'link' ? 'target="_blank"' : false }}>
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
                    <div class="col-xs-6 col-sm-2 col">
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
            <div class="col-xs-6 col-sm-1 col-lg-offset-1 col">
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
            <a href="/" class="logo">
                @include('partials/image', ['image' => get_field('footer_logo', 'options')])
            </a>

            @if(get_field('footer_copyright', 'options'))
            <div class="copyright">{{ get_field('footer_copyright', 'options') }}</div>
            @endif
        </div>
    </div>
</footer>