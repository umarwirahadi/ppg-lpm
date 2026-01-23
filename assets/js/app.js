$(document).ready(function() {
    // Smooth scrolling for navigation links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $(this.getAttribute('href'));
        if (target.length) {
            const headerOffset = 80;
            const elementPosition = target.offset().top;
            const offsetPosition = elementPosition - headerOffset;

            $('html, body').animate({
                scrollTop: offsetPosition
            }, 800);
        }
    });

    // Active navigation highlighting
    $(window).on('scroll', function() {
        let current = '';
        const scrollPos = $(window).scrollTop();
        
        $('section[id]').each(function() {
            const sectionTop = $(this).offset().top - 100;
            if (scrollPos >= sectionTop) {
                current = $(this).attr('id');
            }
        });

        $('.navbar-nav .nav-link').removeClass('active');
        $('.navbar-nav .nav-link[href="#' + current + '"]').addClass('active');
    });

    // Counter animation for stats
    function animateCounters() {
        $('.stat-number').each(function() {
            const $counter = $(this);
            const target = parseInt($counter.text().replace(/[^0-9]/g, ''));
            const suffix = $counter.text().replace(/[0-9]/g, '');
            let current = 0;
            const increment = target / 100;
            
            const timer = setInterval(function() {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                $counter.text(Math.floor(current) + suffix);
            }, 20);
        });
    }

    // Trigger counter animation when stats section comes into view
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        });

        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            observer.observe(statsSection);
        }
    } else {
        // Fallback for browsers without IntersectionObserver
        $(window).on('scroll', function() {
            const statsSection = $('.stats-section');
            if (statsSection.length) {
                const windowHeight = $(window).height();
                const scrollTop = $(window).scrollTop();
                const sectionTop = statsSection.offset().top;
                
                if (scrollTop + windowHeight > sectionTop && !statsSection.hasClass('animated')) {
                    statsSection.addClass('animated');
                    animateCounters();
                }
            }
        });
    }

    // Mobile menu close on link click
    $('.navbar-nav .nav-link').on('click', function() {
        $('.navbar-collapse').collapse('hide');
    });

    // Add smooth fade-in effect to service cards on scroll
    function fadeInOnScroll() {
        $('.service-card').each(function() {
            const cardTop = $(this).offset().top;
            const cardBottom = cardTop + $(this).outerHeight();
            const windowTop = $(window).scrollTop();
            const windowBottom = windowTop + $(window).height();

            if (cardBottom >= windowTop && cardTop <= windowBottom) {
                $(this).addClass('fade-in');
            }
        });
    }

    $(window).on('scroll', fadeInOnScroll);
    fadeInOnScroll(); // Run once on page load

    // Navbar background opacity on scroll
    $(window).on('scroll', function() {
        const scroll = $(window).scrollTop();
        if (scroll >= 50) {
            $('.navbar').addClass('scrolled');
        } else {
            $('.navbar').removeClass('scrolled');
        }
    });
});
