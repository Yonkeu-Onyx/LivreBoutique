<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Gestionnaire</title>
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
            @include('includes.menuGestionnaire')
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
                        Bienvenue Cher Gestionnaire
                    </div>
                    <div class="container">
                        <div class="card">
                            <h5 class="card-header">Gestion des ouvrages</h5>
                            <div class="ibox-head mb-3 d-flex align-items-center gap-3 flex-wrap">
                                <a href="/addOuvrage" class="btn btn-success">
                                    <i class="fa fa-plus me-1"></i> Ajouter un ouvrage
                                </a>

                                <form action="{{ route('livres.rechercheStock') }}" method="GET"
                                    class="d-flex align-items-center gap-2">
                                    <input type="number" name="stock" class="form-control" placeholder="Stock minimum"
                                        min="0" required>
                                    <button type="submit" class="btn btn-primary">Rechercher</button>
                                </form>

                                @if(request()->has('stock'))
                                    <a href="{{ route('livres.index') }}" class="btn btn-secondary">Retour à la liste
                                        complète</a>
                                @endif
                            </div>

                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Image</th>
                                            <th>Titre</th>
                                            <th>Stock</th>
                                            <th>Prix</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach($livre as $lv)
                                            <tr data-id="{{ $lv->id }}">
                                                <td><img src="{{ url("assets/images/" . $lv->image) }}" width="100"
                                                        height="100" alt="{{ $lv->image }}"></td>
                                                <td>{{ $lv->titre }}</td>
                                                <td>

                                                    <button class="btn btn-danger btn-sm btn-stock" data-action="decrement"
                                                        data-id="{{ $lv->id }}">-</button>
                                                    <span class="mx-2" id="stock-{{ $lv->id }}">{{ $lv->stock }}</span>
                                                    <button class="btn btn-success btn-sm btn-stock" data-action="increment"
                                                        data-id="{{ $lv->id }}">+</button>


                                                </td>
                                                <td>{{ $lv->prix }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('RouteModifier.edit', $lv->id) }}">
                                                                <i class="bx bx-edit-alt me-1"></i> Modifier
                                                            </a>
                                                            <form action="{{ route('livres.destroy', $lv->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Voulez-vous vraiment supprimer ce livre ?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="dropdown-item text-danger" type="submit">
                                                                    <i class="bx bx-trash me-1"></i> Supprimer
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
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

    <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script>
        $(document).ready(function () {
            $(".btn-stock").click(function (e) {
                e.preventDefault();

                const btn = $(this);
                const action = btn.data("action");
                const id = btn.data("id");
                const stockElement = $("#stock-" + id);

                $.ajax({
                    url: "/livres/" + action + "/" + id,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        stockElement.text(response.stock);
                    },
                    error: function () {
                        alert("Erreur lors de la mise à jour du stock");
                    }
                });
            });
        });
    </script>

</body>

</html>