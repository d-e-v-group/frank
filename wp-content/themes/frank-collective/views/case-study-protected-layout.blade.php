@layout('layouts/master')
@section('body-class') protected @endsection
<?php /* Template Name: Case Study Protected */ ?>
@section('content')
    <div class='wrapper-protected__casestudy'>
        <div class='wrapper-protected__form'>
            <?php echo get_the_password_form(); ?>
        </div>
    </div>
@endsection