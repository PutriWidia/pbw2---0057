<x-layout>
    <div class="container">
        <div class="row p-lg-3">
            <div class="col">
                <form action="/buku" method="POST" enctype="multipart/form-data">
                    @csrf
                    <form>
                        <h1>Tambah Buku</h1>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                value="{{ old('judul') }}" id="judul" name="judul">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="penulisan" class="form-label">Penulis</label>
                            <input type="text" class="form-control @error('penulisan') is-invalid @enderror"
                                value="{{ old('penulisan') }}" id="penulisan" name="penulisan">
                            @error('penulisan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select form-select-md mb-3 @error('kategori') is-invalid @enderror"
                                id="kategori" name="kategori">
                                <option value="" selected>Pilih Kategori</option>
                                <option value="Novel">Novel</option>
                                <option value="Komik">Komik</option>
                                <option value="Biografi">Biografi</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sampul" class="form-label">Sampul Buku</label>
                            <img class="img-preview img-fluid mb-3" width="250px">
                            <input class="form-control @error('sampul') is-invalid @enderror" type="file" id="sampul"
                                name="sampul" onchange="previewImage()">
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