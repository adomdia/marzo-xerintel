@include('articulo.cabecera')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('actulizararticulo') }}" method="post" enctype="multipart/form-data">
    @csrf
  
    @include('articulo.form')
</form>


<div class="text-center">
    <a href="{{ url('/articulo') }}"><button class="btn btn-success m-5">Volver al inicio</button></a>
</div>