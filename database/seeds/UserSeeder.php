<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Supplier;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a default admin user
        User::firstOrCreate(
            ['email' => 'admin@aisin-indonesia.co.id'],
            [
                'name' => 'admin',
                'password' => Hash::make('password'),
                'dept' => 'MIM',
                'npk' => '10460',
            ]
        );

        // Create additional users
        User::firstOrCreate(
            ['email' => 'esa@aisin-indonesia.co.id'],
            [
                'name' => 'Esa',
                'password' => Hash::make('password'),
                'dept' => 'NPL',
                'npk' => '10461',
            ]
        );

        User::firstOrCreate(
            ['email' => 'fernanda@aisin-indonesia.co.id'],
            [
                'name' => 'Fernanda',
                'password' => Hash::make('password'),
                'dept' => 'NPL',
                'npk' => '10462',
            ]
        );

        User::firstOrCreate(
            ['email' => 'nabila@aisin-indonesia.co.id'],
            [
                'name' => 'Nabila',
                'password' => Hash::make('password'),
                'dept' => 'NPL',
                'npk' => '10463',
            ]
        );

        User::firstOrCreate(
            ['email' => 'ardan@aisin-indonesia.co.id'],
            [
                'name' => 'Ardan',
                'password' => Hash::make('password'),
                'dept' => 'NPL',
                'npk' => '10464',
            ]
        );

        User::firstOrCreate(
            ['email' => 'friska@aisin-indonesia.co.id'],
            [
                'name' => 'Friska',
                'password' => Hash::make('password'),
                'dept' => 'NPL',
                'npk' => '10465',
            ]
        );

        User::firstOrCreate(
            ['email' => 'affandy@aisin-indonesia.co.id'],
            [
                'name' => 'Affandy',
                'password' => Hash::make('password'),
                'dept' => 'NPL',
                'npk' => '10466',
            ]
        );

        User::firstOrCreate(
            ['email' => 'seno@aisin-indonesia.co.id'],
            [
                'name' => 'Seno',
                'password' => Hash::make('password'),
                'dept' => 'QA',
                'npk' => '10467',
            ]
        );

        User::firstOrCreate(
            ['email' => 'junaedi@aisin-indonesia.co.id'],
            [
                'name' => 'Junaedi',
                'password' => Hash::make('password'),
                'dept' => 'OMD',
                'npk' => '10468',
            ]
        );

        User::firstOrCreate(
            ['email' => 'safitri@aisin-indonesia.co.id'],
            [
                'name' => 'Safitri',
                'password' => Hash::make('password'),
                'dept' => 'ENG',
                'npk' => '10469',
            ]
        );

        $suppliers = [
            [
                'name' => 'PT. Aisin Indonesia',
                'email' => 'procurement@aisin.co.id',
                'contact_person' => 'Mr. Ahmad',
                'phone' => '+62-21-1234567',
                'address' => 'Jl. Industri No. 123, Jakarta',
                'is_active' => true,
            ],
            [
                'name' => 'PT. Toyota Component Indonesia',
                'email' => 'quotes@toyota-component.co.id',
                'contact_person' => 'Ms. Sari',
                'phone' => '+62-21-7654321',
                'address' => 'Jl. Otomotif No. 456, Bekasi',
                'is_active' => true,
            ],
            [
                'name' => 'PT. Honda Parts Manufacturing',
                'email' => 'rfq@honda-parts.co.id',
                'contact_person' => 'Mr. Budi',
                'phone' => '+62-21-9876543',
                'address' => 'Jl. Produksi No. 789, Karawang',
                'is_active' => true,
            ],
            [
                'name' => 'PT. Mitsubishi Electric Components',
                'email' => 'procurement@mitsubishi-electric.co.id',
                'contact_person' => 'Ms. Rina',
                'phone' => '+62-21-5556666',
                'address' => 'Jl. Teknologi No. 321, Cikarang',
                'is_active' => true,
            ],
            [
                'name' => 'PT. Suzuki Parts Indonesia',
                'email' => 'quotes@suzuki-parts.co.id',
                'contact_person' => 'Mr. Dedi',
                'phone' => '+62-21-7778888',
                'address' => 'Jl. Industri Otomotif No. 654, Purwakarta',
                'is_active' => true,
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::firstOrCreate(
                ['email' => $supplier['email']],
                $supplier
            );
        }
    }
}
