<div id="gallary" class="container-fluid bg-dark text-light py-5 text-center wow fadeIn" style="padding-top: 1.5rem;">
    <style>
        #gallary .section-title {
            color: white !important;
            font-size: 2.6rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin: 0 0 1.75rem;
        }
    </style>
    <h2 class="section-title mb-0">Our Menu</h2>
</div>

<div class="gallary row" style="margin-top: 10px; margin-bottom: 60px;">
    @if(isset($galleries) && $galleries->count() > 0)
        {{-- Show dynamic images from database --}}
        @foreach($galleries as $gallery)
            <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
                <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                     alt="{{ $gallery->title ?? 'Gallery Image' }}" 
                     class="gallary-img"
                     title="{{ $gallery->description ?? $gallery->title ?? 'Gallery Image' }}">
               
                   
                </a>
            </div>
        @endforeach
    @else
        {{-- Show static images if no dynamic images available --}}
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="{{ asset('assets/imgs/gallary-1.jpg') }}" alt="template by DevCRID http://www.devcrud.com/" class="gallary-img">
            <a href="#" class="gallary-overlay">
                
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="{{ asset('assets/imgs/gallary-2.jpg') }}" alt="template by DevCRID http://www.devcrud.com/" class="gallary-img">
            <a href="#" class="gallary-overlay">
               
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="{{ asset('assets/imgs/gallary-3.jpg') }}" alt="template by DevCRID http://www.devcrud.com/" class="gallary-img">
            <a href="#" class="gallary-overlay">
               
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="{{ asset('assets/imgs/gallary-4.jpg') }}" alt="template by DevCRID http://www.devcrud.com/" class="gallary-img">
            <a href="#" class="gallary-overlay">
               
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="{{ asset('assets/imgs/gallary-5.jpg') }}" alt="template by DevCRID http://www.devcrud.com/" class="gallary-img">
            <a href="#" class="gallary-overlay">
                
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="{{ asset('assets/imgs/gallary-6.jpg') }}" alt="template by DevCRID http://www.devcrud.com/" class="gallary-img">
            <a href="#" class="gallary-overlay">
              
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="{{ asset('assets/imgs/gallary-7.jpg') }}" alt="template by DevCRID http://www.devcrud.com/" class="gallary-img">
            <a href="#" class="gallary-overlay">
              
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="{{ asset('assets/imgs/gallary-8.jpg') }}" alt="template by DevCRID http://www.devcrud.com/" class="gallary-img">
            <a href="#" class="gallary-overlay">
               
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="{{ asset('assets/imgs/gallary-9.jpg') }}" alt="template by DevCRID http://www.devcrud.com/" class="gallary-img">
            <a href="#" class="gallary-overlay">
               
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="{{ asset('assets/imgs/gallary-10.jpg') }}" alt="template by DevCRID http://www.devcrud.com/" class="gallary-img">
            <a href="#" class="gallary-overlay">
               
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="{{ asset('assets/imgs/gallary-11.jpg') }}" alt="template by DevCRID http://www.devcrud.com/" class="gallary-img">
            <a href="#" class="gallary-overlay">
               
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="{{ asset('assets/imgs/gallary-12.jpg') }}" alt="template by DevCRID http://www.devcrud.com/" class="gallary-img">
            <a href="#" class="gallary-overlay">
                
            </a>
        </div>
    @endif
</div>
