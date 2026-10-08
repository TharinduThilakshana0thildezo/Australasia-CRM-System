<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Response;

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
        Route::get('/talent-pool/export', function () {
            $csvData = "Candidate ID,Name,Role,Experience,Target Countries,Docs Ready,Training Done,Passport Ready,Handler\n";
            $pool = [
                ['CAND-1290','Pradeep Fernando','Warehouse Operator','5 years','Australia / UAE','Yes','Yes','Yes','Amila P.'],
                ['CAND-1285','Samanthi Fernando','Factory Worker','3 years','Qatar / Kuwait','Yes','Yes','Yes','Kasun B.'],
                ['CAND-1282','Ajith Nanayakkara','Construction Worker','8 years','UAE / Qatar','Yes','No','Yes','Nimal J.'],
                ['CAND-1278','Dilrukshi Jayakody','Hospitality','4 years','Maldives / UAE','Yes','Yes','Yes','Priya H.'],
                ['CAND-1274','Chaminda Rathnayake','Heavy Vehicle Driver','12 years','Saudi Arabia / UAE','Yes','No','Yes','Amila P.'],
                ['CAND-1271','Renuka Bandara','Agriculture Worker','2 years','Australia','No','No','No','Kasun B.'],
            ];
            foreach ($pool as $row) { $csvData .= implode(',', $row) . "\n"; }
            return response($csvData, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="talent-pool-export-'.date('Y-m-d').'.csv"',
            ]);
        })->name('talent-pool.export');

        // Candidate Export
        Route::get('/candidates/export', function () {
            $csvData = "Candidate ID,Name,NIC,Passport,Phone,Status,Handler,Docs,Registered,Source\n";
            $candidates = [
                ['CAND-1298','Thilini Madushan','199508204567','N12345678','077 234 5678','Registered','Kasun B.','1/5','06 Oct 2026','Walk-in'],
                ['CAND-1297','Kavindu Perera','198912034578','N98765432','071 456 7890','Visa Approved','Nimal J.','5/5','15 Sep 2026','Referral'],
                ['CAND-1296','Nadeeka Silva','200103214321','N45678901','076 987 6543','Correction Required','Priya H.','3/5','02 Sep 2026','Agent'],
                ['CAND-1295','Sachini Rathnayake','199607120987','N23456789','070 123 4567','Deployed','Kasun B.','5/5','12 Aug 2026','Walk-in'],
                ['CAND-1294','Amara Kumari Dissanayake','199801234567','','077 876 5432','Documents Pending','Amila P.','2/5','28 Aug 2026','Online Enquiry'],
                ['CAND-1293','Ruwan Pathirana','199203145678','N56789012','071 234 5670','Refund','Nimal J.','5/5','05 Jul 2026','Referral'],
                ['CAND-1292','Chamari Dias','199905678901','N67890123','078 345 6789','Checklist','Priya H.','5/5','20 Jul 2026','Walk-in'],
                ['CAND-1291','Roshan Wijesinghe','200201034567','','077 456 7891','Lead','Kasun B.','0/5','06 Oct 2026','Walk-in'],
                ['CAND-1290','Pradeep Fernando','199407125678','N78901234','071 567 8901','Talent Pool','Amila P.','5/5','10 Aug 2026','Agent'],
                ['CAND-1289','Indika Chandrasena','199109087654','N89012345','070 678 9012','Visa Processing','Nimal J.','5/5','15 Jun 2026','Referral'],
            ];
            foreach ($candidates as $row) { $csvData .= implode(',', $row) . "\n"; }
            return response($csvData, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="candidates-export-'.date('Y-m-d').'.csv"',
            ]);
        })->name('candidates.export');

        // Employers
        Route::get('/employers', fn() => view('employment.employers.index'))->name('employers.index');
        Route::get('/employers/create', fn() => view('employment.employers.create'))->name('employers.create');
        Route::get('/employers/{id}', fn($id) => view('employment.employers.show', ['id' => $id]))->name('employers.show');
        Route::get('/employers/export', function () {
            $csv = "Employer ID,Company Name,Country,Contact Person,Email,Phone,Active Vacancies,Candidates Placed,Status\n";
            $rows = [
                ['EMP-001','Global Workforce Solutions','Australia','Michael Johnson','michael@globalworkforce.com.au','+61 3 9000 1234','3','45','Active'],
                ['EMP-002','Al Futtaim Manufacturing','UAE','Ahmed Al Rashid','ahmed@alfuttaim.ae','+971 4 200 5678','4','38','Active'],
                ['EMP-003','Qatar Industrial Services','Qatar','Khalid Al Thani','khalid@qatarind.com.qa','+974 4432 1234','2','29','Active'],
                ['EMP-004','Pacific Hospitality Group','Australia','Sarah Mitchell','sarah@pacifichospitality.com.au','+61 2 9000 5678','1','22','Active'],
                ['EMP-005','Saudi Logistics & Transport','Saudi Arabia','Abdullah Al-Otaibi','info@saudilogistics.sa','+966 11 400 3456','1','17','Active'],
            ];
            foreach ($rows as $r) { $csv .= implode(',', $r)."\n"; }
            return response($csv, 200, ['Content-Type'=>'text/csv','Content-Disposition'=>'attachment; filename="employers-'.date('Y-m-d').'.csv"']);
        })->name('employers.export');

        // Vacancies
        Route::get('/vacancies', fn() => view('employment.vacancies.index'))->name('vacancies.index');
        Route::get('/vacancies/create', fn() => view('employment.vacancies.create'))->name('vacancies.create');
        Route::get('/vacancies/{id}', fn($id) => view('employment.vacancies.show', ['id' => $id]))->name('vacancies.show');
        Route::get('/vacancies/export', function () {
            $csv = "Vacancy ID,Job Title,Employer,Country,Openings,Salary,Applications,Deadline,Status\n";
            $rows = [
                ['VAC-0042','Warehouse Operator','Global Workforce Solutions','Australia','5','AUD 55000/yr','3','30 Oct 2026','Open'],
                ['VAC-0041','Machine Operator','Al Futtaim Manufacturing','UAE','8','AED 3500/mo','6','15 Nov 2026','Open'],
                ['VAC-0040','Factory Worker','Qatar Industrial Services','Qatar','12','QAR 2800/mo','8','20 Nov 2026','Open'],
                ['VAC-0039','Heavy Vehicle Driver','Saudi Logistics & Transport','Saudi Arabia','3','SAR 4200/mo','2','10 Nov 2026','Matching'],
                ['VAC-0038','Construction Worker','Kuwait General Contracting','Kuwait','6','KWD 250/mo','5','25 Nov 2026','Matching'],
                ['VAC-0037','Hospitality Staff','Pacific Hospitality Group','Australia','4','AUD 50000/yr','4','01 Oct 2026','Filled'],
            ];
            foreach ($rows as $r) { $csv .= implode(',', $r)."\n"; }
            return response($csv, 200, ['Content-Type'=>'text/csv','Content-Disposition'=>'attachment; filename="vacancies-'.date('Y-m-d').'.csv"']);
        })->name('vacancies.export');

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
        Route::post('/visas', function (\Illuminate\Http\Request $req) {
            return redirect()->route('employment.visas.index')->with('success', 'Visa application VSA-00292 created for '.$req->input('candidate_name','candidate').' successfully.');
        })->name('visas.store');
        Route::get('/visas/export', function () {
            $csv = "Visa ID,Candidate,Candidate ID,Country,Visa Type,Application,Submitted,Deadline,Days Elapsed,Status\n";
            $rows = [
                ['VSA-00291','Nadeeka Silva','CAND-1296','Australia','482 Work','APP-0849','01 Oct 2026','30 Nov 2026','5','Submitted'],
                ['VSA-00290','Chamari Dias','CAND-1292','UAE','Work','APP-0847','28 Sep 2026','28 Oct 2026','8','Processing'],
                ['VSA-00289','Indika Chandrasena','CAND-1289','Qatar','Work','APP-0845','10 Sep 2026','10 Oct 2026','26','Overdue'],
                ['VSA-00287','Malith Perera','CAND-1281','Kuwait','Work','APP-0841','01 Sep 2026','01 Oct 2026','35','Overdue'],
                ['VSA-00284','Kavindu Perera','CAND-1297','Australia','482 Work','APP-0842','05 Oct 2026','04 Dec 2026','1','Approved'],
                ['VSA-00279','Ruwan Pathirana','CAND-1293','Saudi Arabia','Iqama','APP-0836','15 Aug 2026','15 Sep 2026','51','Refund'],
            ];
            foreach ($rows as $r) { $csv .= implode(',', $r)."\n"; }
            return response($csv, 200, ['Content-Type'=>'text/csv','Content-Disposition'=>'attachment; filename="visa-applications-'.date('Y-m-d').'.csv"']);
        })->name('visas.export');

        // Deployments
        Route::get('/deployments', fn() => view('employment.deployments.index'))->name('deployments.index');
        Route::get('/deployments/{id}', fn($id) => view('employment.deployments.show', ['id' => $id]))->name('deployments.show');
        Route::post('/deployments', function (\Illuminate\Http\Request $req) {
            return redirect()->route('employment.deployments.index')->with('success', 'Deployment DEP-0019 scheduled for '.$req->input('candidate_name','candidate').' on '.$req->input('departure_date','scheduled date').'.');
        })->name('deployments.store');
        Route::get('/deployments/export', function () {
            $csv = "Deployment ID,Candidate,Candidate ID,Employer,Vacancy,Destination,Flight,Departure Date,Briefing,Status\n";
            $rows = [
                ['DEP-0018','Kavindu Perera','CAND-1297','Global Workforce Solutions','Warehouse Operator','Melbourne AU','UL 605','10 Oct 2026','Completed','Deployment'],
                ['DEP-0017','Pradeep Fernando','CAND-1290','Global Workforce Solutions','Warehouse Operator','Melbourne AU','UL 605','10 Oct 2026','Completed','Deployment'],
                ['DEP-0016','Dilrukshi Jayakody','CAND-1278','Pacific Hospitality Group','Hospitality Staff','Sydney AU','SQ 483','12 Oct 2026','Completed','Deployment'],
                ['DEP-0015','Chamari Dias','CAND-1292','Al Futtaim Manufacturing','Machine Operator','Dubai UAE','EK 343','18 Oct 2026','Pending','Checklist'],
                ['DEP-0014','Nadeeka Silva','CAND-1296','Qatar Industrial Services','Factory Worker','Doha QA','QR 157','22 Oct 2026','Scheduled','Visa Processing'],
                ['DEP-0012','Kumari Dissanayake','CAND-1271','Pacific Hospitality Group','Hospitality Staff','Sydney AU','UL 601','02 Oct 2026','Completed','Deployed'],
            ];
            foreach ($rows as $r) { $csv .= implode(',', $r)."\n"; }
            return response($csv, 200, ['Content-Type'=>'text/csv','Content-Disposition'=>'attachment; filename="deployments-'.date('Y-m-d').'.csv"']);
        })->name('deployments.export');

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
        Route::get('/profile', fn() => view('settings.index', ['tab' => 'profile']))->name('profile');
    });

});
