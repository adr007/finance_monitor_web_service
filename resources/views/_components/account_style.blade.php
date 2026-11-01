<style>
    .acc-page {
        --ink: #1e2340;
        --muted: #8a90a8;
        --line: #eef0f6;
        --soft: #f7f8fc;
        --green: #12b886;
        --red: #f0565b;
        --amber: #f59f00;
        --violet: #7048e8;
        color: var(--ink);
    }

    .acc-page .d-label {
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: var(--muted);
    }

    .acc-page .d-card {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 18px;
        box-shadow: 0 6px 24px rgba(30, 35, 64, .06);
    }

    .acc-page .card-head {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 18px 22px;
        border-bottom: 1px solid var(--line);
    }

    .acc-page .card-head h6 {
        margin: 0;
        font-weight: 800;
        color: var(--ink);
    }

    .acc-page .card-head p {
        margin: 2px 0 0;
        font-size: .8rem;
        color: var(--muted);
    }

    .acc-page .head-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--c, var(--violet));
        background: var(--c-soft, #f0ebfe);
    }

    .acc-page .card-body-x {
        padding: 22px;
    }

    /* Cover / hero */
    .acc-page .cover {
        position: relative;
        overflow: hidden;
        border-radius: 18px;
        padding: 24px 28px 70px;
        color: #fff;
        background: linear-gradient(135deg, #1e2340 0%, #3b3f8f 55%, #7048e8 100%);
        box-shadow: 0 12px 30px rgba(30, 35, 64, .28);
    }

    .acc-page .cover::before,
    .acc-page .cover::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, .08);
        pointer-events: none;
    }

    .acc-page .cover::before {
        width: 260px;
        height: 260px;
        right: -70px;
        top: -110px;
    }

    .acc-page .cover::after {
        width: 140px;
        height: 140px;
        right: 160px;
        bottom: -80px;
    }

    .acc-page .cover .d-label {
        color: rgba(255, 255, 255, .7);
    }

    .acc-page .cover-title {
        font-size: clamp(1.3rem, 4vw, 1.7rem);
        font-weight: 800;
        margin: 4px 0 0;
    }

    .acc-page .cover-sub {
        margin: 4px 0 0;
        font-size: .88rem;
        color: rgba(255, 255, 255, .75);
        max-width: 520px;
    }

    .acc-page .lift {
        position: relative;
        margin-top: -48px;
        margin-left: 16px;
        margin-right: 16px;
    }

    /* Form */
    .acc-page .f-group {
        margin-bottom: 18px;
    }

    .acc-page .f-label {
        display: block;
        font-size: .8rem;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 6px;
    }

    .acc-page .f-label small {
        color: var(--muted);
        font-weight: 600;
    }

    .acc-page .f-input {
        position: relative;
    }

    .acc-page .f-input > i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        font-size: .85rem;
        pointer-events: none;
        transition: color .15s ease;
    }

    .acc-page .f-input input {
        width: 100%;
        height: 46px;
        padding: 0 14px 0 40px;
        border-radius: 12px;
        border: 1px solid var(--line);
        background: var(--soft);
        font-size: .9rem;
        color: var(--ink);
        transition: all .15s ease;
    }

    .acc-page .f-input input:focus {
        outline: none;
        background: #fff;
        border-color: var(--violet);
        box-shadow: 0 0 0 3px rgba(112, 72, 232, .12);
    }

    .acc-page .f-input input:focus ~ i,
    .acc-page .f-input:focus-within > i {
        color: var(--violet);
    }

    .acc-page .f-input.is-invalid input {
        border-color: var(--red);
        background: #fff8f8;
    }

    .acc-page .f-error {
        display: block;
        margin-top: 6px;
        font-size: .78rem;
        font-weight: 600;
        color: var(--red);
    }

    .acc-page .f-hint {
        display: block;
        margin-top: 6px;
        font-size: .76rem;
        color: var(--muted);
    }

    .acc-page .f-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 18px;
        margin-top: 4px;
        border-top: 1px solid var(--line);
    }

    .acc-page .btn-x {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 44px;
        padding: 0 20px;
        border-radius: 12px;
        border: 1px solid transparent;
        font-size: .88rem;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none !important;
        transition: all .15s ease;
    }

    .acc-page .btn-x.primary {
        color: #fff;
        background: linear-gradient(135deg, #3b3f8f, #7048e8);
        box-shadow: 0 6px 16px rgba(112, 72, 232, .3);
    }

    .acc-page .btn-x.primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 22px rgba(112, 72, 232, .35);
    }

    .acc-page .btn-x.primary:disabled {
        opacity: .5;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .acc-page .btn-x.ghost {
        color: var(--ink);
        background: #fff;
        border-color: var(--line);
    }

    .acc-page .btn-x.ghost:hover {
        background: var(--soft);
    }

    /* Flash toast */
    .acc-page .flash {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        margin-bottom: 18px;
        border-radius: 14px;
        border: 1px solid #c3f0dd;
        background: #e6f8f1;
        color: #0b7a5a;
        font-weight: 700;
        font-size: .88rem;
        animation: accSlide .35s ease;
    }

    .acc-page .flash.err {
        border-color: #fbd0d1;
        background: #fdecec;
        color: #c92a2f;
    }

    .acc-page .flash .flash-close {
        margin-left: auto;
        border: 0;
        background: transparent;
        color: inherit;
        opacity: .6;
        cursor: pointer;
    }

    @keyframes accSlide {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    /* Info list */
    .acc-page .info-row {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-top: 1px solid var(--line);
    }

    .acc-page .info-row:first-child {
        border-top: 0;
        padding-top: 0;
    }

    .acc-page .info-row .ic {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .8rem;
        color: var(--c, var(--violet));
        background: var(--c-soft, #f0ebfe);
    }

    .acc-page .info-row .tx {
        min-width: 0;
        flex: 1;
    }

    .acc-page .info-row .tx small {
        display: block;
        font-size: .72rem;
        color: var(--muted);
        font-weight: 600;
    }

    .acc-page .info-row .tx b {
        display: block;
        font-size: .88rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    @media (max-width: 575.98px) {
        .acc-page .cover {
            padding: 20px 20px 64px;
        }

        .acc-page .lift {
            margin-left: 8px;
            margin-right: 8px;
        }

        .acc-page .card-head,
        .acc-page .card-body-x {
            padding: 16px;
        }

        .acc-page .f-actions .btn-x {
            flex: 1 1 100%;
        }
    }
</style>
