<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function index()
    {
        return view('academy.trainers.index');
    }

    public function create()
    {
        return view('academy.trainers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'phone'          => 'required|string|max:15',
            'email'          => 'required|email',
            'specialization' => 'required|string|max:255',
            'courses'        => 'nullable|array',
            'nic'            => 'nullable|string|max:12',
            'joining_date'   => 'nullable|date',
            'notes'          => 'nullable|string',
        ]);

        // TODO: AcademyTrainer::create([...]);
        return redirect()->route('academy.trainers.index')
            ->with('success', 'Trainer registered successfully.');
    }

    public function show(int $id)
    {
        return view('academy.trainers.show');
    }
}
