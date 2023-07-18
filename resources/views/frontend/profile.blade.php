<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIMAS KOTO LUAR</title>

  <!-- Styling tampilan dengan bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

  <!-- Styling untuk owl carousel -->
  <link rel="stylesheet" href="{!! asset('/owlcarousel/dist/assets/owl.carousel.min.css ') !!}">
  <link rel="stylesheet" href="{!! asset('/owlcarousel/dist/assets/owl.theme.default.min.css ') !!}">

  <!-- Styling buatan sendiri -->
  <link href="{!! asset('/css/style.css') !!}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    body {
      background-color: #e3f8ff;
    }
  </style>
</head>

<body>
  <section class="container bg-aliceblue py-5">
    <div class="card w-75 mx-auto">
      <div class="card-header text-center bg-green rounded-0">
        <span class="fw-bold text-white">Profile User</span>
      </div>
      <div class="card-body bg-light px-3">
        @if(Session::has('success'))
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered  w-25">
            <div class="modal-content text-center">
              <div class="modal-body">
                <div class="mb-5">
                  <img alt="Logo" src="{!! asset('/img/icon/success.png') !!}" class="h-60px h-lg-75px" style="width: 100px; height: 120px;"/>
                  <H5 class="mt-1 fw-bold">SUKSES</H5>
                </div class="">
                {{ Session::get('success') }}
                <div>
                  <button type="button" class="btn btn-primary mt-2" data-bs-dismiss="modal" aria-label="Close">
                    OK
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();
          });
        </script>
        @endif
        @if ($errors->any())
        <div id="notification" class="alert alert-danger" style="display: none;">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        <script>
          // Tampilkan notifikasi saat halaman dimuat
          document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('notification').style.display = 'block';

            // Atur waktu penghilangan notifikasi setelah 3 detik
            setTimeout(function() {
              document.getElementById('notification').style.display = 'none';
            }, 5000);
          });
        </script>
        @endif
        <form action="/simpan_profile/{{ Auth::user()->id }}" method="POST">
          @method('put')
          @csrf
          <div class="row">
            <div class="col-4 mx-auto text-center">
              <img src="{!! asset('/img/icon/icon_user.jpg') !!}" alt="User Image" class="rounded-circle me-2" style="width: 150px; height: 150px;">
            </div>
            <div class="col-8 pt-2">
              <div class="mb-3 row">
                <label for="nik" class="col-sm-4 col-form-label">NIK</label>
                <div class="col-sm-7">
                  <input type="text" value="{{ Auth::user()->profile->nik ? Auth::user()->profile->nik : '' }}" class="form-control" id="nik" placeholder="Tambahkan NIK" name="nik">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="name" class="col-sm-4 col-form-label">Nama Lengkap</label>
                <div class="col-sm-7">
                  <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" id="name">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="tempat_lahir" class="col-sm-4 col-form-label">Tempat Lahir</label>
                <div class="col-sm-7">
                  <input type="text" value="{{ Auth::user()->profile->tempat_lahir }}" placeholder="Tambahkan Tempat Lahir" class="form-control" id="tempat_lahir" name="tempat_lahir">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="tanggal_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-7">
                  <input type="date" value="{{ Auth::user()->profile->tanggal_lahir }}" placeholder="Tambahkan Tanggal Lahir" name="tanggal_lahir" class="form-control" id="tanggal_lahir">
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-7">
                  <select class="form-select" data-control="select2" data-hide-search="true" name="jenis_kelamin">
                    <option value="L" {{ (Auth::user()->profile->jenis_kelamin === 'L') ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ (Auth::user()->profile->jenis_kelamin === 'P') ? 'selected' : '' }}>Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-7">
                  <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" id="email">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="no_telepon" class="col-sm-4 col-form-label">No telepon</label>
                <div class="col-sm-7">
                  <input type="text" value="{{ Auth::user()->profile->no_telepon }}" class="form-control" id="no_telepon" placeholder="Tambahkan No Telepon" name="no_telepon">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-7">
                  <textarea name="alamat" id="alamat" cols="10" rows="2" class="form-control" placeholder="Tambahkan Alamat">{{ Auth::user()->profile->alamat }}</textarea>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="alamat" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-7">
                  <div class="row">
                    <div class="col-6">
                      <div class="mb-3 row">
                        <label for="rt" class="col-sm-4 col-form-label">RT</label>
                        <div class="col-sm-8">
                          <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih RT" name="rt">
                            @foreach ($rts as $rt)
                            <option value="{{$rt->id}}">{{$rt->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="mb-3 row">
                        <label for="rw" class="col-sm-4 col-form-label">RW</label>
                        <div class="col-sm-8">
                          <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih RW" name="rw">
                            @foreach ($rws as $rw)
                            <option value="{{$rw->id}}">{{$rw->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mx-auto text-center">
            <button class="btn btn-success rounded-0" name="submit" type="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <script>
    function confirmLogout() {
      return confirm('Yakin ingin keluar?');
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>