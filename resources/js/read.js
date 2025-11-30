    (function() {
        // Navbar collapse functionality untuk halaman read
        let lastScrollTop = 0;
        const header = document.querySelector('header');
        let isScrolling = false;
        let scrollTimeout;

        if (!header) return;

        window.addEventListener('scroll', function() {
            if (isScrolling) return;
            
            isScrolling = true;
            requestAnimationFrame(function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                // Clear timeout
                clearTimeout(scrollTimeout);
                
                if (scrollTop > lastScrollTop && scrollTop > 100) {
                    // Scrolling down - hide navbar
                    header.style.transform = 'translateY(-100%)';
                } else if (scrollTop < lastScrollTop) {
                    // Scrolling up - show navbar
                    header.style.transform = 'translateY(0)';
                }
                
                // Show navbar when at top
                if (scrollTop <= 50) {
                    header.style.transform = 'translateY(0)';
                }
                
                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
                isScrolling = false;
            });
        }, { passive: true });
        
    })();    (function() {
        // Navbar collapse functionality untuk halaman read
        let lastScrollTop = 0;
        const header = document.querySelector('header');
        let isScrolling = false;
        let scrollTimeout;

        if (!header) return;

        window.addEventListener('scroll', function() {
            if (isScrolling) return;
            
            isScrolling = true;
            requestAnimationFrame(function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                // Clear timeout
                clearTimeout(scrollTimeout);
                
                if (scrollTop > lastScrollTop && scrollTop > 100) {
                    // Scrolling down - hide navbar
                    header.style.transform = 'translateY(-100%)';
                } else if (scrollTop < lastScrollTop) {
                    // Scrolling up - show navbar
                    header.style.transform = 'translateY(0)';
                }
                
                // Show navbar when at top
                if (scrollTop <= 50) {
                    header.style.transform = 'translateY(0)';
                }
                
                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
                isScrolling = false;
            });
        }, { passive: true });
        
    })();