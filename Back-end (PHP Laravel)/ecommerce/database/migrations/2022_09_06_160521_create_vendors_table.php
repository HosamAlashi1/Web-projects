<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name','150');
            $table->string('mobile','100');
            $table->string('logo','200');
            $table->string('email','100');
            $table->string('password'); 
            $table->text('address')->nullable();
            $table->integer('category_id');
            $table->addColumn(
                'tinyInteger', 'active',
                [
                    'length'   => 1,
                    'default'  => '0',
                    'autoIncrement' => false,
                    'comment'  => ''
                ]
            );
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
        Schema::dropIfExists('vendors');
    }
};
