<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Save existing data temporarily
        $items = DB::table('service_items')->select('id', 'servicefeatures')->get();
        
        // Change column type from integer to json
        Schema::table('service_items', function (Blueprint $table) {
            $table->json('servicefeatures')->nullable()->change();
        });
        
        // Convert and update data to new format
        foreach ($items as $item) {
            if ($item->servicefeatures !== null) {
                DB::table('service_items')
                    ->where('id', $item->id)
                    ->update([
                        // Convert single integer to array format
                        'servicefeatures' => json_encode([$item->servicefeatures])
                    ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Get current data
        $items = DB::table('service_items')->select('id', 'servicefeatures')->get();
        
        // Revert column type back to integer
        Schema::table('service_items', function (Blueprint $table) {
            $table->integer('servicefeatures')->change();
        });
        
        // Convert data back to integer format
        foreach ($items as $item) {
            if ($item->servicefeatures !== null) {
                $features = json_decode($item->servicefeatures, true);
                if (is_array($features) && count($features) > 0) {
                    DB::table('service_items')
                        ->where('id', $item->id)
                        ->update([
                            // Use first element from array
                            'servicefeatures' => $features[0]
                        ]);
                }
            }
        }
    }
};