<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CineMarvel - Experiencia de Cine Premium</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700,800&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body class="modern-dark-theme">
        @include('partials.header')

        <script src="{{ asset('js/menu.js') }}"></script>

        <main>
            <section class="hero reveal">
                <div class="banner-carousel">
                    <div class="carousel-container">
                        <div class="carousel-slides">
                            <div class="slide active">
                                <img src="/img/4DE-Motion.jpg" alt="Banner 1">
                            </div>
                            <div class="slide">
                                <img src="/img/sololevelingbaner.jpg" alt="Banner 2">
                            </div>
                            <div class="slide">
                                <img src="/img/starwarsbaner.jpg" alt="Banner 3">
                            </div>
                            <div class="slide">
                                <img src="/imgpel/avatar2026.jpeg" alt="Banner 4">
                            </div>
                            <div class="slide">
                                <img src="/img/ultimobaner.jpeg" alt="Banner 5">
                            </div>
                        </div>

                        <button class="carousel-button carousel-button-prev" aria-label="Anterior">‹</button>
                        <button class="carousel-button carousel-button-next" aria-label="Siguiente">›</button>

                        <div class="carousel-dots"></div>
                    </div>
                </div>
            </section>

            <section id="cartelera" class="cartelera-section reveal">
                <h2 class="cartelera-title">Cartelera</h2>

                <div class="peliculas-container" role="region" aria-label="Galería de películas">
                    <div class="pelicula pelicula-featured reveal">
                        <img src="/img/starwarsposter.jpg" alt="Star Wars">
                        <div class="pelicula-overlay">Star Wars</div>
                    </div>

                    <div class="pelicula pelicula-featured reveal">
                        <img src="/img/interstelarposter.jpg" alt="Interestelar">
                        <div class="pelicula-overlay">Interestelar</div>
                    </div>

                    <div class="pelicula reveal">
                        <img src="/img/deadpolposter.jpg" alt="Deadpool">
                        <div class="pelicula-overlay">Deadpool</div>
                    </div>

                    <div class="pelicula reveal">
                        <img src="/img/sololevelingposter.jpg" alt="Solo Leveling">
                        <div class="pelicula-overlay">Solo Leveling</div>
                    </div>

                    <div class="pelicula reveal">
                        <img src="/imgpel/avatar2026.jpeg" alt="Coraline">
                        <div class="pelicula-overlay">Avatar: Fuego y Ceniza</div>
                    </div>

                    <div class="pelicula reveal">
                        <img src="/img/ultimoposter.jpg" alt="El Ultimo">
                        <div class="pelicula-overlay">El Ultimo</div>
                    </div>

                    <div class="pelicula reveal">
                        <img src="/img/serñorposter.jpg" alt="El Senor">
                        <div class="pelicula-overlay">El Senor</div>
                    </div>

                    <div class="pelicula reveal">
                        <img src="/img/ladoposter.jpg" alt="El Lado Oscuro">
                        <div class="pelicula-overlay">El Lado Oscuro</div>
                    </div>

                    <div class="pelicula reveal">
                        <img src="/img/silencioposter.jpg" alt="Silencio">
                        <div class="pelicula-overlay">Silencio</div>
                    </div>

                    <div class="pelicula reveal">
                        <img src="/img/niños2poster.jpg" alt="Los Ninos">
                        <div class="pelicula-overlay">Los Ninos</div>
                    </div>
                </div>
            </section>

            <section id="horarios" class="cartelera-section reveal">
                <h2 class="cartelera-title">Horarios de hoy</h2>
                <div class="peliculas-container">
                    <article class="pelicula reveal">
                        <div class="pelicula-overlay" style="opacity: 1; transform: translateY(0); position: static; background: transparent;">
                            Star Wars<br>14:00 | 17:30 | 21:00
                        </div>
                    </article>

                    <article class="pelicula reveal">
                        <div class="pelicula-overlay" style="opacity: 1; transform: translateY(0); position: static; background: transparent;">
                            Interestelar<br>13:00 | 16:40 | 20:20
                        </div>
                    </article>

                    <article class="pelicula reveal">
                        <div class="pelicula-overlay" style="opacity: 1; transform: translateY(0); position: static; background: transparent;">
                            Deadpool<br>15:15 | 18:45 | 22:10
                        </div>
                    </article>
                </div>
            </section>
        </main>

        <footer class="modern-footer reveal">
            <p>&copy; 2026 CineMarvel. Todos los derechos reservados.</p>
        </footer>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                let slideIndex = 0;
                const slides = document.querySelectorAll(".slide");
                const prevButton = document.querySelector(".carousel-button-prev");
                const nextButton = document.querySelector(".carousel-button-next");
                const dotsContainer = document.querySelector(".carousel-dots");
                const reveals = document.querySelectorAll(".reveal");
                let autoPlay;

                slides.forEach((_, index) => {
                    const dot = document.createElement("button");
                    dot.classList.add("carousel-dot");
                    dot.setAttribute("aria-label", `Ir al slide ${index + 1}`);
                    dot.addEventListener("click", () => {
                        slideIndex = index;
                        showSlide(slideIndex);
                        restartAutoPlay();
                    });
                    dotsContainer.appendChild(dot);
                });

                const dots = document.querySelectorAll(".carousel-dot");

                function showSlide(index) {
                    const total = slides.length;
                    const prevIndex = (index - 1 + total) % total;
                    const nextIndex = (index + 1) % total;
                    const prev2Index = (index - 2 + total) % total;
                    const next2Index = (index + 2) % total;

                    slides.forEach((slide, i) => {
                        slide.classList.remove(
                            "active",
                            "is-prev",
                            "is-next",
                            "is-prev-2",
                            "is-next-2",
                            "is-hidden"
                        );

                        if (i === index) {
                            slide.classList.add("active");
                        } else if (i === prevIndex) {
                            slide.classList.add("is-prev");
                        } else if (i === nextIndex) {
                            slide.classList.add("is-next");
                        } else if (i === prev2Index) {
                            slide.classList.add("is-prev-2");
                        } else if (i === next2Index) {
                            slide.classList.add("is-next-2");
                        } else {
                            slide.classList.add("is-hidden");
                        }
                    });

                    dots.forEach((dot, i) => {
                        dot.classList.toggle("active", i === index);
                    });
                }

                function nextSlide() {
                    slideIndex = (slideIndex + 1) % slides.length;
                    showSlide(slideIndex);
                }

                function prevSlide() {
                    slideIndex = (slideIndex - 1 + slides.length) % slides.length;
                    showSlide(slideIndex);
                }

                function startAutoPlay() {
                    autoPlay = setInterval(nextSlide, 5000);
                }

                function restartAutoPlay() {
                    clearInterval(autoPlay);
                    startAutoPlay();
                }

                if (nextButton) {
                    nextButton.addEventListener("click", () => {
                        nextSlide();
                        restartAutoPlay();
                    });
                }

                if (prevButton) {
                    prevButton.addEventListener("click", () => {
                        prevSlide();
                        restartAutoPlay();
                    });
                }

                showSlide(slideIndex);
                startAutoPlay();

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("is-visible");
                        }
                    });
                }, { threshold: 0.2 });

                reveals.forEach((item, idx) => {
                    item.style.transitionDelay = `${Math.min(idx * 70, 500)}ms`;
                    observer.observe(item);
                });
            });
        </script>

        <script src="/script/script.js"></script>
    </body>
</html>