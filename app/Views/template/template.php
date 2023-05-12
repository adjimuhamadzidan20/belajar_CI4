<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- my css -->
    <link rel="stylesheet" href="/css/style.css">

    <title><?= $judul; ?></title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-success">
      <div class="container">
          <a class="navbar-brand text-white" href="#">Beyourself Comic</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="/">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="/komik">Komik</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="/anggota">Anggota</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="/pages/tentang">Tentang</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="/pages/kontak">Kontak</a>
              </li>
            </ul>
          </div>
      </div>
    </nav>

    <?= $this->renderSection('content'); ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    -->

    <script type="text/javascript">

      function thumbnail() {
        const sampul = document.querySelector('#sampul');
        const imgSampul = document.querySelector('.preview');

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);
      
        fileSampul.onload = function (e) {
          imgSampul.src = e.target.result;
        }  
      }

      setTimeout(function() {
        let elemen = document.getElementById('pop-up');
        elemen.style.opacity = "0";
        elemen.style.transition = "1s ease-in-out";

        setTimeout(function() {
            elemen.style.display = "none";
        }, 1000);
    }, 2000);
      
    </script>
  </body>
</html>
