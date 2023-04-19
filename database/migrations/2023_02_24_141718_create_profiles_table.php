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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('matricule');
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->string('prestationDate');
            $table->string('address');
            $table->string('phone');
            $table->boolean('is_upToDate')->default(0)->change();
            $table->text('password')->nullable();
            $table->string('email', 100)->nullable();
            $table->timestamps();
            $table->boolean('grant_link_access_feature')->default(1);
            $table->boolean('is_link_accessible')->default(0);
            $table->boolean('is_card_lost')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
