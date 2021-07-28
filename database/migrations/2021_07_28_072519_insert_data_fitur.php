<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;
class InsertDataFitur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $feature_group = App\Models\FeatureGroup::where('feature_group_name', 'Master Katalog')->first();
        DB::table('feature')->insert(
            array(
                
                [
                    
                    'feature_id' => Uuid::uuid4()->getHex(),
                    'feature_group_id' => $feature_group->feature_group_id,
                    'feature_name' => 'Kategori',
                    'feature_order' => '1',
                    'feature_icon' => 'mdi mdi-home',
                    'feature_url' => '/kategori',
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
        //
    }
}
