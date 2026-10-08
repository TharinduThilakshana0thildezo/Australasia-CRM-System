<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — Australasia CRM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; min-height: 100vh; display: flex; background: #f0f4ff; overflow: hidden; }

        /* LEFT PANEL */
        .login-left { width: 50%; background: linear-gradient(145deg, #0f172a 0%, #1e1b4b 40%, #312e81 75%, #4338ca 100%); display: flex; flex-direction: column; justify-content: space-between; padding: 48px; position: relative; overflow: hidden; }
        @media (max-width: 900px) { .login-left { display: none; } .login-right { width: 100%; } }
        .orb { position: absolute; border-radius: 50%; filter: blur(70px); opacity: 0.22; animation: orb-float 8s ease-in-out infinite; }
        .orb-1 { width: 450px; height: 450px; background: #818cf8; top: -120px; right: -80px; animation-delay: 0s; }
        .orb-2 { width: 320px; height: 320px; background: #34d399; bottom: 40px; left: -80px; animation-delay: 3s; }
        .orb-3 { width: 220px; height: 220px; background: #f472b6; top: 42%; right: 18%; animation-delay: 5s; }
        @keyframes orb-float { 0%,100%{transform:translateY(0) scale(1);} 50%{transform:translateY(-28px) scale(1.04);} }
        .login-left::after { content:''; position:absolute; inset:0; background-image:linear-gradient(rgba(255,255,255,0.025) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.025) 1px,transparent 1px); background-size:44px 44px; pointer-events:none; }

        .left-logo { display:flex; align-items:center; gap:12px; position:relative; z-index:2; }
        .left-logo-icon { width:44px;height:44px; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.18); backdrop-filter:blur(8px); border-radius:12px; display:flex;align-items:center;justify-content:center; }
        .left-logo-text { font-size:18px;font-weight:800;color:white;letter-spacing:-0.5px; }
        .left-logo-sub { font-size:11px;color:rgba(255,255,255,0.45);font-weight:500; }
        .left-hero { position:relative;z-index:2; }
        .left-hero h1 { font-size:44px;font-weight:800;line-height:1.12;color:white;letter-spacing:-1.8px;margin-bottom:20px; }
        .left-hero h1 em { font-style:normal;color:#a5b4fc; }
        .left-hero p { font-size:15px;color:rgba(255,255,255,0.58);line-height:1.75;max-width:380px; }
        .left-stats { position:relative;z-index:2;display:grid;grid-template-columns:repeat(3,1fr);gap:14px; }
        .stat-box { background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:16px;padding:18px 12px;text-align:center;backdrop-filter:blur(8px); }
        .stat-box-num { font-size:26px;font-weight:800;color:white;letter-spacing:-0.5px; }
        .stat-box-lbl { font-size:10px;color:rgba(255,255,255,0.45);margin-top:5px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px; }

        /* RIGHT PANEL */
        .login-right { width:50%;display:flex;align-items:center;justify-content:center;padding:40px;background:#f8fafc; }
        .login-card { width:100%;max-width:420px; }
        .login-card-header { margin-bottom:32px; }
        .login-card-header h2 { font-size:28px;font-weight:800;color:#0f172a;letter-spacing:-0.8px; }
        .login-card-header p { font-size:14px;color:#64748b;margin-top:6px;font-weight:500; }

        .field-group { margin-bottom:18px; }
        .field-label { display:block;font-size:11px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.7px;margin-bottom:8px; }
        .field-input { width:100%;background:white;border:1.5px solid #e2e8f0;border-radius:12px;padding:13px 16px;font-size:15px;font-family:inherit;color:#0f172a;transition:all 0.2s;outline:none; }
        .field-input:focus { border-color:#6366f1;box-shadow:0 0 0 4px rgba(99,102,241,0.08); }
        .field-row { display:flex;justify-content:space-between;align-items:center;margin-bottom:8px; }
        .forgot-link { font-size:12px;font-weight:600;color:#6366f1;text-decoration:none; }
        .forgot-link:hover { text-decoration:underline; }
        .remember-row { display:flex;align-items:center;gap:8px;margin-bottom:24px; }
        .remember-row input { width:16px;height:16px;accent-color:#6366f1; }
        .remember-row label { font-size:13px;color:#64748b;font-weight:500;cursor:pointer; }

        .btn-signin { width:100%;background:linear-gradient(135deg,#6366f1,#4f46e5);color:white;border:none;border-radius:12px;padding:15px;font-size:15px;font-weight:700;font-family:inherit;cursor:pointer;transition:all 0.2s;display:flex;align-items:center;justify-content:center;gap:8px;box-shadow:0 4px 18px rgba(99,102,241,0.35); }
        .btn-signin:hover { background:linear-gradient(135deg,#4f46e5,#4338ca);transform:translateY(-1px);box-shadow:0 8px 28px rgba(99,102,241,0.42); }
        .btn-signin:active { transform:translateY(0); }

        .divider { text-align:center;margin:24px 0;position:relative; }
        .divider::before { content:'';position:absolute;top:50%;left:0;right:0;height:1px;background:#e2e8f0; }
        .divider span { background:#f8fafc;padding:0 12px;color:#94a3b8;font-size:11px;font-weight:700;position:relative;text-transform:uppercase;letter-spacing:1px; }

        .demo-card { background:linear-gradient(135deg,#f0f4ff,#eef2ff);border:1.5px solid #c7d2fe;border-radius:14px;padding:18px 20px;display:flex;align-items:center;gap:16px; }
        .demo-icon { width:42px;height:42px;border-radius:10px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;flex-shrink:0; }
        .demo-info p { font-size:10px;font-weight:700;color:#6366f1;text-transform:uppercase;letter-spacing:0.7px;margin-bottom:6px; }
        .demo-creds { font-size:13px;color:#1e293b;font-family:'Courier New',monospace; }
        .demo-creds span { display:block; }
        .demo-creds .pass { color:#6366f1;font-weight:700;margin-top:3px; }

        .alert-error { background:#fef2f2;border:1.5px solid #fecaca;color:#b91c1c;padding:12px 16px;border-radius:12px;font-size:13px;margin-bottom:20px;display:flex;align-items:center;gap:8px;font-weight:500; }
        .footer-text { text-align:center;margin-top:28px;font-size:12px;color:#94a3b8;font-weight:500; }
        .footer-text a { color:#6366f1;text-decoration:none;font-weight:600; }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <!-- LEFT PANEL -->
    <div class="login-left">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>

        <div class="left-logo">
            <div class="left-logo-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                </svg>
            </div>
            <div>
                <div class="left-logo-text">Australasia</div>
                <div class="left-logo-sub">Enterprise CRM Platform</div>
            </div>
        </div>

        <div class="left-hero">
            <h1>Powering<br><em>smarter</em><br>placements.</h1>
            <p>The all-in-one platform for managing foreign employment, consultancy, and academy operations — built for teams that move fast.</p>
        </div>

        <div class="left-stats">
            <div class="stat-box">
                <div class="stat-box-num">1,284</div>
                <div class="stat-box-lbl">Candidates</div>
            </div>
            <div class="stat-box">
                <div class="stat-box-num">47</div>
                <div class="stat-box-lbl">Vacancies</div>
            </div>
            <div class="stat-box">
                <div class="stat-box-num">96%</div>
                <div class="stat-box-lbl">Success Rate</div>
            </div>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="login-right">
        <div class="login-card">

            <div class="login-card-header">
                <h2>Welcome back 👋</h2>
                <p>Sign in to your Australasia CRM account to continue</p>
            </div>

            @if(session('error'))
            <div class="alert-error">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="field-group">
                    <label class="field-label">Email Address</label>
                    <input type="email" name="email" class="field-input" placeholder="name@australasia.lk" required autofocus value="{{ old('email') }}">
                </div>

                <div class="field-group">
                    <div class="field-row">
                        <label class="field-label" style="margin-bottom:0">Password</label>
                        <a href="#" class="forgot-link">Forgot password?</a>
                    </div>
                    <input type="password" name="password" class="field-input" placeholder="••••••••" required>
                </div>

                <div class="remember-row">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Keep me signed in for 30 days</label>
                </div>

                <button type="submit" class="btn-signin" id="signin-btn">
                    Sign In
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </button>
            </form>

            <div class="divider"><span>Demo Access</span></div>

            <div class="demo-card">
                <div class="demo-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div class="demo-info">
                    <p>Demo Credentials</p>
                    <div class="demo-creds">
                        <span>admin@australasia.lk</span>
                        <span class="pass">password</span>
                    </div>
                </div>
            </div>

            <div class="footer-text">
                &copy; 2026 Australasia Group &nbsp;&middot;&nbsp; <a href="#">Privacy Policy</a> &nbsp;&middot;&nbsp; <a href="#">Terms</a>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('signin-btn').addEventListener('click', function() {
        const form = this.closest('form');
        const btn = this;
        if (form.checkValidity()) {
            // Show spinner AFTER a tiny delay so the form's native submit fires first
            setTimeout(function() {
                btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="animation:spin 1s linear infinite"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg> Signing in\u2026';
                btn.style.opacity = '0.8';
            }, 50);
        }
    });
    </script>

</body>
</html>
