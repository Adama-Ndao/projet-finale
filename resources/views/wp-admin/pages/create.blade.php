@include('wp-admin/Menue')
   
</head>
<body>
<h1 class="mt-5">Créer un nouvel utilisateur</h1>

<form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data" class="mt-4">
    @csrf

    <div class="form-group">
        <label for="name">Nom:</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="firstname">Prénom:</label>
        <input type="text" name="firstname" id="firstname" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="role">Rôle:</label>
        <input type="text" name="role" id="role" class="form-control">
    </div>

    <div class="form-group">
        <label for="datenaiss">Date de naissance:</label>
        <input type="date" name="datenaiss" id="datenaiss" class="form-control">
    </div>

    <div class="form-group">
        <label for="photo">Photo:</label>
        <input type="file" name="photo" id="photo" class="form-control-file">
    </div>

    <div class="form-group">
        <label for="sexe">Sexe:</label>
        <select name="sexe" id="sexe" class="form-control">
            <option value="homme">Homme</option>
            <option value="femme">Femme</option>
        </select>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Créer l'utilisateur</button>
</form>
</body>

@include('wp-admin/Menuef')