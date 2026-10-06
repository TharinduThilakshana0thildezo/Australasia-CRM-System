<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Australasia CRM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        /* Background Elements */
        .bg-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            z-index: 0;
        }
        .shape-1 { width: 500px; height: 500px; background: rgba(99, 102, 241, 0.15); top: -100px; left: -100px; }
        .shape-2 { width: 400px; height: 400px; background: rgba(16, 185, 129, 0.15); bottom: -100px; right: -100px; }
        
        /* Login Container */
        .login-container {
            width: 100%;
            max-width: 440px;
            z-index: 10;
            padding: 20px;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0,0,0,0.02);
            border-radius: 24px;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }
        
        /* Top Gradient Bar in Card */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6, #10b981);
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
            justify-content: center;
        }
        
        .brand-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }
        
        .brand-text {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
        }
        
        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-input {
            width: 100%;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 15px;
            color: #0f172a;
            transition: all 0.2s;
            outline: none;
        }
        
        .form-input:focus {
            background: #ffffff;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
        
        .btn-login {
            width: 100%;
            background: #0f172a;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn-login:hover {
            background: #1e293b;
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .credential-hint {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 16px;
            margin-top: 32px;
            border: 1px dashed #cbd5e1;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>

    <div class="login-container">
        <div class="login-card">
            
            <div class="brand-logo">
                <div class="brand-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                </div>
                <div class="brand-text">Australasia <span style="color:#6366f1">CRM</span></div>
            </div>

            <div class="text-center mb-8">
                <h1 class="text-xl font-bold text-slate-800">Welcome back</h1>
                <p class="text-sm text-slate-500 mt-1">Sign in to your account to continue</p>
            </div>

            @if(session('error'))
            <div class="alert-error">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-input" placeholder="name@australasia.lk" required autofocus value="{{ old('email') }}">
                </div>
                
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <label class="form-label">Password</label>
                        <a href="#" style="font-size: 13px; font-weight: 500; color: #6366f1; text-decoration: none;">Forgot password?</a>
                    </div>
                    <input type="password" name="password" class="form-input" placeholder="••••••••" required>
                </div>

                <div style="margin-top: 16px; display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" id="remember" style="width: 16px; height: 16px; accent-color: #6366f1; border-radius: 4px;">
                    <label for="remember" style="font-size: 13px; color: #64748b; font-weight: 500; cursor: pointer;">Remember for 30 days</label>
                </div>
                
                <button type="submit" class="btn-login">
                    Sign In
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </button>
            </form>

            <div class="credential-hint">
                <p style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Demo Credentials</p>
                <div style="font-size: 14px; color: #0f172a; font-family: monospace; font-weight: 600; display: flex; flex-direction: column; gap: 4px;">
                    <span>admin@australasia.lk</span>
                    <span style="color: #6366f1;">password</span>
                </div>
            </div>

        </div>
        
        <div style="text-align: center; margin-top: 24px; font-size: 13px; color: #94a3b8; font-weight: 500;">
            &copy; 2026 Australasia Group. All rights reserved.
        </div>
    </div>

</body>
</html>
