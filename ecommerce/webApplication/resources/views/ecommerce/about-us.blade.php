@extends('ecommerce.layouts.master')
@section('title','About Us')
@section('content')

<body>

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>ABOUT US</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{'/'}}">Home</a></li>
                        <li class="breadcrumb-item active">About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start About Page  -->
    <div class="about-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="noo-sh-title">We are <span>ThewayShop</span></h2>
                    <p>Welcome to "The Way Shop", your number one source for all things product, ie: men t-shirt, women t-shirt. We're dedicated to giving you the very best of product, with a focus on three characteristics, ie: dependability, customer service and uniqueness. We now serve customers all over place in the world, and are thrilled to be a part of the quirky, eco-friendly, fair trade wing of the fashion industry.
                    <br><br>
                    We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact us.
                    <br><br>
                    While we adapt, evolve, and continue to grow, the beliefs that are most important to us stay the same - Audacity, Bias for Action, and Customer First - our core values which are reflected in everything we do! While these core values define our identity and form the basis of all our decisions and actions, integrity and inclusion underpins all our processes.</p>
                </div>
                <div class="col-lg-6">
                    <div class="banner-frame"> <img class="img-thumbnail img-fluid" src="{{asset('front_assets/images/about-img.jpg')}}" alt="" />
                    </div>
                </div>
            </div>
            {{-- <div class="row my-5">
                <div class="col-sm-6 col-lg-4">
                    <div class="service-block-inner">
                        <h3>We are Trusted</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="service-block-inner">
                        <h3>We are Professional</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="service-block-inner">
                        <h3>We are Expert</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    </div>
                </div>
            </div> --}}
            <div class="row my-4">
                <div class="col-12">
                    <h2 class="noo-sh-title" align="center">Meet Our Team</h2><br>
                </div>
                <div class="col-sm-6 col-lg-3"></div>
                <div class="col-sm-6 col-lg-3">
                    <div class="hover-team">
                        <div class="our-team"> <img src="{{asset('front_assets/images/samir.jpg')}}" alt="" />
                            <div class="team-content">
                                <h3 class="title">Samir Randeriya</h3> <span class="post">Web Developer</span> </div>
                                <ul class="social">
                                    <li>
                                        <a href="https://api.whatsapp.com/send?phone=9099400550&text=Hello%20" target="_blank" class="fab fa-whatsapp"></a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/samir.randeriya.3/" target="_blank" class="fab fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/sam_randeriya__/" target="_blank" class="fab fa-instagram"></a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/in/samir-randeriya-578a17185/" target="_blank" class="fab fa-linkedin-in"></a>
                                    </li>
                                    <li>
                                        <a href="https://github.com/samir-randeriya" target="_blank" class="fab fa-github"></a>
                                    </li>
                                </ul>
                            <!-- <div class="icon"> <i class="fa fa-plus" aria-hidden="true"></i> </div> -->
                        </div>
                        <div class="team-description">
                            <p>In eCommerce, your website is your storefront; therefore, it’s essential that your site is easy to use and efficient to manage. On a foundational level, this means it should be aesthetically pleasing, process various payment types, offer multiple search and filtering options.</p>
                        </div>
                        <hr class="my-0"> </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="hover-team">
                        <div class="our-team"> <img src="{{asset('front_assets/images/jemina.jpg')}}" alt="" />
                            <div class="team-content">
                                <h3 class="title">Jemina Asmani</h3> <span class="post">Web Developer</span> </div>
                                <ul class="social">
                                    <li>
                                        <a href="#" target="_blank" class="fab fa-whatsapp"></a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" class="fab fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" class="fab fa-instagram"></a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" class="fab fa-linkedin-in"></a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" class="fab fa-github"></a>
                                    </li>
                                </ul>
                        </div>
                        <div class="team-description">
                            <p>In eCommerce, your website is your storefront; therefore, it’s essential that your site is easy to use and efficient to manage.On a foundational level, this means it should be aesthetically pleasing, process various payment types, offer multiple search and filtering options. </p>
                        </div>
                        <hr class="my-0"> </div>
                </div>
                <div class="col-sm-6 col-lg-3"></div>
            </div>
        </div>
    </div>
    <!-- End About Page -->

    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-01.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-02.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-03.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-04.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-05.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-06.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-07.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-08.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-09.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-05.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Instagram Feed  -->

</body>

@endsection