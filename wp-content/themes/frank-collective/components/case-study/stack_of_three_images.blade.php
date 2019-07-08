<div class="case-banner-wrap" {{ ($section['navigation_color'] === 'light') ? 'data-dark' : false }}  {{ ($section_id) ? 'id="'.$section_id.'"' : false }} {{ ($section_id) ? 'data-nav-section="'.$section_id.'"' : false }}>
    <div class="cw-3-1" data-appear-block="fade-in">
        <div class="case-banner ch-half" style="background-image: url('{{ helper::imageURL($section['secondary_image_1'], 'full') }}');"></div>
        <div class="case-banner ch-half" style="background-image: url('{{ helper::imageURL($section['secondary_image_2'], 'full') }}');"></div>
    </div>
    <div class="cw-3-2 ch-xmd case-banner" style="background-image: url('{{ helper::imageURL($section['main_image'], 'full') }}');" data-appear-fade-in></div>
</div>