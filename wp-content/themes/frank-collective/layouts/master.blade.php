<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ wp_title('') }}</title>
    @yield('head')
    {{ wp_head() }}
    <!-- frank -->
    @if(is_user_logged_in())
    <?php /* This is to override bottom admin bar stuff */ ?>
    <style>
        html { margin-top: 0px !important; }
        * html body { margin-top: 0px !important; }
        @media screen and ( max-width: 782px ) {
            html { margin-top: 0px !important; }
            * html body { margin-top: 0px !important; }
        }
    </style>
    @endif
    <style>
        #preloader_overlay{
            position: fixed;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: #ffffff;
            /*opacity: 0.8;*/
            z-index: 99999;
        }
        body.protected #preloader_overlay{
            display:none;
        }
        @if(get_field('case_study_loading_overlay', 'options'))
            .work-overlay {
            background-color: {{ get_field('case_study_loading_overlay', 'options') }};
            }
        @endif
    </style>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="@yield('body-class')">
<div id="preloader_overlay"></div>
<div id="wrapper">
    @include('partials/header')
    <div id="barba-wrapper">
        <main id="main" class="@yield('main-class')">
            @yield('content')
        </main>
    </div>
    @include('partials/footer')
</div>
{{ wp_footer() }}
</body>
</html>