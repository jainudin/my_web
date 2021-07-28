<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;
class CreateTableFiturDanInsertDataFitur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature', function (Blueprint $table) {
            $table->uuid('feature_id')->primary();
            $table->char('feature_group_id', 36);
            $table->string('feature_name');
            $table->string('feature_url');
            $table->string('feature_icon');
            $table->integer('feature_order');
            $table->timestamps();
        });
        $feature_group = App\Models\FeatureGroup::where('feature_group_name', 'Dashboard')->first();
        DB::table('feature')->insert(
            array(
                
                [
                    
                    'feature_id' => Uuid::uuid4()->getHex(),
                    'feature_group_id' => $feature_group->feature_group_id,
                    'feature_name' => 'Home',
                    'feature_order' => '1',
                    'feature_icon' => 'mdi mdi-home',
                    'feature_url' => '/home',
                ],
                
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature');
    }
}
