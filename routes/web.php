    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\DashboardComicController;
    use App\Http\Controllers\ImageProxyController;
    use App\Http\Controllers\ComicController;
    
 
    
    
    Route::get('/', [HomeController::class, 'index'])->name('home');


    //Auth
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth', 'isAdmin'])
        ->name('dashboard');

    // Dashboard - comics CRUD (admin)
    Route::middleware(['auth', 'isAdmin'])->group(function () {
        Route::resource('/dashboard/comics', DashboardComicController::class)
            ->names('dashboard.comics')
            ->except(['show']);
    });
    Route::get('/comics/{id}', [ComicController::class, 'show'])->name('comic.show');

    // Profile (protected)
    Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile');
