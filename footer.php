<div id='hbagency_space_191571'></div>
<div class="hb-ad-inpage">
    <div class="hb-ad-inner"> 
    <div class="hbagency_cls hbagency_space_191572"></div>
    </div> 
</div>
<div class="hb-ad-inarticle">
    <div class="hb-ad-inner"> 
    <div class="hbagency_cls"  id="hbagency_space_191568"></div></div> 
</div>
<div id='hbagency_space_191570'></div>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="./index.html">
                            <h2 style="font-family:Cookie; font-weight: bolder;">Zain Stores</h2>
                        </a>
                    </div>
                    <p>Elegance in Modesty</p>
                    <div class="footer__payment">
                        <a href="#"><img src="img/payment/payment-1.png" alt=""></a>
                        <a href="#"><img src="img/payment/payment-2.png" alt=""></a>
                        <a href="#"><img src="img/payment/payment-3.png" alt=""></a>
                        <a href="#"><img src="img/payment/payment-4.png" alt=""></a>
                        <a href="#"><img src="img/payment/payment-5.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <h6>Quick links</h6>
                    <ul>
                        <li><a href="about">About</a></li>
                        <li><a href="#">Blogs</a></li>
                        <li><a href="contact">Contact</a></li>
                        <li><a href="faq">FAQ</a></li>
                        <li><a href="privacy">Privacy Policy</a></li>
                        <li><a href="refund">Refund Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>Account</h6>
                    <ul>
                        <li><a href="login">My Account</a></li>
                        <li><a href="#">Orders Tracking</a></li>
                        <li><a href="#">Checkout</a></li>
                        <li><a href="#">Wishlist</a></li>
                        
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>NEWSLETTER</h6>
                    <form action="#">
                        <input type="text" placeholder="Email">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <div class="footer__social">
                        <a href="https://www.facebook.com/share/15i9S5Pf4t/?mibextid=LQQJ4d"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="https://instagram.com/realzainstores/profileCard/?igsh=MXB6M3B2eDAzYzAxbg=="><i class="fa fa-instagram"></i></a>
                        <a href="https://www.tiktok.com/@real_zainstores?_t=8rjyHtylIHW&_r=1"><i class="fa fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                    <h4>SELECT CURRENCY</h4>
                    <select name="country-currency" id="country-currency" class="form-control">
                        <option value="NGN">Nigeria - Nigerian Naira (NGN)</option>
                        <option value="USD">United States - US Dollar (USD)</option>
                    </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <div class="footer__copyright__text">
                    <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://instagram.com/jcode_techs" target="_blank">Jcode Tech Center</a></p>
                </div>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/main.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const currencySelector = document.getElementById('country-currency');
        const prices = document.querySelectorAll('.product__price');
        const pricer = document.querySelectorAll('.product__details__price');
        // Change event for currency selector
        currencySelector.addEventListener('change', () => {
            const selectedCurrency = currencySelector.value;

            // Update prices based on selected currency
            prices.forEach(price => {
                const priceNaira = price.getAttribute('data-price-ngn');
                const priceDollar = price.getAttribute('data-price-usd');

                if (selectedCurrency === 'USD') {
                    price.innerHTML = `$ ${parseFloat(priceDollar).toFixed(2)}`;
                } else {
                    price.innerHTML = `₦ ${parseFloat(priceNaira).toFixed(2)}`;
                }
            });
            pricer.forEach(price => {
                const priceNaira = price.getAttribute('data-price-ngn');
                const priceDollar = price.getAttribute('data-price-usd');

                if (selectedCurrency === 'USD') {
                    price.innerHTML = `$ ${parseFloat(priceDollar).toFixed(2)}`;
                } else {
                    price.innerHTML = `₦ ${parseFloat(priceNaira).toFixed(2)}`;
                }
            });
        });
    });
</script>
<!--Start of Tawk.to Script-->
<!--<script type="text/javascript">-->
<!--var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();-->
<!--(function(){-->
<!--var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];-->
<!--s1.async=true;-->
<!--s1.src='https://embed.tawk.to/67853c1349e2fd8dfe06ba84/1ihg75bc1';-->
<!--s1.charset='UTF-8';-->
<!--s1.setAttribute('crossorigin','*');-->
<!--s0.parentNode.insertBefore(s1,s0);-->
<!--})();-->
<!--</script>-->
<!--End of Tawk.to Script-->
<script src="https://d3u598arehftfk.cloudfront.net/prebid_hb_13550_20808.js" async> </script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4578354861538131"
     crossorigin="anonymous"></script>
</body>

</html>