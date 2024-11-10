<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('savings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('amount', 20, 2);
            $table->decimal('goal', 20, 2)->nullable();
            $table->text('description')->nullable();
            $table->foreignIdFor(\App\Models\User::class)->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('savings');
    }
};
