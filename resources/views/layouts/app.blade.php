<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description"
        content="Flat Masters is a borderless digital powerhouse delivering scalable web & software development, graphic design, digital marketing, and online cyber services for modern businesses and individuals.">
        <meta name="keywords"
        content="web development, software development, graphic designers, poster designs, brand identity, digital marketing, KRA services, Business registration, ICT support, scalable solutions, borderless delivery, high-performance code">
        <meta name="author" content="Flat Masters">
        <title>@yield('title', config('app.name', 'Laravel')) </title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <link rel="icon" href="" type="image/x-icon">

        @verbatim
        <script type="application/ld+json">
            {
            "@context" : "https://schema.org",
            "@type" : "WebSite",
            "name" : "Flat Masters",
            "url" : "https://www.flatmasters.co.ke/"
            }
        </script>
        @endverbatim
        @vite(['resources/sass/app.scss','resources/js/app.js']) 
        <style>
            body {
                font-family: 'Roboto', sans-serif;
                background: var(--bg-dark);
                color: var(--text-main);
            }
            .card{
                background: var(--card-bg);
                color: var(--text-main);
            }
            :root {
                --bg-dark: #0d1d4eff;
                --card-bg: rgba(255,255,255,0.06);
                --blue: #0000C2;
                --orange: #F97316;
                --text-main: #eaeaea;
                --text-muted: #a1a1a1;
                --light-dark: rgb(67, 79, 110);
            }
            .light-mode {
                --bg-dark: #ffffff;
                --card-bg: rgba(94, 93, 93, 0.06);
                --text-main: #000000;
                --text-muted: #666666;
            }
            .theme-toggle {
                position: fixed;
                bottom: 135px;
                right: 20px;
                z-index: 9999;
                background: var(--blue);
                color: white;
                border: none;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            }
            .theme-toggle:hover {
                background: var(--orange);
            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        
    </head>
    <body>
        <div id="app">
            @yield('content')

        </div>

        <!-- Loader Overlay -->
        <div id="loader-overlay" style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:2000;background:rgba(255,255,255,0.8);display:flex;align-items:center;justify-content:center;">
            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <button onclick="topFunction()" id="backToTopBtn" title="Go to top" style="display:none;position:fixed;bottom:20px;right:20px;z-index:9999;" class="btn btn-primary w-10 h-10  shadow">
            <i class="bi bi-arrow-up"></i>
        </button>
        <button id="themeToggle" class="theme-toggle" title="Toggle Theme">
            <i class="bi bi-moon-fill" id="themeIcon"></i>
        </button>

        <script>
            // Hide the loader overlay when the page is fully loaded
            window.addEventListener('load', function() {
            document.getElementById('loader-overlay').style.display = 'none';
            });
            // Back to top button functionality
            window.onscroll = function() {
                const backToTopBtn = document.getElementById("backToTopBtn");
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    backToTopBtn.style.display = "block";
                } else {
                    backToTopBtn.style.display = "none";
                }
            };

            function topFunction() {
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            }

            // Theme toggle functionality
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');
            const body = document.body;

            // Check for saved theme preference or default to dark
            const currentTheme = localStorage.getItem('theme') || 'dark';
            if (currentTheme === 'light') {
                body.classList.add('light-mode');
                themeIcon.classList.remove('bi-moon-fill');
                themeIcon.classList.add('bi-sun-fill');
            }

            themeToggle.addEventListener('click', () => {
                body.classList.toggle('light-mode');
                const isLight = body.classList.contains('light-mode');
                localStorage.setItem('theme', isLight ? 'light' : 'dark');
                themeIcon.classList.toggle('bi-moon-fill');
                themeIcon.classList.toggle('bi-sun-fill');
            });
            /* document.addEventListener('contextmenu', function (e) {
                e.preventDefault();
            });
            document.addEventListener('keydown', function (e) {
                if (
                    e.key === "F12" ||
                    (e.ctrlKey && e.shiftKey && ['I', 'J', 'C'].includes(e.key)) ||
                    (e.ctrlKey && e.key === 'U')
                ) {
                    e.preventDefault();
                }
            });*/
        </script> 
    </body>
</html>