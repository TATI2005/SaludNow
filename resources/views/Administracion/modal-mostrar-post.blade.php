<div class="modal fade" id="modalBlogPublico" tabindex="-1" aria-labelledby="modalBlogPublicoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
            
            <div class="modal-header py-3 text-white" style="background-color: #1f5945; border-bottom: 4px solid #89cbca;">
                <h5 class="modal-title fw-bold" id="modalBlogPublicoLabel">
                    <i class="fa-solid fa-book-open-reader me-2"></i> Nuestro Blog de Salud
                </h5>
                <button type="button" class="btn btn-sm btn-outline-light d-none ms-auto me-2" id="btnRegresarLista" onclick="mostrarListaBlog()">
                    <i class="fa-solid fa-arrow-left me-1"></i> Volver al listado
                </button>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-light">
                
                <div id="vista-lista-blog">
                    <div class="row g-3">
                        @forelse($articulos as $art)
                            <div class="col-12">
                                <div class="card border-0 shadow-sm rounded-3 overflow-hidden custom-blog-card" style="cursor: pointer;" 
                                     onclick="leerArticulo('{{ $art->titulo }}', '{{ $art->categoria }}', `{{ $art->contenido }}`, '{{ $art->autor ?? 'Especialista' }}', '{{ $art->created_at }}', '{{ !empty($art->imagen) ? asset('img/blog/' . $art->imagen) : '' }}')">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-sm-4 col-12 style-img-container" style="height: 120px;">
                                            @if(!empty($art->imagen))
                                                <img src="{{ asset('img/blog/' . $art->imagen) }}" class="w-100 h-100 object-fit-cover">
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-secondary-subtle text-muted">
                                                    <i class="fa-solid fa-image fs-3 opacity-50"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-sm-8 col-12 p-3">
                                            <span class="badge rounded-pill mb-1 small" style="background-color: #e8f5f1; color: #1f5945;">{{ $art->categoria }}</span>
                                            <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $art->titulo }}</h6>
                                            <p class="text-secondary small mb-0 text-truncate-2" style="font-size: 0.85rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                {{ $art->contenido }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted">
                                <i class="fa-regular fa-folder-open fs-2 d-block mb-2 opacity-50"></i>
                                <p class="small">No hay artículos publicados en este momento.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div id="vista-lectura-blog" class="d-none bg-white p-4 rounded-3 shadow-sm">
                    <div class="rounded-3 overflow-hidden mb-3 shadow-sm" style="height: 240px; display: none;" id="ver-contenedor-img">
                        <img src="" id="ver-imagen" class="w-100 h-100 object-fit-cover">
                    </div>
                    <span id="ver-categoria" class="badge rounded-pill mb-2 px-3 py-1 text-uppercase" style="background-color: #89cbca; color: #1f5945; font-size: 0.65rem;"></span>
                    <h3 id="ver-titulo" class="fw-bold mb-3" style="color: #1f5945;"></h3>
                    
                    <div class="d-flex align-items-center mb-3 pb-2 border-bottom border-light">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center fw-bold text-uppercase" style="width: 35px; height: 35px; color: #1f5945; font-size: 0.85rem;" id="ver-avatar"></div>
                        <div class="ms-2">
                            <p class="mb-0 fw-bold small text-dark" id="ver-autor"></p>
                            <small class="text-muted" style="font-size: 0.75rem;" id="ver-fecha"></small>
                        </div>
                    </div>
                    <div id="ver-contenido" class="text-secondary lh-base" style="font-size: 0.95rem; white-space: pre-line;"></div>
                </div>

            </div>
            <div class="modal-footer bg-light border-top-0">
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-blog-card { transition: transform 0.2s, box-shadow 0.2s; }
    .custom-blog-card:hover { transform: translateY(-2px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.08)!important; }
</style>