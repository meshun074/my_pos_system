<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./bootstrap4/css/bootstrap.min.css">
  <title>Document</title>
</head>

<body class="bg-light">
  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
    </li>
  </ul>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"><?php echo password_hash('Adwibikete1', PASSWORD_DEFAULT) ?><br>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi praesentium vel esse commodi dicta aspernatur harum atque itaque, doloribus deserunt, vitae ducimus hic illum, error quae laboriosam numquam autem inventore.</div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">1 Lorem ipsum dolor sit amet consectetur adipisicing elit. In hic est, illo dolores, quia ex molestiae sed voluptatibus placeat minima nesciunt temporibus accusantium quaerat eaque velit natus blanditiis atque qui.</div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">2 Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, magni pariatur recusandae adipisci delectus debitis amet sit veniam, corrupti, voluptatum corporis consequuntur neque totam officia tenetur ad. Pariatur, minima blanditiis!</div>
    <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover">
      Popover on top
    </button>
    <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Right popover">
      Popover on right
    </button>
    <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Bottom popover">
      Popover on bottom
    </button>
    <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="Left popover">
      Popover on left
    </button>

  </div>



  <script src="bootstrap4/js/bootstrap.bundle.js"></script>
  <script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
  </script>
</body>

</html>

<a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
  Link with href
</a>
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
  Button with data-bs-target
</button>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div>

      Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
    </div>
    <div class="dropdown mt-3">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
        Dropdown button
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
      </ul>
    </div>
  </div>
</div>
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
  Dropdown
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
  <li><a class="dropdown-item" href="#">Action</a></li>
  <li><a class="dropdown-item" href="#">Another action</a></li>
  <li>
    <hr class="dropdown-divider">
  </li>
  <li><a class="dropdown-item" href="#">Something else here</a></li>
</ul>