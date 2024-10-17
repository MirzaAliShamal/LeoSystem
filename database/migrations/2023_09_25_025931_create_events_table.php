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
        Schema::dropIfExists('events');
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->bigInteger('user_id');
            $table->text('title');
            $table->text('slug');
            $table->string('event_category');
            $table->tinyInteger('event_status')->default(1)->comment('1=active_event, 2=past_event, 3=future_event');
            $table->tinyInteger('ticket_type')->default(1)->comment('1=standard, 2=advanced, 3=pro, 4=vip');
            $table->tinyInteger('country_id');
            $table->tinyInteger('state_id');
            $table->tinyInteger('city_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('event_duration')->comment('duration must be minutes');
            $table->integer('min_members');
            $table->integer('max_members');
            $table->text('event_organizer');
            $table->string('event_language');
            $table->string('num_lead_teachers');
            $table->text('name_lead_teachers');
            $table->text('event_sponsors');
            $table->string('buffet_reception');
            $table->string('event_entertainment');
            $table->string('event_prizes');
            $table->string('event_materials');
            $table->string('event_books');
            $table->string('event_quizzes');
            $table->string('event_testing');
            $table->string('event_party');
            $table->string('event_transfer');
            $table->string('event_certificate');
            $table->string('standard_ticket_price');
            $table->string('standard_ticket_price_discount');
            $table->string('advanced_ticket_price');
            $table->string('pro_ticket_price');
            $table->string('vip_ticket_price');
            $table->string('logo_image')->nullable();
            $table->string('main_image')->nullable();
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
        Schema::dropIfExists('events');
    }
};
