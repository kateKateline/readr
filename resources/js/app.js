import './bootstrap';
import '../css/app.css';

document.addEventListener('DOMContentLoaded', () => {
    const profileBtn = document.getElementById('profile-btn');
    const profileMenu = document.getElementById('profile-menu');

    if (profileBtn) {
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
            profileMenu.classList.toggle('scale-100');
        });
    }

    document.addEventListener('click', (e) => {
        if (profileMenu && !profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
            profileMenu.classList.add('hidden');
            profileMenu.classList.remove('scale-100');
        }
    });
});

// Mobile Menu Toggle
 const menuBtn = document.getElementById('mobile-menu-btn');
 const mobileMenu = document.getElementById('mobile-menu');
 const menuIcon = document.getElementById('menu-icon');
 
 menuBtn.addEventListener('click', () => {
     mobileMenu.classList.toggle('hidden');
     if (mobileMenu.classList.contains('hidden')) {
         menuIcon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
     } else {
         menuIcon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
     }
 })
 
 // Smooth Scrolling
 document.querySelectorAll('a[href^="#"]').forEach(anchor => {
     anchor.addEventListener('click', function (e) {
         e.preventDefault();
         const target = document.querySelector(this.getAttribute('href'));
         if (target) {
             target.scrollIntoView({
                 behavior: 'smooth',
                 block: 'start'
             });
             // Close mobile menu if open
             mobileMenu.classList.add('hidden');
             menuIcon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
         }
     });
 })

 // Navbar scroll effect
 const navbar = document.getElementById('navbar');
 window.addEventListener('scroll', () => {
     if (window.scrollY > 50) {
         navbar.classList.add('shadow-lg');
     } else {
         navbar.classList.remove('shadow-lg');
     }
 })

 // Intersection Observer for fade-in animations
 const observerOptions = {
     threshold: 0.1,
     rootMargin: '0px 0px -100px 0px'
 }

 const observer = new IntersectionObserver((entries) => {
     entries.forEach(entry => {
         if (entry.isIntersecting) {
             entry.target.style.opacity = '1';
             entry.target.style.transform = 'translateY(0)';
         }
     });
 }, observerOptions)

 // Observe all feature cards and sections
 document.querySelectorAll('.speech-bubble, .card-hover').forEach(el => {
     el.style.opacity = '0';
     el.style.transform = 'translateY(30px)';
     el.style.transition = 'all 0.6s ease-out';
     observer.observe(el);
 });