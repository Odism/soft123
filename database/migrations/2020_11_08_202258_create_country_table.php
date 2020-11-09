<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $date = new DateTime();
        $unixTimeStamp = $date->getTimeStamp();
        
        Schema::create('country', function (Blueprint $table) {
            $table->Increments('id', true)->unsigned();
            $table->string('code', 3);
            $table->string('name', 99)->default('');
            $table->string('dname', 99)->default('');
            $table->smallinteger('num_code');
            $table->mediuminteger('phone_code');
            
            $table->integer('created')->unsigned();
            $table->integer('register_by')->unsigned();
            $table->integer('modified')->unsigned();
            $table->integer('modified_by')->unsigned();
            $table->boolean('record_deleted')->default(0);

            $table->engine = 'InnoDB';
        });

        DB::table('country')->insert([
          
            [
                'code' => 'pk',
                'name' => 'Pakistan',
                'dname' => 'pakistan',
                'num_code' => 0,
                'phone_code' => 92,
                'created' => $unixTimeStamp,
                'register_by' => 1,
                'modified' => $unixTimeStamp,
                'modified_by' => 1
            ]
        ]);

        Schema::create('Country_state', function (Blueprint $table) {
            $table->Increments('id', true)->unsigned();
            $table->integer('country_id')->unsigned();
            $table->string('name', 99)->default('');
            $table->string('code', 10)->default('');
           
            $table->integer('created')->unsigned();
            $table->integer('register_by')->unsigned();
            $table->integer('modified')->unsigned();
            $table->integer('modified_by')->unsigned();
            $table->boolean('record_deleted')->default(0);

            $table->engine = 'InnoDB';
        });

        Schema::table('country_state',function(Blueprint $table){
            $table->foreign('country_id')->references('id')->on('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country');
    }
}
