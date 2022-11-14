<?php
require_once('./inc/header.php');
include_once('./functions/functions.php');

/* Si le bouton 'Ajouter' a été pressé, alors cette condition vérifie que les champs de  formulaires ont bien été remplis. Puis on élimine les caractères spéciaux des valeurs entrés par l'utilisateur pour sécuriser notre site, et on ajoute finalement ces valeurs à la base de donnée.
 */
if (isset($_POST['add']) && !empty($_POST['title']) && !empty($_POST['url'])) {

    $title = htmlspecialchars($_POST['title']);
    $url   = htmlspecialchars($_POST['url']);
    $data = [$title,$url];
    
    create_link($data);
}
/* Fonction qui récupère toute la table 'links' */
$links = get_all_link();
?>

<body>
  <header class="py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h1 class="display-4 text-center">Gestionnaire de liens utiles</h1>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="mb-3">
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
              <div class="row g-2">
                <div class="col-md">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="title"
                      name="title"
                      placeholder="Stack overflow"
                    />
                    <label for="title">Titre</label>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-floating">
                    <input
                      type="url"
                      class="form-control"
                      id="url"
                      name="url"
                      placeholder="https://stackoverflow.com"
                    />
                    <label for="url">Lien</label>
                  </div>
                </div>
                <div class="col-md-auto d-flex">
                  <button name="add" type="submit" class="btn btn-primary btn-lg">Ajouter</button>
                </div>
              </div>
            </form>
          </div>
          <ul class="list-group">

          <?php foreach($links as $link) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <a href="<?= $link['url'] ?>"><?= $link['title'] ?></a>
              <span>
                <a href="edit-link.php?id=<?= $link['link_id'] ?>">
                  <i class="fa-regular fa-pen-to-square me-1 text-warning"></i>
                </a>
                <a onclick="<?php /* delete_link($link['link_id']); */ ?>">
                  <i class="fa-solid fa-trash ms-1 text-danger"></i>
                </a>
              </span>
            </li>
          <?php endforeach; ?>

          </ul>
        </div>
      </div>
    </div>
  </main>
  <footer class="shadow">&copy; 2022 La Manu</footer>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"
  ></script>
</body>

<?php
require_once('./inc/footer.php')
?>
</html>