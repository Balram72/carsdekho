<?php
require_once 'config/db.php';

$type = $_REQUEST['type'] ?? '';
$brand = $_REQUEST['brand'] ?? '';
$budget = $_REQUEST['budget'] ?? '';

$search_cars = "SELECT * FROM cars WHERE status = 1";
if(!empty($type)){
    $search_cars .= " AND car_type ='$type'";
}
if(!empty($brand)){
    
    $search_cars .= " AND brand ='$brand'";
}
if(!empty($budget)){
     $search_cars .= " AND price <= '$budget'";
}

$cars = mysqli_query($conn, $search_cars);

// GET active banners

$banner = "SELECT * FROM banners WHERE status = 1 ORDER BY id DESC";
$banners = mysqli_query($conn, $banner);





include 'includes/header.php';
?>

    <!-- Hero Banner Section -->
    <section class="hero-section">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php foreach($banners as $index => $banner): ?>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?php echo $index; ?>" <?php echo $index === 0 ? 'class="active"' : ''; ?>></button>
                <?php endforeach; ?>
            </div>

            <div class="carousel-inner">
                <?php foreach($banners as $index => $banner): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="banner-slide" style="background-image: url('uploads/banners/<?php echo $banner['image']; ?>');">
                        <div class="banner-overlay">
                            <div class="container">
                                <div class="banner-content text-center text-white">
                                    <h1 class="display-4 fw-bold mb-3"><?php echo $banner['title']; ?></h1>
                                    <p class="lead mb-4"><?php echo $banner['subtitle']; ?></p>
                                    <a href="<?php echo $banner['link']; ?>" class="btn btn-primary btn-lg px-5">Book Now <i class="fas fa-arrow-right ms-2"></i></a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <?php if(empty($banners)): ?>
                <div class="carousel-item active">
                    <div class="banner-slide default-banner">
                        <div class="banner-overlay">
                            <div class="container">
                                <div class="banner-content text-center text-white">
                                    <h1 class="display-4 fw-bold mb-3">Find Your Dream Car</h1>
                                    <p class="lead mb-4">Explore thousands of cars at the best prices</p>
                                    <a href="inquiry.php" class="btn btn-primary btn-lg px-5">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <!-- Search Box Section -->
    <section class="search-section py-3">
        <div class="container">
            <div class="search-box bg-white shadow rounded p-4">
                <form class="row g-3 align-items-end" method="GET" action="search.php">
                    <div class="col-md-3">
                        <label class="form-label">Select Brand</label>
                        <select class="form-select" name="brand">
                            <option value="">All Brands</option>
                            <option value="Maruti Suzuki" <?= ($brand === 'Maruti Suzuki') ? 'selected' : '';  ?>>Maruti Suzuki</option>
                            <option value="Hyundai" <?=  ($brand === 'Hyundai') ? 'selected' : '';  ?>>Hyundai</option>
                            <option value="Tata Motors" <?= ($brand === 'Tata Motors') ? 'selected' : ''; ?>>Tata Motors</option>
                            <option value="Honda" <?= ($brand === 'Honda') ? 'selected' : ''; ?>>Honda</option>
                            <option value="Kia" <?= ($brand === 'Kia') ? 'selected' : ''; ?>>Kia</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Car Type</label>
                        <select class="form-select" name="type">
                            <option value="">All Types</option>
                            <option value="Hatchback" <?= ($type === 'Hatchback')?'selected':'';  ?>>Hatchback</option>
                            <option value="Sedan" <?= ($type === 'Sedan')?'selected':'';  ?>>Sedan</option>
                            <option value="SUV" <?= ($type === 'SUV')?'selected':'';  ?>>SUV</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Budget</label>
                        <select class="form-select" name="budget">
                            <option value="">Select Budget</option>
                            <option value="5" <?= ($budget === '5')?'selected':'';  ?>>Under 5 Lakh</option>
                            <option value="10" <?= ($budget === '10')?'selected':'';  ?>>5 - 10 Lakh</option>
                            <option value="15" <?= ($budget === '15')?'selected':'';  ?>>10 - 15 Lakh</option>
                            <option value="20" <?= ($budget === '20')?'selected':'';  ?>>Above 15 Lakh</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i>Search Cars
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Most Searched Cars Section -->
    <section class="popular-cars-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="fw-bold">Search Cars</h2>
                <!-- <p class="text-muted">Explore our most popular car choices</p> -->
            </div>

            <div class="row">
                <?php if(!empty($cars)): ?>
                    <?php foreach($cars as $car): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="car-card">
                            <div class="car-image">
                                <?php if(file_exists('uploads/cars/' . $car['image'])): ?>
                                    <img src="uploads/cars/<?php echo $car['image']; ?>" alt="<?php echo $car['name']; ?>">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/300x200?text=<?php echo urlencode($car['name']); ?>" alt="<?php echo $car['name']; ?>">
                                <?php endif; ?>
                                <span class="car-type-badge"><?php echo $car['car_type']; ?></span>
                            </div>
                            <div class="car-details">
                                <h5 class="car-name"><?php echo $car['brand']; ?> <?php echo $car['name']; ?></h5>
                                <p class="car-price text-primary fw-bold"><?php echo $car['price']; ?> onwards</p>
                                <div class="car-features">
                                    <span><i class="fas fa-gas-pump me-1"></i><?php echo $car['fuel_type']; ?></span>
                                </div>
                                <a href="inquiry.php" class="btn btn-outline-primary btn-sm mt-3 w-100">Get Quote</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">No cars available at the moment.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="text-center mt-4">
                <a href="#" class="btn btn-outline-primary px-5">View All Cars</a>
            </div>
        </div>
    </section>

   

    <!-- Call to Action Section -->
    <section class="cta-section py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="mb-2">Looking for Your Dream Car?</h3>
                    <p class="mb-0">Fill out our inquiry form and we'll help you find the perfect car.</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="inquiry.php" class="btn btn-light btn-lg px-5">Get Quote Now <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
