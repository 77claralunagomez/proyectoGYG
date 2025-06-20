<?= $this->extend('plantilla'); ?>

<?= $this->section('content'); ?>

<div class="container my-5 mt-5">
    <h3 class="my-5 mt-5">Editar Producto</h3>

    <form action="<?= base_url('editarproducto/' . $producto['id_producto']); ?>" class="row g-3" method="post" autocomplete="off" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="producto_id" value="<?= $producto['id_producto']; ?>">


        <div class="col-md-4">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $producto['nombre']; ?>" required autofocus>
        </div>

        <div class="col-md-8">
            <label for="descripcion" class="form-label">Descripcion</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $producto['descripcion']; ?>" required>
        </div>

        <div class="col-md-6">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" value="<?= $producto['precio']; ?>" required>
        </div>

        <div class="col-md-6">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?= $producto['stock']; ?>" required>
        </div>


        <div class="col-md-6">
            <label for="categoria" class="form-label">cantegoria</label>
            <select class="form-select" id="categoria" name="categoria" required>
                <option value="">seleccionar categoria</option>
                <option value="1">lentes de sol</option>
                <option value="2">lentes de vista</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen del producto</label>
            <input class="form-control" type="file" id="imagen" name="imagen" value="<?= set_value('imagen'); ?>">
        </div>

        <div class="col-12">
            <a href="<?= base_url('catalogo'); ?>" class="btn btn-secondary">Regresar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

    </form>
    <?php if (session()->getFlashdata('errors') !== null) : ?>
        <div class="alert alert-danger my-3" role='alert'>
            <?= session()->getFlashdata('errors'); ?>
        </div>
    <?php endif; ?>

</div>
<?= $this->endSection(); ?>