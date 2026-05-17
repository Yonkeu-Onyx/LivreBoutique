<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>Gérer les utilisateurs</title>
    <link rel="stylesheet" href="{{ url('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <script src="{{ url('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ url('assets/js/config.js') }}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('includes.menuAdmin')

            <div class="layout-page">
                @include('includes.navbarUser')

                <div class="content-wrapper">
                    <div class="container">
                        <br>
                        <a href="{{ route('AjouterUser.AjouterUser') }}">
                            <button type="submit" class="btn btn-primary me-2">Ajouter Utilisateur</button>
                        </a>
                        <br><br>

                        <div class="card">
                            <h5 class="card-header">Tous les Utilisateurs</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Utilisateur</th>
                                            <th>Rôle</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td><strong>{{ $user->nom }}</strong></td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <ul
                                                        class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                        <li class="avatar avatar-xl pull-up">
                                                            <img src="{{ url('assets/images/' . $user->image) }}"
                                                                alt="Avatar" class="rounded-circle" />
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <span class="badge bg-label-primary me-1">{{ $user->role }}</span>
                                                    <button type="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                                        data-bs-target="#editRoleModal{{ $user->id }}">
                                                        <i class="bx bx-edit-alt text-primary"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('ModifierUser.showUser', $user->id) }}">
                                                                <i class="bx bx-edit-alt me-1"></i> Modifier
                                                            </a>
                                                            <form action="{{ route('delete.destroy', $user->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item"
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                                                    <i class="bx bx-trash me-1"></i> Supprimer
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                            <!-- Modal Modifier Rôle -->
                                            <div class="modal fade" id="editRoleModal{{ $user->id }}" tabindex="-1"
                                                aria-labelledby="editRoleModalLabel{{ $user->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editRoleModalLabel{{ $user->id }}">
                                                                Modifier le rôle</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="roleSelect{{ $user->id }}"
                                                                    class="form-label">Choisir un rôle :</label>
                                                                <select class="form-select" id="roleSelect{{ $user->id }}">
                                                                    <option value="editeur" {{ $user->role == 'editeur' ? 'selected' : '' }}>Éditeur</option>
                                                                    <option value="gestionnaire" {{ $user->role == 'gestionnaire' ? 'selected' : '' }}>
                                                                        Gestionnaire</option>
                                                                    <option value="administrateur" {{ $user->role == 'administrateur' ? 'selected' : '' }}>
                                                                        Administrateur</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                onclick="modifierRole({{ $user->id }})">Enregistrer</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    @include('includes.footer')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>
    <script>
        function modifierRole(userId) {
            const role = document.getElementById('roleSelect' + userId).value;
            const token = '{{ csrf_token() }}';

            fetch(`/api/modifierRole/${userId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    role: role
                })
            })
                .then(response => {
                    if (response.ok) {
                        alert('✅ Rôle modifié avec succès.');
                        location.reload();
                    } else {
                        return response.text().then(text => {
                            throw new Error(text);
                        });
                    }
                })
                .catch(error => {
                    console.error('Erreur :', error);
                    alert("❌ Une erreur est survenue lors de la modification.");
                });
        }
    </script>

</body>

</html>