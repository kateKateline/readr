    document.addEventListener('DOMContentLoaded', function() {
        // --- LOGIC TAGS SHOW/HIDE ---
        const showMoreButton = document.getElementById('show-more-tags');
        const hiddenTags = document.querySelectorAll('.tag-item');
        const visibleTagsCount = 3; 

        if (showMoreButton) {
            showMoreButton.addEventListener('click', function() {
                hiddenTags.forEach(tag => {
                    if (parseInt(tag.getAttribute('data-tag-index')) >= visibleTagsCount) {
                        tag.classList.remove('hidden');
                    }
                });
                this.classList.add('hidden');
            });
        }
        
        // --- LOGIC PERGANTIAN TAB ---
        const tabButtons = document.querySelectorAll('.tab-btn');
        const chapterPanels = document.querySelectorAll('.chapter-panel');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const selectedLang = this.getAttribute('data-lang');

                tabButtons.forEach(btn => {
                    btn.classList.remove('border-orange-500', 'text-white');
                    btn.classList.add('border-transparent', 'text-[#8b949e]', 'hover:text-white', 'hover:border-[#8b949e]');
                    btn.setAttribute('aria-selected', 'false');
                });

                this.classList.add('border-orange-500', 'text-white');
                this.classList.remove('border-transparent', 'text-[#8b949e]', 'hover:text-white', 'hover:border-[#8b949e]');
                this.setAttribute('aria-selected', 'true');

                chapterPanels.forEach(panel => {
                    panel.classList.add('hidden');
                });

                const targetPanel = document.getElementById(`panel-${selectedLang}`);
                if (targetPanel) {
                    targetPanel.classList.remove('hidden');
                    // Reset sorting saat tab diganti
                    document.getElementById('current-sort-label').textContent = 'Chapter';
                    applySorting(targetPanel.querySelector('.chapter-list-container'), 'chapter'); 
                }
            });
        });

        // --- LOGIC CHAPTER DROPDOWN ---
        document.addEventListener('click', function(e) {
            const dropdownButton = e.target.closest('.chapter-dropdown button');
            
            if (dropdownButton) {
                e.preventDefault();
                e.stopPropagation();
                
                const dropdown = dropdownButton.closest('.chapter-dropdown');
                const dropdownContent = dropdown.querySelector('.dropdown-content');
                const arrow = dropdown.querySelector('.dropdown-arrow');
                
                // Tutup semua dropdown lain
                document.querySelectorAll('.chapter-dropdown .dropdown-content').forEach(content => {
                    if (content !== dropdownContent) {
                        content.classList.add('hidden');
                        content.closest('.chapter-dropdown').querySelector('.dropdown-arrow').classList.remove('rotate-180');
                    }
                });
                
                // Toggle dropdown yang diklik
                dropdownContent.classList.toggle('hidden');
                arrow.classList.toggle('rotate-180');
            } else if (!e.target.closest('.dropdown-content')) {
                // Klik di luar dropdown, tutup semua
                document.querySelectorAll('.chapter-dropdown .dropdown-content').forEach(content => {
                    content.classList.add('hidden');
                    content.closest('.chapter-dropdown').querySelector('.dropdown-arrow').classList.remove('rotate-180');
                });
            }
        });

        // --- LOGIC SORT BY ---
        const sortMenuButton = document.getElementById('sort-menu-button');
        const sortMenu = document.getElementById('sort-menu');
        const currentSortLabel = document.getElementById('current-sort-label');

        sortMenuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            sortMenu.classList.toggle('hidden');
        });

        // Tutup sort menu saat klik di luar
        document.addEventListener('click', (e) => {
            if (!e.target.closest('#sort-menu-button') && !e.target.closest('#sort-menu')) {
                sortMenu.classList.add('hidden');
            }
        });

        document.querySelectorAll('.sort-option').forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                sortMenu.classList.add('hidden');
                const sortType = this.getAttribute('data-sort');
                const sortLabel = this.textContent.split('(')[0].trim();
                currentSortLabel.textContent = sortLabel;

                // Temukan panel yang sedang aktif
                const activePanel = document.querySelector('.chapter-panel:not(.hidden)');
                if (activePanel) {
                    const listContainer = activePanel.querySelector('.chapter-list-container');
                    if (listContainer) {
                        applySorting(listContainer, sortType);
                    }
                }
            });
        });

        function applySorting(container, sortType) {
            const volumeSections = Array.from(container.querySelectorAll('.volume-section'));
            
            if (sortType === 'volume') {
                // Sort by volume
                volumeSections.sort((a, b) => {
                    const volA = a.getAttribute('data-volume');
                    const volB = b.getAttribute('data-volume');
                    
                    if (volA === 'none') return 1;
                    if (volB === 'none') return -1;
                    
                    return parseFloat(volA) - parseFloat(volB);
                });
            } else {
                // Untuk sort lainnya, kita perlu flatten semua chapters
                let allChapters = [];
                
                volumeSections.forEach(section => {
                    const volume = section.getAttribute('data-volume');
                    const chapters = Array.from(section.querySelectorAll('.chapter-dropdown, .chapter-single'));
                    
                    chapters.forEach(ch => {
                        allChapters.push({
                            element: ch,
                            volume: volume,
                            chapterNumber: parseFloat(ch.getAttribute('data-chapter-number')),
                            hasAlt: ch.getAttribute('data-has-alt') === 'true'
                        });
                    });
                });
                
                // Sort chapters
                allChapters.sort((a, b) => {
                    if (sortType === 'alternate_link') {
                        if (a.hasAlt !== b.hasAlt) return b.hasAlt - a.hasAlt; // Has alt link first
                    } else if (sortType === 'available') {
                        if (a.hasAlt !== b.hasAlt) return a.hasAlt - b.hasAlt; // No alt link first
                    }
                    
                    // Secondary sort by chapter number
                    return a.chapterNumber - b.chapterNumber;
                });
                
                // Clear container
                container.innerHTML = '';
                
                // Re-group by volume if needed
                if (sortType === 'chapter') {
                    // Keep volume structure
                    volumeSections.forEach(section => container.appendChild(section));
                } else {
                    // Create flat list without volume headers for alternate_link and available sorts
                    const wrapper = document.createElement('div');
                    wrapper.className = 'space-y-1';
                    allChapters.forEach(item => {
                        wrapper.appendChild(item.element);
                    });
                    container.appendChild(wrapper);
                }
                
                return; // Exit early for non-volume sorts
            }
            
            // Re-append volume sections for volume sort
            container.innerHTML = '';
            volumeSections.forEach(section => container.appendChild(section));
        }

        // Jalankan sorting default saat halaman dimuat
        const defaultActivePanel = document.querySelector('.chapter-panel:not(.hidden)');
        if (defaultActivePanel) {
            const listContainer = defaultActivePanel.querySelector('.chapter-list-container');
            if (listContainer) {
                applySorting(listContainer, 'chapter');
            }
        }
    });