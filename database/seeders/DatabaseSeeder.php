<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\InventoryItem;
use App\Models\InventoryTransaction;
use App\Models\LaundryOrder;
use App\Models\Machine;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@bubblesdrop.com',
            'password' => Hash::make('admin12345'),
            'role' => 'admin',
        ]);

        // Staff
        User::create([
            'name' => 'Laundry Staff',
            'email' => 'staff@bubblesdrop.com',
            'password' => Hash::make('staff12345'),
            'role' => 'staff',
        ]);

        // Services
        Service::create([
            'service_name' => 'Wash, Dry, and Fold',
            'price' => 210,
            'description' => 'Complete wash, dry, and fold laundry service.',
        ]);

        Service::create([
            'service_name' => 'Self Service',
            'price' => 100,
            'description' => 'Customer-operated washing service.',
        ]);

        Service::create([
            'service_name' => 'Detergent',
            'price' => 10,
            'description' => 'Laundry detergent.',
        ]);

        Service::create([
            'service_name' => 'Fabric Conditioner',
            'price' => 15,
            'description' => 'Laundry fabric conditioner.',
        ]);

        // Customers
        Customer::create([
            'customer_code' => '101',
            'full_name' => 'Maria Santos',
            'contact_number' => '09171234567',
        ]);

        Customer::create([
            'customer_code' => '102',
            'full_name' => 'Juan Dela Cruz',
            'contact_number' => '09181234567',
        ]);

        // Inventory
        InventoryItem::create([
            'item_name' => 'Detergent',
            'category' => 'Laundry Supply',
            'quantity' => 50,
            'reorder_level' => 10,
            'unit' => 'piece',
        ]);

        InventoryItem::create([
            'item_name' => 'Fabric Conditioner',
            'category' => 'Laundry Supply',
            'quantity' => 35,
            'reorder_level' => 10,
            'unit' => 'piece',
        ]);

        // Machines
        for ($i = 1; $i <= 5; $i++) {
            Machine::create([
                'machine_name' => 'Washer ' . $i,
                'status' => 'Available',
                'maintenance_period' => 'Every 3 months',
            ]);
        }

        // Test laundry order
        $customer = Customer::where('customer_code', '101')->first();

        $service = Service::where(
            'service_name',
            'Wash, Dry, and Fold'
        )->first();

        LaundryOrder::create([
            'customer_id' => $customer->id,
            'service_id' => $service->id,
            'service_number' => 'WDF-00125',
            'kilos' => 8,
            'detergent_quantity' => 1,
            'fabric_conditioner_quantity' => 1,
            'total_amount' => 210,
            'status' => 'Ready for Pickup',
            'received_at' => now(),
        ]);
    }
}