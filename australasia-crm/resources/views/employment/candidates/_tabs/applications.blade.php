<!-- Applications Tab -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Applications</h3>
        <x-status-badge status="selected" />
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Application ID</th>
                    <th>Vacancy</th>
                    <th>Employer</th>
                    <th>Submitted</th>
                    <th>Interview</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="{{ route('employment.applications.show', 1) }}" class="font-mono font-semibold text-indigo-600 hover:underline">APP-0842</a></td>
                    <td>
                        <div class="text-sm font-semibold text-slate-800">Warehouse Operator</div>
                        <div class="text-xs text-slate-500">Australia · Full-time · AUD 55,000/yr</div>
                    </td>
                    <td>
                        <a href="{{ route('employment.employers.show', 1) }}" class="text-sm font-medium text-slate-700 hover:text-indigo-600">
                            Global Workforce Solutions Pty Ltd
                        </a>
                    </td>
                    <td class="text-sm text-slate-600">02 Oct 2026</td>
                    <td class="text-sm text-slate-600">—</td>
                    <td><x-status-badge status="selected" /></td>
                    <td>
                        <a href="{{ route('employment.applications.show', 1) }}" class="btn btn-ghost btn-xs">
                            <i data-lucide="eye" style="width:13px;height:13px"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
