<?php
session_start();
include_once "../config/database.php";

if ($_SESSION['is_admin'] != 1) {
    header("Location: ../login.php");
    exit();
}

$query = "SELECT 
            auctions.title,
            bids.bid_price,
            bids.bid_time,
            users.username
          FROM auctions
          LEFT JOIN bids  ON bids.auction_id = auctions.id
          LEFT JOIN users ON bids.user_id   = users.id
          ORDER BY auctions.id DESC";
$stmt = $conn->prepare($query);
$stmt->execute();



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VAULT</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>416118 Sanjay Ghodawat Polytechnic,Atigre</small>
                </div>
              
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>+91 9307769415</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square bg-white text-primary me-1" href="https://www.facebook.com/people/vault25343764/61558453107194/?mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href="https://x.com/VAULT25343764?t=wNsSKKPwAiyZC2bFv0gf-Q&s=08"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href="https://www.linkedin.com/in/vault-e-auction-7aa543297?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-0" href="https://www.instagram.com/vault25343764?igsh=MWUzcTY4NDVkam1ybQ=="><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


     <?php include_once"../nav.php"; ?>




    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h2 class="display-3 text-white mb-3 animated slideInDown"> Auction Bids</h2>
            <nav aria-label="breadcrumb animated slideInDown">
               
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Projects Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <<div class="section-title text-center">
    <h1 class="display-5 mb-5" style="color: rgb(215, 152, 75);">View Bids</h1>
</div>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success text-center">
        Auction created successfully!
    </div>
<?php endif; ?>

<div class="row mt-n2 wow fadeInUp" data-wow-delay="0.3s">

                <div class="col-12 text-center">
                   
                </div>
            </div>
            <div class="row g-4 portfolio-container">
                <div class="col-lg-8 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
    <table class='table'>
        <thead>
            <tr>
                <th>Auction Title</th>
                <th>Bid Price</th>
                <th>Bid Time</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
<?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $bidPrice = $row['bid_price'] ?? 'No bids yet';
    $bidTime  = $row['bid_time']  ?? '-';
    $user     = $row['username']  ?? '-';

    echo "<tr>
            <td>{$row['title']}</td>
            <td>{$bidPrice}</td>
            <td>{$bidTime}</td>
            <td>{$user}</td>
          </tr>";
}
?>



</tbody>
    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Projects End -->
        

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Address</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>416118 Sanjay Ghodawat Polytechnic,Atigre</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+91 9307769415</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>vault49812@gmail.com</p>
                    
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Services</h4>
                    <a class="btn btn-link" href="inventorymanagement.html">Inventory Management</a>
                    <a class="btn btn-link" href="antiqueprising.html">Antique Prising</a>
                    <a class="btn btn-link" href="restoration.html">Restoration</a>
                    <a class="btn btn-link" href="clientadvisory.html">Client Advisory</a>
                    <a class="btn btn-link" href="onetoonetrade.html">One To One Trade</a>
                </div>
              
               
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">VAULT</a>, All Right Reserved.
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/counterup/counterup.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/isotope/isotope.pkgd.min.js"></script>
    <script src="../lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>