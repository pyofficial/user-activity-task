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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')
                    ->index()->name('fk_user_activities_user_id');
            $table->foreignId('activity_id')->constrained('activities')->onDelete('cascade')
                    ->index()->name('fk_user_activities_activity_id');
            $table->boolean('status')->default(false);
            $table->integer('points')->default(0);
            $table->dateTime('performed_at')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};
