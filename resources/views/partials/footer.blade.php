<footer class="bg-[#161b22] border-t border-[#30363d] mt-12">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
            <h3 class="text-xl font-semibold text-white mb-3">About Readr</h3>
            <p class="text-sm text-[#8b949e] leading-relaxed">
                Readr adalah platform untuk membaca manga, manhwa, dan manhua favoritmu. 
                Dibangun dengan Laravel & TailwindCSS.
            </p>
        </div>

        <div>
            <h3 class="text-xl font-semibold text-white mb-3">Quick Links</h3>
            <ul class="space-y-2 text-sm text-[#8b949e]">
                <li><a href="/" class="hover:text-blue-400 transition">Home</a></li>
                <li><a href="#" class="hover:text-blue-400 transition">Explore</a></li>
                <li><a href="#" class="hover:text-blue-400 transition">Contact</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-xl font-semibold text-white mb-3">Follow Us</h3>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-blue-400 transition">Instagram</a>
                <a href="#" class="hover:text-blue-400 transition">Twitter</a>
                <a href="#" class="hover:text-blue-400 transition">Discord</a>
            </div>
        </div>
    </div>
    <div class="border-t border-[#30363d] py-4 text-center text-sm text-[#8b949e]">
        © {{ date('Y') }} Readr. All rights reserved.
    </div>
</footer>
