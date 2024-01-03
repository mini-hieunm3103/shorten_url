<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap");
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            font-size: 16px;
        }

        body {
            font-family: "Poppins", sans-serif, "Segoe UI", Tahoma, Geneva, Verdana;
            font-weight: 500;
            outline: none;
        }

        h1,
        h2,
        h3,
        h4 {
            color: #35323e;
            font-weight: 700;
        }

        p {
            color: #9e9aa7;
            font-weight: 500;
            line-height: 1.7;
        }

        a {
            text-decoration: none;
        }

        img {
            max-width: 100%;
        }

        .btn {
            display: inline-block;
            color: white;
            background-color: #2acfcf;
            text-transform: capitalize;
            font-weight: 700;
            border: none;
            outline: none;
            cursor: pointer;
            border-radius: 100px;
            transition: 0.3s;
        }

        .btn.btn-sm {
            padding: 7px 21px;
        }

        .btn.btn-lg {
            padding: 12px 36px!important;
        }

        .btn.btn-plus-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            column-gap: 10px;
        }

        .btn.btn-plus-icon .icon {
            font-size: 22px;
        }

        .btn:hover {
            background-color: #6be1e1;
        }

        .flex-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
        }

        .flex-ver-top {
            align-items: flex-start;
        }

        .scale-effect:active {
            transform: scale(0.88);
            transition: 0.2s;
        }

        .section-header {
            text-align: center;
        }

        .section-header h2 {
            font-size: 35px;
        }

        @media (max-width: 500px) {
            .section-header h2 {
                font-size: 26px;
            }
        }

        @media (max-width: 280px) {
            .section-header h2 {
                font-size: 22px;
            }
        }

        .section-header p {
            width: 50%;
            margin: 7px auto 0;
        }
        a.width-992 {
            display: inline-block!important;
        }
        div.width-992 {
            display: none!important;
        }
        @media (max-width: 992px) {
            .section-header p {
                width: 70%;
            }
            a.width-992 {
                display: none!important;
            }
            div.width-992 {
                display: block!important;
            }
        }

        @media (max-width: 500px) {
            .section-header p {
                width: 100%;
            }
        }

        .container {
            position: relative;
            width: 78%;
            margin: 0 auto;
        }

        @media (max-width: 992px) {
            .container {
                width: 90%;
            }
        }

        .header {
            padding: 45px 0;
        }

        .header .logo img {
            height: 30px;
        }

        .header .main-navgation {
            flex: 1;
            gap: 0;
        }

        @media (max-width: 992px) {
            .header .main-navgation {
                position: absolute;
                top: 150%;
                left: 50%;
                transform: translateX(-50%);
                width: 70%;
                height: 0;
                z-index: 999;
                overflow: hidden;
                flex-direction: column;
                align-items: center;
                padding: 0 33.33333px;
                border-radius: 10px;
                background-color: #3b3054;
                transition: height 0.3s;
            }
        }

        @media (max-width: 767px) {
            .header .main-navgation {
                width: 90%;
            }
        }

        @media (max-width: 375px) {
            .header .main-navgation {
                width: 100%;
            }
        }

        @media (max-width: 280px) {
            .header .main-navgation {
                padding: 0 25px;
            }
        }

        .header .main-navgation > div {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        @media (max-width: 992px) {
            .header .main-navgation > div {
                flex-direction: column;
                width: 100%;
                padding: 33.33333px 0;
            }
        }

        @media (max-width: 280px) {
            .header .main-navgation > div {
                padding: 25px 0;
            }
        }

        .header .main-navgation div:first-child {
            border-bottom: 1px solid white;
        }

        .header .nav-buttons .btn {
            color: #fff;
            width: 80%;
        }

        @media (max-width: 375px) {
            .header .nav-buttons .btn {
                width: 100%;
            }
        }

        .header .burger-menu {
            font-size: 22px;
            color: #9e9aa7;
            cursor: pointer;
            display: none;
        }

        @media (max-width: 992px) {
            .header .burger-menu {
                display: block;
            }
        }

        .main-navgation a {
            font-weight: 700;
            font-size: 14px;
            color: #9e9aa7;
            transition: 0.3s;
        }

        .main-navgation a:hover {
            color: #232127;
        }

        @media (max-width: 992px) {
            .main-navgation a {
                width: 100%;
                color: white;
                text-align: center;
                font-size: 16px;
            }
            .main-navgation a:hover {
                color: #2acfcf;
            }
        }

        .landing {
            display: flex;
            align-items: center;
            padding: 40px 0;
            margin-left: 11%;
            overflow-x: hidden;
        }

        @media (max-width: 992px) {
            .landing {
                flex-direction: column-reverse;
                margin-left: 0;
                padding-bottom: 80px;
                row-gap: 60px;
            }
        }

        @media (max-width: 280px) {
            .landing {
                padding-bottom: 40px;
            }
        }

        .landing .landing-text {
            flex: 1;
            min-width: 465px;
        }

        @media (max-width: 992px) {
            .landing .landing-text {
                max-width: 95%;
                min-width: 0;
                text-align: center;
            }
        }

        .landing .landing-text h1 {
            width: 100%;
            font-size: 3.9em;
            line-height: 1.15;
        }

        @media (max-width: 992px) {
            .landing .landing-text h1 {
                font-size: 3em;
            }
        }

        @media (max-width: 500px) {
            .landing .landing-text h1 {
                font-size: 2em;
            }
        }

        .landing .landing-text p {
            font-size: 18px;
            max-width: 500px;
            margin: 0 0 29.41176px;
        }

        @media (max-width: 992px) {
            .landing .landing-text p {
                font-size: 16px;
                margin: 10px auto 29.41176px;
            }
        }

        @media (max-width: 500px) {
            .landing .landing-text p {
                font-size: 15px;
            }
        }

        .landing .landing-image {
            position: relative;
            right: -70px;
        }

        @media (max-width: 992px) {
            .landing .landing-image {
                flex-basis: initial;
                right: -240px;
            }
        }

        @media (max-width: 767px) {
            .landing .landing-image {
                right: -170px;
            }
        }

        @media (max-width: 500px) {
            .landing .landing-image {
                right: -110px;
            }
        }

        @media (max-width: 375px) {
            .landing .landing-image {
                right: -120px;
            }
        }

        @media (max-width: 280px) {
            .landing .landing-image {
                right: -70px;
            }
        }

        @media (min-width: 1100px) {
            .landing .landing-image {
                right: -130px;
            }
        }

        .landing .landing-image img {
            width: 100%;
        }

        .features {
            margin-top: 100px;
            background-color: #eff0f5;
        }

        .url-shorten-form {
            width: 100%;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            background: #3b3054 url(../images/bg-shorten-desktop.svg) no-repeat right top;
            background-size: cover;
            padding: 45px;
            border-radius: 6px;
            margin-bottom: 20px;
            transform: translateY(-50%);
            transition: gap 0.3s;
        }

        @media (max-width: 850px) {
            .url-shorten-form {
                flex-direction: column;
                background: #3b3054 url(../images/bg-shorten-mobile.svg) no-repeat right top;
                padding: 25px;
                margin-bottom: 0;
            }
        }

        @media (max-width: 280px) {
            .url-shorten-form {
                padding: 20px;
            }
        }

        .url-shorten-form > div {
            position: relative;
            flex: 1;
        }

        .url-shorten-form .url-input {
            width: 100%;
            font-family: "Poppins", sans-serif, "Segoe UI", Tahoma, Geneva, Verdana;
            font-size: 18px;
            padding: 8px 20px;
            background: white;
            border: 2px solid transparent;
            border-radius: 6px;
            outline: none;
            transition: 0.2s;
        }

        .url-shorten-form .url-input::placeholder {
            font-family: "Poppins", sans-serif, "Segoe UI", Tahoma, Geneva, Verdana;
            font-size: 16px;
            font-weight: 500;
            color: #9e9aa7;
        }

        .url-shorten-form .alert {
            position: absolute;
            left: 0;
            top: calc(100% + 4px);
            font-style: italic;
            font-size: 16px;
            color: #f46262;
            opacity: 0;
            transition: 0.2s opacity;
        }

        @media (max-width: 500px) {
            .url-shorten-form .alert {
                font-size: 14px;
            }
        }

        .url-shorten-form .btn {
            text-align: center;
            border-radius: inherit;
            white-space: nowrap;
            font-size: 16px;
            cursor: pointer;
        }

        @media (max-width: 850px) {
            .url-shorten-form .btn {
                font-size: 19px;
                padding: 10px 30px;
            }
        }

        .url-shorten-form.empty {
            gap: 37px;
        }

        .url-shorten-form.empty .url-input {
            border-color: #f46262;
        }

        .url-shorten-form.empty .url-input::placeholder {
            color: #f46262;
            opacity: 0.5;
        }

        .url-shorten-form.empty .alert {
            opacity: 1;
        }

        .url-shorten-form.success button {
            background: #30c59b;
        }

        .url-shorten-results {
            position: relative;
            top: -60px;
        }

        .url-shorten-results .url-shorten-result {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            padding: 15px 25px;
            background: white;
            border-radius: 6px;
            margin-bottom: 15.15152px;
        }

        .url-shorten-results .url-shorten-result > div p {
            font-size: 17px;
            word-break: break-word;
        }

        .url-shorten-results .url-shorten-result > div a:hover {
            text-decoration: underline wavy #30c59b 2px;
        }

        @media (max-width: 850px) {
            .url-shorten-results .url-shorten-result {
                flex-direction: column;
                align-items: flex-start;
                padding: 0;
                gap: 0;
            }
            .url-shorten-results .url-shorten-result > div {
                width: 100%;
                align-items: flex-start;
                padding: 12px 18px;
            }
        }

        .url-shorten-results .delete-all-urls {
            display: block;
            margin: auto;
            font-size: 15px;
            background-color: #f24a4a;
        }

        .url-shorten-results .delete-all-urls:hover {
            background-color: #f46262;
        }

        .url-shorten-result .old-url p {
            color: #35323e;
            font-weight: 500;
        }

        .url-shorten-result .old-url a {
            color: inherit;
        }

        @media (max-width: 850px) {
            .url-shorten-result .old-url {
                border-bottom: 1px solid #bfbfbf;
            }
        }

        .url-shorten-result .new-url {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .url-shorten-result .new-url a {
            color: #2acfcf;
        }

        @media (max-width: 850px) {
            .url-shorten-result .new-url {
                flex-direction: column;
                gap: 12px;
            }
        }

        .url-shorten-result .options {
            display: flex;
            gap: 10px;
        }

        @media (max-width: 850px) {
            .url-shorten-result .options {
                width: 100%;
            }
        }

        .url-shorten-result .options button {
            width: 95px;
            font-size: 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        .url-shorten-result .options button.copied {
            background: #3b3054;
        }

        .url-shorten-result .options button.delete-url {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 35px;
            background: #f46262;
            border: none;
            color: white;
            font-size: 18px;
            transition: 0.2s;
        }

        .url-shorten-result .options button.delete-url:hover {
            color: #f46262;
            background-color: #eff0f5;
            font-size: 20px;
        }

        @media (max-width: 850px) {
            .url-shorten-result .options button {
                width: 100%;
                font-size: 18px;
                padding: 10px 30px;
            }
        }

        .more-features-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            padding: 80px 0 90px 0;
        }

        @media (max-width: 666px) {
            .more-features-content {
                gap: 80px;
            }
        }

        @media (max-width: 280px) {
            .more-features-content {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }

        .more-features-content .feature {
            position: relative;
            background: white;
            border-radius: 6px;
        }

        .more-features-content .feature:before,
        .more-features-content .feature::after {
            position: absolute;
            content: "";
            background: #2acfcf;
        }

        @media (max-width: 666px) {
            .more-features-content > div:nth-child(2):before,
            .more-features-content > div:nth-child(2)::after {
                width: 6px;
                height: 80px;
                left: 50%;
                transform: translateX(-50%);
            }
            .more-features-content > div:nth-child(2):before {
                top: -80px;
            }
            .more-features-content > div:nth-child(2):after {
                bottom: -80px;
            }
        }

        @media (min-width: 1130px) {
            .more-features-content {
                align-items: flex-start;
            }
            .more-features-content > div:nth-child(2) {
                margin-top: 30px;
            }
            .more-features-content > div:nth-child(2):before,
            .more-features-content > div:nth-child(2)::after {
                height: 6px;
                width: 25px;
                top: 40%;
            }
            .more-features-content > div:nth-child(2):before {
                left: -25px;
            }
            .more-features-content > div:nth-child(2):after {
                right: -25px;
            }
            .more-features-content > div:nth-child(3) {
                margin-top: 60px;
            }
        }

        .feature .feature-illustration {
            position: absolute;
            top: -32.5px;
            left: 25px;
            display: grid;
            place-items: center;
            width: 65px;
            height: 65px;
            background: #3b3054;
            border-radius: 50%;
        }

        @media (max-width: 666px) {
            .feature .feature-illustration {
                left: 50%;
                transform: translateX(-50%);
                width: 80px;
                height: 80px;
            }
        }

        .feature .feature-illustration img {
            max-width: 50%;
        }

        .feature .feature-details {
            padding: 0 25px 30px;
            margin-top: 60px;
        }

        @media (max-width: 666px) {
            .feature .feature-details {
                text-align: center;
                margin-top: 80px;
            }
        }

        @media (max-width: 280px) {
            .feature .feature-details {
                padding: 0 20px 25px;
            }
        }

        @media (max-width: 500px) {
            .feature .feature-details h3 {
                font-size: 20px;
            }
        }

        @media (max-width: 280px) {
            .feature .feature-details h3 {
                font-size: 18px;
            }
        }

        .feature .feature-details p {
            margin-top: 10px;
            font-size: 14px;
        }

        .pricing {
            padding: 50px 0;
            background: #3b3054 url(../images/bg-boost-desktop.svg) no-repeat right;
            background-size: cover;
        }

        @media (max-width: 500px) {
            .pricing {
                padding: 90px 0;
                background-image: url(../images/bg-boost-mobile.svg);
            }
        }

        .pricing .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .pricing h2 {
            color: white;
            margin-bottom: 20px;
        }

        .footer {
            padding-top: 50px;
            background: #232127;
        }

        .footer .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 70px;
            flex-wrap: wrap;
        }

        @media (max-width: 705px) {
            .footer .container {
                flex-wrap: nowrap;
                flex-direction: column;
                align-items: center;
                gap: 30px;
            }
        }

        .footer .logo {
            flex: 1 0 auto;
        }

        .footer .logo img {
            filter: brightness(10);
        }

        .footer .quick-links {
            display: flex;
            gap: 60px;
        }

        @media (max-width: 705px) {
            .footer .quick-links {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 30px;
            }
        }

        .footer .quick-links .links-group {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .footer .links-group span {
            color: white;
            font-weight: 700;
        }

        .footer .links-group > div {
            display: flex;
            flex-direction: column;
            gap: 6.66667px;
        }

        .footer .links-group a {
            color: #bfbfbf;
            font-size: 13px;
            transition: 0.2s color;
        }

        .footer .links-group a:hover {
            color: cyan;
        }

        .footer .social-media {
            display: flex;
            flex-shrink: 0;
            align-items: center;
            gap: 20px;
        }

        .footer .social-media img {
            max-width: 85%;
            transition: 0.2s transform;
        }

        .footer .social-media img:hover {
            transform: scale(1.1);
            filter: invert(0%) sepia(59%) saturate(6585%) hue-rotate(125deg)
            brightness(86%) contrast(85%);
        }

        .attribution {
            padding: 30px 0 25px 0;
            text-align: center;
            font-size: 13px;
            color: #fff;
        }

        .attribution .outer-link {
            font-size: 15px;
            color: #2acfcf;
            margin-left: 2px;
            cursor: pointer;
        }

        .attribution .outer-link:hover {
            text-decoration: underline wavy #2acfcf 2px;
        }

        .attribution .social-media {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            list-style: none;
            margin-left: 5px;
        }

        .attribution .social-media .icon {
            font-size: 20px;
            color: #fff;
        }

        .attribution .social-media .image {
            width: 23px;
        }

        .attribution .social-media .image:hover {
            filter: none;
            background-color: none;
        }

    </style>
</head>
<body>
<main class="main">
    <!-- Header -->
    <header class="header">
        <div class="container flex-between">
            <div class="logo">
                <a href="{{route('welcome')}}" class="" style="font-size: xx-large; color: rgba(0,0,0,.8); font-weight: 1000">
                    ShortenURL
                </a>
            </div>
            <nav class="main-navgation flex-between flex-ver-top">
                <div class="nav-links">
                    <a href="#features">Features</a>
                    <a href="#pricing">Pricing</a>
                    <a href="#resources">Resources</a>
                </div>
                <div class="nav-buttons">
                    <a href="{{route('login')}}" class="log-in">Login</a>
                    <a href="{{route('register')}}" class="sign-up btn btn-sm">Sign Up</a>
                </div>
            </nav>
            <div class="burger-menu">
                <i class="fa-regular fa-bars icon"></i>
            </div>
        </div>
    </header>
    <!-- Landing -->
    <section class="landing">
        <div class="landing-text">
            <h1>More than just shorter links</h1>
            <p>
                Build your brand’s recognition and get detailed insights on how your
                links are performing.
            </p>
            <a href="#url-shorten-form" class="btn btn-lg width-992">Get Started</a>
            <div class="nav-buttons width-992 mt-3">
                <a href="{{route('login')}}" class="log-in" style="margin-right: 10px;">Login</a>
                <a href="{{route('register')}}" class="sign-up btn btn-sm">Sign Up</a>
            </div>
        </div>
        <div class="landing-image">
            <img src="https://raw.githubusercontent.com/MohamedAridah/frontendmentor_url-shortening-api/main/images/illustration-working.svg" alt="Working Illustration" />
        </div>
    </section>
    <!-- Features -->
    <section class="features" id="features">
        <div class="container">
            <!-- Short URL Feature -->
            <div class="url-shorten-feature">
                <form class="url-shorten-form" action="{{route('register')}}" method="get" id="url-shorten-form">
                    <div>
                        <input type="text" name="long_url" class="url-input" placeholder="Shorten a link here..." autocomplete="off" />
                        <span class="alert"></span>
                    </div>
                    <button type="submit" class="btn btn-lg btn-plus-icon">Sign up and get your link!</button>
                </form>
                <div class="url-shorten-results"></div>
            </div>
            <!-- Advanced Features -->
            <div class="more-features">
                <div class="section-header">
                    <h2>Advanced Statistics</h2>
                    <p>
                        Track how your links are performing across the web with our
                        advanced statistics dashboard.
                    </p>
                </div>
                <div class="more-features-content">
                    <div class="feature">
                        <div class="feature-illustration">
                            <img src="https://raw.githubusercontent.com/MohamedAridah/frontendmentor_url-shortening-api/main/images/icon-brand-recognition.svg" alt="Feature Illustration Icon" />
                        </div>
                        <div class="feature-details">
                            <h3>Brand Recognition</h3>
                            <p>
                                Boost your brand recognition with each click. Generic links
                                don’t mean a thing. Branded links help instil confidence in
                                your content.
                            </p>
                        </div>
                    </div>
                    <div class="feature">
                        <div class="feature-illustration">
                            <img src="https://raw.githubusercontent.com/MohamedAridah/frontendmentor_url-shortening-api/main/images/icon-detailed-records.svg" alt="Feature Illustration Icon" />
                        </div>
                        <div class="feature-details">
                            <h3>Detailed Records</h3>
                            <p>
                                Gain insights into who is clicking your links. Knowing when
                                and where people engage with your content helps inform
                                better decisions.
                            </p>
                        </div>
                    </div>
                    <div class="feature">
                        <div class="feature-illustration">
                            <img src="https://raw.githubusercontent.com/MohamedAridah/frontendmentor_url-shortening-api/main/images/icon-fully-customizable.svg" alt="Feature Illustration Icon" />
                        </div>
                        <div class="feature-details">
                            <h3>Fully Customizable</h3>
                            <p>
                                Improve brand awareness and content discoverability through
                                customizable links, supercharging audience engagement.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Pricing -->
    <section class="pricing" id="pricing">
        <div class="container">
            <div class="section-header">
                <h2>Boost your links today</h2>
                <a href="#" class="btn btn-lg">Get Started</a>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="footer" id="resources">
        <div class="container">
            <!-- Website Logo -->
            <div class="logo">
                <a href="{{route('welcome')}}" class="" style="font-size: xx-large; color: white; font-weight: 1000">
                    ShortenURL
                </a>
            </div>
            <!-- Quick Links -->
            <div class="quick-links">
                <div class="links-group">
                    <span>Features</span>
                    <div>
                        <a href="#">Link Shortening</a>
                        <a href="#">Branded Links</a>
                        <a href="#">Analytics</a>
                    </div>
                </div>
                <div class="links-group">
                    <span>Resources</span>
                    <div>
                        <a href="#">Blog</a>
                        <a href="#">Developers</a>
                        <a href="#">Support</a>
                    </div>
                </div>
                <div class="links-group">
                    <span>Company</span>
                    <div>
                        <a href="#">About</a>
                        <a href="#">Our Team</a>
                        <a href="#">Careers</a>
                        <a href="#">Contact</a>
                    </div>
                </div>
            </div>
            <!-- Social Media -->
            <div class="social-media">
                <a target="_blank" href="https://fb.com/hieunm3103">
                    <img src="https://raw.githubusercontent.com/MohamedAridah/frontendmentor_url-shortening-api/main/images/icon-facebook.svg" alt="Facebook Logo">
                </a>
                <a href="#">
                    <img src="https://raw.githubusercontent.com/MohamedAridah/frontendmentor_url-shortening-api/main/images/icon-twitter.svg" alt="Twitter Logo">
                </a>
                <a href="#">
                    <img src="https://raw.githubusercontent.com/MohamedAridah/frontendmentor_url-shortening-api/main/images/icon-pinterest.svg" alt="Pinterest Logo">
                </a>
                <a href="#">
                    <img src="https://raw.githubusercontent.com/MohamedAridah/frontendmentor_url-shortening-api/main/images/icon-instagram.svg" alt="Instagram Logo">
                </a>
            </div>
        </div>
        <!-- Made By -->
        <div class="attribution">
            Landing Page: Challenge by <a href="https://www.frontendmentor.io?ref=challenge" class="outer-link" target="_blank">Frontend Mentor</a>.
            Coded by <span class="outer-link">Mohamed Aridah</span>.
            <ul class="social-media">
                <li>
                    <a href="https://www.codepen.io/FedLover" title="go To My Codepen Account">
                        <i class="fa-brands fa-codepen icon"></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.frontendmentor.io/profile/MohamedAridah" title="go To My Frontend Mentor Account">
                        <img src="https://mohamedaridah.github.io/hosted-assets/FEM.png" class="image" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </footer>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
