<?php
global $post;
if ( !post_password_required( $post ) ) :
?>

@include('views/case-study-layout')

<?php
else:
?>
    @include('views/case-study-protected-layout')
<?php
endif;
?>