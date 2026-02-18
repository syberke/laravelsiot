    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\TitleContoller;
    use App\Http\Controllers\RouteContoller;
    use App\Http\Controllers\QueryContoller;
    use App\Http\Controllers\PostContoller;
use App\Http\Controllers\SensorController;


Route::resource('sensor', SensorController::class);


Route::get('/', [SensorController::class, 'index']);




