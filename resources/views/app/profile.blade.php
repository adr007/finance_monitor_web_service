@extends('_layouts.app')
@section('css')
    @include('_components.account_style')
    <style>
        /* Identity card */
        .acc-page .id-card {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 18px;
            padding: 20px 22px;
        }

        .acc-page .avatar {
            position: relative;
            width: 104px;
            height: 104px;
            flex-shrink: 0;
        }

        .acc-page .avatar img {
            width: 100%;
            height: 100%;
            border-radius: 28px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 8px 22px rgba(30, 35, 64, .18);
            background: var(--soft);
        }

        .acc-page .avatar .cam {
            position: absolute;
            right: -6px;
            bottom: -6px;
            width: 36px;
            height: 36px;
            border-radius: 12px;
            border: 3px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: .8rem;
            background: linear-gradient(135deg, #3b3f8f, #7048e8);
            cursor: pointer;
            transition: transform .15s ease;
        }

        .acc-page .avatar .cam:hover {
            transform: scale(1.08);
        }

        .acc-page .id-main {
            flex: 1 1 220px;
            min-width: 0;
        }

        .acc-page .id-name {
            font-size: 1.35rem;
            font-weight: 800;
            margin: 0;
            overflow-wrap: anywhere;
        }

        .acc-page .id-handle {
            color: var(--violet);
            font-weight: 700;
            font-size: .88rem;
        }

        .acc-page .id-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 10px;
        }

        .acc-page .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 11px;
            border-radius: 999px;
            background: var(--soft);
            border: 1px solid var(--line);
            font-size: .76rem;
            font-weight: 600;
            color: var(--ink);
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .acc-page .pill i {
            color: var(--muted);
        }

        .acc-page .id-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .acc-page .photo-hint {
            display: none;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
            font-size: .78rem;
            font-weight: 600;
            color: var(--amber);
        }

        .acc-page .photo-hint.show {
            display: flex;
        }

        /* Stats */
        .acc-page .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
        }

        .acc-page .stat {
            padding: 14px;
            border-radius: 14px;
            background: var(--soft);
            min-width: 0;
        }

        .acc-page .stat i {
            color: var(--c);
            margin-bottom: 8px;
            display: block;
        }

        .acc-page .stat b {
            display: block;
            font-size: 1.05rem;
            font-weight: 800;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-variant-numeric: tabular-nums;
        }

        .acc-page .stat small {
            font-size: .72rem;
            color: var(--muted);
            font-weight: 600;
        }

        /* Completeness ring */
        .acc-page .complete {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .acc-page .ring {
            --p: 0;
            width: 76px;
            height: 76px;
            flex-shrink: 0;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: conic-gradient(var(--violet) calc(var(--p) * 1%), var(--line) 0);
        }

        .acc-page .ring span {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #fff;
            display: grid;
            place-items: center;
            font-weight: 800;
            font-size: .95rem;
        }

        .acc-page .todo {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: .8rem;
        }

        .acc-page .todo li {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 2px 0;
            color: var(--muted);
        }

        .acc-page .todo li.done {
            color: var(--ink);
        }

        .acc-page .todo li i {
            font-size: .75rem;
            color: #c3c7d6;
        }

        .acc-page .todo li.done i {
            color: var(--green);
        }

        @media (max-width: 575.98px) {
            .acc-page .id-card {
                flex-direction: column;
                text-align: center;
                padding: 18px 16px;
            }

            .acc-page .id-main {
                flex-basis: auto;
                width: 100%;
            }

            .acc-page .id-meta,
            .acc-page .id-actions,
            .acc-page .photo-hint {
                justify-content: center;
            }

            .acc-page .id-actions {
                width: 100%;
            }

            .acc-page .id-actions .btn-x {
                flex: 1;
            }

            .acc-page .stats {
                gap: 8px;
            }

            .acc-page .stat {
                padding: 10px;
            }

            .acc-page .stat b {
                font-size: .9rem;
            }
        }
    </style>
@endsection
@section('pageName', 'Profile')
@section('body')
    @php
        $checks = [
            'Nama lengkap' => filled($user->user_name),
            'Username' => filled($user->username),
            'Email' => filled($user->user_email),
            'No. telepon' => filled($user->user_tlp),
            'Foto profil' => filled($user->user_photo),
        ];
        $percent = round((collect($checks)->filter()->count() / count($checks)) * 100);
        $fmt = fn($n) => number_format((float) $n, 0, ',', '.');
        $shortRp = function ($n) {
            $n = (float) $n;
            if ($n >= 1e9) return 'Rp ' . rtrim(rtrim(number_format($n / 1e9, 1, ',', '.'), '0'), ',') . ' M';
            if ($n >= 1e6) return 'Rp ' . rtrim(rtrim(number_format($n / 1e6, 1, ',', '.'), '0'), ',') . ' jt';
            return 'Rp ' . number_format($n, 0, ',', '.');
        };
    @endphp
    <div class="acc-page">
        @if (session('account_success'))
            <div class="flash" role="status">
                <i class="fas fa-check-circle"></i> {{ session('account_success') }}
                <button type="button" class="flash-close" aria-label="Tutup"><i class="fas fa-times"></i></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="flash err" role="alert">
                <i class="fas fa-exclamation-circle"></i> Periksa kembali data yang kamu isi.
                <button type="button" class="flash-close" aria-label="Tutup"><i class="fas fa-times"></i></button>
            </div>
        @endif

        <div class="cover">
            <div class="d-label"><i class="fas fa-user-circle mr-1"></i> My Account</div>
            <div class="cover-title">Halo, {{ \Illuminate\Support\Str::words($user->user_name, 1, '') }} 👋</div>
            <p class="cover-sub">Kelola informasi pribadi yang terhubung dengan akun ADR Finance Monitor kamu.</p>
        </div>

        <div class="d-card lift mb-4">
            <div class="id-card">
                <div class="avatar">
                    <img id="avatarPreview" src="{{ $user->photo_url }}" alt="Foto profil {{ $user->user_name }}">
                    <label for="user_photo" class="cam mb-0" title="Ganti foto">
                        <i class="fas fa-camera"></i>
                    </label>
                </div>
                <div class="id-main">
                    <h5 class="id-name">{{ $user->user_name }}</h5>
                    <div class="id-handle">{{ '@' . ($user->username ?: 'username') }}</div>
                    <div class="id-meta">
                        <span class="pill"><i class="fas fa-envelope"></i> {{ $user->user_email }}</span>
                        @if ($user->user_tlp)
                            <span class="pill"><i class="fas fa-phone"></i> {{ $user->user_tlp }}</span>
                        @endif
                        @if ($user->created_at)
                            <span class="pill"><i class="fas fa-calendar-alt"></i> Bergabung
                                {{ $user->created_at->translatedFormat('M Y') }}</span>
                        @endif
                    </div>
                    <div class="photo-hint" id="photoHint">
                        <i class="fas fa-info-circle"></i> <span>Foto baru dipilih — klik <b>Simpan Perubahan</b>.</span>
                    </div>
                    @error('user_photo')
                        <span class="f-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="id-actions">
                    @if ($user->user_photo)
                        <button type="button" class="btn-x ghost" id="btnRemovePhoto">
                            <i class="fas fa-trash-alt"></i> Hapus Foto
                        </button>
                    @endif
                    <a href="{{ route('user.setting') }}" class="btn-x ghost">
                        <i class="fas fa-lock"></i> Ubah Password
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="d-card h-100">
                    <div class="card-head">
                        <div class="head-icon"><i class="fas fa-id-card"></i></div>
                        <div>
                            <h6>Informasi Pribadi</h6>
                            <p>Data ini digunakan untuk identitas dan login akun kamu.</p>
                        </div>
                    </div>
                    <div class="card-body-x">
                        <form id="profileForm" action="{{ route('user.profile.update') }}" method="POST"
                            enctype="multipart/form-data" novalidate>
                            @csrf
                            <input type="file" name="user_photo" id="user_photo" accept="image/png,image/jpeg,image/webp"
                                class="d-none">
                            <input type="hidden" name="remove_photo" id="remove_photo" value="0">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="f-group">
                                        <label class="f-label" for="user_name">Nama Lengkap</label>
                                        <div class="f-input @error('user_name') is-invalid @enderror">
                                            <input type="text" id="user_name" name="user_name" maxlength="100" required
                                                value="{{ old('user_name', $user->user_name) }}" placeholder="Nama lengkap">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        @error('user_name')
                                            <span class="f-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="f-group">
                                        <label class="f-label" for="username">Username</label>
                                        <div class="f-input @error('username') is-invalid @enderror">
                                            <input type="text" id="username" name="username" maxlength="50" required
                                                value="{{ old('username', $user->username) }}" placeholder="username"
                                                autocomplete="username">
                                            <i class="fas fa-at"></i>
                                        </div>
                                        @error('username')
                                            <span class="f-error">{{ $message }}</span>
                                        @else
                                            <span class="f-hint">Huruf, angka, strip (-) dan underscore (_).</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="f-group">
                                        <label class="f-label" for="user_email">Email</label>
                                        <div class="f-input @error('user_email') is-invalid @enderror">
                                            <input type="email" id="user_email" name="user_email" maxlength="100" required
                                                value="{{ old('user_email', $user->user_email) }}"
                                                placeholder="nama@email.com" autocomplete="email">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        @error('user_email')
                                            <span class="f-error">{{ $message }}</span>
                                        @else
                                            <span class="f-hint">Email ini dipakai untuk login.</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="f-group">
                                        <label class="f-label" for="user_tlp">No. Telepon <small>(opsional)</small></label>
                                        <div class="f-input @error('user_tlp') is-invalid @enderror">
                                            <input type="tel" id="user_tlp" name="user_tlp" maxlength="20"
                                                value="{{ old('user_tlp', $user->user_tlp) }}" placeholder="08xxxxxxxxxx"
                                                autocomplete="tel">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        @error('user_tlp')
                                            <span class="f-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="f-actions">
                                <button type="reset" class="btn-x ghost" id="btnReset">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                                <button type="submit" class="btn-x primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="d-card mb-4">
                    <div class="card-body-x">
                        <div class="d-label mb-3">Ringkasan Akun</div>
                        <div class="stats">
                            <div class="stat" style="--c: #4c6ef5">
                                <i class="fas fa-exchange-alt"></i>
                                <b>{{ $fmt($stats['transactions']) }}</b>
                                <small>Transaksi</small>
                            </div>
                            <div class="stat" style="--c: #7048e8">
                                <i class="fas fa-cubes"></i>
                                <b>{{ $fmt($stats['assets']) }}</b>
                                <small>Asset</small>
                            </div>
                            <div class="stat" style="--c: #12b886">
                                <i class="fas fa-wallet"></i>
                                <b title="Rp {{ $fmt($stats['totalAssets']) }}">{{ $shortRp($stats['totalAssets']) }}</b>
                                <small>Total Nilai</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-card">
                    <div class="card-body-x">
                        <div class="d-label mb-3">Kelengkapan Profil</div>
                        <div class="complete">
                            <div class="ring" style="--p: {{ $percent }}"><span>{{ $percent }}%</span></div>
                            <ul class="todo">
                                @foreach ($checks as $label => $done)
                                    <li class="{{ $done ? 'done' : '' }}">
                                        <i class="fas {{ $done ? 'fa-check-circle' : 'fa-circle' }}"></i> {{ $label }}
                                    </li>
                                @endforeach
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
        $('#mn-profile').addClass('active');

        $(function() {
            const originalPhoto = $('#avatarPreview').attr('src');

            $('#user_photo').on('change', function() {
                const file = this.files && this.files[0];
                if (!file) return;

                if (!/^image\/(png|jpe?g|webp)$/.test(file.type)) {
                    alert('Format foto harus JPG, PNG, atau WEBP.');
                    this.value = '';
                    return;
                }
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran foto maksimal 2 MB.');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = e => $('#avatarPreview').attr('src', e.target.result);
                reader.readAsDataURL(file);
                $('#remove_photo').val('0');
                $('#photoHint span').html('Foto baru dipilih — klik <b>Simpan Perubahan</b>.');
                $('#photoHint').addClass('show');
            });

            $('#btnRemovePhoto').on('click', function() {
                if (!confirm('Hapus foto profil?')) return;
                $('#user_photo').val('');
                $('#remove_photo').val('1');
                $('#avatarPreview').attr('src', 'https://ui-avatars.com/api/?background=7048e8&color=fff&bold=true&name=' +
                    encodeURIComponent($('#user_name').val() || 'U'));
                $('#photoHint span').html('Foto akan dihapus — klik <b>Simpan Perubahan</b>.');
                $('#photoHint').addClass('show');
            });

            $('#btnReset').on('click', function() {
                $('#avatarPreview').attr('src', originalPhoto);
                $('#remove_photo').val('0');
                $('#photoHint').removeClass('show');
                $('.f-input').removeClass('is-invalid');
            });

            $('#profileForm').on('submit', function() {
                $(this).find('button[type=submit]').prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin"></i> Menyimpan…');
            });

            $('.flash-close').on('click', function() {
                $(this).closest('.flash').slideUp(200);
            });
            setTimeout(() => $('.flash:not(.err)').slideUp(300), 4000);
        });
    </script>
@endsection
