@extends('adminlte::page')

@section('title', 'Dashboard Admin')

@section('css')
    <style>
        .content-wrapper {
            background:
                radial-gradient(circle at 12% 12%, rgba(95, 146, 229, 0.2), transparent 34%),
                radial-gradient(circle at 88% 16%, rgba(217, 163, 95, 0.16), transparent 38%),
                linear-gradient(135deg, #060b18 0%, #0f1b33 52%, #060b18 100%);
            color: #f5efe5;
        }

        .admin-hero {
            border: 1px solid rgba(217, 163, 95, 0.26);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 18px;
            background: linear-gradient(120deg, rgba(10, 20, 40, 0.95), rgba(13, 25, 46, 0.9));
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.35);
            animation: riseIn 0.45s ease;
        }

        .admin-hero h1 {
            margin: 0;
            font-size: 1.6rem;
            font-weight: 700;
            color: #f0c784;
            text-shadow: 0 0 14px rgba(217, 163, 95, 0.35);
        }

        .admin-hero p {
            margin: 10px 0 0;
            color: #c5cee0;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            gap: 12px;
            margin-top: 16px;
        }

        .kpi-item {
            border: 1px solid rgba(217, 163, 95, 0.22);
            border-radius: 12px;
            padding: 12px 14px;
            background: rgba(12, 22, 44, 0.72);
        }

        .kpi-item .label {
            font-size: .78rem;
            letter-spacing: .5px;
            text-transform: uppercase;
            color: #a8b3c8;
        }

        .kpi-item .value {
            margin-top: 3px;
            font-size: 1.18rem;
            font-weight: 700;
            color: #f7f0e4;
        }

        .module-card {
            border: 1px solid rgba(217, 163, 95, 0.2);
            border-radius: 14px;
            overflow: hidden;
            background: linear-gradient(120deg, rgba(11, 22, 44, 0.92), rgba(8, 17, 35, 0.92));
            box-shadow: 0 10px 22px rgba(0, 0, 0, 0.35);
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
            height: 100%;
            animation: riseIn 0.5s ease;
        }

        .module-card:hover {
            transform: translateY(-4px);
            border-color: rgba(217, 163, 95, 0.45);
            box-shadow: 0 16px 28px rgba(0, 0, 0, 0.42), 0 0 16px rgba(217, 163, 95, 0.2);
        }

        .module-top {
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .module-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 1.1rem;
            color: #231406;
            background: linear-gradient(130deg, #d9a35f, #f0c784);
            box-shadow: 0 0 15px rgba(217, 163, 95, 0.32);
            flex: 0 0 44px;
        }

        .module-title {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
            color: #f8f1e6;
        }

        .module-desc {
            margin: 3px 0 0;
            color: #aeb9cf;
            font-size: .86rem;
        }

        .module-action {
            border-top: 1px solid rgba(217, 163, 95, 0.18);
            padding: 10px 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-decoration: none;
            color: #f0c784;
            font-weight: 600;
            font-size: .9rem;
        }

        .module-action.placeholder {
            color: #96a89f;
            cursor: default;
        }

        .module-action i {
            font-size: .86rem;
        }

        @keyframes riseIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@stop

@section('content_header')
    <h1 class="m-0 text-light">Dashboard Administrador</h1>
@stop

@section('content')
    <div class="admin-hero">
        <h1>Panel de control global</h1>

        <div class="kpi-grid">
            <div class="kpi-item">
                <div class="label">Perfil activo</div>
                <div class="value">Administrador</div>
            </div>
            <div class="kpi-item">
                <div class="label">Estado del sistema</div>
                <div class="value">Operativo</div>
            </div>
            <div class="kpi-item">
                <div class="label">Entorno</div>
                <div class="value">Presentacion</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="module-card">
                <div class="module-top">
                    <div class="module-icon"><i class="fas fa-users"></i></div>
                    <div>
                        <h5 class="module-title">Usuarios</h5>
                        <p class="module-desc">Gestion administrativa general</p>
                    </div>
                </div>
                <a href="{{ route('usuario.index') }}" class="module-action">Abrir modulo <i
                        class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="col-md-6 col-xl-4 mb-3">
            <div class="module-card">
                <div class="module-top">
                    <div class="module-icon"><i class="fas fa-user-friends"></i></div>
                    <div>
                        <h5 class="module-title">Clientes Presenciales</h5>

                    </div>
                </div>
                <a href="{{ route('clientePresencial.index') }}" class="module-action">Abrir modulo <i
                        class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="col-md-6 col-xl-4 mb-3">
            <div class="module-card">
                <div class="module-top">
                    <div class="module-icon"><i class="fas fa-laptop"></i></div>
                    <div>
                        <h5 class="module-title">Clientes Virtuales</h5>

                    </div>
                </div>
                <a href="{{ route('clienteVirtual.index') }}" class="module-action">Abrir modulo <i
                        class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="col-md-6 col-xl-4 mb-3">
            <div class="module-card">
                <div class="module-top">
                    <div class="module-icon"><i class="fas fa-cash-register"></i></div>
                    <div>
                        <h5 class="module-title">Cajeros</h5>

                    </div>
                </div>
                <a href="{{ route('cajero.index') }}" class="module-action">Abrir modulo <i
                        class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="col-md-6 col-xl-4 mb-3">
            <div class="module-card">
                <div class="module-top">
                    <div class="module-icon"><i class="fas fa-film"></i></div>

                    <div>
                        <h5 class="module-title">Películas<h5>

                                <p class="module-desc">
                                    Gestionar películas del cine
                                </p>
                    </div>

                </div>

                <a href="{{ route('peliculas.index') }}" class="module-action">

                    Abrir modulo

                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>
        </div>


    </div>
@stop
