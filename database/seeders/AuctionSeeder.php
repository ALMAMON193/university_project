<?php

namespace Database\Seeders;

use App\Models\Auction;
use App\Models\AuctionImageGallery;
use App\Models\AuctionVideoGallery;
use Illuminate\Database\Seeder;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Auction data for multiple entries
        $auctions = [
            [
                'user_id' => 2,
                'status' => 'approve',
                'featured' => true,
                'full_name' => 'John Doe',
                'phone' => '1234567890',
                'vin_number' => '1HGCM82633A123456',
                'year' => 2020,
                'make' => 'Toyota',
                'model' => 'Camry',
                'transmission' => 'Automatic Transmission',
                'mileage' => 15000,
                'equipment' => 'Air Conditioning, Leather Seats, Navigation System',
                'modify' => false,
                'flaw' => false,
                'location' => 'Saudi',
                'sale_elsewhere' => false,
                'titled_location' => 'Saudi',
                'state_id' => 6,
                'on_my_name' => true,
                'title_status' => 'Clean',
                'reserve_price' => false,
                'price_range' => null,
                'start' => now(),
                'end' => now()->addHours(168),
                'engine' => '2.5L 4-Cylinder',
                'drivetrain' => 'FWD',
                'body_style' => 'Sedan',
                'exterior_color' => 'Black',
                'interior_color' => 'Black',
                'ownership_history' => 'First owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'status' => 'pending',
                'featured' => true,
                'full_name' => 'Jane Smith',
                'phone' => '0987654321',
                'vin_number' => '2HGCM82633A123457',
                'year' => 2019,
                'make' => 'Honda',
                'model' => 'Civic',
                'transmission' => 'Manual Transmission',
                'mileage' => 20000,
                'equipment' => 'Air Conditioning, Sunroof, Backup Camera',
                'modify' => false,
                'flaw' => false,
                'location' => 'Saudi',
                'sale_elsewhere' => true,
                'titled_location' => 'Saudi',
                'state_id' => 2,
                'on_my_name' => true,
                'title_status' => 'Clean',
                'reserve_price' => true,
                'price_range' => '15000',
                'start' => null,
                'end' => null,
                'engine' => '1.5L 4-Cylinder',
                'drivetrain' => 'FWD',
                'body_style' => 'Sedan',
                'exterior_color' => 'White',
                'interior_color' => 'Gray',
                'ownership_history' => 'Second owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'status' => 'pending',
                'featured' => true,
                'full_name' => 'Bob Johnson',
                'phone' => '1122334455',
                'vin_number' => '3HGCM82633A123458',
                'year' => 2021,
                'make' => 'Ford',
                'model' => 'Mustang',
                'transmission' => 'Dual-Clutch Transmission',
                'mileage' => 5000,
                'equipment' => 'Air Conditioning, Leather Seats, Bluetooth',
                'modify' => false,
                'flaw' => false,
                'location' => 'Arab Amirat',
                'sale_elsewhere' => false,
                'titled_location' => 'Arab Amirat',
                'state_id' => 5,
                'on_my_name' => true,
                'title_status' => 'Clean',
                'reserve_price' => false,
                'price_range' => null,
                'start' => null,
                'end' => null,
                'engine' => '5.0L V8',
                'drivetrain' => 'RWD',
                'body_style' => 'Coupe',
                'exterior_color' => 'Red',
                'interior_color' => 'Black',
                'ownership_history' => 'First owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $imageCounter = 1;
        $videoCounter = 1;

        foreach ($auctions as $auctionData) {
            $auction = Auction::create($auctionData);

            // Add 6 photos for each auction
            for ($i = 0; $i < 6; $i++) {
                AuctionImageGallery::create([
                    'auction_id' => $auction->id,
                    'url' => 'images/auctions/' . ($imageCounter++) . '.png',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Add 1 video for each auction
            AuctionVideoGallery::create([
                'auction_id' => $auction->id,
                'url' => 'videos/auctions/' . ($videoCounter++) . '.mp4',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
