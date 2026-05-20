<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Field;
use App\Models\FieldPrice;

class FieldSeeder extends Seeder
{
    public function run(): void
    {
        // Lapangan BF 01
        $field1 = Field::create([
            'name' => 'Lapangan BF 01',
            'description' => 'Rumput sintetis premium, minim risiko cedera',
            'image' => 'asset/img/lapangan1.jfif',
            'surface_type' => 'Rumput Sintetis',
            'is_active' => true,
        ]);

        // Harga Lapangan BF 01 - Weekday (Senin-Jumat)
        FieldPrice::create([
            'field_id' => $field1->id_field,
            'day_type' => 'weekday',
            'start_time' => '07:00',
            'end_time' => '12:00',
            'price_regular' => 65000,
            'price_member' => 260000, // 4x main
        ]);

        FieldPrice::create([
            'field_id' => $field1->id_field,
            'day_type' => 'weekday',
            'start_time' => '12:00',
            'end_time' => '16:00',
            'price_regular' => 120000,
            'price_member' => 400000, // 4x main
        ]);

        FieldPrice::create([
            'field_id' => $field1->id_field,
            'day_type' => 'weekday',
            'start_time' => '16:00',
            'end_time' => '00:00',
            'price_regular' => 130000,
            'price_member' => 400000, // 4x main
        ]);

        // Harga Lapangan BF 01 - Weekend (Sabtu-Minggu)
        FieldPrice::create([
            'field_id' => $field1->id_field,
            'day_type' => 'weekend',
            'start_time' => '07:00',
            'end_time' => '16:00',
            'price_regular' => 120000,
            'price_member' => 400000, // 4x main
        ]);

        FieldPrice::create([
            'field_id' => $field1->id_field,
            'day_type' => 'weekend',
            'start_time' => '16:00',
            'end_time' => '00:00',
            'price_regular' => 130000,
            'price_member' => 400000, // 4x main
        ]);

        // Lapangan BF 02
        $field2 = Field::create([
            'name' => 'Lapangan BF 02',
            'description' => 'Rumput sintetis premium, minim risiko cedera',
            'image' => 'asset/img/lapangan2.jfif',
            'surface_type' => 'Rumput Sintetis',
            'is_active' => true,
        ]);

        // Harga Lapangan BF 02 - Weekday
        FieldPrice::create([
            'field_id' => $field2->id_field,
            'day_type' => 'weekday',
            'start_time' => '07:00',
            'end_time' => '12:00',
            'price_regular' => 65000,
            'price_member' => 260000,
        ]);

        FieldPrice::create([
            'field_id' => $field2->id_field,
            'day_type' => 'weekday',
            'start_time' => '12:00',
            'end_time' => '16:00',
            'price_regular' => 120000,
            'price_member' => 400000,
        ]);

        FieldPrice::create([
            'field_id' => $field2->id_field,
            'day_type' => 'weekday',
            'start_time' => '16:00',
            'end_time' => '00:00',
            'price_regular' => 130000,
            'price_member' => 400000,
        ]);

        // Harga Lapangan BF 02 - Weekend
        FieldPrice::create([
            'field_id' => $field2->id_field,
            'day_type' => 'weekend',
            'start_time' => '07:00',
            'end_time' => '16:00',
            'price_regular' => 120000,
            'price_member' => 400000,
        ]);

        FieldPrice::create([
            'field_id' => $field2->id_field,
            'day_type' => 'weekend',
            'start_time' => '16:00',
            'end_time' => '00:00',
            'price_regular' => 130000,
            'price_member' => 400000,
        ]);

        // Lapangan BF 03
        $field3 = Field::create([
            'name' => 'Lapangan BF 03',
            'description' => 'Rumput sintetis premium, minim risiko cedera',
            'image' => 'asset/img/lapangan3.jfif',
            'surface_type' => 'Rumput Sintetis',
            'is_active' => true,
        ]);

        // Harga Lapangan BF 03 - Weekday
        FieldPrice::create([
            'field_id' => $field3->id_field,
            'day_type' => 'weekday',
            'start_time' => '07:00',
            'end_time' => '12:00',
            'price_regular' => 65000,
            'price_member' => 260000,
        ]);

        FieldPrice::create([
            'field_id' => $field3->id_field,
            'day_type' => 'weekday',
            'start_time' => '12:00',
            'end_time' => '16:00',
            'price_regular' => 120000,
            'price_member' => 400000,
        ]);

        FieldPrice::create([
            'field_id' => $field3->id_field,
            'day_type' => 'weekday',
            'start_time' => '16:00',
            'end_time' => '00:00',
            'price_regular' => 130000,
            'price_member' => 400000,
        ]);

        // Harga Lapangan BF 03 - Weekend
        FieldPrice::create([
            'field_id' => $field3->id_field,
            'day_type' => 'weekend',
            'start_time' => '07:00',
            'end_time' => '16:00',
            'price_regular' => 120000,
            'price_member' => 400000,
        ]);

        FieldPrice::create([
            'field_id' => $field3->id_field,
            'day_type' => 'weekend',
            'start_time' => '16:00',
            'end_time' => '00:00',
            'price_regular' => 130000,
            'price_member' => 400000,
        ]);
    }
}
