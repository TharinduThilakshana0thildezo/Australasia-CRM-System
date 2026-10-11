<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Settings (configurable policies)
        Schema::create('academy_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('attendance_threshold_pct')->default(75);
            $table->boolean('allow_attendance_override')->default(true);
            $table->integer('unpaid_seat_hold_days')->default(7);
            $table->string('withdrawal_fee_policy')->default('manual');
            $table->integer('partial_refund_pct')->default(50);
            $table->string('cert_prefix')->default('CERT-ACD');
            $table->integer('link_default_expiry_days')->default(14);
            $table->boolean('link_require_approval')->default(true);
            $table->timestamps();
        });

        // 2. Courses
        Schema::create('academy_courses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('course_type'); // pre_departure, language, etc.
            $table->text('description')->nullable();
            $table->string('duration');
            $table->integer('capacity');
            $table->decimal('fee', 10, 2)->default(0);
            $table->string('currency', 3)->default('LKR');
            $table->string('status')->default('active'); // active, paused, archived
            $table->string('linked_module')->nullable();
            $table->timestamps();
        });

        // 3. Trainers
        Schema::create('academy_trainers', function (Blueprint $table) {
            $table->id();
            $table->string('trainer_id')->unique();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('specialization');
            $table->json('courses_qualified')->nullable();
            $table->string('nic')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });

        // 4. Batches
        Schema::create('academy_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('academy_courses');
            $table->foreignId('trainer_id')->constrained('academy_trainers');
            $table->string('batch_code')->unique();
            $table->integer('capacity');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->default('scheduled'); // scheduled, active, completed
            $table->timestamps();
        });

        // 5. Students
        Schema::create('academy_students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique(); // e.g. ACD-1001
            $table->string('nic')->unique();
            $table->string('full_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('source');
            $table->string('status')->default('active');
            $table->timestamps();
        });

        // 6. Enrollments
        Schema::create('academy_enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('enrollment_id')->unique();
            $table->foreignId('student_id')->constrained('academy_students');
            $table->foreignId('course_id')->constrained('academy_courses');
            $table->foreignId('batch_id')->constrained('academy_batches');
            $table->string('fee_status')->default('pending'); // pending, paid
            $table->string('status')->default('active'); // active, completed, withdrawn, waitlisted
            $table->timestamps();
        });

        // 7. Sessions
        Schema::create('academy_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->unique();
            $table->foreignId('batch_id')->constrained('academy_batches');
            $table->string('topic');
            $table->date('session_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('venue')->nullable();
            $table->boolean('attendance_recorded')->default(false);
            $table->timestamps();
        });

        // 8. Attendance & Makeups
        Schema::create('academy_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('academy_sessions');
            $table->foreignId('student_id')->constrained('academy_students');
            $table->string('status'); // present, absent, late, excused
            $table->string('note')->nullable();
            $table->timestamps();
        });

        Schema::create('academy_makeup_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('academy_students');
            $table->foreignId('original_session_id')->constrained('academy_sessions');
            $table->date('makeup_date');
            $table->string('reason');
            $table->string('status')->default('scheduled'); // scheduled, completed
            $table->timestamps();
        });

        // 9. Exams & Results
        Schema::create('academy_exams', function (Blueprint $table) {
            $table->id();
            $table->string('exam_id')->unique();
            $table->string('title');
            $table->foreignId('course_id')->constrained('academy_courses');
            $table->foreignId('batch_id')->constrained('academy_batches');
            $table->string('exam_type');
            $table->date('exam_date');
            $table->integer('max_marks');
            $table->integer('pass_marks');
            $table->string('status')->default('scheduled'); // draft, scheduled, marks_pending, completed
            $table->timestamps();
        });

        Schema::create('academy_exam_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('academy_exams');
            $table->foreignId('student_id')->constrained('academy_students');
            $table->decimal('marks_obtained', 5, 2)->nullable();
            $table->string('outcome')->nullable(); // pass, fail, resit
            $table->integer('attempt')->default(1);
            $table->timestamps();
        });

        // 10. Certificates
        Schema::create('academy_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_id')->unique();
            $table->foreignId('enrollment_id')->constrained('academy_enrollments');
            $table->foreignId('student_id')->constrained('academy_students');
            $table->foreignId('course_id')->constrained('academy_courses');
            $table->date('issue_date');
            $table->string('issued_by');
            $table->string('status')->default('issued'); // issued, voided, reissued
            $table->string('void_reason')->nullable();
            $table->timestamps();
        });

        // 11. Payments (Ledger)
        Schema::create('academy_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->unique();
            $table->foreignId('student_id')->constrained('academy_students');
            $table->foreignId('course_id')->constrained('academy_courses');
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3);
            $table->string('method');
            $table->string('reference')->nullable();
            $table->date('paid_on');
            $table->timestamps();
        });

        // 12. Registration Links
        Schema::create('academy_registration_links', function (Blueprint $table) {
            $table->id();
            $table->string('link_code')->unique();
            $table->foreignId('course_id')->constrained('academy_courses');
            $table->date('expires_at');
            $table->integer('max_uses')->nullable();
            $table->integer('uses')->default(0);
            $table->string('status')->default('active'); // active, expired, deactivated
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academy_registration_links');
        Schema::dropIfExists('academy_payments');
        Schema::dropIfExists('academy_certificates');
        Schema::dropIfExists('academy_exam_results');
        Schema::dropIfExists('academy_exams');
        Schema::dropIfExists('academy_makeup_sessions');
        Schema::dropIfExists('academy_attendances');
        Schema::dropIfExists('academy_sessions');
        Schema::dropIfExists('academy_enrollments');
        Schema::dropIfExists('academy_students');
        Schema::dropIfExists('academy_batches');
        Schema::dropIfExists('academy_trainers');
        Schema::dropIfExists('academy_courses');
        Schema::dropIfExists('academy_settings');
    }
};
