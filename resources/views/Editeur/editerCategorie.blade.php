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
            @include('includes.menu')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('includes.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <!-- contenu changable  -->
                    <div class="container">
                        Bienvenue Cher Editeur
                    </div>
                    <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0"></h5>
                                <small class="text-muted float-end">Default label</small>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3 class="card-header">{{ $categorie->nom }}</h3>
                                    </div>
                                    <div>
                                        <form action="{{route('deleteCategorie.delete', $categorie->id)}}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer la Categorie</button>
                                        </form>
                                    </div>
                                </div>
                                <form enctype="multipart/form-data" action="{{ route('supCategorie.DelLivre') }}"
                                    method="POST">
                                    @csrf
                                    <fieldset>
                                        <legend>Selectionner les livres a Retirer</legend>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="titre">Nom</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="nom" value="{{ $categorie->nom }}">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="id" value="{{ $categorie->id }}" hidden>
                                            </div>

                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="stock">Livres</label>
                                            <div class="col-sm-10">
                                                @if(!empty($livresCategorie))
                                                    @foreach($livresCategorie as $lv)
                                                        <input type="checkbox" name="livres[]" value="{{ $lv->id }}">
                                                        <label for="livres"> {{$lv->titre}}</label><br><br>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form><br><br>
                                <!--Les Autres Livres-->
                                <form enctype="multipart/form-data"
                                    action="{{ route('addLivreCategorie.addLivre', $categorie->id) }}" method="POST">
                                    @csrf
                                    <fieldset>
                                        <legend>Selectionner les livres a Ajouter</legend>
                                        @csrf
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="titre"></label>
                                            <div class="col-sm-10">
                                                @if(!empty($otherLivres))
                                                    @foreach($otherLivres as $liv)
                                                        <input type="checkbox" name="livres[]" value="{{ $liv->id }}">
                                                        <label for="livres"> {{$liv->titre}}</label><br><br>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
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

    <!-- Upgrade Button -->
    <!-- <div class="buy-now">
        <a href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" target="_blank" class="btn btn-danger btn-buy-now">Upgrade to Pro</a>
    </div> -->

    <!-- Core JS -->
    <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('assets/vendor/js/menu.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ url('assets/js/main.js') }}"></script>

    <!-- GitHub button -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>