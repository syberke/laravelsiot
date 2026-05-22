    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\TitleContoller;
    use App\Http\Controllers\RouteContoller;
    use App\Http\Controllers\QueryContoller;
    use App\Http\Controllers\PostContoller;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\DeviceController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('sensor',SensorController::class);
Route::resource('device',DeviceController::class);





