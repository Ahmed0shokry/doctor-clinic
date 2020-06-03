<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablishmentsCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishments', function (Blueprint $collection) {
            $collection->bigIncrements('id');
            $collection->index('branches.*.country._id');
            $collection->index('branches.*.city._id');
            $collection->index('branches.*.area._id');
            $collection->index('section._id');
            $collection->index([
                'name' => 'text',
                'biography' => 'text',
                'specialises' => 'text',
                'keywords' => 'text',
            ],
                'doctors_full_text',
                null,
                [
                    "weights" => [
                        "name" => 25,
                        "biography" => 12,
                        "specialities" => 8,
                        "keywords" => 8,
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
        Schema::dropIfExists('establishments');
    }
}
