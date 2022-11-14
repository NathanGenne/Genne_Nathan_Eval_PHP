<?php
require_once('./inc/header.php');
include_once('./functions/functions.php');

$link = get_link_by_id($_GET['id']);

if (isset($_POST['add']) && !empty($_POST['title']) && !empty($_POST['url'])) {

    $title = htmlspecialchars($_POST['title']);
    $url   = htmlspecialchars($_POST['url']);
    $data = [$_GET['id'], $title, $url];
    
    update_link($data);
}

?>

  <body>
    <header class="pt-5 mb-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <h1 class="display-4 text-center">Gestionnaire de liens utiles</h1>
          </div>
        </div>
      </div>
    </header>
    <main>
      <div class="container h-100">
        <div class="row justify-content-center h-50">
          <div class="col-md-6 shadow p-3 pt-5">
            <h2 class="mb-3">Éditer le lien <?= $link['title'] ?></h2>
            <div class="mb-3">
              <form action="index.php" method="post">
                <div class="mb-3">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="title"
                      name="title"
                      placeholder="<?= $link['title'] ?>"
                    />
                    <label for="title">Titre</label>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-floating">
                    <input
                      type="url"
                      class="form-control"
                      id="url"
                      name="url"
                      placeholder="<?= $link['url'] ?>"
                    />
                    <label for="url">Lien</label>
                  </div>
                </div>
                <div class="col-md-auto d-flex">
                  <button name = "add" type = "submit" class="btn btn-primary btn-lg">Enregister</button>
                </div>
              </form>
            </div>
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