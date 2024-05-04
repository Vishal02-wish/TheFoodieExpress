<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  session_start();
  include('header.php');
  include('admin/db_connect.php');

  $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
  foreach ($query as $key => $value) {
    if (!is_numeric($key))
      $_SESSION['setting_' . $key] = $value;
  } ?>

  <style>
    body {
      font-family: "Poppins", sans-serif !important;
    }

    .navbar-brand {
      color: white !important;
      font-family: "Poppins", sans-serif !important;
    }

    .navbar-nav .nav-item .nav-link {
      color: white !important;
      font-family: "Poppins", sans-serif !important;
      font-weight: 500 !important;
    }

    .heading-nav {
      font-family: "Poppins", sans-serif !important;
    }

    .navbar-scrolled .navbar-nav .nav-item .nav-link {
      color: black !important;
    }

    .navbar-scrolled .navbar-brand {
      color: black !important;
    }

    .col-lg-10.align-self-end.mb-4.page-title {
      background: none;
    }

    .text-white {
      color: black !important;
      font-family: "Poppins", sans-serif !important;
      font-size: 3.3rem;
      font-weight: 900;
    }

    .btn-xl {
      padding: 1.1rem 2rem !important;
    }

    .align-self-end {
      align-self: center !important;
    }

    .text-center {
      text-align: center;
    }

    .btn-outline-primary {
      background-color: #22a85f !important;
      color: wheat !important;
      border: 2px solid black;
      box-shadow: 10px 10px 10px 2px black;
    }

    h3,
    p {
      margin-bottom: 10px !important;
      margin-top: 10px !important;
      color: black !important;
    }

    .btn-primary {
      background-color: #6258e4;
      border: 2px solid black;
      box-shadow: 0px 0px 10px 5px;
    }

    .btn-xl {
      color: black !important;
    }

    .page-section {
      padding-top: 2rem !important;
    }

    .row {
      margin-left: 0 !important;
    }

    @media (min-width: 992px) {
      header.masthead {
        height: 85vh !important;
        min-height: 70vh !important;
        padding-top: 150px;
        padding-bottom: 100px;
      }
    }

    .small-text {
      font-size: 2rem !important;
    }

    header.masthead {
      /* background-color: #b72100fa; */
      background-repeat: no-repeat;
      background-size: cover;
    }

.footer{
text-align:center;
}

.footer .row{
width:100%;
margin:1% 0%;
padding:0.6% 0%;
color:gray;
font-size:0.8em;
}

.footer .row a{
text-decoration:none;
color:gray;
transition:0.5s;
}

.footer .row a:hover{
color:#fff;
}

.footer .row ul li{
display:inline-block;
margin:0px 30px;
}

.footer .row a i{
font-size:2em;
margin:0% 1%;
}

@media (max-width:720px){
.footer{
text-align:center;
padding:5%;
}
.footer .row a i{
margin:0% 3%;
}
}
  </style>
</head>

<body id="page-top">
  <!-- Navigation-->
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white small-text"></div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container heading-nav">
      <a class="navbar-brand js-scroll-trigger" href="./">
        <?php echo $_SESSION['setting_name'] ?>
      </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
        data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0 px-2">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="index.php?page=cart_list"><span>
                <span class="badge badge-danger item_count">0</span>
                <i class="fa fa-shopping-cart"></i> </span>Cart</a>
          </li>
          <?php if (isset($_SESSION['login_user_id'])) { ?>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php?page=order_history">
                <span><i class="fas fa-concierge-bell"></i></span> Orders
              </a>
            </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a>
          </li>
          <?php if (isset($_SESSION['login_user_id'])): ?>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="admin/ajax.php?action=logout2">
                <?php echo "Welcome " . $_SESSION['login_first_name'] . ' ' . $_SESSION['login_last_name'] ?>
                <i class="fa fa-power-off"></i>
              </a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="login_now">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <?php
  $page = isset($_GET['page']) ? $_GET['page'] : "home";
  include $page . '.php';
  ?>

  <div class="modal fade" id="confirm_modal" role="dialog">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
        </div>
        <div class="modal-body">
          <div id="delete_content"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="confirm" onclick="">
            Continue
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role="dialog">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="submit" onclick="$('#uni_modal form').submit()">
            Save
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role="dialog">
    <div class="modal-dialog modal-full-height modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg"
                viewBox="0 0 16 16">
                <path
                  d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
              </svg>
              ></span>
          </button>
        </div>
        <div class="modal-body"></div>
      </div>
    </div>
  </div>
  <footer class="bg-light py-5">
    <div class="container">
        <div class="small text-center text-muted">
          Copyright © 2023 Online Food Order system | The Foodie Express
        </div>
      </div>
  </footer>
  <?php include('footer.php') ?>
</body>

<?php $conn->close() ?>

</html>