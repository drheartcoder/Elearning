<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <title>Page not found</title>
    <meta property="og:title" content="ELearning">
    <meta property="og:description" content="">
    <meta property="og:image" content="images/logo.png">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1920">
    <meta property="og:image:height" content="1280">
    <meta property="og:locale" content="English">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="ELearning">
    <meta property="og:type" content="website">
    <!-- ======================================================================== -->
    <link rel=icon href="{{url('/')}}/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="{{url('/')}}/css/front/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!--Custom Css-->
    <link href="{{url('/')}}/css/front/elearning.css" rel="stylesheet" type="text/css" />
</head>

<body>


    <div class="banner-404" style="background:url('{{ url('/').'/images/404-image.JPG' }}'); background-size:cover;background-position:center top;background-repeat:none; height: 100%;position: fixed;width: 100%;overflow: auto;">        
        <div class="bg-tra">
            <div class="container">
                <div class="row">
                    <div class="err-cont">

                        <div class="col-sm-8 col-md-6 col-lg-5">
                            <div class="text-center">
                                <div class="logo-head">
                                    <a href="#"><img src="{{url('/')}}/images/404-logo-img.png" alt=""></a>
                                </div>
                                <div class="error_type">404</div>
                                <p class="err-cls ">error</p>
                                <div class="error_msg">
                                    <p>Sorry, The page is missing</p>
                                </div>
                                <hr class="seperator">
                                <a href="{{url('/')}}" class="become-phot">Go Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end of global js -->