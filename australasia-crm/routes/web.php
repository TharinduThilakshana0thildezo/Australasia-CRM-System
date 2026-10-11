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

        // Dashboard
        Route::get('/', fn() => view('consultancy.dashboard'))->name('dashboard');

        // Leads
        Route::get('/leads', fn() => view('consultancy.leads.index'))->name('leads.index');
        Route::get('/leads/create', fn() => view('consultancy.leads.create'))->name('leads.create');
        Route::post('/leads', function (\Illuminate\Http\Request $req) {
            $req->validate([
                'first_name'   => 'required|string|max:100',
                'last_name'    => 'required|string|max:100',
                'phone'        => 'required|string|max:20',
                'source'       => 'required|string',
                'enquiry_date' => 'required|date',
            ]);
            $name = $req->input('first_name').' '.$req->input('last_name');
            return redirect()->route('consultancy.leads.index')
                ->with('success', "Lead for {$name} created successfully. ID: CON-L-".rand(1000,9999));
        })->name('leads.store');
        Route::get('/leads/{id}', fn($id) => view('consultancy.leads.show', ['id' => $id]))->name('leads.show');

        // Registration Links
        Route::get('/registration-links', fn() => view('consultancy.registration-links.index'))->name('registration-links.index');
        Route::post('/registration-links', function (\Illuminate\Http\Request $req) {
            $req->validate(['lead_id' => 'required|string', 'expires_in' => 'required|integer|min:1|max:30']);
            $token = bin2hex(random_bytes(24));
            return redirect()->route('consultancy.registration-links.index')
                ->with('success', "Secure registration link generated. Token: {$token} (expires in {$req->input('expires_in')} days). Share only via secure channel.");
        })->name('registration-links.store');
        Route::post('/registration-links/{id}/revoke', function ($id) {
            return redirect()->route('consultancy.registration-links.index')
                ->with('success', "Registration link REG-{$id} has been revoked and can no longer be used.");
        })->name('registration-links.revoke');

        // Students / Profiles
        Route::get('/students', fn() => view('consultancy.students.index'))->name('students.index');
        Route::get('/students/create', fn() => view('consultancy.students.create'))->name('students.create');
        Route::post('/students', function (\Illuminate\Http\Request $req) {
            $req->validate([
                'full_name'   => 'required|string|max:150',
                'nic'         => 'required|string|max:20',
                'phone'       => 'required|string|max:20',
                'email'       => 'nullable|email|max:150',
                'dob'         => 'nullable|date',
                'source'      => 'required|string',
                'handler_id'  => 'required|string',
            ]);
            // Demonstrate duplicate-detection response in demo mode
            $knownNICs = ['199508204567','198912034578','200103214321'];
            if (in_array($req->input('nic'), $knownNICs)) {
                return back()->withInput()
                    ->with('dup_warning', 'A profile with this NIC already exists. Please review the existing profile before creating a new one. You may link a Consultancy stream to the existing profile instead.');
            }
            $id = 'CON-'.str_pad(rand(100,999), 4, '0', STR_PAD_LEFT);
            return redirect()->route('consultancy.students.show', 1)
                ->with('success', "Student profile {$id} created for {$req->input('full_name')}. Registration fee collection pending.");
        })->name('students.store');
        Route::get('/students/{id}', fn($id) => view('consultancy.students.show', ['id' => $id]))->name('students.show');
        Route::post('/students/{id}/update-status', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['status' => 'required|string', 'reason' => 'nullable|string|max:500']);
            return redirect()->back()->with('success', "Student status updated to: ".ucwords(str_replace('_',' ',$req->input('status'))));
        })->name('students.update-status');
        Route::post('/students/{id}/close', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['closure_reason' => 'required|string|max:500', 'closure_type' => 'required|string']);
            return redirect()->route('consultancy.students.index')
                ->with('success', "Case CON-{$id} closed. Reason recorded. All records preserved.");
        })->name('students.close');
        Route::post('/students/{id}/reopen', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['reopen_reason' => 'required|string|max:500']);
            return redirect()->back()->with('success', "Case CON-{$id} reopened. Reason audited.");
        })->name('students.reopen');
        Route::post('/students/{id}/assign', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['handler_id' => 'required|string']);
            return redirect()->back()->with('success', "Case reassigned successfully.");
        })->name('students.assign');

        // Registration Fee
        Route::post('/students/{id}/registration-fee', function (\Illuminate\Http\Request $req, $id) {
            $req->validate([
                'amount'   => 'required|numeric|min:0',
                'currency' => 'required|string',
                'method'   => 'required|string',
                'paid_on'  => 'required|date',
                'reference'=> 'nullable|string|max:100',
            ]);
            return redirect()->back()
                ->with('success', "Registration fee of {$req->input('currency')} {$req->input('amount')} recorded. Case unblocked.");
        })->name('students.reg-fee');

        // Documents (DMS)
        Route::get('/documents', fn() => view('consultancy.documents.index'))->name('documents.index');
        Route::get('/documents/review', fn() => view('consultancy.documents.review'))->name('documents.review');
        Route::post('/students/{id}/documents', function (\Illuminate\Http\Request $req, $id) {
            $req->validate([
                'category'  => 'required|string',
                'document'  => 'required|file|max:20480|mimes:pdf,jpg,jpeg,png,doc,docx',
            ]);
            $cat = $req->input('category');
            return redirect()->back()->with('success', "Document '{$cat}' uploaded successfully. Pending staff review.");
        })->name('students.documents.upload');
        Route::post('/documents/{docId}/approve', function (\Illuminate\Http\Request $req, $docId) {
            $req->validate(['reviewer_notes' => 'nullable|string|max:500']);
            return redirect()->back()->with('success', "Document approved by reviewer.");
        })->name('documents.approve');
        Route::post('/documents/{docId}/request-correction', function (\Illuminate\Http\Request $req, $docId) {
            $req->validate(['correction_reason' => 'required|string|max:500']);
            return redirect()->back()->with('success', "Correction requested. Student/consultant notified.");
        })->name('documents.request-correction');

        // Counselling & Study Plan
        Route::get('/counselling', fn() => view('consultancy.counselling.index'))->name('counselling.index');
        Route::get('/counselling/create', fn() => view('consultancy.counselling.create'))->name('counselling.create');
        Route::post('/counselling', function (\Illuminate\Http\Request $req) {
            $req->validate([
                'student_id'       => 'required|string',
                'session_date'     => 'required|date',
                'consultant_id'    => 'required|string',
                'preferred_country'=> 'required|string',
                'study_goals'      => 'required|string',
                'study_plan_agreed'=> 'required|string',
            ]);
            $agreed = $req->input('study_plan_agreed') === 'yes';
            $msg = $agreed
                ? "Counselling session recorded. Study plan agreed — proceed to institution shortlisting."
                : "Counselling session recorded. Study plan not yet agreed — follow-up session scheduled.";
            return redirect()->route('consultancy.counselling.index')->with('success', $msg);
        })->name('counselling.store');

        // Institutions & Courses
        Route::get('/institutions', fn() => view('consultancy.institutions.index'))->name('institutions.index');
        Route::get('/institutions/{id}', fn($id) => view('consultancy.institutions.show', ['id' => $id]))->name('institutions.show');
        Route::get('/courses', fn() => view('consultancy.courses.index'))->name('courses.index');
        Route::get('/shortlists', fn() => view('consultancy.shortlists.index'))->name('shortlists.index');
        Route::post('/shortlists', function (\Illuminate\Http\Request $req) {
            $req->validate([
                'student_id'     => 'required|string',
                'institution_id' => 'required|string',
                'course'         => 'required|string',
                'intake'         => 'required|string',
                'estimated_cost' => 'required|numeric|min:0',
                'currency'       => 'required|string',
            ]);
            return redirect()->back()->with('success', "Institution/course added to shortlist.");
        })->name('shortlists.store');
        Route::post('/shortlists/{id}/remove', function ($id) {
            return redirect()->back()->with('success', "Shortlist option removed.");
        })->name('shortlists.remove');

        // Applications
        Route::get('/applications', fn() => view('consultancy.applications.index'))->name('applications.index');
        Route::get('/applications/{id}', fn($id) => view('consultancy.applications.show', ['id' => $id]))->name('applications.show');
        Route::post('/applications', function (\Illuminate\Http\Request $req) {
            $req->validate([
                'student_id'     => 'required|string',
                'institution_id' => 'required|string',
                'course'         => 'required|string',
                'intake'         => 'required|string',
                'submission_date'=> 'required|date',
            ]);
            $appId = 'APP-CON-'.rand(1000,9999);
            return redirect()->route('consultancy.applications.index')
                ->with('success', "Application {$appId} submitted successfully. Status: Submitted.");
        })->name('applications.store');
        Route::post('/applications/{id}/update-status', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['status' => 'required|string', 'notes' => 'nullable|string|max:1000']);
            return redirect()->back()
                ->with('success', "Application status updated to: ".ucwords(str_replace('_',' ',$req->input('status'))));
        })->name('applications.update-status');
        Route::post('/applications/{id}/withdraw', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['withdrawal_reason' => 'required|string|max:500']);
            return redirect()->route('consultancy.applications.index')
                ->with('success', "Application APP-{$id} withdrawn. Reason recorded.");
        })->name('applications.withdraw');

        // Offers & Acceptance
        Route::get('/offers', fn() => view('consultancy.offers.index'))->name('offers.index');
        Route::post('/offers', function (\Illuminate\Http\Request $req) {
            $req->validate([
                'application_id' => 'required|string',
                'offer_date'     => 'required|date',
                'offer_type'     => 'required|in:conditional,unconditional',
                'deadline'       => 'required|date',
            ]);
            return redirect()->route('consultancy.offers.index')
                ->with('success', "Offer recorded for application {$req->input('application_id')}. Type: {$req->input('offer_type')}.");
        })->name('offers.store');
        Route::post('/offers/{id}/accept', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['acceptance_method' => 'required|string', 'accepted_on' => 'required|date']);
            return redirect()->back()->with('success', "Offer accepted. Confirmation recorded. Proceed to visa case preparation.");
        })->name('offers.accept');
        Route::post('/offers/{id}/decline', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['decline_reason' => 'required|string|max:500']);
            return redirect()->back()->with('success', "Offer declined. Case can proceed to alternative institution or closure.");
        })->name('offers.decline');
        Route::post('/offers/{id}/conditions/{condId}/satisfy', function ($id, $condId) {
            return redirect()->back()->with('success', "Condition marked as satisfied. Offer eligibility updated.");
        })->name('offers.conditions.satisfy');

        // Visa Cases
        Route::get('/visas', fn() => view('consultancy.visas.index'))->name('visas.index');
        Route::get('/visas/{id}', fn($id) => view('consultancy.visas.show', ['id' => $id]))->name('visas.show');
        Route::post('/visas', function (\Illuminate\Http\Request $req) {
            $req->validate([
                'student_id'    => 'required|string',
                'offer_id'      => 'required|string',
                'visa_type'     => 'required|string',
                'country'       => 'required|string',
                'submission_date' => 'required|date',
            ]);
            $visaId = 'VIS-CON-'.rand(1000,9999);
            return redirect()->route('consultancy.visas.index')
                ->with('success', "Visa case {$visaId} created. Status: Submitted.");
        })->name('visas.store');
        Route::post('/visas/{id}/update-status', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['status' => 'required|string', 'notes' => 'nullable|string|max:1000']);
            $status = $req->input('status');
            if ($status === 'rejected') {
                $req->validate(['can_reapply' => 'required|in:yes,no']);
            }
            return redirect()->back()
                ->with('success', "Visa status updated to: ".ucwords(str_replace('_',' ',$status)));
        })->name('visas.update-status');

        // Registrations (post-visa)
        Route::get('/registrations', fn() => view('consultancy.registrations.index'))->name('registrations.index');
        Route::post('/registrations/{id}/complete-item', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['item_id' => 'required|string', 'notes' => 'nullable|string|max:500']);
            return redirect()->back()->with('success', "Registration checklist item marked complete.");
        })->name('registrations.complete-item');
        Route::post('/registrations/{id}/complete', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['completion_notes' => 'nullable|string|max:500']);
            return redirect()->back()->with('success', "Registration marked complete. Proceed to final payment.");
        })->name('registrations.complete');

        // Final Payments
        Route::get('/payments', fn() => view('consultancy.payments.index'))->name('payments.index');
        Route::post('/payments', function (\Illuminate\Http\Request $req) {
            $req->validate([
                'student_id'   => 'required|string',
                'payment_type' => 'required|in:registration,final,other',
                'amount'       => 'required|numeric|min:0.01',
                'currency'     => 'required|string',
                'method'       => 'required|string',
                'paid_on'      => 'required|date',
                'reference'    => 'nullable|string|max:100',
            ]);
            $payId = 'PAY-CON-'.rand(10000,99999);
            return redirect()->route('consultancy.payments.index')
                ->with('success', "Payment {$payId} recorded. Amount: {$req->input('currency')} {$req->input('amount')}.");
        })->name('payments.store');

        // Enrollment
        Route::get('/enrollment', fn() => view('consultancy.enrollment.index'))->name('enrollment.index');
        Route::post('/enrollment', function (\Illuminate\Http\Request $req) {
            $req->validate([
                'student_id'       => 'required|string',
                'institution'      => 'required|string',
                'course'           => 'required|string',
                'intake'           => 'required|string',
                'enrollment_date'  => 'required|date',
                'student_number'   => 'nullable|string|max:100',
            ]);
            $enrollId = 'ENR-CON-'.rand(1000,9999);
            return redirect()->route('consultancy.enrollment.index')
                ->with('success', "Enrollment {$enrollId} confirmed. Journey marked complete. 🎓");
        })->name('enrollment.store');
        Route::post('/enrollment/{id}/override', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['override_reason' => 'required|string|min:20|max:1000']);
            return redirect()->back()->with('success', "Override applied with mandatory reason recorded in audit log.");
        })->name('enrollment.override');

        // Reports
        Route::get('/reports', fn() => view('consultancy.reports'))->name('reports');

        // Settings
        Route::get('/settings', fn() => view('consultancy.settings'))->name('settings');
        Route::post('/settings', function (\Illuminate\Http\Request $req) {
            return redirect()->route('consultancy.settings')
                ->with('success', "Consultancy settings saved.");
        })->name('settings.save');

    });

    // =============================================
    // ACADEMY
    // =============================================
    Route::prefix('academy')->name('academy.')->group(function () {
        // ---- Dashboard ----
        Route::get('/', fn() => view('academy.dashboard'))->name('dashboard');

        // ---- Registration Links (Phase A) ----
        Route::get('/registration-links', fn() => view('academy.registration-links.index'))->name('registration-links.index');
        Route::post('/registration-links', function (\Illuminate\Http\Request $req) {
            $req->validate(['expires_in_days' => 'required|integer|min:1|max:30', 'notes' => 'nullable|string|max:500']);
            $token = bin2hex(random_bytes(24));
            return redirect()->route('academy.registration-links.index')
                ->with('success', "Registration link generated. Expires in {$req->input('expires_in_days')} days. Token: ".substr($token,0,16).'…');
        })->name('registration-links.store');
        Route::post('/registration-links/{id}/revoke', function ($id) {
            return redirect()->back()->with('success', 'Registration link revoked.');
        })->name('registration-links.revoke');
        Route::post('/registration-links/{id}/regenerate', function ($id) {
            return redirect()->back()->with('success', 'Registration link regenerated with new token.');
        })->name('registration-links.regenerate');
        Route::post('/registration-links/{id}/deactivate', function ($id) {
            return redirect()->back()->with('success', 'Registration link deactivated.');
        })->name('registration-links.deactivate');
        Route::get('/registration-links/{id}/applications', function ($id) {
            return redirect()->back()->with('info', 'Applications list view to be implemented.');
        })->name('registration-links.applications');
        Route::post('/registration-links/{id}/reject', function ($id) {
            return redirect()->back()->with('success', 'Application rejected.');
        })->name('registration-links.reject');

        // ---- Trainers ----
        Route::get('/trainers', fn() => view('academy.trainers.index'))->name('trainers.index');
        Route::get('/trainers/create', fn() => view('academy.trainers.create'))->name('trainers.create');
        Route::post('/trainers', function (\Illuminate\Http\Request $req) {
            $req->validate(['name' => 'required|string|max:150', 'specialization' => 'required|string', 'email' => 'required|email', 'phone' => 'required|string']);
            $id = 'TRN-'.rand(1000,9999);
            return redirect()->route('academy.trainers.index')->with('success', "Trainer {$id} registered: {$req->input('name')}.");
        })->name('trainers.store');
        Route::get('/trainers/{id}', fn($id) => view('academy.trainers.show', compact('id')))->name('trainers.show');

        // ---- Courses ----
        Route::get('/courses', fn() => view('academy.courses.index'))->name('courses.index');
        Route::get('/courses/create', fn() => view('academy.courses.create'))->name('courses.create');
        Route::post('/courses', function (\Illuminate\Http\Request $req) {
            $req->validate([
                'name'        => 'required|string|max:200',
                'code'        => 'required|string|max:50',
                'description' => 'nullable|string',
                'duration'    => 'required|string',
                'fee'         => 'required|numeric|min:0',
                'currency'    => 'required|string',
                'capacity'    => 'required|integer|min:1',
            ]);
            $cid = 'CRS-'.strtoupper(substr($req->input('code'),0,4)).'-'.rand(100,999);
            return redirect()->route('academy.courses.index')->with('success', "Course {$cid} created: {$req->input('name')}.");
        })->name('courses.store');
        Route::get('/courses/{id}', fn($id) => view('academy.courses.show', compact('id')))->name('courses.show');
        Route::get('/courses/{id}/edit', fn($id) => view('academy.courses.edit', compact('id')))->name('courses.edit');
        Route::post('/courses/{id}/update', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['name' => 'required|string|max:200', 'fee' => 'required|numeric|min:0']);
            return redirect()->route('academy.courses.show', $id)->with('success', 'Course updated.');
        })->name('courses.update');
        Route::post('/courses/{id}/pause', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['pause_reason' => 'required|string|min:10|max:500']);
            return redirect()->back()->with('success', 'Course paused. Running batches are unaffected.');
        })->name('courses.pause');
        Route::post('/courses/{id}/resume', function ($id) {
            return redirect()->back()->with('success', 'Course resumed and now open for new enrollments.');
        })->name('courses.resume');
        Route::post('/courses/{id}/archive', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['archive_reason' => 'required|string|min:10|max:500']);
            return redirect()->route('academy.courses.index')->with('success', 'Course archived. Historical data preserved.');
        })->name('courses.archive');

        // ---- Batches ----
        Route::get('/batches', fn() => view('academy.batches.index'))->name('batches.index');
        Route::get('/batches/create', fn() => view('academy.batches.create'))->name('batches.create');
        Route::post('/batches', function (\Illuminate\Http\Request $req) {
            $req->validate([
                'course_id'  => 'required|string',
                'batch_code' => 'required|string|max:50',
                'trainer_id' => 'required|string',
                'start_date' => 'required|date',
                'end_date'   => 'required|date|after:start_date',
                'capacity'   => 'required|integer|min:1',
            ]);
            $bid = 'BCH-'.rand(1000,9999);
            return redirect()->route('academy.batches.index')->with('success', "Batch {$bid} created for {$req->input('batch_code')}.");
        })->name('batches.store');
        Route::get('/batches/{id}', fn($id) => view('academy.batches.show', compact('id')))->name('batches.show');
        Route::post('/batches/{id}/start', function ($id) {
            return redirect()->back()->with('success', 'Batch marked as started. Attendance tracking begins.');
        })->name('batches.start');
        Route::post('/batches/{id}/complete', function (\Illuminate\Http\Request $req, $id) {
            return redirect()->back()->with('success', 'Batch marked complete. Proceed to exam/certificate stage.');
        })->name('batches.complete');
        Route::post('/batches/{id}/transfer', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['student_id' => 'required|string', 'new_batch_id' => 'required|string', 'transfer_reason' => 'required|string|min:10']);
            return redirect()->back()->with('success', "Student transferred to new batch. History preserved.");
        })->name('batches.transfer');

        // ---- Students / Enquiries ----
        Route::get('/students', fn() => view('academy.students.index'))->name('students.index');
        Route::get('/students/create', fn() => view('academy.students.create'))->name('students.create');
        Route::post('/students', function (\Illuminate\Http\Request $req) {
            $req->validate([
                'full_name'  => 'required|string|max:150',
                'nic'        => 'required|string|min:10|max:12',
                'phone'      => 'required|string|min:9|max:15',
                'email'      => 'nullable|email',
                'source'     => 'required|string',
                'handler_id' => 'required|string',
            ]);
            $sid = 'ACD-'.rand(1000,9999);
            return redirect()->route('academy.students.show', 1)->with('success', "Student {$sid} registered. NIC: {$req->input('nic')}.");
        })->name('students.store');
        Route::get('/students/{id}', fn($id) => view('academy.students.show', compact('id')))->name('students.show');
        Route::post('/students/{id}/close', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['close_reason' => 'required|string|min:10|max:1000', 'close_type' => 'required|in:withdrawn,unresponsive,final_fail,other']);
            return redirect()->route('academy.students.index')->with('success', 'Case closed and archived. All records preserved.');
        })->name('students.close');
        Route::post('/students/{id}/reopen', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['reopen_reason' => 'required|string|min:10|max:500']);
            return redirect()->back()->with('success', 'Case reopened. Audit entry recorded.');
        })->name('students.reopen');

        // ---- Course Selections ----
        Route::get('/course-selections', fn() => view('academy.course-selections.index'))->name('course-selections.index');
        Route::post('/students/{id}/select-course', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['course_id' => 'required|string', 'batch_id' => 'required|string', 'preferred_start' => 'nullable|string']);
            return redirect()->back()->with('success', 'Course selected. Proceed to fee payment to confirm enrollment.');
        })->name('students.select-course');
        Route::post('/students/{id}/waitlist', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['course_id' => 'required|string', 'batch_id' => 'required|string']);
            return redirect()->back()->with('success', 'Added to waitlist. Student will be notified when a seat becomes available.');
        })->name('students.waitlist');

        // ---- Enrollments ----
        Route::get('/enrollments', fn() => view('academy.enrollments.index'))->name('enrollments.index');
        Route::get('/enrollments/{id}', fn($id) => view('academy.enrollments.show', compact('id')))->name('enrollments.show');
        Route::post('/students/{id}/enroll', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['course_id' => 'required|string', 'batch_id' => 'required|string']);
            $eid = 'ENR-ACD-'.rand(1000,9999);
            return redirect()->back()->with('success', "Enrollment {$eid} confirmed. Student added to batch roster.");
        })->name('students.enroll');
        Route::post('/enrollments/{id}/withdraw', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['withdrawal_reason' => 'required|string|min:10|max:1000', 'withdrawal_date' => 'required|date']);
            return redirect()->back()->with('success', 'Withdrawal recorded. Fee treatment pending confirmation — do not process refund without director authorization.');
        })->name('enrollments.withdraw');
        Route::post('/enrollments/{id}/complete', function ($id) {
            return redirect()->back()->with('success', 'Enrollment marked complete. Certificate eligibility updated.');
        })->name('enrollments.complete');

        // ---- Payments ----
        Route::get('/payments', fn() => view('academy.payments.index'))->name('payments.index');
        Route::post('/payments', function (\Illuminate\Http\Request $req) {
            $req->validate([
                'student_id'   => 'required|string',
                'course_id'    => 'required|string',
                'amount'       => 'required|numeric|min:0.01',
                'currency'     => 'required|string',
                'method'       => 'required|string',
                'paid_on'      => 'required|date',
                'reference'    => 'nullable|string|max:100',
            ]);
            $pid = 'PAY-ACD-'.rand(10000,99999);
            return redirect()->route('academy.payments.index')->with('success', "Payment {$pid} recorded. {$req->input('currency')} {$req->input('amount')} — {$req->input('method')}.");
        })->name('payments.store');

        // ---- Class Sessions ----
        Route::get('/sessions', fn() => view('academy.sessions.index'))->name('sessions.index');
        Route::post('/sessions', function (\Illuminate\Http\Request $req) {
            $req->validate(['batch_id' => 'required|string', 'session_date' => 'required|date', 'start_time' => 'required', 'end_time' => 'required|after:start_time', 'topic' => 'required|string|max:200']);
            $sid = 'SES-'.rand(1000,9999);
            return redirect()->route('academy.sessions.index')->with('success', "Class session {$sid} created.");
        })->name('sessions.store');

        // ---- Attendance ----
        Route::get('/attendance', fn() => view('academy.attendance.index'))->name('attendance.index');
        Route::get('/attendance/{sessionId}', fn($sessionId) => view('academy.attendance.mark', compact('sessionId')))->name('attendance.mark');
        Route::post('/attendance/{sessionId}', function (\Illuminate\Http\Request $req, $sessionId) {
            $req->validate(['attendance' => 'required|array', 'attendance.*.student_id' => 'required|string', 'attendance.*.status' => 'required|in:present,absent,late,excused']);
            return redirect()->route('academy.attendance.index')->with('success', "Attendance recorded for session {$sessionId}. ".count($req->input('attendance'))." entries saved.");
        })->name('attendance.store');
        Route::post('/attendance/{sessionId}/correct', function (\Illuminate\Http\Request $req, $sessionId) {
            $req->validate(['student_id' => 'required|string', 'new_status' => 'required|in:present,absent,late,excused', 'correction_reason' => 'required|string|min:5']);
            return redirect()->back()->with('success', 'Attendance corrected. Original entry preserved in audit log.');
        })->name('attendance.correct');
        Route::get('/makeup-sessions', fn() => view('academy.attendance.makeup'))->name('attendance.makeup');
        Route::post('/makeup-sessions', function (\Illuminate\Http\Request $req) {
            $req->validate(['student_id' => 'required|string', 'session_id' => 'required|string', 'makeup_date' => 'required|date', 'reason' => 'required|string']);
            return redirect()->back()->with('success', 'Make-up session scheduled. Student notified.');
        })->name('attendance.makeup.store');

        // ---- Exams & Marks ----
        Route::get('/exams', fn() => view('academy.exams.index'))->name('exams.index');
        Route::get('/exams/create', fn() => view('academy.exams.create'))->name('exams.create');
        Route::post('/exams', function (\Illuminate\Http\Request $req) {
            $req->validate([
                'title'        => 'required|string|max:200',
                'course_id'    => 'required|string',
                'batch_id'     => 'required|string',
                'exam_date'    => 'required|date',
                'max_marks'    => 'required|integer|min:1',
                'pass_marks'   => 'required|integer|min:0',
            ]);
            if ($req->integer('pass_marks') > $req->integer('max_marks')) {
                return back()->withErrors(['pass_marks' => 'Pass marks cannot exceed maximum marks.'])->withInput();
            }
            $eid = 'EXM-'.rand(1000,9999);
            return redirect()->route('academy.exams.index')->with('success', "Exam {$eid} scheduled: {$req->input('title')}.");
        })->name('exams.store');
        Route::get('/exams/{id}', fn($id) => view('academy.exams.show', compact('id')))->name('exams.show');
        Route::get('/exams/{id}/marks', fn($id) => view('academy.exams.marks', compact('id')))->name('exams.marks');
        Route::post('/exams/{id}/marks', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['marks' => 'required|array', 'marks.*.student_id' => 'required|string', 'marks.*.obtained' => 'required|numeric|min:0']);
            return redirect()->route('academy.exams.show', $id)->with('success', 'Marks saved as draft. Review before publishing results.');
        })->name('exams.marks.store');
        Route::post('/exams/{id}/publish', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['publish_notes' => 'nullable|string|max:500']);
            return redirect()->back()->with('success', 'Results published. Students can now view their results.');
        })->name('exams.publish');
        Route::post('/exams/{id}/resit', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['student_id' => 'required|string', 'resit_date' => 'required|date', 'resit_reason' => 'nullable|string']);
            $rid = 'RST-'.rand(1000,9999);
            return redirect()->back()->with('success', "Re-sit {$rid} scheduled. Previous attempt preserved in history.");
        })->name('exams.resit.schedule');

        // ---- Certificates ----
        Route::get('/certificates', fn() => view('academy.certificates.index'))->name('certificates.index');
        Route::post('/certificates', function (\Illuminate\Http\Request $req) {
            $req->validate(['enrollment_id' => 'required|string', 'issue_date' => 'required|date', 'issued_by' => 'required|string']);
            $cid = 'CERT-ACD-'.strtoupper(substr(md5(rand()),0,8));
            return redirect()->route('academy.certificates.index')->with('success', "Certificate {$cid} issued. Document stored in secure storage.");
        })->name('certificates.store');
        Route::post('/certificates/{id}/void', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['void_reason' => 'required|string|min:10|max:500']);
            return redirect()->back()->with('success', 'Certificate voided. Audit entry recorded. Original file preserved.');
        })->name('certificates.void');
        Route::post('/certificates/{id}/reissue', function (\Illuminate\Http\Request $req, $id) {
            $req->validate(['reissue_reason' => 'required|string|min:10|max:500']);
            $newId = 'CERT-ACD-'.strtoupper(substr(md5(rand()),0,8));
            return redirect()->back()->with('success', "Certificate reissued as {$newId}. Previous certificate voided.");
        })->name('certificates.reissue');

        // ---- Reports ----
        Route::get('/reports', fn() => view('academy.reports'))->name('reports');

        // ---- Settings ----
        Route::get('/settings', fn() => view('academy.settings'))->name('settings');
        Route::post('/settings', function (\Illuminate\Http\Request $req) {
            return redirect()->route('academy.settings')->with('success', 'Academy settings saved successfully.');
        })->name('settings.save');
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
        Route::get('/create', fn() => view('staff.create'))->name('create');
        Route::get('/{id}', fn($id) => view('staff.show', ['id' => $id]))->name('show');
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
