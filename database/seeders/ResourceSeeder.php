<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Facility;
use App\Models\Equipment;

class ResourceSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Facility::truncate();
        Equipment::truncate();
        Schema::enableForeignKeyConstraints();

        // 1. Real-World Facilities & Rooms with Exact Local Photos
        Facility::insert([
            [
                'name' => 'Lecture Hall 101',
                'description' => 'Tiered amphitheater equipped with a smart podium, laser projector, and acoustic sound system.',
                'image' => 'images/Audio-Visual.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Computer Laboratory 3',
                'description' => 'Equipped with 40 high-performance workstations, fiber internet, and dual-display developer environments.',
                'image' => 'images/Computer_Lab3.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Executive Conference Room',
                'description' => 'Boardroom setup featuring a 75-inch smart TV, conference speakerphone, and executive seating for meetings.',
                'image' => 'images/Student_Council_Conference_Room.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Multimedia Production Lab',
                'description' => 'Acoustically treated media room featuring a green screen backdrop, studio lighting rigs, and editing bays.',
                'image' => 'images/Speech_Laboratory.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 2. Real-World Equipment with Quantities and Exact Local Photos
        Equipment::insert([
            [
                'name' => 'Epson Short-Throw Classroom Projector',
                'description' => 'Portable classroom projector with HDMI, wireless casting, and wide-angle projection lens.',
                'total_stock' => 12,
                'image' => 'images/Epson_Multimedia.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dell Latitude 5530 Student Laptop',
                'description' => 'Intel Core i7 laptop pre-configured with programming IDEs, office suites, and design software.',
                'total_stock' => 30,
                'image' => 'images/High_Speed_Pocket_WiFi_LTE_Modem.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sony 4K Mirrorless Camera',
                'description' => 'High-resolution digital camera with tripod, zoom lens, and extra battery kit for campus events and media coverage.',
                'total_stock' => 6,
                'image' => 'images/Sony_Mirrorless_Vlogging_Camera_Kit.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shure Wireless Microphone Set',
                'description' => 'Dual-channel handheld UHF wireless microphone system with crystal-clear audio transmission for seminars.',
                'total_stock' => 10,
                'image' => 'images/Wireless_Microphone_Set.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anker Bluetooth Conference Speakerphone',
                'description' => 'Omnidirectional speakerphone with 360-degree voice pickup and noise cancellation for hybrid meetings.',
                'total_stock' => 8,
                'image' => 'images/Portable_PA_System_with_Wireless_Mic.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arduino & Raspberry Pi STEM Kit',
                'description' => 'Complete hardware prototyping toolbox containing sensors, microcontrollers, and breadboards for student projects.',
                'total_stock' => 15,
                'image' => 'images/Arduino_Raspberry_Pi_STEM_Kit.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}