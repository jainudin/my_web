<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSosialMediaAndCompanyProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_sosial_media', function (Blueprint $table) {
            $table->uuid('jenis_sosial_media_id')->primary();
            $table->string('nama_jenis_sosial_media');
            $table->string('url_path_sosial_media');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('sosial_media', function (Blueprint $table) {
            $table->uuid('sosial_media_id')->primary();
            $table->char('user_id', 36);
            $table->char('jenis_sosial_media_id', 36);
            $table->string('URL');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('contact_person', function (Blueprint $table) {
            $table->uuid('contact_person_id')->primary();
            $table->char('user_id', 36);
            $table->string('nomor_telepon');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('profil_perusahaan', function (Blueprint $table) {
            $table->uuid('profil_perusahaan_id')->primary();
            $table->string('nama_perusahaan');
            $table->string('alamat_perusahaan');
            $table->string('path_foto_perusahaan');
            $table->string('path_logo_perusahaan');
            $table->string('website_perusahaan');
            $table->string('email_perusahaan');
            $table->text('tentang_perusahaan');
            $table->string('status');
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
        Schema::dropIfExists('jenis_sosial_media');
        Schema::dropIfExists('sosial_media');
        Schema::dropIfExists('contact_person');
        Schema::dropIfExists('profil_perusahaan');
    }
}
