<section class="page-section portfolio" id="katalog">
            <div class="container">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Katalog</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center">
                    
                    <!-- Portfolio Item -->
                    @foreach(App\Models\Kategori::orderBy('order_kategori','asc')->get() as $menuItem)
                        <div class="col-md-6 col-lg-4 mb-5">
                            <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal2">
                                <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                    <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="{{ asset('file_upload/kategori/thumbnails/'.$menuItem->path_gambar_kategori) }}" alt="..." />
                                <figcaption>{{ $menuItem->nama_kategori }}</figcaption>
                            </div>
                            <div class="container">
                                <div class="row">
                                <button class="btn btn-primary btn-xl disabled">{{ $menuItem->nama_kategori }}</button>
                                   
                                </div>
                             </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </section>