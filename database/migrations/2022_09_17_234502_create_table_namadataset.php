<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableNamadataset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('namadataset', function (Blueprint $table) {
            $table->id();
            $table->string('namaData');
            $table->float('akurasi', 4,2)->nullable();
            $table->float('deviasi', 4,2)->nullable();
            $table->timestamps();
        });

        Schema::table('dataset', function (Blueprint $table) {
            $table->foreign('id_dataset')
                  ->references('id')
                  ->on('namadataset')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dataset', function (Blueprint $table) {
            $table->dropForeign('dataset_id_dataset_foreign');
        });

        Schema::dropIfExists('namadataset');
    }
}
