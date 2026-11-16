<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Facilities with updateOrInsert to fix existing rows
        $facilities = [
            [
                'id' => 1,
                'name' => 'Audio-Visual Room (AVR 2) - Main Building',
                'description' => 'Air-conditioned room equipped with a wide screen projector and sound system.',
                'image' => 'images/Audio-Visual.jpg',
                'capacity' => null,
                'status' => 'Available',
            ],
            [
                'id' => 2,
                'name' => 'Computer Laboratory 3 (ComLab)',
                'description' => 'Fully air-conditioned computer hub with 40 workstation terminals.',
                'image' => 'images/Computer_lab3.jpg',
                'capacity' => null,
                'status' => 'Available',
            ],
            [
                'id' => 3,
                'name' => 'University Covered Court',
                'description' => 'Semi-open multipurpose coliseum style court for sports and large gatherings.',
                'image' => 'images/Covered_court.jpg',
                'capacity' => null,
                'status' => 'Available',
            ],
            [
                'id' => 4,
                'name' => 'Student Council Conference Room',
                'description' => 'Collaborative discussion space furnished with a long conference table.',
                'image' => 'images/Student_Council_Conference_Room.jpg',
                'capacity' => null,
                'status' => 'Available',
            ],
            [
                'id' => 5,
                'name' => 'Speech Laboratory',
                'description' => 'Air-conditioned language and audio training facility with individual booths.',
                'image' => 'images/Speech_Laboratory.jpg',
                'capacity' => null,
                'status' => 'Available',
            ],
            [
                'id' => 6,
                'name' => 'Engineering Physics Laboratory',
                'description' => 'Equipped with heavy-duty workbenches, circuit test kits, and measurement tools.',
                'image' => 'images/Engineering_Physics_Laboratory.jpg',
                'capacity' => null,
                'status' => 'Available',
            ],
            [
                'id' => 7,
                'name' => 'HRM / Culinary Kitchen Studio',
                'description' => 'Commercial-grade kitchen facility featuring cooking stations and baking ovens.',
                'image' => 'images/Culinary_Kitchen_Studio.jpg',
                'capacity' => null,
                'status' => 'Available',
            ],
            [
                'id' => 8,
                'name' => 'Outdoor Student Pavilion / Gazebo',
                'description' => 'Shaded open-air study hub with concrete seating benches and garden views.',
                'image' => 'images/Outdoor_Student_Pavilion.jpg',
                'capacity' => null,
                'status' => 'Available',
            ],
        ];

        foreach ($facilities as $facility) {
            DB::table('facilities')->updateOrInsert(
                ['id' => $facility['id']],
                [
                    'name' => $facility['name'],
                    'description' => $facility['description'],
                    'image' => $facility['image'],
                    'capacity' => $facility['capacity'],
                    'status' => $facility['status'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // Seed Equipment with updateOrInsert
        $equipmentList = [
            [
                'id' => 1,
                'name' => 'Epson Multimedia Classroom Projector',
                'description' => 'High-lumen portable LCD projector with HDMI and VGA inputs.',
                'total_stock' => 10,
                'image' => 'images/Epson_Multimedia.jpg',
                'quantity' => 1,
                'status' => 'Available',
            ],
            [
                'id' => 2,
                'name' => 'Sony Mirrorless Vlogging Camera Kit',
                'description' => 'Digital camera kit complete with tripod, 16-50mm lens, and shotgun mic.',
                'total_stock' => 5,
                'image' => 'images/Sony_Mirrorless_Vlogging_Camera_Kit.jpg',
                'quantity' => 1,
                'status' => 'Available',
            ],
            [
                'id' => 3,
                'name' => 'Wireless Microphone Set (Dual Handheld)',
                'description' => 'VHF/UHF dual wireless mic system with receiver base and anti-roll rings.',
                'total_stock' => 8,
                'image' => 'images/Wireless_Microphone_Set.jpg',
                'quantity' => 1,
                'status' => 'Available',
            ],
            [
                'id' => 4,
                'name' => 'Heavy-Duty Extension Cord (5-Meter)',
                'description' => 'Thick-insulated 5-way outlet power extension cord with surge protection.',
                'total_stock' => 15,
                'image' => 'images/Heavy_Duty_Extension_Cord.jpg',
                'quantity' => 1,
                'status' => 'Available',
            ],
            [
                'id' => 5,
                'name' => 'Arduino & Raspberry Pi STEM Kit',
                'description' => 'Complete hardware prototyping toolbox with sensors, jumper wires, and breadboards.',
                'total_stock' => 12,
                'image' => 'images/Arduino_Raspberry_Pi_STEM_Kit.jpg',
                'quantity' => 1,
                'status' => 'Available',
            ],
            [
                'id' => 6,
                'name' => 'Portable PA System with Wireless Mic',
                'description' => 'Rechargeable mobile sound system with built-in Bluetooth and trolley handle.',
                'total_stock' => 6,
                'image' => 'images/Portable_PA_System_with_Wireless_Mic.jpg',
                'quantity' => 1,
                'status' => 'Available',
            ],
            [
                'id' => 7,
                'name' => 'Compound Monocular Microscope Set',
                'description' => 'High-magnification optical microscopes with LED illumination and prepared slides.',
                'total_stock' => 20,
                'image' => 'images/Compound_Monocular_Microscope_Set.jpg',
                'quantity' => 1,
                'status' => 'Available',
            ],
            [
                'id' => 8,
                'name' => 'High-Speed Pocket Wi-Fi / LTE Modem',
                'description' => 'Portable wireless router with pre-loaded data SIM for remote field activities.',
                'total_stock' => 10,
                'image' => 'images/High_Speed_Pocket_WiFi_Modem.jpg',
                'quantity' => 1,
                'status' => 'Available',
            ],
            [
                'id' => 9,
                'name' => 'Whiteboard Marker & Eraser Bulk Set',
                'description' => 'Set of assorted color dry-erase markers, magnetic eraser, and refill ink bottles.',
                'total_stock' => 25,
                'image' => 'images/Whiteboard_Marker_Eraser_Bulk_Set.jpg',
                'quantity' => 1,
                'status' => 'Available',
            ],
        ];

        foreach ($equipmentList as $item) {
            DB::table('equipment')->updateOrInsert(
                ['id' => $item['id']],
                [
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'total_stock' => $item['total_stock'],
                    'image' => $item['image'],
                    'quantity' => $item['quantity'],
                    'status' => $item['status'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}