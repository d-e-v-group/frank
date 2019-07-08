@if($section['images'])
<div class="case-gal {{ ($section['force_prevent_wrap']) ? 'no-wrap' : false }} " {{ ($section_id) ? 'id="'.$section_id.'"' : false }} {{ ($section_id) ? 'data-nav-section="'.$section_id.'"' : false }}>
    <div class="container">
        <ul class="list">
            @foreach((array)$section['images'] as $item)
                <?php
                    $style = '';
                    if($item['adjust_top']){
                    	$style = 'margin-top:'.$item['adjust_top'].";";
                    }
                    if($item['adjust_bottom']){
                    	$style = $style.'margin-bottom:'.$item['adjust_bottom'].";";
                    }
                    if($item['adjust_left']){
                    	$style = $style.'left:'.$item['adjust_left'].";";
                    }
                    if($item['adjust_right']){
                        $style = $style.'margin-right:'.$item['adjust_right'].";";
                    }
                    if($item['adjust_width']){
                    	$style = $style.'width:'.$item['adjust_width'].";";
                    }
		            if($item['z_index']){
    			        $style = $style.'z-index:'.$item['z_index'].";";
    		        }
                ?>
            <li {{ ($style !== '') ? 'style="'.$style.'"' : false }} data-appear-fade-in>
	            <?php
	            $width = ($item['width']) ? $item['width'] : false
	            ?>
                {{ helper::image($item['image'], 'full', ['width' => $width]) }}
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endif