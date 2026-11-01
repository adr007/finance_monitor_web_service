<!DOCTYPE html>
<html lang="id-ID">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Masuk ke ADR Finance Monitor">
    <meta name="author" content="artono_dr">
    <meta name="theme-color" content="#0b3a82">

    <title>ADR Finance Monitor | Login</title>

    <link href="{{ asset('komponen/app') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #13304a;
            --muted: #8a90a8;
            --line: #eef0f6;
            --soft: #f7f8fc;
            --green: #12b886;
            --red: #f0565b;
            --accent: #1c7ed6;
            --grad: linear-gradient(135deg, #0b3a82 0%, #1971c2 38%, #0fa3b1 70%, #2bb673 100%);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
        }

        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--ink);
            background: #e8f4f6;
            -webkit-font-smoothing: antialiased;
        }

        .auth {
            min-height: 100vh;
            min-height: 100dvh;
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr);
        }

        /* ---------- Brand panel ---------- */
        .brand {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 44px 56px;
            color: #fff;
            background: var(--grad);
        }

        .brand .orb {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, .07);
            pointer-events: none;
        }

        .brand .orb.o1 { width: 420px; height: 420px; right: -140px; top: -160px; }
        .brand .orb.o2 { width: 220px; height: 220px; left: -80px; bottom: 60px; }
        .brand .orb.o3 { width: 90px; height: 90px; right: 22%; bottom: -30px; background: rgba(255, 255, 255, .1); }

        .logo {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 900;
            font-size: 1.15rem;
            letter-spacing: .02em;
        }

        .logo-mark {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            font-size: 1.2rem;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(6px);
        }

        .logo sup {
            font-size: .6em;
            opacity: .7;
        }

        .brand-copy {
            position: relative;
            max-width: 440px;
        }

        .eyebrow {
            font-size: .72rem;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .65);
        }

        .brand-copy h1 {
            margin: 10px 0 12px;
            font-size: clamp(1.9rem, 3.2vw, 2.6rem);
            line-height: 1.15;
            font-weight: 900;
        }

        .brand-copy h1 em {
            font-style: normal;
            background: linear-gradient(90deg, #96f2d7, #99e9f2);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .brand-copy p {
            margin: 0;
            font-size: .98rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, .75);
        }

        /* Mock widgets */
        .showcase {
            position: relative;
            height: 250px;
            max-width: 460px;
            margin: 34px 0;
        }

        .glass {
            position: absolute;
            padding: 16px 18px;
            border-radius: 18px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .18);
            backdrop-filter: blur(10px);
            box-shadow: 0 18px 40px rgba(6, 40, 70, .25);
            animation: float 6s ease-in-out infinite;
        }

        .glass .lbl {
            font-size: .68rem;
            font-weight: 800;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .65);
        }

        .g-balance {
            left: 0;
            top: 0;
            width: 72%;
        }

        .g-balance .val {
            margin-top: 4px;
            font-size: 1.6rem;
            font-weight: 900;
            font-variant-numeric: tabular-nums;
        }

        .g-balance .val small {
            font-size: .55em;
            opacity: .7;
            margin-right: 4px;
        }

        .bars {
            display: flex;
            align-items: flex-end;
            gap: 6px;
            height: 58px;
            margin-top: 12px;
        }

        .bars span {
            flex: 1;
            border-radius: 6px 6px 3px 3px;
            background: rgba(255, 255, 255, .25);
            transform-origin: bottom;
            animation: grow 1s cubic-bezier(.2, .8, .2, 1) both;
        }

        .bars span.hi {
            background: linear-gradient(180deg, #96f2d7, #20c997);
        }

        .g-income {
            right: 0;
            top: 120px;
            width: 52%;
            animation-delay: -2s;
        }

        .g-spend {
            left: 10%;
            bottom: 0;
            width: 48%;
            animation-delay: -4s;
        }

        .row-ic {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .row-ic .ic {
            width: 36px;
            height: 36px;
            border-radius: 11px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            font-size: .85rem;
        }

        .row-ic .ic.up { background: rgba(18, 184, 134, .25); color: #96f2d7; }
        .row-ic .ic.down { background: rgba(240, 86, 91, .25); color: #ffc9ca; }

        .row-ic b {
            display: block;
            font-size: 1rem;
            font-weight: 800;
            font-variant-numeric: tabular-nums;
        }

        .brand-foot {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            font-size: .8rem;
            font-weight: 700;
            color: rgba(255, 255, 255, .7);
        }

        .brand-foot i {
            margin-right: 6px;
            color: #96f2d7;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes grow {
            from { transform: scaleY(0); }
            to { transform: scaleY(1); }
        }

        /* ---------- Form panel ---------- */
        .panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            background: #fff;
        }

        .form-box {
            width: 100%;
            max-width: 400px;
            animation: rise .5s ease both;
        }

        @keyframes rise {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: none; }
        }

        .hello {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 999px;
            background: #e3f8f8;
            color: #0c8599;
            font-size: .76rem;
            font-weight: 800;
        }

        .form-box h2 {
            margin: 14px 0 6px;
            font-size: 1.8rem;
            font-weight: 900;
        }

        .form-box .sub {
            margin: 0 0 28px;
            font-size: .92rem;
            color: var(--muted);
        }

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 13px 14px;
            margin-bottom: 20px;
            border-radius: 14px;
            border: 1px solid #fbd0d1;
            background: #fdecec;
            color: #c92a2f;
            font-size: .86rem;
            font-weight: 700;
            animation: shake .4s ease;
        }

        .alert i {
            margin-top: 2px;
        }

        .alert button {
            margin-left: auto;
            border: 0;
            background: transparent;
            color: inherit;
            opacity: .6;
            cursor: pointer;
            padding: 0 2px;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-6px); }
            75% { transform: translateX(6px); }
        }

        .field {
            margin-bottom: 18px;
        }

        .field label {
            display: block;
            margin-bottom: 7px;
            font-size: .82rem;
            font-weight: 800;
        }

        .control {
            position: relative;
        }

        .control > i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: .9rem;
            pointer-events: none;
            transition: color .15s ease;
        }

        .control input {
            width: 100%;
            height: 52px;
            padding: 0 16px 0 46px;
            border-radius: 14px;
            border: 1.5px solid var(--line);
            background: var(--soft);
            font: inherit;
            font-size: .95rem;
            color: var(--ink);
            transition: all .15s ease;
        }

        .control input::placeholder {
            color: #b3b8cb;
        }

        .control input:focus {
            outline: none;
            background: #fff;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(28, 126, 214, .14);
        }

        .control:focus-within > i {
            color: var(--accent);
        }

        .control.has-eye input {
            padding-right: 52px;
        }

        .eye {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 38px;
            height: 38px;
            border: 0;
            border-radius: 10px;
            background: transparent;
            color: var(--muted);
            cursor: pointer;
        }

        .eye:hover {
            background: var(--line);
            color: var(--ink);
        }

        .caps {
            display: none;
            margin-top: 7px;
            font-size: .76rem;
            font-weight: 700;
            color: #e67700;
        }

        .caps.show {
            display: block;
        }

        .check {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin: 2px 0 24px;
            font-size: .86rem;
            font-weight: 700;
            cursor: pointer;
            user-select: none;
        }

        .check input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .check .box {
            width: 20px;
            height: 20px;
            border-radius: 6px;
            border: 1.5px solid #d0d4e2;
            display: grid;
            place-items: center;
            font-size: .62rem;
            color: transparent;
            transition: all .15s ease;
        }

        .check input:checked + .box {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        .check input:focus-visible + .box {
            box-shadow: 0 0 0 4px rgba(28, 126, 214, .22);
        }

        .btn-login {
            width: 100%;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 0;
            border-radius: 14px;
            font: inherit;
            font-size: 1rem;
            font-weight: 800;
            color: #fff;
            background: var(--grad);
            background-size: 160% 100%;
            background-position: 0 0;
            box-shadow: 0 10px 24px rgba(15, 163, 177, .34);
            cursor: pointer;
            transition: all .2s ease;
        }

        .btn-login:hover {
            background-position: 100% 0;
            transform: translateY(-1px);
            box-shadow: 0 14px 28px rgba(15, 163, 177, .42);
        }

        .btn-login:disabled {
            opacity: .75;
            cursor: wait;
            transform: none;
        }

        .btn-login .fa-arrow-right {
            transition: transform .2s ease;
        }

        .btn-login:hover .fa-arrow-right {
            transform: translateX(4px);
        }

        .secure {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 22px;
            font-size: .78rem;
            font-weight: 600;
            color: var(--muted);
        }

        .secure i {
            color: var(--green);
        }

        .copy {
            margin-top: 34px;
            text-align: center;
            font-size: .76rem;
            color: #b3b8cb;
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 1100px) {
            .brand {
                padding: 40px;
            }

            .showcase {
                transform: scale(.9);
                transform-origin: left center;
            }
        }

        @media (max-width: 991.98px) {
            .auth {
                grid-template-columns: 1fr;
                grid-template-rows: auto 1fr;
                background: var(--grad);
            }

            .brand {
                padding: 28px 24px 70px;
                background: transparent;
            }

            .showcase,
            .brand-foot {
                display: none;
            }

            .brand-copy {
                margin-top: 26px;
            }

            .brand-copy h1 {
                font-size: 1.7rem;
                margin-bottom: 6px;
            }

            .brand-copy p {
                font-size: .9rem;
            }

            .panel {
                align-items: flex-start;
                margin-top: -44px;
                padding: 32px 24px 28px;
                border-radius: 28px 28px 0 0;
                box-shadow: 0 -10px 30px rgba(6, 40, 70, .15);
                position: relative;
            }

            .form-box h2 {
                font-size: 1.55rem;
            }
        }

        @media (max-width: 400px) {
            .brand {
                padding: 22px 18px 64px;
            }

            .panel {
                padding: 28px 18px 24px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body>
    <main class="auth">
        <section class="brand" aria-hidden="false">
            <span class="orb o1"></span>
            <span class="orb o2"></span>
            <span class="orb o3"></span>

            <div class="logo">
                <span class="logo-mark"><i class="fas fa-wallet"></i></span>
                <span>ADR <sup>fm</sup></span>
            </div>

            <div>
                <div class="brand-copy">
                    <div class="eyebrow">Finance Monitor</div>
                    <h1>Pantau setiap rupiah, <em>kendalikan</em> masa depanmu.</h1>
                    <p>Catat pemasukan & pengeluaran, kelola aset, dan lihat perkembangan keuanganmu dalam satu tempat.</p>
                </div>

                <div class="showcase" aria-hidden="true">
                    <div class="glass g-balance">
                        <div class="lbl">Total Aset</div>
                        <div class="val"><small>Rp</small>128.450.000</div>
                        <div class="bars">
                            <span style="height:38%; animation-delay:.05s"></span>
                            <span style="height:55%; animation-delay:.1s"></span>
                            <span style="height:42%; animation-delay:.15s"></span>
                            <span style="height:68%; animation-delay:.2s"></span>
                            <span style="height:60%; animation-delay:.25s"></span>
                            <span style="height:82%; animation-delay:.3s"></span>
                            <span class="hi" style="height:100%; animation-delay:.35s"></span>
                        </div>
                    </div>
                    <div class="glass g-income">
                        <div class="row-ic">
                            <span class="ic up"><i class="fas fa-arrow-up"></i></span>
                            <div>
                                <div class="lbl">Income</div>
                                <b>+12,4%</b>
                            </div>
                        </div>
                    </div>
                    <div class="glass g-spend">
                        <div class="row-ic">
                            <span class="ic down"><i class="fas fa-arrow-down"></i></span>
                            <div>
                                <div class="lbl">Spending</div>
                                <b>−4,1%</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="brand-foot">
                <span><i class="fas fa-chart-pie"></i>Laporan bulanan</span>
                <span><i class="fas fa-cubes"></i>Multi aset</span>
                <span><i class="fas fa-history"></i>Riwayat lengkap</span>
            </div>
        </section>

        <section class="panel">
            <div class="form-box">
                <span class="hello"><i class="fas fa-hand-sparkles"></i> Selamat datang kembali</span>
                <h2>Masuk ke akunmu</h2>
                <p class="sub">Silakan login untuk melanjutkan ke dashboard.</p>

                @error('loginFail')
                    <div class="alert" role="alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                        <button type="button" aria-label="Tutup" onclick="this.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @enderror

                <form id="loginForm" method="POST" action="{{ route('web.login.gas') }}">
                    @csrf
                    <div class="field">
                        <label for="user_email">Email</label>
                        <div class="control">
                            <input type="email" name="user_email" id="user_email" placeholder="nama@email.com"
                                value="{{ old('user_email') }}" autocomplete="email" required
                                {{ old('user_email') ? '' : 'autofocus' }}>
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>

                    <div class="field">
                        <label for="user_pass">Password</label>
                        <div class="control has-eye">
                            <input type="password" name="user_pass" id="user_pass" placeholder="Masukkan password"
                                autocomplete="current-password" required {{ old('user_email') ? 'autofocus' : '' }}>
                            <i class="fas fa-lock"></i>
                            <button type="button" class="eye" id="togglePass" aria-label="Tampilkan password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="caps" id="capsWarn"><i class="fas fa-exclamation-triangle"></i> Caps Lock aktif</div>
                    </div>

                    <label class="check">
                        <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                        <span class="box"><i class="fas fa-check"></i></span>
                        Ingat saya
                    </label>

                    <button type="submit" class="btn-login" id="btnLogin">
                        Masuk <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="secure"><i class="fas fa-shield-alt"></i> Koneksi aman & data terenkripsi</div>
                <div class="copy">&copy; {{ date('Y') }} ADR Finance Monitor</div>
            </div>
        </section>
    </main>

    <script>
        (function() {
            const pass = document.getElementById('user_pass');
            const toggle = document.getElementById('togglePass');
            const caps = document.getElementById('capsWarn');
            const form = document.getElementById('loginForm');
            const btn = document.getElementById('btnLogin');

            toggle.addEventListener('click', function() {
                const show = pass.type === 'password';
                pass.type = show ? 'text' : 'password';
                toggle.innerHTML = '<i class="fas ' + (show ? 'fa-eye-slash' : 'fa-eye') + '"></i>';
                toggle.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
                pass.focus();
            });

            ['keydown', 'keyup'].forEach(function(evt) {
                pass.addEventListener(evt, function(e) {
                    if (e.getModifierState) caps.classList.toggle('show', e.getModifierState('CapsLock'));
                });
            });
            pass.addEventListener('blur', function() {
                caps.classList.remove('show');
            });

            form.addEventListener('submit', function() {
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Memproses…';
            });
        })();
    </script>
</body>

</html>
