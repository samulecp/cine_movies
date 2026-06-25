@extends('layouts.cliente')

@section('title','Pago')

@section('content')

<style>
.payment-box{
    max-width:600px;
    margin:auto;
    border-radius:15px;
}

.total-price{
    font-size:32px;
    font-weight:bold;
    color:#28a745;
}

.method-box{
    display:flex;
    gap:10px;
    margin-top:10px;
}

.method-option{
    flex:1;
    border:1px solid #555;
    padding:12px;
    border-radius:10px;
    cursor:pointer;
    text-align:center;
    transition:.2s;
}

.method-option:hover{
    transform:scale(1.03);
}

.method-option input{
    display:none;
}

.method-option.active{
    background:#0d6efd;
    border-color:#0d6efd;
}
</style>

<div class="card text-white bg-dark payment-box">

    <div class="card-header text-center">
        <h3>💳 Confirmar Pago</h3>
        <small>{{ $venta->proyeccion->pelicula->nombre }}</small>
    </div>

    <div class="card-body">

        {{-- TOTAL --}}
        <div class="text-center mb-4">
            <p>Total a pagar</p>
            <div class="total-price">
                Bs {{ number_format($venta->precio_total,2) }}
            </div>
        </div>

        <hr>

        {{-- RESUMEN --}}
        <p><b>🎬 Película:</b> {{ $venta->proyeccion->pelicula->nombre }}</p>
        <p><b>🎟 Entradas:</b> {{ $venta->detalles ? $venta->detalles->count() : 0 }}</p>

        <hr>

        <form action="{{ route('pagos.store',$venta->id) }}" method="POST">
            @csrf

            <label><b>Método de Pago</b></label>

            <div class="method-box">

                <label class="method-option">
                    <input type="radio" name="metodo_pago" value="QR" checked>
                    📱 QR
                </label>

                <label class="method-option">
                    <input type="radio" name="metodo_pago" value="Tarjeta">
                    💳 Tarjeta
                </label>

                

            </div>

            <button class="btn btn-success btn-block mt-4">
                Confirmar Pago
            </button>

        </form>

    </div>
</div>

<script>
document.querySelectorAll('.method-option input').forEach(input => {
    input.addEventListener('change', function(){
        document.querySelectorAll('.method-option')
            .forEach(el => el.classList.remove('active'));

        this.parentElement.classList.add('active');
    });
});
</script>

@endsection