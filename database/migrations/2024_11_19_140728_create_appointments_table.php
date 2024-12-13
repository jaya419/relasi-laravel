<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        $table->string('foto');
        $table->string('name');
        $table->string('alamat');
        $table->string('jenis_kelamin');
        $table->string('phone');        
        $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
        $table->date('appointment_date');
        $table->string('status');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('appointments');
}

};
