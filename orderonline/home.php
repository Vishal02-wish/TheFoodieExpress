<!-- Masthead-->
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4 page-title">
                <h3 class="text-white">Welcome to
                    <?php echo $_SESSION['setting_name']; ?>
                </h3>
                <p>The fastest food ordering service available!</p>
                <a class="btn btn-primary btn-xl js-scroll-trigger" href="#menu">Order Now</a>

            </div>

        </div>
    </div>
    </section>
</header>
<style>
    header.masthead p {
    font-size: 1.3rem;
    font-weight: 500;
  }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }

    h1 {
        border: 2px solid black;
        border-radius: 5px;
        margin: 2px auto;
        width: 70rem;
        background-color:#aa121285;
        color: #fff;
        text-align: center;
        padding: 10px;
    }

    #btn {
        font-size: 20px;
    }

    section {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 20px;
    }

    .category {
        margin: 10px;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        text-align: center;
        max-width: 200px;
    }

    a[target] {
        text-decoration: none;
        /* background-color: black;
            color: white; */
    }

    button {
        border-radius: 5px;
        background-color: cyan;
        font-size: 20px;
        border: 2px solid black;
    }

    .category img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    hr {
        border: 4px solid black;
        width: 700px;
        border-radius: 3px;
    }
</style>
</head>

<body>
    <div>
        <h1>Foods Category</h1>
    </div>

    <section>
        <div class="category">
            <img src="assets\downloaded\download.jpeg" alt="Category 1">
            <h3>Foods</h3>
        </div>

        <div class="category">
            <img src="assets\downloaded/thali.png" alt="Category 2">
            <h3>Meals</h3>
        </div>

        <div class="category">
            <img src="assets\downloaded\soup.png" alt="Category 3">
            <h3>Soup</h3>
        </div>
        <div class="category">
            <img src="assets\downloaded/Rice.png" alt="Category 3">
            <h3>Fried Rice</h3>
        </div>
        </div>
    </section>
    </header>
    <section class="page-section" id="menu">
        <div id="menu-field" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            include 'admin/db_connect.php';
            $qry = $conn->query("SELECT * FROM  product_list order by rand() ");
            while ($row = $qry->fetch_assoc()):
                ?>
                <div class="col my-3 container">
                    <div class=" card shadow-sm ">
                        <img src="assets/img/<?php echo $row['img_path'] ?>" class="bd-placeholder-img card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $row['name'] ?>
                            </h5>
                            <p class="card-text truncate">
                                <?php echo $row['description'] ?>
                            </p>
                            <div class="text-center">
                                <button class="btn btn-sm btn-outline-primary view_prod btn-block" data-id=<?php echo $row['id'] ?>><i class="fa fa-eye"></i> View</button>

                            </div>
                        </div>

                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
    <header>
        <h1>Our Clients</h1>
    </header>

    <section>
        <div class="category">
            <img src="assets\downloaded\zomato.png" alt="Category 1">
            <button><a href="https://zomato.com" target="_blank">Zomato</a></button>
        </div>

        <div class="category">
            <img src="assets\downloaded\swiggy.png" alt="Category 2">
            <button><a href="https://swiggy.com" target="_blank">Swiggy</a></button>
        </div>

        <div class="category">
            <img src="assets\downloaded\foodpand.png" alt="Category 3">
            <button><a href="https://foodpanda.com" target="_blank">FoodPanda</a></button>
        </div>
        <div class="category" id="btn">
            <img src="assets\downloaded\Domino's.png" alt="Category 3">
            <button><a href="https://dominos.com" target="_blank"> Domino's Pizza </a></button>
        </div>
    </section>
    </section>
    <script>

        $('.view_prod').click(function () {
            uni_modal_right('Product', 'view_prod.php?id=' + $(this).attr('data-id'))
        })
    </script>