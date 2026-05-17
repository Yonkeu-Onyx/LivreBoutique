<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Container - Layouts | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Helpers -->
    <script src="{{ url('assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ url('assets/js/config.js') }}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('includes.menuAdmin')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container">
                        <br>
                        <div class="card mb-4">
                            <h5 class="card-header">Ajouter Utilisateur</h5>
                            <!-- Account -->
                            <div class="card-body">
                                <form id="formAccountSettings" action='{{ route("ajout.AddUser") }}' method="POST"
                                    enctype='multipart/form-data'>
                                    @csrf
                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        <img src="../assets/img/avatars/1.png" alt="user-avatar"
                                            class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                                        <div class="button-wrapper">
                                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                <span class="d-none d-sm-block">Upload new photo</span>
                                                <i class="bx bx-upload d-block d-sm-none"></i>
                                                <input type="file" name="image" id="upload"
                                                    class="account-file-input" hidden=""
                                                    accept="image/png, image/jpeg">
                                            </label>
                                            <button type="button"
                                                class="btn btn-outline-secondary account-image-reset mb-4">
                                                <i class="bx bx-reset d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Reset</span>
                                            </button>
                                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                        </div>
                                    </div>
                            </div>
                            <hr class="my-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">Nom</label>
                                        <input class="form-control" type="text" id="firstName" name="nom" value=""
                                            autofocus="">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email" value=""
                                            placeholder="john.doe@example.com">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="organization" class="form-label">Mot de Passe</label>
                                        <input type="password" class="form-control" id="organization" name="motDePasse"
                                            value="">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="country">Role</label>
                                        <select id="country" class="select2 form-select" name="role">
                                            <option value="">Select</option>
                                            <option value="editeur">editeur</option>
                                            <option value="gestionnaire">gestionnaire</option>
                                            <option value="administrateur">administrateur</option>
                                        </select>
                                    </div>

                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <!-- /Account -->
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('includes.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- / Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- / Layout container -->

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('assets/vendor/js/menu.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ url('assets/js/main.js') }}"></script>

    <!-- Image preview + reset -->
    <script>
        document.getElementById('upload').addEventListener('change', function(e) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('uploadedAvatar').src = e.target.result;
            };
            if (this.files[0]) {
                reader.readAsDataURL(this.files[0]);
            }
        });

        document.querySelector('.account-image-reset').addEventListener('click', function() {
            document.getElementById('uploadedAvatar').src = '../assets/img/avatars/1.png';
            document.getElementById('upload').value = "";
        });
    </script>

    <!-- GitHub button -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>