<!-- Tasks Tab -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tasks</h3>
        <button class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i> Add Task
        </button>
    </div>
    <div class="card-body">
        <div class="space-y-3">
            @php
            $tasks = [
                ['title' => 'Book flight to Australia', 'due' => 'Urgent', 'priority' => 'high', 'assignee' => 'Nimal J.', 'status' => 'pending'],
                ['title' => 'Schedule pre-departure briefing', 'due' => '10 Oct 2026', 'priority' => 'high', 'assignee' => 'Kasun B.', 'status' => 'pending'],
                ['title' => 'Share final documents with employer', 'due' => '12 Oct 2026', 'priority' => 'medium', 'assignee' => 'Nimal J.', 'status' => 'in_progress'],
            ];
            @endphp
            @foreach($tasks as $task)
            <div class="flex items-center gap-3 p-3 border border-slate-100 rounded-xl hover:border-indigo-200 transition-colors">
                <input type="checkbox" class="form-input" style="width:16px;height:16px;padding:0;flex-shrink:0">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-800">{{ $task['title'] }}</p>
                    <div class="flex items-center gap-3 mt-1 text-xs text-slate-500">
                        <span>Due: <strong class="{{ $task['due'] === 'Urgent' ? 'text-rose-600' : 'text-slate-700' }}">{{ $task['due'] }}</strong></span>
                        <span>Assignee: {{ $task['assignee'] }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full flex-shrink-0 {{ $task['priority'] === 'high' ? 'bg-rose-500' : 'bg-amber-400' }}"></span>
                    <x-status-badge :status="$task['status']" />
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
