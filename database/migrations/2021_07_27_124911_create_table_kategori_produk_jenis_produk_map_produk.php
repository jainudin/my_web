<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKategoriProdukJenisProdukMapProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->uuid('kategori_id')->primary();
            $table->string('nama_kategori');
            $table->boolean('status_kategori');
            $table->timestamps();
        });

        Schema::create('jenis_produk', function (Blueprint $table) {
            $table->uuid('jenis_produk_id')->primary();
            $table->string('nama_jenis_produk');
            $table->boolean('status_jenis_produk');
            $table->timestamps();
        });

        Schema::create('produk', function (Blueprint $table) {
            $table->uuid('produk_id')->primary();
            $table->char('kategori_id',36);
            $table->string('nama_produk');
            $table->string('path_gambar_produk');
            $table->string('keterangan_produk');
            $table->boolean('status_produk');
            $table->timestamps();
        });

        Schema::create('map_jenis_produk', function (Blueprint $table) {
            $table->uuid('map_jenis_produk_id')->primary();
            $table->char('produk_id',36);
            $table->char('jenis_produk_id',36);
            $table->string('keterangan_produk');
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
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('jenis_produk');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('map_jenis_produk');
    }
}
