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
        Schema::create('background_admin_photos', function (Blueprint $table) {
            $table->id();
            $table->enum('code', ['admin', 'user', 'ruangan', 'pinjamSementara', 'pinjamRuang', 'fotoBackground']);
            $table->string('img');
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
        Schema::dropIfExists('background_admin_photos');
    }
};
