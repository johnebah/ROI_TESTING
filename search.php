<?php
session_start();
require_once "config.php";
require_once "gemini.php"; // Include the Gemini API function

// Initialize variables
$searchQuery = '';
$searchResults = [];
$totalResults = 0;

if (isset($_GET['query'])) {
    $searchQuery = htmlspecialchars(trim($_GET['query']));
    $title = "Search Results for: " . $searchQuery;
    $description = "Zain Stores search results for " . $searchQuery;
    $keyword1 = $searchQuery;
    $keyword2 = $searchQuery . " Products";
    $keyword3 = "Zain Stores " . $searchQuery;
    
    // Call Gemini API to refine the search query if needed
    $refinedQuery = callGeminiAPI($searchQuery);
    
    // Normalize the refined query (convert to lowercase and trim)
    $refinedQuery = strtolower(trim($refinedQuery));
    
    // Prepare the SQL query to search for products by name
    $sql = "SELECT * FROM shop WHERE LOWER(name) LIKE LOWER(?)";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$refinedQuery%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Get total number of results
    $totalResults = $result->num_rows;
    
    // Fetch all search results
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }
} else {
    $title = "Search Products";
    $description = "Zain Stores - Search for products";
    $keyword1 = "Search";
    $keyword2 = "Zain Stores Products";
    $keyword3 = "Zain Stores Search";
}

// Include header
require_once "header.php";
?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./"><i class="fa fa-home"></i> Home</a>
                    <span>Search</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Search Results Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Display Gemini API Error Message if any -->
                <?php if (isset($_SESSION['gemini_error'])): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Search Enhancement Temporarily Unavailable:</strong> <?php echo $_SESSION['gemini_error']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php 
                    // Clear the error message after displaying it
                    unset($_SESSION['gemini_error']);
                endif; 
                ?>
                
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <h2>Search Results</h2>
                                <p>Showing results for: <strong><?php echo $searchQuery; ?></strong></p>
                                <?php if ($totalResults > 0): ?>
                                    <p>Found <?php echo $totalResults; ?> product(s)</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <form method="get" action="search.php" class="search-form">
                                    <div class="input-group">
                                        <input type="text" name="query" class="form-control" placeholder="Search products..." value="<?php echo $searchQuery; ?>">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Search Results Display -->
                <div class="row product__filter">
                    <?php if ($totalResults > 0): ?>
                        <?php foreach ($searchResults as $product): ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mix">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="<?php echo $product['img']; ?>">
                                        <ul class="product__hover">
                                            <li><a href="<?php echo $product['img']; ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            <li>
                                                <form method="post" action="wishlist.php">
                                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                                    <button type="submit" class="wishlist-btn"><span class="icon_heart_alt"></span></button>
                                                </form>
                                            </li>
                                            <li>
                                                <form method="post" action="cart.php">
                                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="cart-btn"><span class="icon_bag_alt"></span></button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="product-details?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product__price" 
                                             data-price-ngn="<?php echo $product['price']; ?>" 
                                             data-price-usd="<?php echo $product['dollar']; ?>">
                                            ₦<?php echo number_format($product['price'], 2); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-lg-12">
                            <div class="no-results">
                                <h3>No products found for your search: <?php echo $searchQuery; ?></h3>
                                <p>Please try a different search term or browse our categories.</p>
                                <div class="mt-4">
                                    <a href="./" class="primary-btn">Browse All Products</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Related Searches -->
                <?php if ($totalResults > 0): ?>
                <div class="row mt-5">
                    <div class="col-lg-12 text-center">
                        <div class="related__title">
                            <h5>YOU MIGHT ALSO LIKE</h5>
                        </div>
                    </div>
                    
                    <?php
                    // Fetch some related products based on category if available
                    if (!empty($searchResults)) {
                        $firstProduct = $searchResults[0];
                        $category = $conn->real_escape_string($firstProduct['category'] ?? '');
                        $excludeIds = array_map(function($product) {
                            return $product['id'];
                        }, $searchResults);
                        
                        $excludeList = implode(',', $excludeIds) ?: 0;
                        
                        $relatedSql = "SELECT * FROM shop WHERE category = '$category' AND id NOT IN ($excludeList) LIMIT 4";
                        $relatedResult = $conn->query($relatedSql);
                        
                        if ($relatedResult && $relatedResult->num_rows > 0) {
                            while ($related = $relatedResult->fetch_assoc()) {
                                ?>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="<?php echo htmlspecialchars($related['img']); ?>">
                                            <ul class="product__hover">
                                                <li><a href="<?php echo htmlspecialchars($related['img']); ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                <li>
                                                    <form method="post" action="wishlist.php">
                                                        <input type="hidden" name="product_id" value="<?php echo $related['id']; ?>">
                                                        <button type="submit" class="wishlist-btn"><span class="icon_heart_alt"></span></button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form method="post" action="cart.php">
                                                        <input type="hidden" name="product_id" value="<?php echo $related['id']; ?>">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <button type="submit" class="cart-btn"><span class="icon_bag_alt"></span></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="product-details?id=<?php echo $related['id']; ?>"><?php echo htmlspecialchars($related['name']); ?></a></h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="product__price" 
                                                data-price-ngn="<?php echo $related['price']; ?>" 
                                                data-price-usd="<?php echo $related['dollar']; ?>">
                                                ₦<?php echo number_format($related['price'], 2); ?>
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
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- Search Results Section End -->

<!-- Voice Search Button -->
<div class="voice-search-container">
    <input type="hidden" id="searchQuery" placeholder="Search products...">
    <button id="voiceSearchButton" class="floating-mic-button">
        <i class="fa fa-microphone"></i>
    </button>
</div>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
    
    /* Error message styling */
    .alert-warning {
        background-color: #fff3cd;
        border-color: #ffeeba;
        color: #856404;
        padding: 12px 20px;
        margin-bottom: 20px;
        border-radius: 4px;
        position: relative;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .alert-dismissible .close {
        position: absolute;
        top: 0;
        right: 0;
        padding: 12px 20px;
        color: inherit;
        background: transparent;
        border: none;
        cursor: pointer;
    }
</style>

<?php 
require "footer.php";
?>