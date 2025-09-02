<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedSuppliers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-suppliers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed suppliers data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
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
            \App\Models\Supplier::create($supplier);
        }

        $this->info('Suppliers seeded successfully!');
    }
}
