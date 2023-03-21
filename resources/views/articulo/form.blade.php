
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
        <input type="text" name="Codigo" id="codigo" require>
    </div>
    <div class="form-group p-2">
        <label for="Descripcion">
            Descripción:
        </label>
        <input type="text" name="Descripcion" id="descripcion" require>
    </div>
    <div class="form-group p-2">
        <label for="Precio">
            Precio:
        </label>
        <input type="number" name="Precio" id="precio" min="0" require>
    </div>
    <div class="form-group p-2">
        <label for="Stock">
            Stock:
        </label>
        <input type="number" name="Stock" id="stock" min="0" require>
    </div>
    <div class="form-group p-2">
        <label for="Foto">
            Foto:
        </label>
        <input type="file" name="Foto" id="foto" require>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
