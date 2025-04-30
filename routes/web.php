<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;
use App\Models\DeviceIp;
use App\Models\Pcap;
use App\Models\Process;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Inventory
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

// Fragenkatalog

// Pcap Analyzer
Route::get('pcaps', [\App\Http\Controllers\PcapAnalyzerController::class, 'index'])
    ->name('pcaps')
    ->middleware('auth')
    ->breadcrumb('Pcaps');;

Route::post('pcaps', [\App\Http\Controllers\PcapAnalyzerController::class, 'store'])
    ->name('pcaps.store')
    ->middleware('auth');

Route::get('pcaps/create', [\App\Http\Controllers\PcapAnalyzerController::class, 'create'])
    ->name('pcaps.create')
    ->middleware('auth');

Route::delete('pcaps/{pcap}/delete', [\App\Http\Controllers\PcapController::class, 'destroy'])
    ->name('pcap.destroy')
    ->middleware('auth');

Route::post('pcaps/{pcap}/analyze', [\App\Http\Controllers\PcapController::class, 'analyze'])
    ->name('pcap.analyze')
    ->middleware('auth');

Route::get('pcaps/{pcap}/show', [\App\Http\Controllers\PcapController::class, 'show'])
    ->name('pcap.show')
    ->middleware('auth')
    ->breadcrumb(fn(Pcap $pcap) => $pcap->name, 'process.show', fn(Pcap $pcap) => $pcap->process);

// View analyzings
Route::get('analyzings/{pcapId}', [\App\Http\Controllers\PcapAnalyzerController::class, 'show'])
    ->name('pcaps.show')
    ->middleware('auth')
    ->breadcrumb('Details', 'pcaps');

Route::get('analyzings/{pcapId}/download', [\App\Http\Controllers\PcapAnalyzerController::class, 'download'])
    ->name('pcaps.download')
    ->middleware('auth');


Route::middleware(['auth'])->group(function() {
    Route::resource('device', \App\Http\Controllers\DeviceController::class);
    Route::resource('deviceMeta', \App\Http\Controllers\DeviceMetaController::class);
    Route::resource('customer', \App\Http\Controllers\CustomerController::class);
    Route::resource('manufacturer', \App\Http\Controllers\ManufacturerController::class);
    Route::resource('deviceType', \App\Http\Controllers\DeviceTypeController::class);
});

/* ##################### Devices ############################# */


Route::get('process/{process}/devices', [\App\Http\Controllers\ProcessDevicesController::class, 'show'])
    ->name('process.devices')
    ->middleware('auth')
    ->breadcrumb(fn(Process $process) => $process->name, 'process.index');

Route::post('process/{process}/devices', [\App\Http\Controllers\ProcessDevicesController::class, 'store'])
    ->name('process.devices.store')
    ->middleware('auth');

Route::post('devices/{device}/ip', [\App\Http\Controllers\ProcessDevicesController::class, 'addIp'])
    ->name('process.devices.ip.store')
    ->middleware('auth');

Route::delete('ip/{deviceIp}', [\App\Http\Controllers\ProcessDevicesController::class, 'removeIp'])
    ->name('process.devices.ip.delete')
    ->middleware('auth');

Route::patch('devices/{device}', [\App\Http\Controllers\ProcessDevicesController::class, 'update'])
    ->name('process.devices.update')
    ->middleware('auth');

Route::delete('devices/{device}', [\App\Http\Controllers\ProcessDevicesController::class, 'destroy'])
    ->name('process.devices.delete')
    ->middleware('auth');
/* ##################### End Devices ############################# */

/* ##################### Process ############################# */
Route::get('process', [\App\Http\Controllers\ProcessController::class, 'index'])
    ->name('process.index')
    ->middleware('auth')
    ->breadcrumb('Vorgänge');

Route::get('process/create', [\App\Http\Controllers\ProcessController::class, 'create'])
    ->name('process.create')
    ->middleware('auth')
    ->breadcrumb('Erstellen', 'process.index');

Route::get('process/{process}/show', [\App\Http\Controllers\ProcessController::class, 'pcaps'])
    ->name('process.show')
    ->middleware('auth')
    ->breadcrumb(fn(Process $process) => $process->name, 'process.index');

Route::get('process/{process}/pcaps', [\App\Http\Controllers\ProcessController::class, 'pcaps'])
    ->name('process.pcaps')
    ->middleware('auth')
    ->breadcrumb(fn(Process $process) => $process->name, 'process.index');

Route::get('pcap/{pcap}/download', [\App\Http\Controllers\PcapController::class, 'download'])
    ->name('pcap.download')
    ->middleware('auth');

Route::post('process', [\App\Http\Controllers\ProcessController::class, 'store'])
    ->name('process.store')
    ->middleware('auth');




Route::post('process/{process}/pcapupload', [\App\Http\Controllers\ProcessController::class, 'pcapUpload'])
    ->name('process.pcapUpload')
    ->middleware('auth');

Route::get('process/{process}/auswertung', [\App\Http\Controllers\ProcessAnalysisController::class, 'show'])
    ->name('process.auswertung');

Route::post('process/{process}/auswertung', [\App\Http\Controllers\ProcessAnalysisController::class, 'analyze'])
    ->name('process.auswertung');

Route::get('process/{process}/auswertung/download', [\App\Http\Controllers\ProcessAnalysisController::class, 'download'])
    ->name('process.auswertung.download');

 Route::get('process/{process}/settings', [\App\Http\Controllers\ProcessSettingsController::class, 'show' ])
     ->name('process.settings');

Route::post('process/{process}/settings', [\App\Http\Controllers\ProcessSettingsController::class, 'store' ])
    ->name('process.settings.store');



// Device

// Users
Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');


// Organizations

Route::get('organizations', [OrganizationsController::class, 'index'])
    ->name('organizations')
    ->middleware('auth');

Route::get('organizations/create', [OrganizationsController::class, 'create'])
    ->name('organizations.create')
    ->middleware('auth');

Route::post('organizations', [OrganizationsController::class, 'store'])
    ->name('organizations.store')
    ->middleware('auth');

Route::get('organizations/{organization}/edit', [OrganizationsController::class, 'edit'])
    ->name('organizations.edit')
    ->middleware('auth');

Route::put('organizations/{organization}', [OrganizationsController::class, 'update'])
    ->name('organizations.update')
    ->middleware('auth');

Route::delete('organizations/{organization}', [OrganizationsController::class, 'destroy'])
    ->name('organizations.destroy')
    ->middleware('auth');

Route::put('organizations/{organization}/restore', [OrganizationsController::class, 'restore'])
    ->name('organizations.restore')
    ->middleware('auth');

// Contacts

Route::get('contacts', [ContactsController::class, 'index'])
    ->name('contacts')
    ->middleware('auth');

Route::get('contacts/create', [ContactsController::class, 'create'])
    ->name('contacts.create')
    ->middleware('auth');

Route::post('contacts', [ContactsController::class, 'store'])
    ->name('contacts.store')
    ->middleware('auth');

Route::get('contacts/{contact}/edit', [ContactsController::class, 'edit'])
    ->name('contacts.edit')
    ->middleware('auth');

Route::put('contacts/{contact}', [ContactsController::class, 'update'])
    ->name('contacts.update')
    ->middleware('auth');

Route::delete('contacts/{contact}', [ContactsController::class, 'destroy'])
    ->name('contacts.destroy')
    ->middleware('auth');

Route::put('contacts/{contact}/restore', [ContactsController::class, 'restore'])
    ->name('contacts.restore')
    ->middleware('auth');

// Reports

Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');

