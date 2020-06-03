<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $collection) {
            $collection->bigIncrements('id');
            $collection->index('country._id');
            $collection->index('city._id');
            $collection->index([
                    'name' => 'text',
                    'biography' => 'text',
                    'specialities' => 'text',
                    'keywords' => 'text',
                    'establishments.*.name' => 'text'
                ],
                'doctors_full_text',
                null,
                [
                    "weights" => [
                        "name" => 25,
                        "biography" => 12,
                        "specialises" => 8,
                        "keywords" => 8,
                        "establishments.*.name" => 6,
                    ],
                    'name' => 'doctors_full_text'
                ]
            );
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
