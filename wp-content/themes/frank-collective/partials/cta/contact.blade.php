<div class="container {{ isset($classes) ? $classes : false }}">
	<?php
	$button = get_field('cta_contacts_button', 'options');
	$link = $button['type'] == 'internal'
		? $button['internal_link']
		: $button['external_link'];
	?>
    <a class="cta contact-cta" href="{{ $link }}" data-appear-text>
        <div class="inner">
            @if(get_field('cta_contacts_title', 'options'))
            <h3>{{ get_field('cta_contacts_title', 'options') }}</h3>
            @endif
            @if(get_field('cta_contacts_button', 'options'))
            <p>
                <span class="link-u">{{ $button['label'] }}</span>
            </p>
            @endif
        </div>
    </a>
</div>