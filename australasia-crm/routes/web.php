<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Auth Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('custom.auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard.index'))->name('dashboard');

    // =============================================
    // FOREIGN EMPLOYMENT
    // =============================================
    Route::prefix('employment')->name('employment.')->group(function () {

        Route::get('/', fn() => view('employment.dashboard'))->name('dashboard');

        // Leads
        Route::get('/leads', fn() => view('employment.leads.index'))->name('leads.index');
        Route::get('/leads/create', fn() => view('employment.leads.create'))->name('leads.create');
        Route::get('/leads/{id}', fn($id) => view('employment.leads.show', ['id' => $id]))->name('leads.show');

        // Candidates
        Route::get('/candidates', fn() => view('employment.candidates.index'))->name('candidates.index');
        Route::get('/candidates/create', fn() => view('employment.candidates.create'))->name('candidates.create');
        Route::get('/candidates/{id}', fn($id) => view('employment.candidates.show', ['id' => $id]))->name('candidates.show');
        Route::get('/candidates/{id}/edit', fn($id) => view('employment.candidates.edit', ['id' => $id]))->name('candidates.edit');

        // Talent Pool
        Route::get('/talent-pool', fn() => view('employment.talent-pool.index'))->name('talent-pool');

        // Employers
        Route::get('/employers', fn() => view('employment.employers.index'))->name('employers.index');
        Route::get('/employers/create', fn() => view('employment.employers.create'))->name('employers.create');
        Route::get('/employers/{id}', fn($id) => view('employment.employers.show', ['id' => $id]))->name('employers.show');

        // Vacancies
        Route::get('/vacancies', fn() => view('employment.vacancies.index'))->name('vacancies.index');
        Route::get('/vacancies/create', fn() => view('employment.vacancies.create'))->name('vacancies.create');
        Route::get('/vacancies/{id}', fn($id) => view('employment.vacancies.show', ['id' => $id]))->name('vacancies.show');

        // Matching
        Route::get('/matching', fn() => view('employment.matching.index'))->name('matching');

        // Applications
        Route::get('/applications', fn() => view('employment.applications.index'))->name('applications.index');
        Route::get('/applications/{id}', fn($id) => view('employment.applications.show', ['id' => $id]))->name('applications.show');

        // Checklists
        Route::get('/checklists', fn() => view('employment.checklists.index'))->name('checklists.index');
        Route::get('/checklists/{id}', fn($id) => view('employment.checklists.show', ['id' => $id]))->name('checklists.show');

        // Visa Processing
        Route::get('/visas', fn() => view('employment.visas.index'))->name('visas.index');
        Route::get('/visas/{id}', fn($id) => view('employment.visas.show', ['id' => $id]))->name('visas.show');

        // Deployments
        Route::get('/deployments', fn() => view('employment.deployments.index'))->name('deployments.index');
        Route::get('/deployments/{id}', fn($id) => view('employment.deployments.show', ['id' => $id]))->name('deployments.show');

        // Refunds
        Route::get('/refunds', fn() => view('employment.refunds.index'))->name('refunds.index');
        Route::get('/refunds/{id}', fn($id) => view('employment.refunds.show', ['id' => $id]))->name('refunds.show');
        Route::get('/refunds/create', fn() => view('employment.refunds.create'))->name('refunds.create');

        // Registration Links
        Route::get('/registration-links', fn() => view('employment.registration-links.index'))->name('registration-links.index');
    });

    // =============================================
    // CONSULTANCY
    // =============================================
    Route::prefix('consultancy')->name('consultancy.')->group(function () {
        Route::get('/', fn() => view('consultancy.dashboard'))->name('dashboard');
        Route::get('/students', fn() => view('consultancy.students.index'))->name('students.index');
        Route::get('/students/{id}', fn($id) => view('consultancy.students.show', ['id' => $id]))->name('students.show');
        Route::get('/students/create', fn() => view('consultancy.students.create'))->name('students.create');
        Route::get('/counselling', fn() => view('consultancy.counselling.index'))->name('counselling.index');
        Route::get('/institutions', fn() => view('consultancy.institutions.index'))->name('institutions.index');
        Route::get('/applications', fn() => view('consultancy.applications.index'))->name('applications.index');
        Route::get('/applications/{id}', fn($id) => view('consultancy.applications.show', ['id' => $id]))->name('applications.show');
        Route::get('/visas', fn() => view('consultancy.visas.index'))->name('visas.index');
        Route::get('/payments', fn() => view('consultancy.payments.index'))->name('payments.index');
        Route::get('/enrollment', fn() => view('consultancy.enrollment.index'))->name('enrollment.index');
    });

    // =============================================
    // ACADEMY
    // =============================================
    Route::prefix('academy')->name('academy.')->group(function () {
        Route::get('/', fn() => view('academy.dashboard'))->name('dashboard');
        Route::get('/students', fn() => view('academy.students.index'))->name('students.index');
        Route::get('/students/{id}', fn($id) => view('academy.students.show', ['id' => $id]))->name('students.show');
        Route::get('/courses', fn() => view('academy.courses.index'))->name('courses.index');
        Route::get('/courses/{id}', fn($id) => view('academy.courses.show', ['id' => $id]))->name('courses.show');
        Route::get('/batches', fn() => view('academy.batches.index'))->name('batches.index');
        Route::get('/enrollments', fn() => view('academy.enrollments.index'))->name('enrollments.index');
        Route::get('/attendance', fn() => view('academy.attendance.index'))->name('attendance.index');
        Route::get('/exams', fn() => view('academy.exams.index'))->name('exams.index');
        Route::get('/certificates', fn() => view('academy.certificates.index'))->name('certificates.index');
    });

    // =============================================
    // FINANCE
    // =============================================
    Route::prefix('finance')->name('finance.')->group(function () {
        Route::get('/', fn() => view('finance.dashboard'))->name('dashboard');
        Route::get('/transactions', fn() => view('finance.transactions'))->name('transactions');
        Route::get('/payments', fn() => view('finance.payments'))->name('payments');
        Route::get('/invoices', fn() => view('finance.invoices'))->name('invoices');
        Route::get('/refunds', fn() => view('finance.refunds'))->name('refunds');
        Route::get('/expenses', fn() => view('finance.expenses'))->name('expenses');
        Route::get('/reports', fn() => view('finance.reports'))->name('reports');
    });

    // =============================================
    // SHARED MODULES
    // =============================================
    Route::get('/documents', fn() => view('documents.index'))->name('documents.index');
    Route::get('/documents/{id}', fn($id) => view('documents.show', ['id' => $id]))->name('documents.show');

    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', fn() => view('tasks.index'))->name('index');
        Route::get('/create', fn() => view('tasks.create'))->name('create');
    });

    Route::prefix('staff')->name('staff.')->group(function () {
        Route::get('/', fn() => view('staff.index'))->name('index');
        Route::get('/{id}', fn($id) => view('staff.show', ['id' => $id]))->name('show');
        Route::get('/create', fn() => view('staff.create'))->name('create');
    });

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', fn() => view('reports.index'))->name('index');
        Route::get('/employment', fn() => view('reports.employment'))->name('employment');
        Route::get('/consultancy', fn() => view('reports.consultancy'))->name('consultancy');
        Route::get('/academy', fn() => view('reports.academy'))->name('academy');
        Route::get('/finance', fn() => view('reports.finance'))->name('finance');
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', fn() => view('settings.index'))->name('index');
    });

});
