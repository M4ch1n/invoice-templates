<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('invoice_number', 20)->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('invoice_due_date')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->tinyInteger('tax')->default(0);
            $table->tinyInteger('discount')->default(0);
            $table->decimal('total', 15, 2);
            $table->string('company_name', 50);
            $table->string('full_name', 50);
            $table->string('company_website', 50);
            $table->string('company_address', 50)->nullable();
            $table->string('company_city_state_zip', 40)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('company_phone', 15);
            $table->string('company_email', 30);
            $table->string('company_logo', 50)->nullable();
            $table->string('client_company_name', 50)->nullable();
            $table->string('client_full_name', 50)->nullable();
            $table->string('client_address', 50)->nullable();
            $table->string('client_city_state_zip', 40)->nullable();
            $table->string('client_country', 50)->nullable();
            $table->tinyText('notes')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
