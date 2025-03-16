<?php
session_start();


    $keyword1 = 'Zain store Boutique';
    $keyword2 = 'Women wears';
    $keyword3 = 'zainstores';
    $title = 'Home | Zain Stores Boutique';
    $title_image = 'uploads/IMG_2976.jpg';
    $description ='Zain stores boutique. Elegance in modesty. Where your fashion shop lies.';
    require_once "header.php";
    require "config.php";
    
   if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    // Sanitize the input
    $user_id = htmlspecialchars(trim($_GET['user_id']));

    // Prepare the query to check if user_id exists in the database
    $query = "SELECT id FROM users WHERE unique_id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $user_id); // Bind the user_id to the query
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user_id exists in the database, store it in the session
            $_SESSION['user_id'] = $user_id;
             echo "<script>window.location.href='index'</script>";
        } else {
            // Handle case where user_id does not exist in the database
            echo "Invalid user ID.";
        }

        $stmt->close();
    } else {
        // Handle case where the query fails to prepare
        echo "Database error: Unable to prepare the query.";
    }
}

    $select1 = 'Corporate/Formal Wears';
    $sql = mysqli_query($conn,"SELECT * FROM shop WHERE category = '$select1' ");
    $select2 = 'Traditional Attires';
    $sql2 = mysqli_query($conn,"SELECT * FROM shop WHERE category = '$select2' ");
    $select3 = 'Summer Wears';
    $sql3 = mysqli_query($conn,"SELECT * FROM shop WHERE category = '$select3' ");
    $select4 = 'Denim/Jeans';
    $sql4 = mysqli_query($conn,"SELECT * FROM shop WHERE category = '$select4' ");
    $select5 = 'Street Wears';
    $sql5 = mysqli_query($conn,"SELECT * FROM shop WHERE category = '$select5' ");
?>
    <!-- Header Section End -->
<!-- Newsletter Popup -->
<style>
    #newsletterPopup input, #newsletterPopup button {
        font-size: 16px;
    }
