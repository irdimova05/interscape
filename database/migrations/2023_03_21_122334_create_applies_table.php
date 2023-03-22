<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->text('folder_path');
            $table->text('description')->nullable();
            $table->foreignId('apply_status_id')->constrained('apply_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applies', function (Blueprint $table) {
            $table->dropForeign(['ad_id', 'user_id', 'apply_status_id']);
        });
        Schema::dropIfExists('applies');
    }
};
