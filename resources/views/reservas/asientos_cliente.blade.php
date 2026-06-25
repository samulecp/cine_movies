
@extends('layouts.cliente')


@section('content')

<h3 class="text-center mb-4">
    🎬 {{ $proyeccion->pelicula->nombre }}
</h3>

{{-- PANTALLA --}}
<div class="text-center mb-4">
    <div class="pantalla">
        PANTALLA
    </div>
</div>

<form action="{{ route('ventas.resumen') }}" method="POST">
    @csrf

    <input type="hidden" name="proyeccion_id" value="{{ $proyeccion->id }}">

    {{-- LEYENDA --}}
    <div class="text-center mb-3">
        <span class="badge bg-success">Libre</span>
        <span class="badge bg-danger">Ocupado</span>
        <span class="badge bg-primary">Seleccionado</span>
    </div>

    <div class="d-flex flex-column align-items-center">

        @php
            $filas = ['A','B','C','D','E','F'];
        @endphp

        @foreach($filas as $fila)

            <div class="d-flex align-items-center mb-2">

                {{-- LETRA FILA --}}
                <div style="width:30px;font-weight:bold;">
                    {{ $fila }}
                </div>

                {{-- BLOQUE IZQUIERDO (1-5) --}}
                @for($col = 1; $col <= 5; $col++)

                    @php
                        $butaca = $butacas->first(function($b) use ($fila, $col) {
                            return $b->fila->letra == $fila && $b->columna->numero == $col;
                        });

                        $ocupada = in_array($butaca->id ?? null, $ocupadas ?? []);
                    @endphp

                    @if($butaca)
                        <label style="margin:2px;">
                            <input type="checkbox"
                                   name="butacas[]"
                                   value="{{ $butaca->id }}"
                                   {{ $ocupada ? 'disabled' : '' }}
                                   style="display:none;">

                            <div class="seat btn btn-sm {{ $ocupada ? 'btn-danger' : 'btn-success' }}"
                                 style="width:40px;">
                                {{ $col }}
                            </div>
                        </label>
                    @endif

                @endfor

                {{-- PASILLO CENTRAL --}}
                <div style="width:40px;"></div>

                {{-- BLOQUE DERECHO (6-10) --}}
                @for($col = 6; $col <= 10; $col++)

                    @php
                        $butaca = $butacas->first(function($b) use ($fila, $col) {
                            return $b->fila->letra == $fila && $b->columna->numero == $col;
                        });

                        $ocupada = in_array($butaca->id ?? null, $ocupadas ?? []);
                    @endphp

                    @if($butaca)
                        <label style="margin:2px;">
                            <input type="checkbox"
                                   name="butacas[]"
                                   value="{{ $butaca->id }}"
                                   {{ $ocupada ? 'disabled' : '' }}
                                   style="display:none;">

                            <div class="seat btn btn-sm {{ $ocupada ? 'btn-danger' : 'btn-success' }}"
                                 style="width:40px;">
                                {{ $col }}
                            </div>
                        </label>
                    @endif

                @endfor

            </div>

        @endforeach

    </div>

    <div class="text-center mt-4">
        <button class="btn btn-primary">
            🎟 Reservar Butacas
        </button>
    </div>

</form>

@endsection

@section('js')
<script>

document.querySelectorAll('input[type=checkbox]').forEach(input => {
    input.addEventListener('change', function () {

        let seat = this.nextElementSibling;

        if (this.checked) {
            seat.classList.remove('btn-success');
            seat.classList.add('btn-primary');
        } else {
            seat.classList.remove('btn-primary');
            seat.classList.add('btn-success');
        }

    });
});

</script>
@stop