</style>


    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="categories__item categories__large__item set-bg"
                    data-setbg="img/categories/category-2.jpg">
                    <div class="categories__text">
                        <center>
                        <!--<img src="img/logos.png">-->
                        </center>
                        <h1 style="font-size:50px;color:#697565;">Corporate/Formal Wears</h1> 
                        <p style="color:#697565;">We've got the seasonal trends to keep your closet fresh.</p>
                        <a href="./product-sort?sort=Corporate/Formal Wears">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="img/categories/category-1.jpg">
                            <div class="categories__text">
                                <h4 style="color:#697565;">Abaya Wears</h4>
                                <p><?php echo mysqli_num_rows($sql2); ?> items</p>
                                <a href="./product-sort?sort=Traditional Attires">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="img/categories/category-25.jpg">
                            <div class="categories__text">
                                <h4 style="color:#697565;">Traditional Wears</h4>
                                <p><?php echo mysqli_num_rows($sql2); ?> items</p>
                                <a href="./product-sort?sort=Summer Wears">Shop now</a>
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="img/categories/category-4.jpg">
                            <div class="categories__text">
                                <h4 style="color:#697565;">Denim/Jeans</h4>
                                <p><?php echo mysqli_num_rows($sql4); ?> items</p>
                                <a href="./product-sort?sort=Denim/Jeans">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="img/categories/category-3.jpg">
                            <div class="categories__text">
                                <h4 style="color:#697565;">Street Wears</h4>
                                <p><?php echo mysqli_num_rows($sql5); ?> items</p>
                                <a href="./product-sort?sort=Street Wears">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>New product</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">All</li>
                    <li data-filter=".women">Abaya</li>
                    <li data-filter=".men">Traditional Attires</li>
                    <li data-filter=".kid">Corporate/Formal Wears</li>
                    <li data-filter=".accessories">Summer Wears</li>
                    <li data-filter=".cosmetic">Street Wears</li>
                </ul>
            </div>
        </div>
        <div class="row property__gallery">
            <?php
            // Define categories
            $categories = [
                'women' => 'Abaya',
                'men' => 'Traditional Attires',
                'kid' => 'Corporate/Formal Wears',
                'accessories' => 'Summer Wears',
                'cosmetic' => 'Street Wears'
            ];

            // Loop through categories to fetch last 3 products
            foreach ($categories as $class => $category) {
                $query = "SELECT * FROM shop WHERE category = '$category' ORDER BY id DESC LIMIT 8";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $priceNaira = $row['price'];
                         $priceDollar = $row['dollar'];
                        $image = $row['img'];
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mix <?php echo $class; ?>">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?php echo $image; ?>">
                                    <ul class="product__hover">
                                        <li><a href="<?php echo $image; ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li>
                                            <form method="post" action="wishlist.php">
                                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                                <button type="submit" class="wishlist-btn"><span class="icon_heart_alt"></span></button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="post" action="cart.php">
                                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                                <input type="hidden" name="quantity" value="1"> <!-- You can modify this as per requirements -->
                                                <button type="submit" class="cart-btn"><span class="icon_bag_alt"></span></button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="product-details?id=<?php echo $id; ?>"><?php echo $name; ?></a></h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price" 
                                         data-price-ngn="<?php echo $priceNaira; ?>" 
                                         data-price-usd="<?php echo $priceDollar; ?>">
                                        ₦ <?php echo $priceNaira; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</section>
<!-- Product Section End -->



<!-- Banner Section Begin -->
<section class="banner set-bg" data-setbg="img/banner/banner-1.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8 m-auto">
                <div class="banner__slider owl-carousel">
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>Zain's Collection</span>
                            <h1>The popular wears</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>Zain's Collection</span>
                            <h1>The trending wears</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>Zain's Collection</span>
                            <h1>Trending traditionals</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Trend Section Begin -->
<section class="trend spad">
    <div class="container">
        <div class="row">
            <!-- Hot Trend Section -->
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Hot Trend</h4>
                    </div>
                    <?php
                    // Fetch hot trend products
                    $query_hot_trend = "SELECT * FROM shop WHERE category = 'Traditional Attires' LIMIT 3";
                    $result_hot_trend = mysqli_query($conn, $query_hot_trend);
                    while ($product = mysqli_fetch_assoc($result_hot_trend)) {
                        $imgPath = $product['img'];
                        $name = $product['name'];
                        $priceNaira = $product['price'];
                         $priceDollar = $product['dollar'];
                        $id = $product['id'];
                        ?>
                        <div class="trend__item">
                            <div class="trend__item__pic" style="width:90px; height:90px;">
                                <img src="<?= $imgPath ?>" alt="" style="width:90px; height:90px;">
                            </div>
                            <div class="trend__item__text">
                                <a href="product-details?id=<?php echo $id; ?>"><h6><?= $name ?></h6></a>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price" 
                                         data-price-ngn="<?php echo $priceNaira; ?>" 
                                         data-price-usd="<?php echo $priceDollar; ?>">
                                        ₦ <?php echo $priceNaira; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Best Seller Section -->
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Best Seller</h4>
                    </div>
                    <?php
                    // Fetch best seller products
                    $query_best_seller = "SELECT * FROM shop WHERE category = 'Corporate/Formal Wears' LIMIT 3";
                    $result_best_seller = mysqli_query($conn, $query_best_seller);
                    while ($product = mysqli_fetch_assoc($result_best_seller)) {
                        $imgPath = $product['img'];
                        $name = $product['name'];
                        $priceNaira = $product['price'];
                        $priceDollar  = $product['dollar'];
                        $id = $product['id'];
                        ?>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="<?= $imgPath ?>" alt="" style="width:90px; height:90px;">
                            </div>
                            <div class="trend__item__text">
                                <a href="product-details?id=<?php echo $id; ?>"><h6><?= $name ?></h6></a>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price" 
                                         data-price-ngn="<?php echo $priceNaira; ?>" 
                                         data-price-usd="<?php echo $priceDollar; ?>">
                                        ₦ <?php echo $priceNaira; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Feature Section -->
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Feature</h4>
                    </div>
                    <?php
                    // Fetch feature products
                    $query_feature = "SELECT * FROM shop WHERE category = 'Street Wears' LIMIT 3";
                    $result_feature = mysqli_query($conn, $query_feature);
                    while ($product = mysqli_fetch_assoc($result_feature)) {
                        $imgPath = $product['img'];
                        $name = $product['name'];
                        $price = $product['price'];
                        $id = $product['id']; 
                        ?>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="<?= $imgPath ?>" alt="" style="width:90px; height:90px;">
                            </div>
                            <div class="trend__item__text">
                               <a href="product-details?id=<?php echo $id; ?>"><h6><?= $name ?></h6></a>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price" 
                                         data-price-ngn="<?php echo $priceNaira; ?>" 
                                         data-price-usd="<?php echo $priceDollar; ?>">
                                        ₦ <?php echo $priceNaira; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Trend Section End -->

<!-- Discount Section Begin -->
<section class="discount">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="discount__pic">
                    <div style="height:500x; overflow:hidden;">
                        <img src="img/discount.jpg" alt="Discount" style="width:100%; height:auto; max-height:100%;">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="discount__text">
                    <div class="discount__text__title">
                        <span>Discount</span>
                        <h2>Holiday 2024</h2>
                        <h5><span>Sale</span> 50%</h5>
                    </div>
                    <div class="discount__countdown">
                        <!-- id="countdown-time" -->
                        <p>Every Friday</p>
                        <!-- <div class="countdown__item">
                            <span>22</span>
                            <p>Days</p>
                        </div>
                        <div class="countdown__item">
                            <span>18</span>
                            <p>Hour</p>
                        </div>
                        <div class="countdown__item">
                            <span>46</span>
                            <p>Min</p>
                        </div>
                        <div class="countdown__item">
                            <span>05</span>
                            <p>Sec</p>
                        </div> -->
                    </div>
                    <a href="shop">Shop now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Discount Section End -->

<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-car"></i>
                    <h6>Free Shipping</h6>
                    <p>For all oder over $99</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-money"></i>
                    <h6>Money Back Guarantee</h6>
                    <p>If good have Problems</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-support"></i>
                    <h6>Online Support 24/7</h6>
                    <p>Dedicated support</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-headphones"></i>
                    <h6>Payment Secure</h6>
                    <p>100% secure payment</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Voice Search Button -->
<div class="voice-search-container">
    <input type="hidden" id="searchQuery" placeholder="Search for products...">
    <button id="voiceSearchButton" class="floating-mic-button">
        <i class="fa fa-microphone"></i>
    </button>
</div>

<script>
    // Check if the browser supports the Web Speech API
    if (!('webkitSpeechRecognition' in window)) {
        alert('Your browser does not support the Web Speech API. Please use a supported browser.');
    } else {
        const recognition = new webkitSpeechRecognition();
        recognition.continuous = false;
        recognition.interimResults = false;
        recognition.lang = 'en-US';
        const searchQuery = document.getElementById('searchQuery');
        const voiceSearchButton = document.getElementById('voiceSearchButton');
        
        voiceSearchButton.addEventListener('click', () => {
            voiceSearchButton.classList.add('listening');
            recognition.start();
        });
        
        recognition.onresult = (event) => {
            const transcript = event.results[0][0].transcript;
            searchQuery.value = transcript;
            performSearch(transcript);
        };
        
        recognition.onend = () => {
            voiceSearchButton.classList.remove('listening');
        };
        
        recognition.onerror = (event) => {
            console.error('Voice recognition error:', event.error);
            voiceSearchButton.classList.remove('listening');
        };
    }
    
    function performSearch(query) {
        window.location.href = `search.php?query=${encodeURIComponent(query)}`;
    }
</script>

<style>
    /* Fixed Floating Microphone Button */
    .voice-search-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
    }
    
    .floating-mic-button {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #697565;
        color: white;
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .floating-mic-button i {
        font-size: 24px;
    }
    
    .floating-mic-button:hover {
        background-color: #5a645a;
        transform: scale(1.05);
    }
    
    /* Animation for when the mic is listening */
    .floating-mic-button.listening {
        background-color: #ca3e47;
        animation: pulse 1.5s infinite;
    }
    
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(202, 62, 71, 0.7);
        }
        70% {
            box-shadow: 0 0 0 15px rgba(202, 62, 71, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(202, 62, 71, 0);
        }
    }
</style>
<!-- Services Section End -->

<!-- Instagram Begin -->

<!-- Instagram End -->

<!-- Footer Section Begin -->
<?php
    require_once "footer.php";
?>
<div id="newsletterPopup" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
    <div style="width: 400px; background: white; margin: 100px auto; padding: 20px; border-radius: 10px; text-align: center;">
        <h3>Subscribe to our Newsletter</h3>
        <p>Get the latest updates and offers directly in your inbox.</p>
        <form id="newsletterForm">
            <input type="email" id="email" name="email" placeholder="Enter your email" required style="width: 80%; padding: 10px; margin-bottom: 10px;">
            <button type="submit" style="padding: 10px 20px; background-color: #697565; color: white; border: none; border-radius: 5px;">Subscribe</button>
        </form>
        <button onclick="closePopup()" style="margin-top: 10px; padding: 5px 10px; background: red; color: white; border: none; border-radius: 5px;">Close</button>
    </div>
</div>
<script src="popup-script.js" defer></script>

