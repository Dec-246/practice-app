<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * can add more tables here if in dev stage, but in production, you would want to create a new migration for each table
     * for production stage, do below steps
     * sail artisan make:migration add_state_to_ideas_table
     */
    public function up(): void
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();

            // assicating ideas with users
            // also deletes ideas created from user if their account is deleted
            //  need to use sail artisan migrate:fresh when updating migrations - this does clear records
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * THIS RUNS AT A ROLLBACK
     */
    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};
