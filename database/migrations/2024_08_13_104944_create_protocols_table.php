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
        Schema::create('protocols', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('protocol_number')->nullable();
            $table->foreignId('protocol_type_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('region_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('district_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('protocol_status_id')->nullable()->constrained()->onDelete('set null');
            $table->text('address')->nullable();
            $table->double('long')->nullable();
            $table->double('lat')->nullable();
            $table->string('object_name')->nullable();
            $table->foreignId('violation_id')->nullable()->comment('qoidabuzarlik turi')->constrained()->onDelete('set null');
            $table->foreignId('repression_id')->nullable()->comment('Jazo')->constrained()->onDelete('set null');
            $table->float('amount')->nullable()->comment('zarar summasi');
            $table->date('fixed_date')->nullable();
            $table->foreignId('user_id')->nullable()->comment('Inspector')->constrained()->onDelete('set null');
            $table->string('user_position')->nullable()->comment('Inspector Lavozimi');
            $table->foreignId('violator_type_id')->nullable()->constrained()->onDelete('set null');
            $table->bigInteger('violator_pinfl')->nullable();
            $table->string('violator_name')->nullable();
            $table->string('violator_phone')->nullable();
            $table->text('violator_address')->after('violator_phone')->nullable();
            $table->string('assignee_name')->nullable();
            $table->string('inspector_name')->nullable();
            $table->string('crash_diameter')->nullable();
            $table->string('crash_hour')->nullable();
            $table->string('crash_participants_count')->nullable();
            $table->string('crash_technic_count')->nullable();
            $table->foreignId('consumer_id')->nullable()->comment('istemolchi turi')->constrained()->nullOnDelete();
            $table->foreignId('building_type_id')->nullable()->comment('namuna olingan bino')->constrained()->nullOnDelete();
            $table->foreignId('organization_id')->nullable()->comment('namuna olingan joy')->constrained()->nullOnDelete();
            $table->foreignId('measure_id')->nullable()->comment('qollanilgan chora')->constrained()->nullOnDelete();
            $table->boolean('laboratory_report')->nullable()->comment('laboratoriya xulosasi');
            $table->foreignId('standart_norm_id')->nullable()->comment('standart meyorlari')->constrained()->nullOnDelete();
            $table->string('laboratory_report_indicator')->nullable()->comment('laboratoriya xulosasi korsatkichi');
            $table->boolean('technical_specifications')->nullable()->comment('texnik shartlar haqida malumotnoma');
            $table->boolean('billing')->nullable()->comment('billing bazasidagi texnik shartlar togrisidagi malumot');
            $table->boolean('contract_information')->nullable()->comment('shartnoma malumotlari');
            $table->boolean('contract_requirements')->nullable()->comment('shartnoma shartlariga rioya etilgannligi haqida');
            $table->boolean('billing_subscriber')->nullable()->comment('billing bazasidagi abonent malumotlari');
            $table->boolean('technical_requirements')->nullable()->comment('texnik shartlariga rioya etilgannligi haqida');
            $table->text('description')->nullable();
            $table->text('comment')->nullable();
            $table->text('rejected_comment')->nullable();
            $table->integer('rejected_by')->nullable();
            $table->date('rejected_at')->nullable();
            $table->date('accepted_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('protocols');
    }
};
