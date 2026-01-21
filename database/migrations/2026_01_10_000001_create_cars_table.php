<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->string('police_number')->unique();
            $table->string('engine');
            $table->decimal('price_per_day', 10, 2);
            $table->string('image')->nullable();
            $table->enum('status', ['tersedia', 'disewa', 'perbaikan'])->default('tersedia');
            $table->decimal('reduce', 5, 2)->default(0)->comment('Diskon dalam persen');
            $table->decimal('stars', 2, 1)->default(0);
            $table->enum('transmission', ['manual', 'automatic', 'semi-automatic'])->default('manual');
            $table->enum('fuel_type', ['bensin', 'diesel', 'elektrik', 'hybrid'])->default('bensin');
            $table->integer('seats')->default(5);
            $table->integer('doors')->default(4);
            $table->string('category')->nullable();
            $table->json('features')->nullable();
            $table->string('color')->nullable();
            $table->integer('year');
            $table->text('description')->nullable();
            $table->json('images')->nullable();
            $table->json('gallery_images')->nullable();
            $table->integer('mileage')->default(0)->comment('Kilometer');
            $table->boolean('available_for_long_term')->default(false);
            $table->integer('minimum_rental_days')->default(1);
            $table->timestamps();
        });

        // Insert test data
        DB::table('cars')->insert([
            [
                'brand' => 'Toyota',
                'model' => 'Avanza',
                'police_number' => 'B 1234 ABC',
                'engine' => '1.5L DOHC VVT-i',
                'price_per_day' => 300000,
                'image' => '/storage/images/cars/avanza.jpg',
                'status' => 'tersedia',
                'reduce' => 10,
                'stars' => 4.5,
                'transmission' => 'manual',
                'fuel_type' => 'bensin',
                'seats' => 7,
                'doors' => 4,
                'category' => 'MPV',
                'features' => json_encode(['AC', 'Audio System', 'Power Steering', 'Central Lock']),
                'color' => 'Putih',
                'year' => 2022,
                'description' => 'Toyota Avanza merupakan mobil keluarga yang nyaman dan irit bahan bakar. Cocok untuk perjalanan keluarga atau rombongan.',
                'mileage' => 15000,
                'available_for_long_term' => true,
                'minimum_rental_days' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Honda',
                'model' => 'Brio',
                'police_number' => 'B 5678 DEF',
                'engine' => '1.2L i-VTEC',
                'price_per_day' => 250000,
                'image' => '/storage/images/cars/brio.jpg',
                'status' => 'tersedia',
                'reduce' => 0,
                'stars' => 4.3,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'seats' => 5,
                'doors' => 4,
                'category' => 'Hatchback',
                'features' => json_encode(['AC', 'Audio System', 'Power Window', 'Airbag']),
                'color' => 'Merah',
                'year' => 2023,
                'description' => 'Honda Brio adalah city car yang lincah dan efisien. Perfect untuk aktivitas dalam kota.',
                'mileage' => 8000,
                'available_for_long_term' => true,
                'minimum_rental_days' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Mitsubishi',
                'model' => 'Xpander',
                'police_number' => 'B 9012 GHI',
                'engine' => '1.5L MIVEC',
                'price_per_day' => 350000,
                'image' => '/storage/images/cars/xpander.jpg',
                'status' => 'tersedia',
                'reduce' => 15,
                'stars' => 4.7,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'seats' => 7,
                'doors' => 4,
                'category' => 'MPV',
                'features' => json_encode(['AC', 'Audio System', 'Power Window', 'Cruise Control', 'Parking Sensor']),
                'color' => 'Hitam',
                'year' => 2023,
                'description' => 'Mitsubishi Xpander adalah MPV modern dengan desain stylish dan fitur lengkap. Ideal untuk perjalanan jarak jauh.',
                'mileage' => 12000,
                'available_for_long_term' => true,
                'minimum_rental_days' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Daihatsu',
                'model' => 'Ayla',
                'police_number' => 'B 3456 JKL',
                'engine' => '1.0L DOHC',
                'price_per_day' => 200000,
                'image' => '/storage/images/cars/ayla.jpg',
                'status' => 'tersedia',
                'reduce' => 5,
                'stars' => 4.0,
                'transmission' => 'manual',
                'fuel_type' => 'bensin',
                'seats' => 5,
                'doors' => 4,
                'category' => 'City Car',
                'features' => json_encode(['AC', 'Audio System', 'Power Steering']),
                'color' => 'Silver',
                'year' => 2021,
                'description' => 'Daihatsu Ayla adalah mobil kecil yang sangat irit dan praktis. Cocok untuk mobilitas harian di kota.',
                'mileage' => 25000,
                'available_for_long_term' => false,
                'minimum_rental_days' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Suzuki',
                'model' => 'Ertiga',
                'police_number' => 'B 7890 MNO',
                'engine' => '1.5L K15B',
                'price_per_day' => 280000,
                'image' => '/storage/images/cars/ertiga.jpg',
                'status' => 'disewa',
                'reduce' => 0,
                'stars' => 4.4,
                'transmission' => 'manual',
                'fuel_type' => 'bensin',
                'seats' => 7,
                'doors' => 4,
                'category' => 'MPV',
                'features' => json_encode(['AC', 'Audio System', 'Power Window', 'Central Lock']),
                'color' => 'Abu-abu',
                'year' => 2022,
                'description' => 'Suzuki Ertiga adalah MPV yang tangguh dan hemat BBM. Sempurna untuk keluarga besar.',
                'mileage' => 18000,
                'available_for_long_term' => true,
                'minimum_rental_days' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Innova Reborn',
                'police_number' => 'B 2345 PQR',
                'engine' => '2.4L Diesel',
                'price_per_day' => 450000,
                'image' => '/storage/images/cars/innova.jpg',
                'status' => 'tersedia',
                'reduce' => 20,
                'stars' => 4.8,
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'seats' => 7,
                'doors' => 4,
                'category' => 'MPV',
                'features' => json_encode(['AC', 'Audio System', 'Leather Seat', 'Cruise Control', 'Parking Camera', 'Sunroof']),
                'color' => 'Putih Mutiara',
                'year' => 2023,
                'description' => 'Toyota Innova Reborn adalah MPV premium dengan kenyamanan maksimal. Pilihan terbaik untuk perjalanan keluarga yang mewah.',
                'mileage' => 10000,
                'available_for_long_term' => true,
                'minimum_rental_days' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Honda',
                'model' => 'Jazz',
                'police_number' => 'B 6789 STU',
                'engine' => '1.5L i-VTEC',
                'price_per_day' => 320000,
                'image' => '/storage/images/cars/jazz.jpg',
                'status' => 'tersedia',
                'reduce' => 0,
                'stars' => 4.6,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'seats' => 5,
                'doors' => 4,
                'category' => 'Hatchback',
                'features' => json_encode(['AC', 'Audio System', 'Power Window', 'Airbag', 'Parking Sensor']),
                'color' => 'Biru',
                'year' => 2022,
                'description' => 'Honda Jazz adalah hatchback premium dengan interior luas dan fitur modern. Nyaman untuk perjalanan dalam dan luar kota.',
                'mileage' => 14000,
                'available_for_long_term' => true,
                'minimum_rental_days' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Fortuner',
                'police_number' => 'B 1111 VWX',
                'engine' => '2.7L Bensin',
                'price_per_day' => 650000,
                'image' => '/storage/images/cars/fortuner.jpg',
                'status' => 'tersedia',
                'reduce' => 10,
                'stars' => 4.9,
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'seats' => 7,
                'doors' => 4,
                'category' => 'SUV',
                'features' => json_encode(['AC', 'Audio System', 'Leather Seat', '4WD', 'Cruise Control', 'Parking Camera', 'Sunroof', 'Hill Start Assist']),
                'color' => 'Hitam Metalik',
                'year' => 2023,
                'description' => 'Toyota Fortuner adalah SUV tangguh dan mewah. Cocok untuk petualangan dan perjalanan keluarga yang berkelas.',
                'mileage' => 8000,
                'available_for_long_term' => true,
                'minimum_rental_days' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
