// database/migrations/xxxx_xx_xx_create_car_location_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarLocationTable extends Migration
{
    public function up()
    {
        Schema::create('car_location', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('location_id');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('car_location');
    }
}
