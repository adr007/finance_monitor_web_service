@extends('_layouts.app')
@section('css')
    @include('_components.account_style')
    <style>
        .acc-page .f-input input {
            padding-right: 46px;
        }

        .acc-page .eye {
            position: absolute;
            right: 6px;
            top: 50%;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            border: 0;
            border-radius: 10px;
            background: transparent;
            color: var(--muted);
            cursor: pointer;
        }

        .acc-page .eye:hover {
            background: var(--line);
            color: var(--ink);
        }

        /* Strength meter */
        .acc-page .meter {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 6px;
            margin-top: 10px;
        }

        .acc-page .meter span {
            height: 6px;
            border-radius: 999px;
            background: var(--line);
            transition: background .2s ease;
        }

        .acc-page .meter-label {
            display: flex;
            justify-content: space-between;
            margin-top: 6px;
            font-size: .76rem;
            font-weight: 700;
            color: var(--muted);
        }

        .acc-page .meter-label b {
            color: var(--mc, var(--muted));
        }

        /* Requirement checklist */
        .acc-page .reqs {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
            padding: 14px;
            margin-bottom: 18px;
            border-radius: 14px;
            background: var(--soft);
            list-style: none;
        }

        .acc-page .reqs li {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .8rem;
            font-weight: 600;
            color: var(--muted);
            transition: color .15s ease;
        }

        .acc-page .reqs li i {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: .6rem;
            color: #fff;
            background: #d5d8e3;
            transition: background .15s ease;
        }

        .acc-page .reqs li.ok {
            color: var(--ink);
        }

        .acc-page .reqs li.ok i {
            background: var(--green);
        }

        /* Side cards */
        .acc-page .shield {
            position: relative;
            overflow: hidden;
            text-align: center;
            padding: 26px 22px;
        }

        .acc-page .shield-ic {
            width: 70px;
            height: 70px;
            margin: 0 auto 12px;
            border-radius: 22px;
            display: grid;
            place-items: center;
            font-size: 1.6rem;
            color: #fff;
            background: linear-gradient(135deg, #12b886, #15aabf);
            box-shadow: 0 10px 24px rgba(18, 184, 134, .3);
        }

        .acc-page .shield h6 {
            font-weight: 800;
            margin-bottom: 4px;
        }

        .acc-page .shield p {
            font-size: .82rem;
            color: var(--muted);
            margin: 0;
        }

        .acc-page .tips {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .acc-page .tips li {
            display: flex;
            gap: 10px;
            padding: 8px 0;
            font-size: .82rem;
            color: var(--ink);
        }

        .acc-page .tips li i {
            margin-top: 3px;
            color: var(--amber);
        }

        @media (max-width: 575.98px) {
            .acc-page .reqs {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection
@section('pageName', 'Setting')
@section('body')
    <div class="acc-page">
        @if (session('account_success'))
            <div class="flash" role="status">
                <i class="fas fa-check-circle"></i> {{ session('account_success') }}
                <button type="button" class="flash-close" aria-label="Tutup"><i class="fas fa-times"></i></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="flash err" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
                <button type="button" class="flash-close" aria-label="Tutup"><i class="fas fa-times"></i></button>
            </div>
        @endif

        <div class="cover">
            <div class="d-label"><i class="fas fa-shield-alt mr-1"></i> Security</div>
            <div class="cover-title">Keamanan Akun</div>
            <p class="cover-sub">Gunakan password yang kuat dan unik untuk menjaga data keuangan kamu tetap aman.</p>
        </div>

        <div class="lift">
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="d-card h-100">
                    <div class="card-head">
                        <div class="head-icon" style="--c: #f0565b; --c-soft: #fdecec"><i class="fas fa-key"></i></div>
                        <div>
                            <h6>Ubah Password</h6>
                            <p>Masukkan password lama, lalu buat password baru.</p>
                        </div>
                    </div>
                    <div class="card-body-x">
                        <form id="passwordForm" action="{{ route('user.setting.password') }}" method="POST" novalidate>
                            @csrf
                            <input type="text" name="username" value="{{ $user->user_email }}" autocomplete="username"
                                class="d-none" aria-hidden="true" tabindex="-1">

                            <div class="f-group">
                                <label class="f-label" for="current_password">Password Saat Ini</label>
                                <div class="f-input @error('current_password') is-invalid @enderror">
                                    <input type="password" id="current_password" name="current_password" required
                                        autocomplete="current-password" placeholder="••••••••">
                                    <i class="fas fa-lock"></i>
                                    <button type="button" class="eye" aria-label="Tampilkan password"><i
                                            class="fas fa-eye"></i></button>
                                </div>
                                @error('current_password')
                                    <span class="f-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="f-group">
                                        <label class="f-label" for="password">Password Baru</label>
                                        <div class="f-input @error('password') is-invalid @enderror">
                                            <input type="password" id="password" name="password" required
                                                autocomplete="new-password" placeholder="Min. 8 karakter">
                                            <i class="fas fa-key"></i>
                                            <button type="button" class="eye" aria-label="Tampilkan password"><i
                                                    class="fas fa-eye"></i></button>
                                        </div>
                                        <div class="meter" aria-hidden="true"><span></span><span></span><span></span><span></span></div>
                                        <div class="meter-label"><span>Kekuatan</span><b id="meterText">—</b></div>
                                        @error('password')
                                            <span class="f-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="f-group">
                                        <label class="f-label" for="password_confirmation">Konfirmasi Password Baru</label>
                                        <div class="f-input">
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                required autocomplete="new-password" placeholder="Ulangi password baru">
                                            <i class="fas fa-check-double"></i>
                                            <button type="button" class="eye" aria-label="Tampilkan password"><i
                                                    class="fas fa-eye"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="reqs">
                                <li data-req="length"><i class="fas fa-check"></i> Minimal 8 karakter</li>
                                <li data-req="letter"><i class="fas fa-check"></i> Mengandung huruf</li>
                                <li data-req="number"><i class="fas fa-check"></i> Mengandung angka</li>
                                <li data-req="match"><i class="fas fa-check"></i> Konfirmasi cocok</li>
                            </ul>

                            <div class="f-actions">
                                <button type="reset" class="btn-x ghost" id="btnReset">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                                <button type="submit" class="btn-x primary" id="btnSubmit" disabled>
                                    <i class="fas fa-save"></i> Simpan Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="d-card shield mb-4">
                    <div class="shield-ic"><i class="fas fa-user-shield"></i></div>
                    <h6>Akun Terlindungi</h6>
                    <p>
                        Akun terakhir diperbarui
                        <b>{{ $user->updated_at ? $user->updated_at->diffForHumans() : '-' }}</b>
                    </p>
                </div>

                <div class="d-card mb-4">
                    <div class="card-body-x">
                        <div class="d-label mb-3">Info Akun</div>
                        <div class="info-row">
                            <div class="ic"><i class="fas fa-envelope"></i></div>
                            <div class="tx"><small>Email login</small><b>{{ $user->user_email }}</b></div>
                        </div>
                        <div class="info-row">
                            <div class="ic" style="--c: #4c6ef5; --c-soft: #edf2ff"><i class="fas fa-at"></i></div>
                            <div class="tx"><small>Username</small><b>{{ $user->username ?: '-' }}</b></div>
                        </div>
                        <div class="info-row">
                            <div class="ic" style="--c: #12b886; --c-soft: #e6f8f1"><i class="fas fa-user-edit"></i></div>
                            <div class="tx">
                                <small>Ingin mengubah data akun?</small>
                                <b><a href="{{ route('user.profile') }}">Buka halaman Profile →</a></b>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-card">
                    <div class="card-body-x">
                        <div class="d-label mb-2">Tips Password Aman</div>
                        <ul class="tips">
                            <li><i class="fas fa-lightbulb"></i> Kombinasikan huruf besar, kecil, angka & simbol.</li>
                            <li><i class="fas fa-lightbulb"></i> Jangan gunakan tanggal lahir atau nama.</li>
                            <li><i class="fas fa-lightbulb"></i> Jangan pakai password yang sama di aplikasi lain.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#mn-setting').addClass('active');

        $(function() {
            const levels = [
                { text: '—', color: '#8a90a8' },
                { text: 'Lemah', color: '#f0565b' },
                { text: 'Cukup', color: '#f59f00' },
                { text: 'Baik', color: '#4c6ef5' },
                { text: 'Kuat', color: '#12b886' },
            ];

            function scorePassword(pw) {
                if (!pw) return 0;
                let score = 0;
                if (pw.length >= 8) score++;
                if (/[a-z]/.test(pw) && /[A-Z]/.test(pw)) score++;
                if (/\d/.test(pw)) score++;
                if (/[^A-Za-z0-9]/.test(pw) || pw.length >= 12) score++;
                return Math.max(score, 1);
            }

            function validate() {
                const pw = $('#password').val();
                const confirm = $('#password_confirmation').val();
                const reqs = {
                    length: pw.length >= 8,
                    letter: /[A-Za-z]/.test(pw),
                    number: /\d/.test(pw),
                    match: pw.length > 0 && pw === confirm,
                };

                $.each(reqs, (key, ok) => $('.reqs li[data-req="' + key + '"]').toggleClass('ok', ok));

                const score = scorePassword(pw);
                const level = levels[score];
                $('.meter span').each(function(i) {
                    $(this).css('background', i < score ? level.color : '');
                });
                $('#meterText').text(level.text).css('color', level.color);

                const allOk = Object.values(reqs).every(Boolean) && $('#current_password').val().length > 0;
                $('#btnSubmit').prop('disabled', !allOk);
            }

            $('#current_password, #password, #password_confirmation').on('input', validate);

            $('.eye').on('click', function() {
                const input = $(this).siblings('input');
                const show = input.attr('type') === 'password';
                input.attr('type', show ? 'text' : 'password');
                $(this).find('i').toggleClass('fa-eye', !show).toggleClass('fa-eye-slash', show);
                $(this).attr('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
            });

            $('#btnReset').on('click', function() {
                setTimeout(validate, 0);
                $('.f-input').removeClass('is-invalid');
            });

            $('#passwordForm').on('submit', function() {
                $('#btnSubmit').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan…');
            });

            $('.flash-close').on('click', function() {
                $(this).closest('.flash').slideUp(200);
            });
            setTimeout(() => $('.flash:not(.err)').slideUp(300), 4000);
        });
    </script>
@endsection
