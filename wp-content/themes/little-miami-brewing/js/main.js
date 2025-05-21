// Header scroll effect
const header = document.querySelector('.site-header');
const handleScroll = () => {
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
};

window.addEventListener('scroll', handleScroll);

// Hero Slider
class HeroSlider {
    constructor() {
        this.slider = document.querySelector('.hero-slider');
        this.slides = this.slider.querySelectorAll('.hero-slide');
        this.dots = document.querySelector('.hero-slider-dots');
        this.currentSlide = 0;
        this.slideInterval = 5000; // 5 seconds per slide
        this.init();
    }

    init() {
        // Create dots
        this.slides.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.classList.add('hero-slider-dot');
            if (index === 0) dot.classList.add('active');
            dot.addEventListener('click', () => this.goToSlide(index));
            this.dots.appendChild(dot);
        });

        // Start autoplay
        this.startAutoplay();
    }

    goToSlide(index) {
        this.slides[this.currentSlide].classList.remove('active');
        this.dots.children[this.currentSlide].classList.remove('active');
        
        this.currentSlide = index;
        
        this.slides[this.currentSlide].classList.add('active');
        this.dots.children[this.currentSlide].classList.add('active');
    }

    nextSlide() {
        const next = (this.currentSlide + 1) % this.slides.length;
        this.goToSlide(next);
    }

    startAutoplay() {
        setInterval(() => this.nextSlide(), this.slideInterval);
    }
}

// Navigation toggle
document.addEventListener('DOMContentLoaded', function() {
    // Header scroll effect
    const header = document.querySelector('.site-header');
    const scrollThreshold = 100;

    window.addEventListener('scroll', () => {
        if (window.scrollY > scrollThreshold) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Hero slider functionality
    const heroSlider = document.querySelector('.hero-slider');
    const slides = heroSlider?.querySelectorAll('.hero-slide') || [];
    const dotsContainer = document.querySelector('.hero-slider-dots');
    let currentSlide = 0;

    if (slides.length > 0) {
        // Create slider dots
        slides.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.classList.add('hero-slider-dot');
            if (index === 0) dot.classList.add('active');
            dot.addEventListener('click', () => goToSlide(index));
            dotsContainer.appendChild(dot);
        });

        // Auto-advance slides
        setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            goToSlide(currentSlide);
        }, 5000);
    }

    function goToSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.opacity = i === index ? '1' : '0';
            dotsContainer.children[i].classList.toggle('active', i === index);
        });
        currentSlide = index;
    }

    // Mobile menu toggle
    const menuToggle = document.createElement('button');
    menuToggle.classList.add('menu-toggle');
    menuToggle.setAttribute('aria-controls', 'primary-menu');
    menuToggle.setAttribute('aria-expanded', 'false');
    menuToggle.innerHTML = '<span class="screen-reader-text">Menu</span><span class="menu-toggle-icon"></span>';

    const nav = document.querySelector('.main-navigation');
    if (nav) {
        nav.insertBefore(menuToggle, nav.firstChild);
        
        menuToggle.addEventListener('click', function() {
            nav.classList.toggle('toggled');
            const expanded = nav.classList.contains('toggled');
            menuToggle.setAttribute('aria-expanded', expanded);
        });
    }
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Intersection Observer for animations
const observerOptions = {
    root: null,
    threshold: 0.1,
    rootMargin: '0px'
};

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('in-view');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.animate-on-scroll').forEach((element) => {
    observer.observe(element);
});
