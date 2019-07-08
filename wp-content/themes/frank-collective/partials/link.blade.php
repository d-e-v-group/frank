@if(isset($button))
	@if($button['label'] !== '' || $button['internal_link'] || $button['external_link'] !== '')
	<?php
	$link = $button['type'] == 'internal'
			? $button['internal_link']
			: $button['external_link'];
	?>
	<a href="{{ $link }}" class="{{ isset($classes) ? $classes : false }}">{{ $button['label'] }}</a>
	@endif
@endif