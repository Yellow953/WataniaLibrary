<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ReportController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

// Auth
Route::middleware(['auth'])->group(function () {
    // Logout
    Route::get('/custom_logout', [AppController::class, 'custom_logout'])->name('custom_logout');

    // App
    Route::prefix('app')->group(function () {
        // Switch Currency
        Route::get('/currencies/switch/{currency}', [CurrencyController::class, 'switch'])->name('currencies.switch');
        // Switch Tax
        Route::get('/taxes/switch/{tax}', [TaxController::class, 'switch'])->name('taxes.switch');

        Route::get('/products/barcode/{barcode}', [ProductController::class, 'barcode'])->name('products.barcode');

        // Navigation
        Route::post('/navigate', [AppController::class, 'navigate'])->name('navigate');

        // Quick Actions
        Route::prefix('quick')->group(function () {
            Route::post('/new_client', [ClientController::class, 'new_client'])->name('quick.new_client');
            Route::post('/new_debt', [DebtController::class, 'new_debt'])->name('quick.new_debt');
            Route::post('/reports/create', [ReportController::class, 'create'])->name('reports.create');
        });

        // Users
        Route::prefix('users')->group(function () {
            Route::get('/export', [UserController::class, 'export'])->name('users.export');
            Route::get('/new', [UserController::class, 'new'])->name('users.new');
            Route::post('/create', [UserController::class, 'create'])->name('users.create');
            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
            Route::post('/update/{user}', [UserController::class, 'update'])->name('users.update');
            Route::get('/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
            Route::get('/', [UserController::class, 'index'])->name('users');
        });

        // Taxes Routes
        Route::prefix('taxes')->group(function () {
            Route::get('/export', [TaxController::class, 'export'])->name('taxes.export');
            Route::get('/new', [TaxController::class, 'new'])->name('taxes.new');
            Route::post('/create', [TaxController::class, 'create'])->name('taxes.create');
            Route::get('/{tax}/edit', [TaxController::class, 'edit'])->name('taxes.edit');
            Route::post('/{tax}/update', [TaxController::class, 'update'])->name('taxes.update');
            Route::get('/{tax}/delete', [TaxController::class, 'destroy'])->name('taxes.destroy');
            Route::get('/', [TaxController::class, 'index'])->name('taxes');
        });

        // Backup
        Route::prefix('backup')->group(function () {
            Route::get('/export', [BackupController::class, 'export'])->name('backup.export');
            Route::post('/import', [BackupController::class, 'import'])->name('backup.import');
            Route::get('/', [BackupController::class, 'index'])->name('backup');
        });

        // Profile Routes
        Route::prefix('profile')->group(function () {
            Route::post('/save_password', [ProfileController::class, 'save_password'])->name('profile.save_password');
            Route::get('/deactivate', [ProfileController::class, 'deactivate'])->name('profile.deactivate');
            Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
            Route::get('/', [ProfileController::class, 'show'])->name('profile');
        });

        // Logs
        Route::prefix('logs')->group(function () {
            Route::get('/export', [LogController::class, 'export'])->name('logs.export');
            Route::get('/fetch', [LogController::class, 'fetch'])->name('logs.fetch');
            Route::get('/', [LogController::class, 'index'])->name('logs');
        });

        // Notifications
        Route::prefix('notifications')->group(function () {
            Route::get('/fetch', [NotificationController::class, 'fetch'])->name('notifications.fetch');
            Route::get('/', [NotificationController::class, 'index'])->name('notifications');
        });

        // Todos
        Route::prefix('todos')->group(function () {
            Route::post('/create', [TodoController::class, 'create'])->name('todos.create');
            Route::get('/delete/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
            Route::get('/complete/{todo}', [TodoController::class, 'complete'])->name('todos.complete');
            Route::get('/fetch', [TodoController::class, 'fetch'])->name('todos.fetch');
        });

        // Categories
        Route::prefix('categories')->group(function () {
            Route::get('/export', [CategoryController::class, 'export'])->name('categories.export');
            Route::get('/new', [CategoryController::class, 'new'])->name('categories.new');
            Route::post('/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::post('/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
            Route::get('/{category}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
            Route::get('/', [CategoryController::class, 'index'])->name('categories');
        });

        // Products
        Route::prefix('products')->group(function () {
            Route::get('/secondary_images/{secondary_image}/delete', [ProductController::class, 'secondary_image_delete'])->name('products.secondary_images.delete');
            Route::get('/variants/{variant}/delete', [ProductController::class, 'variant_delete'])->name('products.variants.delete');
            Route::get('/variant_options/{variant_option}/delete', [ProductController::class, 'variant_option_delete'])->name('products.variant_options.delete');
            Route::get('/export', [ProductController::class, 'export'])->name('products.export');
            Route::post('/import', [ProductController::class, 'import'])->name('products.import');
            Route::get('/sample', [ProductController::class, 'sample'])->name('products.sample');
            Route::get('/new', [ProductController::class, 'new'])->name('products.new');
            Route::post('/create', [ProductController::class, 'create'])->name('products.create');
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
            Route::post('/{product}/update', [ProductController::class, 'update'])->name('products.update');
            Route::get('/{product}/add', [ProductController::class, 'add'])->name('products.add');
            Route::get('/generate_barcodes', [ProductController::class, 'generate_barcodes'])->name('products.generate_barcodes');
            Route::post('/{product}/save', [ProductController::class, 'save'])->name('products.save');
            Route::get('/{product}/destroy', [ProductController::class, 'destroy'])->name('products.destroy');
            Route::get('/', [ProductController::class, 'index'])->name('products');
        });

        // Orders
        Route::prefix('orders')->group(function () {
            Route::get('/export', [OrderController::class, 'export'])->name('orders.export');
            Route::get('/new', [OrderController::class, 'new'])->name('orders.new');
            Route::post('/create', [OrderController::class, 'create'])->name('orders.create');
            Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
            Route::post('/{order}/update', [OrderController::class, 'update'])->name('orders.update');
            Route::get('/{order}/destroy', [OrderController::class, 'destroy'])->name('orders.destroy');
            Route::get('/{order}/show', [OrderController::class, 'show'])->name('orders.show');
            Route::get('/', [OrderController::class, 'index'])->name('orders');
        });

        // Reports Routes
        Route::prefix('reports')->group(function () {
            Route::get('/export', [ReportController::class, 'export'])->name('reports.export');
            Route::get('/pdf', [ReportController::class, 'pdf'])->name('reports.pdf');
            Route::get('/{report}/delete', [ReportController::class, 'destroy'])->name('reports.destroy');
            Route::get('/{report}/show', [ReportController::class, 'show'])->name('reports.show');
            Route::get('/', [ReportController::class, 'index'])->name('reports');
        });

        // Debts Routes
        Route::prefix('debts')->group(function () {
            Route::get('/export', [DebtController::class, 'export'])->name('debts.export');
            Route::get('/new', [DebtController::class, 'new'])->name('debts.new');
            Route::post('/create', [DebtController::class, 'create'])->name('debts.create');
            Route::get('/{debt}/edit', [DebtController::class, 'edit'])->name('debts.edit');
            Route::post('/{debt}/update', [DebtController::class, 'update'])->name('debts.update');
            Route::get('/{debt}/delete', [DebtController::class, 'destroy'])->name('debts.destroy');
            Route::get('/', [DebtController::class, 'index'])->name('debts');
        });

        // Clients Routes
        Route::prefix('clients')->group(function () {
            Route::get('/export', [ClientController::class, 'export'])->name('clients.export');
            Route::get('/fetch', [ClientController::class, 'fetch'])->name('clients.fetch');
            Route::get('/new', [ClientController::class, 'new'])->name('clients.new');
            Route::post('/create', [ClientController::class, 'create'])->name('clients.create');
            Route::get('/{client}/history', [ClientController::class, 'history'])->name('clients.history');
            Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
            Route::post('/{client}/update', [ClientController::class, 'update'])->name('clients.update');
            Route::get('/{client}/delete', [ClientController::class, 'destroy'])->name('clients.destroy');
            Route::get('/', [ClientController::class, 'index'])->name('clients');
        });

        // Suppliers Routes
        Route::prefix('suppliers')->group(function () {
            Route::get('/export', [SupplierController::class, 'export'])->name('suppliers.export');
            Route::get('/new', [SupplierController::class, 'new'])->name('suppliers.new');
            Route::post('/create', [SupplierController::class, 'create'])->name('suppliers.create');
            Route::get('/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
            Route::post('/{supplier}/update', [SupplierController::class, 'update'])->name('suppliers.update');
            Route::get('/{supplier}/delete', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
            Route::get('/', [SupplierController::class, 'index'])->name('suppliers');
        });

        // Purchases Routes
        Route::prefix('purchases')->group(function () {
            Route::get('/export', [PurchaseController::class, 'export'])->name('purchases.export');
            Route::get('/pdf', [PurchaseController::class, 'pdf'])->name('purchases.pdf');
            Route::get('/new', [PurchaseController::class, 'new'])->name('purchases.new');
            Route::post('/create', [PurchaseController::class, 'create'])->name('purchases.create');
            Route::get('/items/{purchase_item}/delete', [PurchaseController::class, 'purchase_item_destroy'])->name('purchases.items.destroy');
            Route::get('/{purchase}/show', [PurchaseController::class, 'show'])->name('purchases.show');
            Route::get('/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
            Route::post('/{purchase}/update', [PurchaseController::class, 'update'])->name('purchases.update');
            Route::get('/{purchase}/delete', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
            Route::get('/', [PurchaseController::class, 'index'])->name('purchases');
        });

        // Expenses Routes
        Route::prefix('expenses')->group(function () {
            Route::get('/export', [ExpenseController::class, 'export'])->name('expenses.export');
            Route::get('/pdf', [ExpenseController::class, 'pdf'])->name('expenses.pdf');
            Route::get('/new', [ExpenseController::class, 'new'])->name('expenses.new');
            Route::post('/create', [ExpenseController::class, 'create'])->name('expenses.create');
            Route::get('/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
            Route::post('/{expense}/update', [ExpenseController::class, 'update'])->name('expenses.update');
            Route::get('/{expense}/delete', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
            Route::get('/', [ExpenseController::class, 'index'])->name('expenses');
        });

        // Currency Routes
        Route::prefix('currencies')->group(function () {
            Route::get('/export', [CurrencyController::class, 'export'])->name('currencies.export');
            Route::get('/new', [CurrencyController::class, 'new'])->name('currencies.new');
            Route::post('/create', [CurrencyController::class, 'create'])->name('currencies.create');
            Route::get('/{currency}/edit', [CurrencyController::class, 'edit'])->name('currencies.edit');
            Route::post('/{currency}/update', [CurrencyController::class, 'update'])->name('currencies.update');
            Route::get('/{currency}/delete', [CurrencyController::class, 'destroy'])->name('currencies.destroy');
            Route::get('/', [CurrencyController::class, 'index'])->name('currencies');
        });

        // Promos Routes
        Route::prefix('promos')->group(function () {
            Route::get('/export', [PromoController::class, 'export'])->name('promos.export');
            Route::get('/new', [PromoController::class, 'new'])->name('promos.new');
            Route::post('/create', [PromoController::class, 'create'])->name('promos.create');
            Route::get('/{promo}/edit', [PromoController::class, 'edit'])->name('promos.edit');
            Route::post('/{promo}/update', [PromoController::class, 'update'])->name('promos.update');
            Route::get('/{promo}/delete', [PromoController::class, 'destroy'])->name('promos.destroy');
            Route::get('/', [PromoController::class, 'index'])->name('promos');
        });

        // Analytics
        Route::prefix('analytics')->group(function () {
            Route::get('/pdf-report', [AnalyticsController::class, 'generatePdfReport'])->name('analytics.pdf');
            Route::get('/monthly-report', [AnalyticsController::class, 'monthlyReport'])->name('analytics.monthly-report');
            Route::get('/custom-report', [AnalyticsController::class, 'customReport'])->name('analytics.custom-report');
            Route::get('/hourly-orders', [AnalyticsController::class, 'getHourlyOrders'])->name('analytics.hourly-orders');
            Route::get('/', [AnalyticsController::class, 'index'])->name('analytics');
        });

        // Checkout & Sync
        Route::post('/checkout', [AppController::class, 'checkout'])->name('checkout');
        Route::post('/sync', [AppController::class, 'sync'])->name('sync');

        Route::get('/fix', [AppController::class, 'fix'])->name('fix');

        // Dashboard
        Route::get('/', [AppController::class, 'index'])->name('dashboard');
    });
});

// Frontend

// Policies
Route::get('/terms_and_conditions', [HomeController::class, 'terms_and_conditions'])->name('terms_and_conditions');
Route::get('/privacy_policy', [HomeController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/return_policy', [HomeController::class, 'return_policy'])->name('return_policy');

// Shop
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/product/{product:name}', [HomeController::class, 'product'])->name('product');

// Checkout
Route::get('/checkout', [HomeController::class, 'checkout'])->name('shop.checkout');
Route::post('/checkout/order', [HomeController::class, 'order'])->name('checkout.order');

// Search
Route::get('/search/products', [HomeController::class, 'search'])->name('products.search');

// Check Promo
Route::post('/check', [HomeController::class, 'check'])->name('promos.check');

// Contact
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact/send', [HomeController::class, 'contact_send'])->name('contact.send');

Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/', [HomeController::class, 'index'])->name('home');
