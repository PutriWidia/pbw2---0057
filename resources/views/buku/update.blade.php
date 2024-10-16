<x-layout>
    <div class="container">
        <div class="row p-lg-3">
            <div class="col">
                <form action="/buku/{{ $buku->id }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <form>
                        <h1>Ubah Buku</h1>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                value="{{ $buku->judul }}" id="judul" name="judul">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="penulisan" class="form-label">Penulis</label>
                            <input type="text" class="form-control @error('penulisan') is-invalid @enderror"
                                value="{{ $buku->penulisan }}" id="penulisan" name="penulisan">
                            @error('penulisan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select form-select-md mb-3 @error('kategori') is-invalid @enderror"
                                id="kategori" name="kategori">
                                <option value="" selected>Pilih Kategori</option>
                                <option value="Novel" {{ $buku->kategori == 'Novel' ? 'Selected' : '' }}>Novel</option>
                                <option value="Komik" {{ $buku->kategori == 'Komik' ? 'Selected' : '' }}>Komik</option>
                                <option value="Biografi" {{ $buku->kategori == 'Biografi' ? 'Selected' : '' }}>Biografi</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sampul" class="form-label">Sampul Buku</label>
                            @if ($buku->sampul)
                            <img src="{{ asset('storage/' . $buku->sampul) }}" class="img-preview img-fluid mb-3 d-block" width="250px">
                            @else
                            <img class="img-preview img-fluid mb-3" width="250px">
                            @endif
                            <input type="hidden" name="sampulLama" value="{{ $buku->sampul }}">
                            <input class="form-control @error('sampul') is-invalid @enderror" type="file" 
                                value="{{ $buku->sampul }}" id="sampul" name="sampul" onchange="previewImage()">
                            @error('sampul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
            </div>
        </div>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector('#sampul');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.style.display = 'block';

            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);

            ofReader.onload = function (oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }
    </script>

</x-layout>