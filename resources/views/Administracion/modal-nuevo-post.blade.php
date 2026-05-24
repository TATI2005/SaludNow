<!-- resources/views/Administracion/modal-nuevo-post.blade.php -->
<div class="modal fade" id="modalNuevoPost" tabindex="-1" aria-labelledby="modalNuevoPostLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header py-3" style="background-color: #1f5945; color: white; border-bottom: 4px solid #89cbca;">
                <h5 class="modal-title fw-bold" id="modalNuevoPostLabel">
                    <i class="fa-solid fa-pen-nib me-2"></i> Redactar Nueva Entrada
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/blog/publicar" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 text-start">
                    <div class="row g-3">
                        <div class="col-md-8 col-12">
                            <label class="form-label fw-bold text-secondary small">Título del Post:</label>
                            <input type="text" name="titulo" class="form-control form-control-sm rounded-2" required>
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label fw-bold text-secondary small">Categoría:</label>
                            <select name="categoria" class="form-select form-select-sm rounded-2" required>
                                <option value="Prevención Médica">Prevención Médica</option>
                                <option value="Salud y Nutrición">Salud y Nutrición</option>
                                <option value="Pediatría General">Pediatría General</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary small">Imagen Adjunta:</label>
                            <input type="file" name="imagen_destacada" class="form-control form-control-sm rounded-2" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary small">Contenido del Artículo:</label>
                            <textarea name="contenido" class="form-control rounded-2" rows="6" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-sm px-4 text-white" style="background-color: #1f5945; font-weight: 600;">Guardar y Publicar</button>
                </div>
            </form>
        </div>
    </div>
</div>