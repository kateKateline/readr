document.addEventListener("DOMContentLoaded", function () {
    // --- 1. Tags Show/Hide Logic (Show More) ---
    const showMoreTagsButton = document.getElementById("show-more-tags");
    const tagItems = document.querySelectorAll(".tag-item");
    let tagsExpanded = false;

    if (showMoreTagsButton) {
        showMoreTagsButton.addEventListener("click", function () {
            tagsExpanded = !tagsExpanded;
            tagItems.forEach((tag) => {
                const index = parseInt(tag.dataset.tagIndex);
                if (index >= 3) {
                    tag.classList.toggle("hidden", !tagsExpanded);
                }
            });
            showMoreTagsButton.textContent = tagsExpanded ? "<" : ">";
        });
    }

    // --- 2. Language Tab Logic ---
    const tabButtons = document.querySelectorAll(".tab-btn");
    const defaultLanguage = "{{ $defaultLanguage }}";

    // Fungsi untuk inisialisasi Dropdown (diperlukan saat tab beralih atau sorting)
    function initializeDropdowns() {
        const dropdownButtons = document.querySelectorAll(
            ".chapter-dropdown > button"
        );

        dropdownButtons.forEach((button) => {
            if (button.dataset.listenerAttached !== "true") {
                button.addEventListener("click", function () {
                    const dropdown = this.closest(".chapter-dropdown");
                    const content = dropdown.querySelector(".dropdown-content");
                    const arrow = dropdown.querySelector(".dropdown-arrow");

                    if (content) {
                        content.classList.toggle("hidden");
                    }
                    if (arrow && content) {
                        arrow.classList.toggle(
                            "rotate-180",
                            !content.classList.contains("hidden")
                        );
                    }
                });
                button.dataset.listenerAttached = "true";
            }
        });
    }

    function switchTab(selectedLang) {
        tabButtons.forEach((btn) => {
            const lang = btn.dataset.lang;
            const panel = document.getElementById(`panel-${lang}`);
            const isSelected = lang === selectedLang;

            // Update Button State (Menggunakan class yang sama dengan di Blade)
            btn.classList.toggle("border-blue-500", isSelected);
            btn.classList.toggle("text-white", isSelected);
            btn.classList.toggle("border-transparent", !isSelected);
            btn.classList.toggle("text-[#8b949e]", !isSelected);
            btn.setAttribute("aria-selected", isSelected);

            // Update Panel Visibility
            if (panel) {
                // Menggunakan class 'block' dan 'hidden'
                panel.classList.toggle("block", isSelected);
                panel.classList.toggle("hidden", !isSelected);
            }
        });

        // Inisialisasi ulang dropdown setelah mengganti tab
        initializeDropdowns();
    }

    tabButtons.forEach((button) => {
        button.addEventListener("click", function () {
            switchTab(this.dataset.lang);
        });
    });

    // --- 3. Sort Menu Logic (Dropdown Sortir) ---
    const sortMenuButton = document.getElementById("sort-menu-button");
    const sortMenu = document.getElementById("sort-menu");
    const sortOptions = document.querySelectorAll(".sort-option");
    const currentSortLabel = document.getElementById("current-sort-label");
    let currentSort = "chapter";

    // Toggle Sort Menu
    if (sortMenuButton) {
        sortMenuButton.addEventListener("click", function (e) {
            if (sortMenu) {
                sortMenu.classList.toggle("hidden");
            }
        });
    }

    // Hide menu when clicking outside
    document.addEventListener("click", function (e) {
        if (sortMenuButton && sortMenu) {
            if (
                !sortMenuButton.contains(e.target) &&
                !sortMenu.contains(e.target)
            ) {
                sortMenu.classList.add("hidden");
            }
        }
    });


    // --- 3. Chapter Dropdown Logic (Fungsi untuk inisialisasi) ---
    function initializeDropdowns() {
        // Ambil semua tombol dropdown yang ada di DOM saat ini
        const dropdownButtons = document.querySelectorAll(
            ".chapter-dropdown > button"
        );

        dropdownButtons.forEach((button) => {
            // Hapus listener yang mungkin sudah ada sebelumnya untuk mencegah double-click
            // (Cara yang lebih canggih mungkin diperlukan tergantung cara browser menangani listener)
            // Untuk skenario ini, kita hanya menambahkan listener.

            // Kita harus pastikan listener hanya ditambahkan sekali
            if (button.dataset.listenerAttached !== "true") {
                button.addEventListener("click", function () {
                    const dropdown = this.closest(".chapter-dropdown");
                    const content = dropdown.querySelector(".dropdown-content");
                    const arrow = dropdown.querySelector(".dropdown-arrow");

                    // Toggle visibility
                    if (content) {
                        content.classList.toggle("hidden");
                    }

                    // Toggle arrow rotation
                    if (arrow && content) {
                        arrow.classList.toggle(
                            "rotate-180",
                            !content.classList.contains("hidden")
                        );
                    }
                });
                button.dataset.listenerAttached = "true";
            }
        });
    }

    // Inisialisasi dropdown saat halaman pertama kali dimuat
    initializeDropdowns();
});
