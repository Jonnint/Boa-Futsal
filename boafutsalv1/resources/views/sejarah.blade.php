<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sejarah - BOA Futsal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(0, 0, 0, 0.8); backdrop-filter: blur(12px); }
    </style>
</head>
<body class="bg-[#050505] text-white">

    <x-public-navbar simple="true" backUrl="/" backText="← Kembali ke Beranda" />

    <section class="pt-32 pb-12">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <p class="text-green-400 font-bold tracking-widest uppercase text-sm mb-3">Since 2009</p>
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tighter uppercase italic">
                    Our <span class="text-green-400">Legacy</span>
                </h1>
            </div>

            <div class="max-w-5xl mx-auto">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-green-500/20 to-emerald-500/20 rounded-[2.5rem] blur-2xl opacity-50 group-hover:opacity-100 transition duration-1000"></div>
                    
                    <div class="relative aspect-video (16/9) overflow-hidden rounded-[2.5rem] border border-white/10 shadow-2xl">
                        <img src="{{asset ('asset/img/sejarah.jfif')}}" 
                             alt="Sejarah BOA Futsal" 
                             class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <article class="py-16">
        <div class="container mx-auto px-6 max-w-3xl">
            <div class="space-y-12 text-gray-400 text-lg leading-relaxed">
                <section>
                    <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
                        <span class="w-8 h-1 bg-green-500 rounded-full"></span>
                        Awal Mula (2009)
                    </h2>
                    <p>
                        BOA Futsal bermula dari sebuah garasi kecil dan kecintaan komunitas lokal terhadap sepak bola dalam ruangan. Kami melihat perlunya standar lapangan yang lebih baik di kota ini—tempat di mana setiap pemain merasa seperti seorang profesional.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
                        <span class="w-8 h-1 bg-green-500 rounded-full"></span>
                        Visi & Misi
                    </h2>
                    <p>
                        Bukan sekadar bisnis persewaan, BOA Futsal dibangun untuk menjadi pusat pembinaan talenta muda. Dengan menghadirkan teknologi pencahayaan LED terbaru dan permukaan lantai internasional, kami berkomitmen memberikan pengalaman bermain yang aman dan kompetitif.
                    </p>
                </section>

                <blockquote class="p-8 bg-white/5 border-l-4 border-green-500 rounded-r-2xl italic text-white text-xl">
                    "Kami tidak hanya membangun lapangan, kami membangun komunitas juara."
                    <footer class="text-sm text-green-400 mt-2 not-italic">— Founder BOA Futsal</footer>
                </blockquote>

                <section>
                    <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
                        <span class="w-8 h-1 bg-green-500 rounded-full"></span>
                        Hari Ini
                    </h2>
                    <p>
                        Kini, BOA Futsal telah menjadi destinasi utama bagi turnamen amatir maupun profesional di Jakarta Selatan. kami terus berinovasi untuk mendukung gairah olahraga Anda.
                    </p>
                </section>
            </div>
        </div>
    </article>

    <footer class="py-10 border-t border-white/5 text-center text-gray-600 text-sm">
        &copy; 2026 BOA Futsal Arena.
    </footer>
    </footer>

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Apply fade-up animation to sections automatically
            document.querySelectorAll('section, article').forEach((el) => {
                if (!el.hasAttribute('data-aos')) el.setAttribute('data-aos', 'fade-up');
            });
            AOS.init({
                duration: 800,
                once: true,
                offset: 50,
            });
        });
    </script>
</body>
</html>