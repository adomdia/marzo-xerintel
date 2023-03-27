<input type="hidden" name="id_articulo" value="{{ isset($articulo->id)?$articulo->id:'' }}">
<div class="container border text-center" style="margin: 150px auto;
        max-width: 400px;
        font-weight: 600;
        background-color: #fff;
        border-radius: 15px;
        padding: 20px;">
    <div class="form-group p-2">
        <label for="Codigo">
            Código:
        </label>
        <input type="text" name="codigo" id="codigo" value="{{ isset($articulo->codigo)?$articulo->codigo:''  }}" require>
    </div>
    <div class="form-group p-2">
        <label for="Descripcion">
            Descripción:
        </label>
        <input type="text" name="descripcion" id="descripcion" value="{{ isset($articulo->descripcion)?$articulo->descripcion:''  }}"  require>
    </div>
    <div class="form-group p-2">
        <label for="Precio">
            Precio:
        </label>
        <input type="number" name="precio" id="precio" min="0" value="{{ isset($articulo->precio)?$articulo->precio:''  }}" require>
    </div>
    <div class="form-group p-2">
        <label for="Stock">
            Stock:
        </label>
        <input type="number" name="stock" id="stock" min="0" value="{{ isset($articulo->stock)?$articulo->stock:''  }}" require>
    </div>
    <div class="form-group p-2">
        <label for="Foto">
            Foto:
        </label>
        <input type="file" name="foto" id="foto" require>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
