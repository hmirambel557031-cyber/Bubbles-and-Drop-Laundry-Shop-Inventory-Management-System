<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laundry_orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            $table->foreignId('service_id')
                ->constrained('services')
                ->restrictOnDelete();

            $table->string('service_number')->unique();

            $table->decimal('kilos', 8, 2)->nullable();

            $table->decimal('detergent_quantity', 8, 2)->default(0);
            $table->decimal('fabric_conditioner_quantity', 8, 2)->default(0);

            $table->decimal('total_amount', 10, 2)->default(0);

            $table->string('status')->default('Received');

            $table->timestamp('received_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laundry_orders');
    }
};