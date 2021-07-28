<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use App\Models\FeatureGroup;
use Ramsey\Uuid\Uuid;
class InsertDataGrupFiturDanFitur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    
    
    public function up()
    {
       
        DB::table('feature_group')->insert(
            array(
                [
                    
                    'feature_group_id' => Uuid::uuid4()->getHex(),
                    'feature_group_name' => 'Dashboard',
                    'feature_group_order' => '1'
                ],
                [
                    'feature_group_id' => Uuid::uuid4()->getHex(),
                    'feature_group_name' => 'Akses',
                    'feature_group_order' => '2'
                ],
                [
                    'feature_group_id' => Uuid::uuid4()->getHex(),
                    'feature_group_name' => 'Master Katalog',
                    'feature_group_order' => '3'
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
        feature_group::where('feature_group_name','Dashboard')->delete();
        feature_group::where('feature_group_name','Akses')->delete();
        feature_group::where('feature_group_name','Master Katalog')->delete();
    }
}
