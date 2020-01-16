<article class="case-intro">
    <div class="container">
        <div class="grid">
            <div class="col-sm-5 col-sm-offset-1" data-appear-block>
                @if(isset($pagetitle))
                <div class="title">{{ $pagetitle }}</div>
                @endif
                
                @if(isset($subtitle))
                <div class="subtitle"><a href="{{ $link }}" target="_blank">{{ $subtitle }}</a></div>
                @endif

                <?php
                    $term_obj_list = get_the_terms( get_the_ID(), 'service' );
                ?>
                @if(!empty($term_obj_list))
                    <?php
                    $services = array_chunk($term_obj_list, 3);
                    ?>
                    <h6>What we did</h6>
                    <ul class="service-list">
                    @foreach($services as $items)
                        @foreach($items as $item)
                            <li>{{ $item->name }}</li>
                        @endforeach
                    @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-sm-5" data-appear-block>
                @if(isset($h1))
                <h1>{{ $h1 }}</h1>
                @endif
                @if(isset($content))
                    {{ $content }}
                @endif
            </div>
        </div>
    </div>
</article>