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

        // 1. Facilities & Rooms (Matching exact photos)
        Facility::insert([
            [
                'name' => 'Outdoor Student Pavilion',
                'description' => 'Open-air campus pavilion equipped with study benches and natural surroundings for collaborative learning.',
                'image' => 'images/Outdoor_Student_Pavilion.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Computer Laboratory 3',
                'description' => 'Equipped with 40 high-performance workstations, fiber internet, and dual-display developer environments.',
                'image' => 'images/Computer_lab3.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Student Council Conference Room',
                'description' => 'Boardroom setup featuring a smart TV, conference speakerphone, and executive seating for student meetings.',
                'image' => 'images/Student_Council_Conference_Room.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Speech Laboratory',
                'description' => 'Acoustically treated media and audio room featuring booths, headsets, and recording equipment.',
                'image' => 'images/Speech_Laboratory.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Covered Sports Court',
                'description' => 'Multi-purpose indoor sports facility for basketball, volleyball, campus assemblies, and large student events.',
                'image' => 'images/Covered_court.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Culinary Kitchen Studio',
                'description' => 'Fully equipped commercial-grade kitchen setup for hospitality training, cooking workshops, and food demos.',
                'image' => 'images/Culinary_Kitchen_Studio.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Engineering Physics Laboratory',
                'description' => 'Advanced experimental lab equipped with precision instruments, oscilloscopes, and testing benches.',
                'image' => 'images/Engineering_Physics_Laboratory.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 2. Equipment & Devices (Matching exact photos)
        Equipment::insert([
            [
                'name' => 'Epson Multimedia Projector',
                'description' => 'Portable classroom projector with HDMI, wireless casting, and wide-angle projection lens.',
                'total_stock' => 12,
                'image' => 'images/Epson_Multimedia.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'High Speed Pocket WiFi LTE Modem',
                'description' => 'Portable cellular hotspot router providing high-speed mobile internet connectivity across campus.',
                'total_stock' => 30,
                'image' => 'images/High_Speed_Pocket_WiFi_LTE_Modem.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sony Mirrorless Vlogging Camera Kit',
                'description' => 'High-resolution digital camera with tripod, zoom lens, and extra battery kit for campus events and media.',
                'total_stock' => 6,
                'image' => 'images/Sony_Mirrorless_Vlogging_Camera_Kit.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wireless Microphone Set',
                'description' => 'Dual-channel handheld UHF wireless microphone system with crystal-clear audio transmission for events.',
                'total_stock' => 10,
                'image' => 'images/Wireless_Microphone_one_Set.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Portable PA System with Wireless Mic',
                'description' => 'All-in-one portable active speaker system with Bluetooth and wireless microphones for outdoor assemblies.',
                'total_stock' => 8,
                'image' => 'images/Portable_PA_System_with_Wireless_Mic.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arduino & Raspberry Pi STEM Kit',
                'description' => 'Complete hardware prototyping toolbox containing sensors, microcontrollers, and breadboards.',
                'total_stock' => 15,
                'image' => 'images/Arduino_Raspberry_Pi_STEM_Kit.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Compound Monocular Microscope Set',
                'description' => 'High-magnification laboratory microscopes with LED illumination for biology and science research.',
                'total_stock' => 20,
                'image' => 'images/Compound_Monocular_Microscope_Set.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Heavy Duty Extension Cord',
                'description' => '50-meter heavy-duty retractable power reel with surge protection for outdoor events and labs.',
                'total_stock' => 14,
                'image' => 'images/Heavy_Duty_Extension_Cord.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Whiteboard Marker & Eraser Bulk Set',
                'description' => 'Assorted color dry-erase markers with magnetic erasers and cleaning spray bottles for classrooms.',
                'total_stock' => 25,
                'image' => 'images/Whiteboard_Marker_Eraser_Bulk_Set.jpg',
                'status' => 'Available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}