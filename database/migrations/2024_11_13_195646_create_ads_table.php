<?php

use App\Enums\ButtonText;
use App\Enums\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            $table->enum('status',  ['Активен', 'В ожидании', 'В архиве']);
            $table->string('url');

            $table->integer('impressions')->default(0);
            $table->decimal('cpm', 10, 2)->default(0);
            $table->decimal('budget', 10, 2)->default(0);
            $table->enum('button_text', ['Смотреть', 'Оставить заявку', 'Скачать', 'Подробнее']);

            $table->foreignId('campaign_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
