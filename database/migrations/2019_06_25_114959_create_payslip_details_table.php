<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayslipDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payslip_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('payslip_id');
            $table->foreign('payslip_id')->references('id')->on('payslips')->onDelete('cascade');
            $table->string('name');
            $table->string('type');
            $table->bigInteger('amount');
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
        Schema::dropIfExists('payslip_details');
    }
}
