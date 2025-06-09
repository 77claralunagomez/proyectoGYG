<div class="container my-5 mt-5" >
            <h3 class="my-5 mt-5">Nuevo Producto</h3>

            <form action="<?= base_url('nuevoproducto');?>" class="row g-3" method="post" autocomplete="off">

                <div class="col-md-4">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required autofocus>
                </div>

                <div class="col-md-8">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                </div>

                <div class="col-md-6">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="precio" name="precio" required>
                </div>

                <div class="col-md-6">
                    <label for="cantidad" class="form-label">cantidad</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                </div>


                <div class="col-md-6">
                    <label for="categoria" class="form-label">cantegoria</label>
                    <select class="form-select" id="categoria" name="categoria" required>
                     <option value="">seleccionar categoria</option>
                     <option value="">lentes de sol</option>
                     <option value="">lentes de vista</option>
                    </select>
                </div>


                <div class="col-12">
                    <a href="index.html" class="btn btn-secondary">Regresar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

            </form>

        </div>