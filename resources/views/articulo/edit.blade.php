@include('articulo.cabecera')
<form action="{{ url('/articulo/'.$articulo->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}
    @include('articulo.form')
</form>


<div class="text-center">
    <a href="{{ url('/articulo') }}"><button class="btn btn-success m-5">Volver al inicio</button></a>
</div>