<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wells', function (Blueprint $table) {
            $table->id();
            $table->text('object_name');
            $table->foreignId('protocol_id')->constrained()->onDelete('cascade');
            $table->integer('well_status_id')->index();
            $table->boolean('technical_passport')->default(false);
            $table->boolean('license')->default(false);
            $table->integer('counter_info_id')->index();
            $table->string('chlorination_device')->nullable();
            $table->string('bactericidal_device')->nullable();
            $table->string('other_device')->nullable();
            $table->boolean('not_device')->default(false);
            $table->integer('smz_id')->index();
            $table->integer('debit_id')->index();
            $table->foreignId('repression_id')->comment('Jazo')->constrained()->onDelete('set null');
            $table->float('amount')->comment('zarar summasi');
            $table->date('fixed_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wells');
    }
};
