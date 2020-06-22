<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrateLevelDayTable extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_day', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('plan_id');
            $table->string('level_name');
            $table->string('day_name');
            $table->string('first_defination');
            $table->string('second_defination');
            $table->integer('no_of_round');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('level_day');
    }
}
