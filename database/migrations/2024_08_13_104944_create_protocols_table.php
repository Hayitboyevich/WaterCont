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
            $table->bigInteger('protocol_number');
            $table->foreignId('region_id')->constrained();
            $table->foreignId('district_id')->constrained();
            $table->foreignId('protocol_status_id')->constrained();
            $table->text('address');
            $table->double('long');
            $table->double('lat');
            $table->string('object_name');
            $table->foreignId('violation_id')->comment('qoidabuzarlik turi')->constrained();
            $table->foreignId('repression_id')->comment('Jazo')->constrained();
            $table->float('amount')->comment('zarar summasi');
            $table->date('fixed_date');
            $table->foreignId('user_id')->comment('Inspector')->constrained()->onDelete('set null');
            $table->string('user_position')->comment('Inspector Lavozimi');
            $table->foreignId('violator_type_id')->constrained();
            $table->bigInteger('violator_pinfl');
            $table->string('violator_name');
            $table->string('violator_phone');
            $table->string('assignee_name');
            $table->string('inspector_name');
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
