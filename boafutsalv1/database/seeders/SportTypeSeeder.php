<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SportType;
use App\Models\SportTypeGallery;
use App\Models\Field;
use App\Models\FieldPrice;
use App\Models\Booking;

class SportTypeSeeder extends Seeder
{
    public function run(): void
    {
        // 1. FUTSAL (Default Active)
        $futsal = SportType::updateOrCreate(
            ['slug' => 'futsal'],
            [
                'name' => 'Futsal',
                'hero_title' => 'MAIN PRO SETIAP HARI.',
                'hero_subtitle' => 'Nikmati kualitas rumput internasional dan atmosfer stadion profesional di pusat kota. Booking lapanganmu dalam hitungan detik.',
                'description' => 'Arena futsal berstandar dengan rumput sintetis premium dan fasilitas lengkap.',
                'hero_image_path' => 'asset/img/landing.webp',
                'facilities' => [
                    [
                        'name' => 'Toilet',
                        'desc' => 'Kamar mandi yang bersih dan terawat untuk menjamin kenyamanan para pengunjung sebelum atau sesudah berolahraga.',
                        'icon' => 'toilet'
                    ],
                    [
                        'name' => 'Mushola',
                        'desc' => 'Fasilitas ibadah yang nyaman dan bersih, dilengkapi dengan tempat wudhu agar ibadah Anda tetap terjaga.',
                        'icon' => 'mushola'
                    ],
                    [
                        'name' => 'Kasir',
                        'desc' => 'Area pelayanan untuk administrasi dan reservasi yang siap melayani dengan proses yang cepat serta ramah.',
                        'icon' => 'kasir'
                    ],
                    [
                        'name' => 'Parkiran',
                        'desc' => 'Area parkir kendaraan untuk mobil dan motor yang aman, luas, serta sangat mudah diakses oleh pengunjung.',
                        'icon' => 'parkir'
                    ],
                ],
                'meta_title' => 'BOA Futsal Arena - Booking Lapangan Futsal',
                'meta_description' => 'Booking lapangan futsal terbaik dengan fasilitas lengkap dan rumput standar internasional.',
                'is_active' => true,
            ]
        );

        // Associate existing fields to Futsal
        Field::whereNull('sport_type_id')->update(['sport_type_id' => $futsal->id]);

        // Seed default galleries for Futsal if none exist
        if ($futsal->galleries()->count() === 0) {
            SportTypeGallery::create([
                'sport_type_id' => $futsal->id,
                'image_path' => 'asset/img/lapangan1.webp',
                'caption' => 'Lapangan Futsal 1 - Rumput Sintetis Standar FIFA',
                'order' => 1,
            ]);
            SportTypeGallery::create([
                'sport_type_id' => $futsal->id,
                'image_path' => 'asset/img/lapangan2.webp',
                'caption' => 'Lapangan Futsal 2 - Pencahayaan LED Terang & Nyaman',
                'order' => 2,
            ]);
            SportTypeGallery::create([
                'sport_type_id' => $futsal->id,
                'image_path' => 'asset/img/lapangan3.webp',
                'caption' => 'Lapangan Futsal 3 - Tribun Penonton & Jaring Pengaman',
                'order' => 3,
            ]);
        }

        // Backfill snapshot on historical bookings
        $existingBookings = Booking::with('field')->whereNull('sport_type_name_snapshot')->get();
        foreach ($existingBookings as $b) {
            $b->update([
                'sport_type_name_snapshot' => 'Futsal',
                'field_name_snapshot' => $b->field ? $b->field->name : 'Lapangan Futsal',
            ]);
        }

        // 2. PADEL (Inactive profile for demo)
        $padel = SportType::updateOrCreate(
            ['slug' => 'padel'],
            [
                'name' => 'Padel',
                'hero_title' => 'SMASH THE COURT, ENJOY PADEL.',
                'hero_subtitle' => 'Rasakan sensasi olahraga raket paling berkembang di dunia dengan kaca panoramic dan karpet standar World Padel Tour.',
                'description' => 'Arena padel eksklusif berstandar internasional dengan pencahayaan LED turnamen dan viewing area nyaman.',
                'hero_image_path' => 'asset/img/aboutus.webp',
                'facilities' => [
                    [
                        'name' => 'Locker & Shower Air Hangat',
                        'desc' => 'Fasilitas ruang ganti privat dan shower bersih berair hangat setelah sesi match yang intens.',
                        'icon' => 'toilet'
                    ],
                    [
                        'name' => 'Pro Shop & Rental Raket',
                        'desc' => 'Tersedia penyewaan raket padel branded serta bola resmi WPT berkualitas tinggi.',
                        'icon' => 'kasir'
                    ],
                    [
                        'name' => 'Spectator Lounge & Coffee',
                        'desc' => 'Area santai tepi lapangan dengan minuman kopi segar dan view langsung ke court.',
                        'icon' => 'mushola'
                    ],
                    [
                        'name' => 'Parkir Khusus & Valet',
                        'desc' => 'Lahan parkir aman dan nyaman tepat di depan pintu masuk arena.',
                        'icon' => 'parkir'
                    ],
                ],
                'meta_title' => 'BOA Padel Arena - Booking Lapangan Padel',
                'meta_description' => 'Sewa lapangan padel berkualitas tinggi dengan teknologi panoramic glass dan karpet WPT.',
                'is_active' => false,
            ]
        );

        // Seed sample fields for Padel if none exist
        if ($padel->fields()->count() === 0) {
            $padelField1 = Field::create([
                'name' => 'Padel Court 01 (Panoramic)',
                'description' => 'Kaca tempered panoramic 12mm tanpa pilar tengah, rumput monofilamen WPT.',
                'image' => 'asset/img/aboutus.webp',
                'surface_type' => 'Karpet Monofilamen WPT',
                'sport_type_id' => $padel->id,
                'is_active' => true,
            ]);

            FieldPrice::create([
                'field_id' => $padelField1->id_field,
                'day_type' => 'weekday',
                'start_time' => '07:00',
                'end_time' => '16:00',
                'price_regular' => 180000,
                'price_member' => 150000,
            ]);
            FieldPrice::create([
                'field_id' => $padelField1->id_field,
                'day_type' => 'weekday',
                'start_time' => '16:00',
                'end_time' => '23:00',
                'price_regular' => 250000,
                'price_member' => 220000,
            ]);
            FieldPrice::create([
                'field_id' => $padelField1->id_field,
                'day_type' => 'weekend',
                'start_time' => '07:00',
                'end_time' => '23:00',
                'price_regular' => 280000,
                'price_member' => 250000,
            ]);

            $padelField2 = Field::create([
                'name' => 'Padel Court 02 (Center Court)',
                'description' => 'Lapangan utama dengan tribun penonton dan sound system terintegrasi.',
                'image' => 'asset/img/sejarah.webp',
                'surface_type' => 'Karpet Monofilamen WPT',
                'sport_type_id' => $padel->id,
                'is_active' => true,
            ]);

            FieldPrice::create([
                'field_id' => $padelField2->id_field,
                'day_type' => 'weekday',
                'start_time' => '07:00',
                'end_time' => '16:00',
                'price_regular' => 200000,
                'price_member' => 170000,
            ]);
            FieldPrice::create([
                'field_id' => $padelField2->id_field,
                'day_type' => 'weekday',
                'start_time' => '16:00',
                'end_time' => '23:00',
                'price_regular' => 270000,
                'price_member' => 240000,
            ]);
            FieldPrice::create([
                'field_id' => $padelField2->id_field,
                'day_type' => 'weekend',
                'start_time' => '07:00',
                'end_time' => '23:00',
                'price_regular' => 300000,
                'price_member' => 270000,
            ]);
        }

        if ($padel->galleries()->count() === 0) {
            SportTypeGallery::create([
                'sport_type_id' => $padel->id,
                'image_path' => 'asset/img/aboutus.webp',
                'caption' => 'Panoramic Court Padel dengan Kaca Anti-Benturan',
                'order' => 1,
            ]);
            SportTypeGallery::create([
                'sport_type_id' => $padel->id,
                'image_path' => 'asset/img/sejarah.webp',
                'caption' => 'Pencahayaan LED Khusus Turnamen Padel',
                'order' => 2,
            ]);
        }

        // 3. BADMINTON (Inactive profile for demo)
        $badminton = SportType::updateOrCreate(
            ['slug' => 'badminton'],
            [
                'name' => 'Badminton',
                'hero_title' => 'RALLY CEPAT, SMASH AKURAT.',
                'hero_subtitle' => 'Bermain bulutangkis di atas karpet vinyl standar BWF dengan sirkulasi udara optimal dan pencahayaan anti-silau.',
                'description' => 'GOR Badminton modern dengan ceiling tinggi, pencahayaan LED anti-glare, dan matras empuk standar kejuaraan.',
                'hero_image_path' => 'asset/img/sejarah.webp',
                'facilities' => [
                    [
                        'name' => 'Karpet Matras BWF 5mm',
                        'desc' => 'Lantai vinyl berstandar BWF yang meredam benturan sendi dan memberikan grip optimal.',
                        'icon' => 'parkir'
                    ],
                    [
                        'name' => 'Lighting Anti-Silau',
                        'desc' => 'Lampu LED khusus olahraga raket yang diposisikan di sisi lapangan agar pandangan tidak silau.',
                        'icon' => 'kasir'
                    ],
                    [
                        'name' => 'Kantin Sehat & Rest Area',
                        'desc' => 'Menyediakan minuman elektrolit, air mineral dingin, dan makanan sehat pendukung stamina.',
                        'icon' => 'mushola'
                    ],
                    [
                        'name' => 'Kamar Mandi & Ruang Bilas',
                        'desc' => 'Kebersihan terjaga dengan ketersediaan air bersih melimpah dan loker penyimpanan barang.',
                        'icon' => 'toilet'
                    ],
                ],
                'meta_title' => 'BOA Badminton Arena - Booking Lapangan Bulutangkis',
                'meta_description' => 'Booking lapangan bulutangkis matras BWF nyaman dan berstandar turnamen.',
                'is_active' => false,
            ]
        );

        // Seed sample fields for Badminton if none exist
        if ($badminton->fields()->count() === 0) {
            $badmintonField1 = Field::create([
                'name' => 'Badminton Court A (Vinyl BWF)',
                'description' => 'Karpet vinyl BWF 5mm, tiang net kokoh dan garis lapangan standar.',
                'image' => 'asset/img/sejarah.webp',
                'surface_type' => 'Vinyl Mat BWF',
                'sport_type_id' => $badminton->id,
                'is_active' => true,
            ]);

            FieldPrice::create([
                'field_id' => $badmintonField1->id_field,
                'day_type' => 'weekday',
                'start_time' => '07:00',
                'end_time' => '17:00',
                'price_regular' => 50000,
                'price_member' => 40000,
            ]);
            FieldPrice::create([
                'field_id' => $badmintonField1->id_field,
                'day_type' => 'weekday',
                'start_time' => '17:00',
                'end_time' => '23:00',
                'price_regular' => 80000,
                'price_member' => 70000,
            ]);
            FieldPrice::create([
                'field_id' => $badmintonField1->id_field,
                'day_type' => 'weekend',
                'start_time' => '07:00',
                'end_time' => '23:00',
                'price_regular' => 90000,
                'price_member' => 80000,
            ]);

            $badmintonField2 = Field::create([
                'name' => 'Badminton Court B (Vinyl BWF)',
                'description' => 'Matras berkualitas tinggi dengan sirkulasi udara sejuk exhaust fan industri.',
                'image' => 'asset/img/aboutus.webp',
                'surface_type' => 'Vinyl Mat BWF',
                'sport_type_id' => $badminton->id,
                'is_active' => true,
            ]);

            FieldPrice::create([
                'field_id' => $badmintonField2->id_field,
                'day_type' => 'weekday',
                'start_time' => '07:00',
                'end_time' => '17:00',
                'price_regular' => 50000,
                'price_member' => 40000,
            ]);
            FieldPrice::create([
                'field_id' => $badmintonField2->id_field,
                'day_type' => 'weekday',
                'start_time' => '17:00',
                'end_time' => '23:00',
                'price_regular' => 80000,
                'price_member' => 70000,
            ]);
            FieldPrice::create([
                'field_id' => $badmintonField2->id_field,
                'day_type' => 'weekend',
                'start_time' => '07:00',
                'end_time' => '23:00',
                'price_regular' => 90000,
                'price_member' => 80000,
            ]);
        }

        if ($badminton->galleries()->count() === 0) {
            SportTypeGallery::create([
                'sport_type_id' => $badminton->id,
                'image_path' => 'asset/img/sejarah.webp',
                'caption' => 'Karpet Vinyl Hijau BWF Standar Turnamen',
                'order' => 1,
            ]);
            SportTypeGallery::create([
                'sport_type_id' => $badminton->id,
                'image_path' => 'asset/img/landing.webp',
                'caption' => 'Sirkulasi Udara Nyaman & Lampu Sisi Lapangan',
                'order' => 2,
            ]);
        }
    }
}
