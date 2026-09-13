<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SportType;
use App\Models\SportTypePageSection;

class SportTypePageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sportTypes = SportType::all();
        if ($sportTypes->isEmpty()) {
            return;
        }

        foreach ($sportTypes as $st) {
            $slug = $st->slug ?? strtolower($st->name);

            if (str_contains($slug, 'futsal')) {
                $this->seedFutsalSections($st);
            } elseif (str_contains($slug, 'padel')) {
                $this->seedPadelSections($st);
            } elseif (str_contains($slug, 'badminton')) {
                $this->seedBadmintonSections($st);
            } else {
                $this->seedGenericSections($st);
            }
        }
    }

    private function seedFutsalSections(SportType $st): void
    {
        $sections = [
            // HOME
            [
                'page_key' => 'home',
                'section_key' => 'hero_title',
                'label' => 'Hero Title',
                'content_type' => 'text',
                'content_value' => $st->hero_title ?? 'MAIN FUTSAL PRO SETIAP HARI.',
                'order' => 1,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'hero_subtitle',
                'label' => 'Hero Subtitle',
                'content_type' => 'text',
                'content_value' => $st->hero_subtitle ?? 'Arena futsal berstandar internasional dengan rumput sintetis impor terbaik & pencahayaan LED pro.',
                'order' => 2,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'facilities',
                'label' => 'Daftar Fasilitas Home',
                'content_type' => 'list_item',
                'content_value' => json_encode($st->facilities ?? [
                    ['icon' => '🏟️', 'title' => 'Rumput Sintetis FIFA', 'desc' => 'Standar internasional empuk dan aman untuk sendi'],
                    ['icon' => '💡', 'title' => 'Pencahayaan LED Pro', 'desc' => 'Terang merata tanpa silau untuk pertandingan malam'],
                    ['icon' => '🚿', 'title' => 'Locker & Shower Room', 'desc' => 'Ruang bilas bersih dan loker pengaman pribadi'],
                    ['icon' => '☕', 'title' => 'Kantin & Area Santai', 'desc' => 'Tersedia minuman isotonik, kopi, & aneka cemilan'],
                ]),
                'order' => 3,
            ],

            // SEJARAH
            [
                'page_key' => 'sejarah',
                'section_key' => 'header_subtitle',
                'label' => 'Sub Judul Header',
                'content_type' => 'text',
                'content_value' => 'Since 2009',
                'order' => 1,
            ],
            [
                'page_key' => 'sejarah',
                'section_key' => 'header_title',
                'label' => 'Judul Header',
                'content_type' => 'text',
                'content_value' => 'Our <span class="text-green-400">Legacy</span>',
                'order' => 2,
            ],
            [
                'page_key' => 'sejarah',
                'section_key' => 'profile_image',
                'label' => 'Foto Profil Venue',
                'content_type' => 'image',
                'content_value' => null,
                'image_path' => 'asset/img/sejarah.webp',
                'order' => 3,
            ],
            [
                'page_key' => 'sejarah',
                'section_key' => 'body_text',
                'label' => 'Cerita Sejarah & Profil (Rich Text)',
                'content_type' => 'richtext',
                'content_value' => '<section>
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
    Kini, BOA Futsal telah menjadi destinasi utama bagi turnamen amatir maupun profesional di Jakarta Selatan. Kami terus berinovasi untuk mendukung gairah olahraga Anda.
</p>
</section>',
                'order' => 4,
            ],

            // CARA BOOKING
            [
                'page_key' => 'cara_booking',
                'section_key' => 'hero_badge',
                'label' => 'Badge Hero',
                'content_type' => 'text',
                'content_value' => 'Panduan Lengkap Futsal',
                'order' => 1,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'hero_title',
                'label' => 'Judul Hero',
                'content_type' => 'text',
                'content_value' => 'Tata Cara <span class="gradient-text">Booking Futsal</span>',
                'order' => 2,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'hero_subtitle',
                'label' => 'Sub Judul Hero',
                'content_type' => 'text',
                'content_value' => 'Pesan lapangan futsal BOA dalam hitungan menit. Tersedia dua pilihan — langsung booking tanpa akun, atau daftar member untuk nikmati keuntungan eksklusif.',
                'order' => 3,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'guest_steps',
                'label' => 'Langkah Booking Tamu (JSON)',
                'content_type' => 'list_item',
                'content_value' => json_encode([
                    [
                        'step' => 1,
                        'title' => 'Buka Halaman Utama & Pilih Lapangan',
                        'desc' => 'Kunjungi boafutsal.com lalu scroll ke bagian "Pilih Arena Kamu". Lihat daftar lapangan futsal beserta status real-time.',
                    ],
                    [
                        'step' => 2,
                        'title' => 'Cek Detail Harga',
                        'desc' => 'Klik tombol "Detail Harga" pada lapangan pilihanmu. Modal akan menampilkan harga per sesi weekday dan weekend.',
                    ],
                    [
                        'step' => 3,
                        'title' => 'Klik "Booking Sekarang"',
                        'desc' => 'Setelah cek harga, klik tombol BOOKING SEKARANG untuk masuk ke formulir pemesanan jadwal futsal.',
                    ],
                    [
                        'step' => 4,
                        'title' => 'Isi Formulir Pemesanan',
                        'desc' => 'Lengkapi data pemesan: nama, nomor WhatsApp aktif, tanggal bermain, dan pilih slot jam yang diinginkan.',
                    ],
                    [
                        'step' => 5,
                        'title' => 'Pilih Metode Pembayaran & Konfirmasi',
                        'desc' => 'Periksa ringkasan pesanan. Pilih opsi transfer bank, QRIS, atau bayar di kasir, lalu klik Konfirmasi Booking.',
                    ],
                    [
                        'step' => 6,
                        'title' => 'Selesai! Tunggu Konfirmasi',
                        'desc' => 'Booking kamu tersimpan! Admin akan mengonfirmasi via WhatsApp. Tunjukkan kode booking saat tiba di lapangan.',
                    ],
                ]),
                'order' => 4,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'member_benefits',
                'label' => 'Keuntungan Member (JSON)',
                'content_type' => 'list_item',
                'content_value' => json_encode([
                    ['icon' => '💰', 'title' => 'Harga Member Spesial', 'desc' => 'Dapatkan tarif khusus lebih hemat untuk semua sesi booking futsal'],
                    ['icon' => '🎟️', 'title' => 'Akses Voucher Eksklusif', 'desc' => 'Nikmati voucher diskon berkala khusus member setia BOA'],
                    ['icon' => '📊', 'title' => 'Riwayat Booking Lengkap', 'desc' => 'Pantau semua histori pemesanan lapangan futsal langsung dari dashboard'],
                    ['icon' => '🔔', 'title' => 'Notifikasi Prioritas', 'desc' => 'Terima info slot kosong dan turnamen futsal lebih awal'],
                    ['icon' => '⚡', 'title' => 'Booking Lebih Cepat', 'desc' => 'Data otomatis tersimpan sehingga pemesanan berikutnya tinggal 1 klik'],
                    ['icon' => '🏅', 'title' => 'Badge Komunitas BOA', 'desc' => 'Status member terverifikasi dan akses event futsal eksklusif'],
                ]),
                'order' => 5,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'faq_items',
                'label' => 'Daftar Pertanyaan FAQ (JSON)',
                'content_type' => 'list_item',
                'content_value' => json_encode([
                    ['q' => 'Apakah saya harus login untuk booking lapangan futsal?', 'a' => 'Tidak! Kamu bisa booking langsung tanpa login cukup dengan memasukkan nama dan nomor WhatsApp aktif.'],
                    ['q' => 'Apa keuntungan menjadi member BOA Futsal?', 'a' => 'Member mendapatkan diskon harga khusus per jam, voucher promo mingguan, dan rekap booking di dashboard personal.'],
                    ['q' => 'Berapa lama batas waktu konfirmasi booking?', 'a' => 'Admin kasir memproses konfirmasi dalam 10-30 menit setelah pembayaran diterima atau status invoice terbit.'],
                    ['q' => 'Bagaimana jika ingin reschedule atau batalkan booking?', 'a' => 'Silakan hubungi WhatsApp kasir maksimal H-1 sebelum jadwal main untuk mengatur perubahan jadwal.'],
                ]),
                'order' => 6,
            ],

            // BOOKING PAGE
            [
                'page_key' => 'booking',
                'section_key' => 'page_badge',
                'label' => 'Badge Halaman Booking',
                'content_type' => 'text',
                'content_value' => 'Reservasi Lapangan Futsal',
                'order' => 1,
            ],
            [
                'page_key' => 'booking',
                'section_key' => 'policy_note',
                'label' => 'Catatan Kebijakan / Aturan Main',
                'content_type' => 'text',
                'content_value' => 'Wajib menggunakan sepatu futsal (non-marking sol). Dilarang merokok dan membawa makanan berat ke dalam arena lapangan.',
                'order' => 2,
            ],
            [
                'page_key' => 'booking',
                'section_key' => 'cta_button_text',
                'label' => 'Teks Tombol Booking',
                'content_type' => 'text',
                'content_value' => 'Lanjutkan ke Pembayaran',
                'order' => 3,
            ],

            // BOOKING DETAIL / INVOICE
            [
                'page_key' => 'booking_detail',
                'section_key' => 'header_title',
                'label' => 'Judul Header Invoice',
                'content_type' => 'text',
                'content_value' => 'Detail Booking Futsal',
                'order' => 1,
            ],
            [
                'page_key' => 'booking_detail',
                'section_key' => 'footer_note',
                'label' => 'Catatan Kaki Invoice / Ketentuan',
                'content_type' => 'text',
                'content_value' => 'Tunjukkan kode booking ini ke kasir sebelum bertanding. Datang 15 menit lebih awal untuk pemanasan.',
                'order' => 2,
            ],
            [
                'page_key' => 'booking_detail',
                'section_key' => 'wa_cta_text',
                'label' => 'Teks Bantuan WhatsApp',
                'content_type' => 'text',
                'content_value' => 'Ada kendala dengan jadwal Anda? Hubungi customer service BOA Futsal via WhatsApp.',
                'order' => 3,
            ],
        ];

        $this->saveSections($st, $sections);
    }

    private function seedPadelSections(SportType $st): void
    {
        $sections = [
            // HOME
            [
                'page_key' => 'home',
                'section_key' => 'hero_title',
                'label' => 'Hero Title',
                'content_type' => 'text',
                'content_value' => 'MAIN PADEL PRO SETIAP HARI.',
                'order' => 1,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'hero_subtitle',
                'label' => 'Hero Subtitle',
                'content_type' => 'text',
                'content_value' => 'Arena padel tenis modern berstandar World Padel Tour dengan kaca panoramic dan karpet monofilament.',
                'order' => 2,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'facilities',
                'label' => 'Daftar Fasilitas Home',
                'content_type' => 'list_item',
                'content_value' => json_encode([
                    ['icon' => '🎾', 'title' => 'Panoramic Glass WPT', 'desc' => 'Kaca tempered panoramic standar turnamen internasional'],
                    ['icon' => '💡', 'title' => 'LED Anti-Glare', 'desc' => 'Pencahayaan khusus padel tanpa efek silau saat smash'],
                    ['icon' => '🎽', 'title' => 'Rental Raket & Ball', 'desc' => 'Tersedia sewa raket carbon pro dan bola padel resmi'],
                    ['icon' => '☕', 'title' => 'Padel Lounge & Cafe', 'desc' => 'Tempat berkumpul komunitas padel dengan aneka hidangan sehat'],
                ]),
                'order' => 3,
            ],

            // SEJARAH
            [
                'page_key' => 'sejarah',
                'section_key' => 'header_subtitle',
                'label' => 'Sub Judul Header',
                'content_type' => 'text',
                'content_value' => 'Since 2022',
                'order' => 1,
            ],
            [
                'page_key' => 'sejarah',
                'section_key' => 'header_title',
                'label' => 'Judul Header',
                'content_type' => 'text',
                'content_value' => 'Our <span class="text-blue-400">Padel Story</span>',
                'order' => 2,
            ],
            [
                'page_key' => 'sejarah',
                'section_key' => 'profile_image',
                'label' => 'Foto Profil Venue',
                'content_type' => 'image',
                'content_value' => null,
                'image_path' => 'asset/img/padel-gallery-1.jpg',
                'order' => 3,
            ],
            [
                'page_key' => 'sejarah',
                'section_key' => 'body_text',
                'label' => 'Cerita Sejarah & Profil (Rich Text)',
                'content_type' => 'richtext',
                'content_value' => '<section>
<h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
    <span class="w-8 h-1 bg-blue-500 rounded-full"></span>
    Revolusi Padel di Jakarta (2022)
</h2>
<p>
    BOA Padel Arena lahir dari antusiasme olahraga padel yang berkembang pesat secara global. Kami membangun fasilitas padel bertaraf internasional pertama dengan dinding panoramic tanpa tiang pembatas sudut, memberikan visibilitas penuh bagi pemain maupun penonton.
</p>
</section>

<section>
<h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
    <span class="w-8 h-1 bg-blue-500 rounded-full"></span>
    Komitmen Mutu Lapangan
</h2>
<p>
    Setiap lapangan dilengkapi karpet bertekstur pasir mikro halus khusus padel yang menjaga grip sepatu tetap optimal serta meminimalisir risiko cedera pergelangan kaki pemain saat bermanuver cepat.
</p>
</section>

<blockquote class="p-8 bg-white/5 border-l-4 border-blue-500 rounded-r-2xl italic text-white text-xl">
    "Padel adalah tentang strategi, keseruan, dan kebersamaan di setiap rally."
    <footer class="text-sm text-blue-400 mt-2 not-italic">— BOA Padel Club</footer>
</blockquote>

<section>
<h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
    <span class="w-8 h-1 bg-blue-500 rounded-full"></span>
    Komunitas & Turnamen
</h2>
<p>
    Kami secara rutin menyelenggarakan coaching clinic bersama pelatih bersertifikasi serta turnamen open padel untuk mendukung regenerasi atlet dan pecinta padel tanah air.
</p>
</section>',
                'order' => 4,
            ],

            // CARA BOOKING
            [
                'page_key' => 'cara_booking',
                'section_key' => 'hero_badge',
                'label' => 'Badge Hero',
                'content_type' => 'text',
                'content_value' => 'Panduan Lengkap Padel',
                'order' => 1,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'hero_title',
                'label' => 'Judul Hero',
                'content_type' => 'text',
                'content_value' => 'Tata Cara <span class="gradient-text">Booking Padel</span>',
                'order' => 2,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'hero_subtitle',
                'label' => 'Sub Judul Hero',
                'content_type' => 'text',
                'content_value' => 'Pesan court padel berstandar WPT dengan mudah. Tersedia opsi booking langsung atau daftar keanggotaan club untuk harga khusus.',
                'order' => 3,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'guest_steps',
                'label' => 'Langkah Booking Tamu (JSON)',
                'content_type' => 'list_item',
                'content_value' => json_encode([
                    [
                        'step' => 1,
                        'title' => 'Pilih Lapangan Padel',
                        'desc' => 'Pilih court panoramic indoor atau outdoor yang sesuai dengan preferensi main kamu.',
                    ],
                    [
                        'step' => 2,
                        'title' => 'Pilih Jam Sesi & Rental Raket',
                        'desc' => 'Tentukan jam main pagi atau malam. Kamu juga bisa menambah sewa raket padel profesional.',
                    ],
                    [
                        'step' => 3,
                        'title' => 'Isi Data Diri',
                        'desc' => 'Tulis nama dan nomor WhatsApp aktif untuk menerima invoice dan instruksi kedatangan.',
                    ],
                    [
                        'step' => 4,
                        'title' => 'Pembayaran Instan via QRIS / Kasir',
                        'desc' => 'Selesaikan pembayaran secara cepat agar slot court langsung terkunci untuk kamu.',
                    ],
                    [
                        'step' => 5,
                        'title' => 'Terima Konfirmasi & Siap Main',
                        'desc' => 'Tunjukkan barcode / kode booking saat check-in di front desk arena padel.',
                    ],
                ]),
                'order' => 4,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'member_benefits',
                'label' => 'Keuntungan Member (JSON)',
                'content_type' => 'list_item',
                'content_value' => json_encode([
                    ['icon' => '🎾', 'title' => 'Diskon Court Member', 'desc' => 'Tarif sewa court lebih hemat hingga 20% setiap sesi'],
                    ['icon' => '🆓', 'title' => 'Free Rental Raket', 'desc' => 'Akses pinjam raket premium gratis setiap booking minimal 2 jam'],
                    ['icon' => '🏆', 'title' => 'Prioritas Event & Turnamen', 'desc' => 'Akses tiket registrasi turnamen padel sebelum dibuka untuk umum'],
                    ['icon' => '🥤', 'title' => 'Welcome Drink & Towel', 'desc' => 'Fasilitas handuk steril dan minuman elektrolit di lounge club'],
                ]),
                'order' => 5,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'faq_items',
                'label' => 'Daftar Pertanyaan FAQ (JSON)',
                'content_type' => 'list_item',
                'content_value' => json_encode([
                    ['q' => 'Apakah pemula bisa bermain padel tanpa membawa raket?', 'a' => 'Bisa sekali! Kami menyediakan persewaan raket dan bola padel berkualitas tinggi langsung di venue.'],
                    ['q' => 'Apa jenis sepatu yang diperbolehkan di court padel?', 'a' => 'Sepatu tenis (clay/omni court) atau sepatu padel khusus untuk menjaga keselamatan sendi dan kualitas karpet.'],
                ]),
                'order' => 6,
            ],

            // BOOKING PAGE
            [
                'page_key' => 'booking',
                'section_key' => 'page_badge',
                'label' => 'Badge Halaman Booking',
                'content_type' => 'text',
                'content_value' => 'Reservasi Court Padel',
                'order' => 1,
            ],
            [
                'page_key' => 'booking',
                'section_key' => 'policy_note',
                'label' => 'Catatan Kebijakan / Aturan Main',
                'content_type' => 'text',
                'content_value' => 'Wajib menggunakan tali pergelangan raket (wrist strap) saat bermain demi keselamatan.',
                'order' => 2,
            ],
            [
                'page_key' => 'booking',
                'section_key' => 'cta_button_text',
                'label' => 'Teks Tombol Booking',
                'content_type' => 'text',
                'content_value' => 'Reservasi Court Sekarang',
                'order' => 3,
            ],

            // BOOKING DETAIL / INVOICE
            [
                'page_key' => 'booking_detail',
                'section_key' => 'header_title',
                'label' => 'Judul Header Invoice',
                'content_type' => 'text',
                'content_value' => 'Detail Reservasi Padel',
                'order' => 1,
            ],
            [
                'page_key' => 'booking_detail',
                'section_key' => 'footer_note',
                'label' => 'Catatan Kaki Invoice / Ketentuan',
                'content_type' => 'text',
                'content_value' => 'Check-in court padel 10 menit sebelum jadwal. Layanan rental raket tersedia di kasir.',
                'order' => 2,
            ],
            [
                'page_key' => 'booking_detail',
                'section_key' => 'wa_cta_text',
                'label' => 'Teks Bantuan WhatsApp',
                'content_type' => 'text',
                'content_value' => 'Butuh sparing partner atau sewa perlengkapan? Hubungi admin via WhatsApp.',
                'order' => 3,
            ],
        ];

        $this->saveSections($st, $sections);
    }

    private function seedBadmintonSections(SportType $st): void
    {
        $sections = [
            // HOME
            [
                'page_key' => 'home',
                'section_key' => 'hero_title',
                'label' => 'Hero Title',
                'content_type' => 'text',
                'content_value' => 'MAIN BADMINTON PRO SETIAP HARI.',
                'order' => 1,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'hero_subtitle',
                'label' => 'Hero Subtitle',
                'content_type' => 'text',
                'content_value' => 'Karpet vinyl BWF standar olimpiade dengan sistem peredam kejut dan sirkulasi udara sejuk.',
                'order' => 2,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'facilities',
                'label' => 'Daftar Fasilitas Home',
                'content_type' => 'list_item',
                'content_value' => json_encode([
                    ['icon' => '🏸', 'title' => 'Vinyl Mat BWF Standard', 'desc' => 'Karpet tebal 4.5mm bersertifikasi BWF dengan cengkeraman maksimal'],
                    ['icon' => '💡', 'title' => 'Direct Diffused Lighting', 'desc' => 'Lampu LED samping anti-silau saat smash dan lob tinggi'],
                    ['icon' => '💨', 'title' => 'Ventilasi Bebas Angin', 'desc' => 'Aliran udara sejuk dirancang khusus agar laju shuttlecock tetap stabil'],
                    ['icon' => '🚿', 'title' => 'Shower & Ruang Ganti', 'desc' => 'Kamar bilas air hangat dan loker penyimpanan barang'],
                ]),
                'order' => 3,
            ],

            // SEJARAH
            [
                'page_key' => 'sejarah',
                'section_key' => 'header_subtitle',
                'label' => 'Sub Judul Header',
                'content_type' => 'text',
                'content_value' => 'Since 2021',
                'order' => 1,
            ],
            [
                'page_key' => 'sejarah',
                'section_key' => 'header_title',
                'label' => 'Judul Header',
                'content_type' => 'text',
                'content_value' => 'Our <span class="text-amber-400">Badminton Legacy</span>',
                'order' => 2,
            ],
            [
                'page_key' => 'sejarah',
                'section_key' => 'profile_image',
                'label' => 'Foto Profil Venue',
                'content_type' => 'image',
                'content_value' => null,
                'image_path' => 'asset/img/badminton-gallery-1.jpg',
                'order' => 3,
            ],
            [
                'page_key' => 'sejarah',
                'section_key' => 'body_text',
                'label' => 'Cerita Sejarah & Profil (Rich Text)',
                'content_type' => 'richtext',
                'content_value' => '<section>
<h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
    <span class="w-8 h-1 bg-amber-500 rounded-full"></span>
    Dedikasi Bulutangkis Indonesia (2021)
</h2>
<p>
    Terinspirasi dari tradisi emas bulutangkis Indonesia, BOA Badminton Hall dibangun dengan standar aula kejuaraan profesional untuk memberikan arena latihan yang layak bagi atlet muda dan pecinta badminton.
</p>
</section>

<section>
<h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-3">
    <span class="w-8 h-1 bg-amber-500 rounded-full"></span>
    Fasilitas Standar BWF
</h2>
<p>
    Tinggi plafon lebih dari 9 meter dan pencahayaan khusus dari samping lapangan memastikan tidak ada bayangan maupun silau yang mengganggu fokus permainan saat shuttlecock melayang di udara.
</p>
</section>

<blockquote class="p-8 bg-white/5 border-l-4 border-amber-500 rounded-r-2xl italic text-white text-xl">
    "Setiap smash bermula dari lapangan yang mengutamakan kualitas dan kenyamanan atlet."
    <footer class="text-sm text-amber-400 mt-2 not-italic">— Head Coach BOA Badminton</footer>
</blockquote>',
                'order' => 4,
            ],

            // CARA BOOKING
            [
                'page_key' => 'cara_booking',
                'section_key' => 'hero_badge',
                'label' => 'Badge Hero',
                'content_type' => 'text',
                'content_value' => 'Panduan Lengkap Badminton',
                'order' => 1,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'hero_title',
                'label' => 'Judul Hero',
                'content_type' => 'text',
                'content_value' => 'Tata Cara <span class="gradient-text">Booking Badminton</span>',
                'order' => 2,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'hero_subtitle',
                'label' => 'Sub Judul Hero',
                'content_type' => 'text',
                'content_value' => 'Pesan lapangan karpet badminton BOA dengan cepat dan fleksibel, baik untuk latihan rutin maupun tanding santai.',
                'order' => 3,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'guest_steps',
                'label' => 'Langkah Booking Tamu (JSON)',
                'content_type' => 'list_item',
                'content_value' => json_encode([
                    [
                        'step' => 1,
                        'title' => 'Pilih Lapangan Karpet',
                        'desc' => 'Tentukan lapangan badminton vinyl yang tersedia pada hari dan jam latihanmu.',
                    ],
                    [
                        'step' => 2,
                        'title' => 'Pilih Durasi Jam',
                        'desc' => 'Pilih durasi sewa minimal 1 jam atau paket main berjam-jam bersama teman.',
                    ],
                    [
                        'step' => 3,
                        'title' => 'Isi Nama & WhatsApp',
                        'desc' => 'Data langsung terhubung ke kasir untuk proses verifikasi instan tanpa login.',
                    ],
                    [
                        'step' => 4,
                        'title' => 'Konfirmasi & Pembayaran',
                        'desc' => 'Gunakan QRIS atau bayar tunai di lokasi sebelum masuk ke lapangan.',
                    ],
                ]),
                'order' => 4,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'member_benefits',
                'label' => 'Keuntungan Member (JSON)',
                'content_type' => 'list_item',
                'content_value' => json_encode([
                    ['icon' => '🏸', 'title' => 'Diskon Paket Jam', 'desc' => 'Harga khusus member bulanan yang rutin main setiap minggu'],
                    ['icon' => '⚡', 'title' => 'Booking Prioritas Weekend', 'desc' => 'Hak reservasi slot prima weekend sebelum dibuka untuk umum'],
                    ['icon' => '🏸', 'title' => 'Diskon Shuttlecock', 'desc' => 'Potongan harga khusus pembelian shuttlecock resmi di pro shop'],
                ]),
                'order' => 5,
            ],
            [
                'page_key' => 'cara_booking',
                'section_key' => 'faq_items',
                'label' => 'Daftar Pertanyaan FAQ (JSON)',
                'content_type' => 'list_item',
                'content_value' => json_encode([
                    ['q' => 'Apakah wajib memakai sepatu badminton khusus?', 'a' => 'Ya, wajib menggunakan sepatu bersol karet non-marking karet mentah demi menjaga keawetan karpet BWF.'],
                    ['q' => 'Apakah tersedia shuttlecock dan senar di lokasi?', 'a' => 'Tersedia! Kami menjual shuttlecock berkualitas dan jasa pasang senar raket badminton di pro shop.'],
                ]),
                'order' => 6,
            ],

            // BOOKING PAGE
            [
                'page_key' => 'booking',
                'section_key' => 'page_badge',
                'label' => 'Badge Halaman Booking',
                'content_type' => 'text',
                'content_value' => 'Reservasi Lapangan Badminton',
                'order' => 1,
            ],
            [
                'page_key' => 'booking',
                'section_key' => 'policy_note',
                'label' => 'Catatan Kebijakan / Aturan Main',
                'content_type' => 'text',
                'content_value' => 'Wajib menggunakan sepatu non-marking sol karet mentah. Menjaga kebersihan karpet lapangan.',
                'order' => 2,
            ],
            [
                'page_key' => 'booking',
                'section_key' => 'cta_button_text',
                'label' => 'Teks Tombol Booking',
                'content_type' => 'text',
                'content_value' => 'Lanjut Booking Badminton',
                'order' => 3,
            ],

            // BOOKING DETAIL / INVOICE
            [
                'page_key' => 'booking_detail',
                'section_key' => 'header_title',
                'label' => 'Judul Header Invoice',
                'content_type' => 'text',
                'content_value' => 'Detail Reservasi Badminton',
                'order' => 1,
            ],
            [
                'page_key' => 'booking_detail',
                'section_key' => 'footer_note',
                'label' => 'Catatan Kaki Invoice / Ketentuan',
                'content_type' => 'text',
                'content_value' => 'Harap lapor ke petugas kasir saat tiba di hall badminton. Sedia shuttlecock di kasir.',
                'order' => 2,
            ],
            [
                'page_key' => 'booking_detail',
                'section_key' => 'wa_cta_text',
                'label' => 'Teks Bantuan WhatsApp',
                'content_type' => 'text',
                'content_value' => 'Pertanyaan mengenai ketersediaan shuttlecock atau pelatih? Hubungi kami di WhatsApp.',
                'order' => 3,
            ],
        ];

        $this->saveSections($st, $sections);
    }

    private function seedGenericSections(SportType $st): void
    {
        $name = $st->name;
        $sections = [
            [
                'page_key' => 'home',
                'section_key' => 'hero_title',
                'label' => 'Hero Title',
                'content_type' => 'text',
                'content_value' => 'MAIN ' . strtoupper($name) . ' SETIAP HARI.',
                'order' => 1,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'hero_subtitle',
                'label' => 'Hero Subtitle',
                'content_type' => 'text',
                'content_value' => 'Arena ' . $name . ' berstandar internasional dengan fasilitas modern dan nyaman.',
                'order' => 2,
            ],
            [
                'page_key' => 'sejarah',
                'section_key' => 'header_subtitle',
                'label' => 'Sub Judul Header',
                'content_type' => 'text',
                'content_value' => 'Sejarah Venue',
                'order' => 1,
            ],
            [
                'page_key' => 'sejarah',
                'section_key' => 'header_title',
                'label' => 'Judul Header',
                'content_type' => 'text',
                'content_value' => 'Our <span class="text-green-400">Story</span>',
                'order' => 2,
            ],
            [
                'page_key' => 'sejarah',
                'section_key' => 'body_text',
                'label' => 'Cerita Sejarah & Profil',
                'content_type' => 'richtext',
                'content_value' => '<p>Selamat datang di arena ' . e($name) . ' dengan fasilitas terbaik untuk Anda dan komunitas.</p>',
                'order' => 3,
            ],
            [
                'page_key' => 'booking_detail',
                'section_key' => 'header_title',
                'label' => 'Judul Header Invoice',
                'content_type' => 'text',
                'content_value' => 'Detail Booking ' . $name,
                'order' => 1,
            ],
            [
                'page_key' => 'booking_detail',
                'section_key' => 'footer_note',
                'label' => 'Catatan Kaki Invoice',
                'content_type' => 'text',
                'content_value' => 'Tunjukkan kode booking kepada staf kasir sebelum bermain.',
                'order' => 2,
            ],
        ];

        $this->saveSections($st, $sections);
    }

    private function saveSections(SportType $st, array $sections): void
    {
        foreach ($sections as $sec) {
            SportTypePageSection::updateOrCreate(
                [
                    'sport_type_id' => $st->id,
                    'page_key' => $sec['page_key'],
                    'section_key' => $sec['section_key'],
                ],
                [
                    'label' => $sec['label'],
                    'content_type' => $sec['content_type'],
                    'content_value' => $sec['content_value'] ?? null,
                    'image_path' => $sec['image_path'] ?? null,
                    'order' => $sec['order'] ?? 0,
                ]
            );
        }
    }
}
