<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColomInTableKatalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       

        Schema::table('kategori', function($table) {
            $table->string('path_gambar_kategori');
            $table->string('keterangan_kategori');
            $table->integer('order_kategori');
        });

        Schema::create('list_gambar_produk', function (Blueprint $table) {
            $table->uuid('list_gambar_produk_id')->primary();
            $table->char('produk_id', 36);
            $table->string('path_list_gambar_produk');
            $table->string('nama_file_image');
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
        Schema::table('kategori', function($table) {
            $table->dropColumn('path_gambar_kategori');
            $table->dropColumn('keterangan_kategori');
        });

        Schema::dropIfExists('list_gambar_produk');
    }
}
