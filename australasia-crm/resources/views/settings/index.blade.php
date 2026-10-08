<x-layouts.app title="Settings — Australasia CRM">

<x-page-header
    title="Settings"
    subtitle="Manage your profile, account preferences and system configuration"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => '#', 'label' => 'Settings']]">
</x-page-header>

<div x-data="{ activeTab: '{{ $tab ?? 'profile' }}' }" class="flex flex-col lg:flex-row gap-6">

    <!-- Settings Sidebar Nav -->
    <aside class="lg:w-60 flex-shrink-0">
        <div class="card">
            <div class="card-body p-2">
                <nav class="space-y-0.5">
                    <button @click="activeTab = 'profile'"
                            :class="activeTab === 'profile' ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-50'"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors text-left">
                        <i data-lucide="user" style="width:15px;height:15px"></i> My Profile
                    </button>
                    <button @click="activeTab = 'account'"
                            :class="activeTab === 'account' ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-50'"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors text-left">
                        <i data-lucide="shield" style="width:15px;height:15px"></i> Account & Security
                    </button>
                    <button @click="activeTab = 'notifications'"
                            :class="activeTab === 'notifications' ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-50'"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors text-left">
                        <i data-lucide="bell" style="width:15px;height:15px"></i> Notifications
                    </button>
                    <button @click="activeTab = 'system'"
                            :class="activeTab === 'system' ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-50'"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors text-left">
                        <i data-lucide="settings-2" style="width:15px;height:15px"></i> System Settings
                    </button>
                    <button @click="activeTab = 'users'"
                            :class="activeTab === 'users' ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-50'"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors text-left">
                        <i data-lucide="users" style="width:15px;height:15px"></i> User Management
                    </button>
                    <button @click="activeTab = 'integrations'"
                            :class="activeTab === 'integrations' ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-50'"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors text-left">
                        <i data-lucide="plug" style="width:15px;height:15px"></i> Integrations
                    </button>
                </nav>
            </div>
        </div>
    </aside>

    <!-- Settings Content -->
    <div class="flex-1 min-w-0 space-y-5">

        <!-- PROFILE TAB -->
        <div x-show="activeTab === 'profile'" x-transition>
            <div class="card mb-5">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                        <div class="relative">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                {{ strtoupper(substr(session('auth_user')['name'] ?? 'SK', 0, 1)) }}{{ strtoupper(substr(strstr(session('auth_user')['name'] ?? 'Senaka K', ' '), 1, 1)) }}
                            </div>
                            <button onclick="showToast('Upload photo feature coming soon!','info')" class="absolute -bottom-2 -right-2 w-7 h-7 bg-white rounded-full shadow-md border border-slate-200 flex items-center justify-center hover:bg-slate-50">
                                <i data-lucide="camera" style="width:12px;height:12px;color:#6366f1"></i>
                            </button>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-lg font-bold text-slate-900">{{ session('auth_user')['name'] ?? 'Senaka Karunaratne' }}</h2>
                            <p class="text-sm text-slate-500 mt-0.5">{{ session('auth_user')['role'] ?? 'Director' }} · Australasia Group</p>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <span class="inline-flex items-center gap-1 text-xs bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-full font-medium">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full inline-block"></span> Active
                                </span>
                                <span class="inline-flex items-center gap-1 text-xs bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-full font-medium">
                                    <i data-lucide="shield-check" style="width:10px;height:10px"></i> Verified
                                </span>
                            </div>
                        </div>
                        <button onclick="showToast('Profile photo updated!','success')" class="btn btn-secondary btn-sm">
                            <i data-lucide="upload" style="width:13px;height:13px"></i> Change Photo
                        </button>
                    </div>
                </div>
            </div>

            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="font-semibold text-slate-800">Personal Information</h3>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">First Name</label>
                            <input type="text" class="form-input" value="Senaka">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Last Name</label>
                            <input type="text" class="form-input" value="Karunaratne">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Email Address</label>
                            <input type="email" class="form-input" value="{{ session('auth_user')['email'] ?? 'admin@australasia.lk' }}">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Phone Number</label>
                            <input type="tel" class="form-input" value="+94 71 456 7890">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Job Title</label>
                            <input type="text" class="form-input" value="{{ session('auth_user')['role'] ?? 'Director' }}">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Department</label>
                            <select class="form-select">
                                <option selected>Executive Management</option>
                                <option>Foreign Employment</option>
                                <option>Consultancy</option>
                                <option>Academy</option>
                                <option>Finance</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Bio</label>
                            <textarea class="form-input" rows="3">Director and Co-founder of Australasia Group. Overseeing foreign employment, consultancy, and academy operations since 2018.</textarea>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4 pt-4 border-t border-slate-100">
                        <button onclick="showToast('Profile updated successfully!','success')" class="btn btn-primary btn-sm">
                            <i data-lucide="save" style="width:13px;height:13px"></i> Save Changes
                        </button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3 class="font-semibold text-slate-800">Activity Summary</h3></div>
                <div class="card-body">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center p-4 bg-indigo-50 rounded-xl">
                            <div class="text-2xl font-bold text-indigo-600">147</div>
                            <div class="text-xs text-slate-500 mt-1">Candidates Handled</div>
                        </div>
                        <div class="text-center p-4 bg-emerald-50 rounded-xl">
                            <div class="text-2xl font-bold text-emerald-600">38</div>
                            <div class="text-xs text-slate-500 mt-1">Deployed This Year</div>
                        </div>
                        <div class="text-center p-4 bg-amber-50 rounded-xl">
                            <div class="text-2xl font-bold text-amber-600">12</div>
                            <div class="text-xs text-slate-500 mt-1">Active Vacancies</div>
                        </div>
                        <div class="text-center p-4 bg-violet-50 rounded-xl">
                            <div class="text-2xl font-bold text-violet-600">96%</div>
                            <div class="text-xs text-slate-500 mt-1">Client Satisfaction</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ACCOUNT & SECURITY TAB -->
        <div x-show="activeTab === 'account'" x-transition style="display:none">
            <div class="card mb-5">
                <div class="card-header"><h3 class="font-semibold text-slate-800">Change Password</h3></div>
                <div class="card-body">
                    <div class="space-y-4 max-w-md">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Current Password</label>
                            <input type="password" class="form-input" placeholder="••••••••">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">New Password</label>
                            <input type="password" class="form-input" placeholder="••••••••">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Confirm New Password</label>
                            <input type="password" class="form-input" placeholder="••••••••">
                        </div>
                    </div>
                    <div class="flex justify-end mt-4 pt-4 border-t border-slate-100">
                        <button onclick="showToast('Password changed successfully!','success')" class="btn btn-primary btn-sm">Update Password</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h3 class="font-semibold text-slate-800">Two-Factor Authentication</h3></div>
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-700">Enable 2FA for extra security</p>
                            <p class="text-xs text-slate-500 mt-1">Protect your account with an authenticator app or SMS</p>
                        </div>
                        <button onclick="showToast('2FA setup initiated — check your email!','info')" class="btn btn-secondary btn-sm">Enable 2FA</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- NOTIFICATIONS TAB -->
        <div x-show="activeTab === 'notifications'" x-transition style="display:none">
            <div class="card">
                <div class="card-header"><h3 class="font-semibold text-slate-800">Notification Preferences</h3></div>
                <div class="card-body divide-y divide-slate-100">
                    @foreach([
                        ['New Candidate Registered', 'Get notified when a new candidate is registered', true],
                        ['Document Submitted', 'Alert when a candidate submits documents for review', true],
                        ['Visa Status Update', 'Updates on visa application status changes', true],
                        ['Deployment Completed', 'Notify when a candidate deployment is confirmed', false],
                        ['Refund Request', 'Alert when a refund request is submitted', true],
                        ['New Vacancy Posted', 'Notification when a new employer vacancy is listed', false],
                    ] as [$title, $desc, $enabled])
                    <div class="flex items-center justify-between py-3">
                        <div>
                            <p class="text-sm font-medium text-slate-700">{{ $title }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $desc }}</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" {{ $enabled ? 'checked' : '' }}>
                            <div class="w-10 h-5 bg-slate-200 rounded-full peer peer-checked:after:translate-x-5 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>
                    @endforeach
                    <div class="pt-4 flex justify-end">
                        <button onclick="showToast('Notification preferences saved!','success')" class="btn btn-primary btn-sm">Save Preferences</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- SYSTEM SETTINGS TAB -->
        <div x-show="activeTab === 'system'" x-transition style="display:none">
            <div class="card">
                <div class="card-header"><h3 class="font-semibold text-slate-800">General Configuration</h3></div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Company Name</label>
                            <input type="text" class="form-input" value="Australasia Group">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Language</label>
                            <select class="form-select"><option>English</option><option>Sinhala</option><option>Tamil</option></select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Timezone</label>
                            <select class="form-select"><option selected>Asia/Colombo (GMT+5:30)</option><option>UTC</option><option>Asia/Dubai</option></select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Date Format</label>
                            <select class="form-select"><option>DD MMM YYYY</option><option>MM/DD/YYYY</option><option>YYYY-MM-DD</option></select>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4 pt-4 border-t border-slate-100">
                        <button onclick="showToast('System settings saved!','success')" class="btn btn-primary btn-sm">Save Settings</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- USER MANAGEMENT TAB -->
        <div x-show="activeTab === 'users'" x-transition style="display:none">
            <div class="card">
                <div class="card-header">
                    <h3 class="font-semibold text-slate-800">System Users</h3>
                    <button onclick="showToast('Invitation sent successfully!','success')" class="btn btn-primary btn-sm">
                        <i data-lucide="user-plus" style="width:13px;height:13px"></i> Invite User
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Department</th><th>Status</th><th>Last Login</th><th>Actions</th></tr></thead>
                        <tbody>
                            @foreach([
                                ['Senaka Karunaratne','admin@australasia.lk','Director','Executive','active','Today 10:22 AM'],
                                ['Kasun Bandara','kasun@australasia.lk','Senior Officer','Foreign Employment','active','Today 09:45 AM'],
                                ['Nimal Jayawardena','nimal@australasia.lk','Officer','Foreign Employment','active','Yesterday'],
                                ['Priya Hewage','priya@australasia.lk','Officer','Consultancy','active','2 days ago'],
                                ['Amila Perera','amila@australasia.lk','Junior Officer','Academy','inactive','1 week ago'],
                            ] as [$name, $email, $role, $dept, $status, $last])
                            <tr>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <div class="avatar avatar-sm avatar-indigo">{{ substr($name,0,1) }}{{ substr(strstr($name,' '),1,1) }}</div>
                                        <span class="text-sm font-semibold text-slate-800">{{ $name }}</span>
                                    </div>
                                </td>
                                <td class="text-sm text-slate-500">{{ $email }}</td>
                                <td><span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full">{{ $role }}</span></td>
                                <td class="text-sm text-slate-500">{{ $dept }}</td>
                                <td><x-status-badge :status="$status" /></td>
                                <td class="text-xs text-slate-400">{{ $last }}</td>
                                <td>
                                    <button onclick="showToast('User settings updated!','success')" class="btn btn-ghost btn-xs">
                                        <i data-lucide="pencil" style="width:12px;height:12px"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- INTEGRATIONS TAB -->
        <div x-show="activeTab === 'integrations'" x-transition style="display:none">
            <div class="card">
                <div class="card-header"><h3 class="font-semibold text-slate-800">Connected Integrations</h3></div>
                <div class="card-body divide-y divide-slate-100">
                    @foreach([
                        ['WhatsApp Business API','Send automated messages to candidates and employers','message-square',true],
                        ['Email SMTP','Configure outbound email delivery','mail',true],
                        ['Sri Lanka Immigration','Check passport and visa status in real time','globe',false],
                        ['SLBFE Portal','Sync deployment data with SLBFE database','link',false],
                        ['Google Workspace','Connect Google Drive for document storage','layout',false],
                    ] as [$name, $desc, $icon, $connected])
                    <div class="flex items-center justify-between py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center">
                                <i data-lucide="{{ $icon }}" style="width:16px;height:16px;color:#6366f1"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-800">{{ $name }}</p>
                                <p class="text-xs text-slate-400">{{ $desc }}</p>
                            </div>
                        </div>
                        <button onclick="showToast('{{ $name }} {{ $connected ? 'disconnected' : 'connection initiated!' }}','{{ $connected ? 'info' : 'success' }}')"
                                class="btn btn-sm {{ $connected ? 'btn-ghost' : 'btn-secondary' }}" style="{{ $connected ? 'color:#ef4444' : '' }}">
                            {{ $connected ? 'Disconnect' : 'Connect' }}
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
function showToast(message, type) {
    const colors = { success:'#10b981', error:'#ef4444', info:'#6366f1', warning:'#f59e0b' };
    const c = document.getElementById('toast-container');
    const t = document.createElement('div');
    t.style.cssText = 'background:white;border-left:4px solid '+colors[type||'success']+';border-radius:10px;box-shadow:0 8px 24px rgba(0,0,0,0.12);padding:12px 16px;display:flex;align-items:center;gap:10px;min-width:280px;font-size:14px;font-weight:500;color:#1e293b;margin-bottom:8px;';
    t.innerHTML = '<span style="color:'+colors[type||'success']+'">&#10003;</span> '+message;
    c.appendChild(t);
    setTimeout(()=>{t.style.transition='opacity 0.3s';t.style.opacity='0';setTimeout(()=>t.remove(),300);},3000);
}
</script>

</x-layouts.app>

