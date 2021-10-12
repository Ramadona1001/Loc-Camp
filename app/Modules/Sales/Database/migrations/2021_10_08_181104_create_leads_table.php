<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->text('industry')->nullable();
            $table->text('company_head_count')->nullable();
            $table->text('company_name')->nullable();
            $table->text('url')->nullable();
            $table->text('company_hq')->nullable();
            $table->text('company_zone')->nullable();
            $table->text('contact_name')->nullable();
            $table->text('title')->nullable();
            $table->text('office')->nullable();
            $table->text('email')->nullable();
            $table->text('phone_skype')->nullable();
            $table->text('social_media')->nullable();
            $table->text('action')->nullable();
            $table->text('customer_status')->nullable();
            $table->text('follow_up')->nullable();
            $table->text('comments')->nullable();
            $table->text('campaign')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
