<!doctype html>
<html lang="en">

@include('layout.header')

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-4">
                        <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                            <img src="{{ asset('/assets/images/logos/elemento.png') }}" width="180" alt="">
                        </a>
                        <form method="POST" action="#" id="formRegister">
                            <input type="hidden" name="role" value="guru">
                            <div class="mb-3">
                                <h2 class="text-center fw-bold">Register Form</h2>
                            </div>
                            <div class="error-container"></div>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="NamaLengkap" class="form-control" required autocomplete="off"
                                    placeholder="Masukkan Nama Lengkap">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat Email</label>
                                <input type="email" name="Email" class="form-control" required autocomplete="off"
                                    placeholder="Masukkan Email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="Password" class="form-control" required autocomplete="off"
                                    placeholder="Masukkan Password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="PasswordConfirmation" class="form-control" required autocomplete="off" placeholder="Masukkan Password Kembali">
                            </div>
                            <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Register</button>
                            <div class="d-flex align-items-center">
                                <p class="fs-4 mb-0 fw-bold">Sudah Punya Akun?</p>
                                <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Masuk</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layout.script')
    <script src="{{ asset('assets/js/pages/register.js') }}"></script>
</body>

</html>
