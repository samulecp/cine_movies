@extends('adminlte::page')

@section('title', 'Crear Proyección')

@section('content_header')
    <h1>CREAR PROYECCIÓN</h1>
@stop

@section('content')

<div class="card shadow p-3">

    <form action="{{ route('proyecciones.store') }}" method="POST">
        @csrf

        <div class="row">

            {{-- PELÍCULA --}}
            <div class="col-md-4">
                <label>Película</label>

                <select name="pelicula_id" id="pelicula_id" class="form-control" required>
                    <option value="">Seleccione...</option>

                    @foreach($peliculas as $pelicula)
                        <option value="{{ $pelicula->id }}"
                                data-duracion="{{ $pelicula->duracion }}">
                            {{ $pelicula->nombre }} ({{ $pelicula->duracion }} min)
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- SALA --}}
            <div class="col-md-4">
                <label>Sala</label>

                <select name="sala_id" class="form-control" required>
                    <option value="">Seleccione...</option>

                    @foreach($salas as $sala)
                        <option value="{{ $sala->id }}">
                            Sala {{ $sala->id }} - Capacidad {{ $sala->capacidad }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- LENGUAJE --}}
            <div class="col-md-4">
                <label>Lenguaje</label>

                <select name="lenguaje_id" class="form-control" required>
                    <option value="">Seleccione...</option>

                    @foreach($lenguajes as $lenguaje)
                        <option value="{{ $lenguaje->id }}">
                            {{ $lenguaje->idioma }}
                            @if($lenguaje->subtitulo)
                                ({{ $lenguaje->subtitulo }})
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="row mt-3">

            {{-- FECHA --}}
            <div class="col-md-4">
                <label>Fecha</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>

            {{-- HORA INICIO --}}
            <div class="col-md-4">
                <label>Hora Inicio</label>
                <input type="time" name="horaIni" id="horaIni" class="form-control" required>
            </div>

            {{-- HORA FIN (AUTO) --}}
            <div class="col-md-4">
                <label>Hora Fin (Automático)</label>
                <input type="time" name="horaFin" id="horaFin" class="form-control" readonly>
            </div>

        </div>

        <div class="mt-4 d-flex justify-content-between">

            <a href="{{ route('proyecciones.index') }}" class="btn btn-secondary">
                Cancelar
            </a>

            <button class="btn btn-primary">
                Guardar Proyección
            </button>

        </div>

    </form>

</div>

@stop

{{-- ================= JS ================= --}}
@section('js')
<script>

function calcularHoraFin() {

    let pelicula = document.getElementById('pelicula_id');
    let horaIni = document.getElementById('horaIni').value;

    if (!pelicula.value || !horaIni) return;

    let duracion = pelicula.options[pelicula.selectedIndex].dataset.duracion;

    let [h, m] = horaIni.split(':').map(Number);

    let inicio = new Date();
    inicio.setHours(h);
    inicio.setMinutes(m);

    inicio.setMinutes(inicio.getMinutes() + parseInt(duracion));

    let hh = String(inicio.getHours()).padStart(2, '0');
    let mm = String(inicio.getMinutes()).padStart(2, '0');

    document.getElementById('horaFin').value = `${hh}:${mm}`;
}

document.getElementById('pelicula_id').addEventListener('change', calcularHoraFin);
document.getElementById('horaIni').addEventListener('change', calcularHoraFin);

</script>
@stop