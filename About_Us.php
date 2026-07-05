<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us Page Design</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-...your-sha512-hash-here..." crossorigin="anonymous" />
</head>

<style>
     body {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
        font-family: "Poppins", times new roman;
        background-color: #fff;
    }
    
    .hero {
        background-color: #fff;
        overflow: hidden;
    }

    .heading h1 {
        color:  #000000;
        font-size: 60px;
        text-align: center;
        margin-top: 40px;
         font-family: "Poppins",Georgia;
    }
    .heading h1 span{
        color:  #FF69B4;
        font-size: 60px;
        text-align: center;
        margin-top: 35px;
        font-family: "Poppins",Georgia;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 90%;
        margin: 65px auto;
    }

    .hero-content {
        flex: 1;
        width: 600px;
        margin: 0px 25px;
    }

    .hero-content h2 {
        font-size: 38px;
        color:  #000000;
        margin-bottom: 30px;
        color: #191970;
        margin-left: 10px;
        font-family: "Poppins",Calisto MT;
    }

    .hero-content p {
        font-size: 19px;
       color:  #000000;
        line-height: 1.6;
        width: 600px;
        margin-bottom: 40px;
        text-align: justify;
        margin-left: 10px;
    }

    .hero-image {
        flex: 1;
        width: 600px;
        height: 350px;
        margin: auto;
        margin-top: 10px;
        margin-left: 140px;
    }

    img {
        width: 600px;
        height: 350px;
        border-radius: 10px;
    }
    
    .hero-image img:hover {
        transform: scale(1.1);
    }

    .about {
        width: 100%;
        height: auto;
        padding: 20px;
        display: flex;
        align-items: center;
        margin-top: -90px;
        justify-content: space-around;
        background-color: #fff;
    }

    .about .about_image img {
        width: 600px;
        height: 350px;
        margin-top: 80px;
    }
    
    .about_image img:hover {
        transform: scale(1.1);
    }

    .about .about_tag h1 {
        font-size: 38px;
        position: relative;
        bottom: 10px;
        margin-bottom: 0px;
        padding: 0;
        margin-top: 60px;
        font-family: "Poppins",Calisto MT;
        color: #8b008b;
    }

    .about .about_tag p {
        line-height: 1.6;
        width: 600px;
        text-align: justify;
        margin-top: 20px;
        margin-bottom: -10px;
        font-size: 19px;
       color: #000000;
    }

    .services {
        width: 100%;
        height: auto;
        margin: 35px 0;
    }

    .services .services_box {
        width: 95%;
        margin: 0 auto;
        display: flex;
        align-items: center;
         margin-top: -120px;
        justify-content: space-around;
    }

    .services .services_box .services_card {
        text-align: center;
        width: 310px;
        height: 200px;
        box-shadow: 0 0 10px #367588;
        padding: 10px;
        margin-top: -5px;
    }

    .services .services_box .services_card i {
        color: #089da1;
        font-size: 45px;
        margin-bottom: 30px;
        cursor: pointer;
    }

    .services .services_box .services_card h3 {
        margin-top: -10px;
        margin-bottom: 50px;
        margin-top: 0;
        padding: 10px;
        font-size: 18px;
    }

    .services .services_box .services_card img {
        width: 150px;
        height: auto;
        margin-top: 0px;
        border-radius: 10px;
    }

   .info {
    background-color: #fff;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-around;
    margin-top: 30px;
}

.info-content {
    flex: 1;
    width: 600px;
    margin: 0px 25px;
}

.info-content h2 {
    font-size: 38px;
    margin-bottom: 30px;
    font-family: "Poppins",Calisto MT;
    margin-left: 70px;
    color: #e4007c;
}

.info-content p {
    font-size: 19px;
    line-height: 1.6;
    width: 600px; 
    margin-bottom: 40px;
    color: #000000;
    text-align: justify;
    margin-left: 70px;
}

.info-image {
    flex: 1;
    margin: auto;
    margin-top: 10px;
    margin-left: 130px; 
}

.info-image img {
    width: 100%;
    height: auto;
    border-radius: 10px;
    max-width: 600px; 
}

.info-image img:hover {
        transform: scale(1.1);
    }


      .main {
        background-color: #fff;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-around;
         margin-top: 60px;
    }

    .main-content {
        flex: 1;
        width: 600px;
        margin: 0px 25px;
        order: 2;
        text-align: justify; 
    }

    .main-content h2 {
        font-size: 38px;
        margin-bottom: 20px;
        font-family: "Poppins",Calisto MT;
        margin-left: 130px;
        color: #c40233;
    }


    .main-image img:hover {
        transform: scale(1.1);
    }

    .main-content p {
        line-height: 1.6;
        width: 600px;
        text-align: justify;
        margin-top: 30px;
        margin-bottom: 220px; 
        font-size: 19px;
        margin-left: 130px;
        color: #000000;
    }

    .main-image img {
        flex: 1;
        margin: auto;
        margin-top: 10px;
        margin-left: 90px;
        margin-bottom: 180px;
        max-width: 600px;
        max-height: 350px;
        border-radius: 10px;
        
    }
    
footer {
margin-top: 15px;
}

.foot-panel1 {
background-color: #1b1b1b;
color: white;
height: 50px;
display: flex;
justify-content: center;
align-items: center;
font-size: 0.85rem; 
margin-bottom: -20px;
}

.foot-panel1 a {
    color: white;
    text-decoration: none; 
  }
</style>
<body>
 <?php include 'user_header.php'; ?>
    <section class="hero">
        <div class="heading">
            <h1><span>About</span> Us</h1>
        </div>
        <div class="container">
            <div class="hero-content">
                <h2>Welcome to Our Website</h2>
                <p>Welcome to ReadCycle:Online Book Reselling Platform, your go-to destination for a dynamic online
                    book reselling experience. Our platform is more than just a marketplace; it's a global community
                    celebrating the joy of reading. We connect readers worldwide, promote sustainable practices, and
                    provide an affordable, user-friendly platform for buying, selling, and exchanging books. With a
                    commitment to supporting independent authors, embracing technology, and ensuring trust through
                    quality control, we create a space where lifelong learning flourishes.</p>
              
            </div>
            <div class="hero-image">
                <img src="images\book_img.jpg">
            </div>
        </div>
    </section>

    <div class="about">

        <div class="about_image">
            <img src="images\aboutus.jpeg">
        </div>
        <div class="about_tag">
            <h1>About Us</h1>
            <p>Welcome to ReadCycle:Online Book Reselling Platform, your premier destination for a revolutionary online
                book reselling experience. Our platform is not just about buying and selling books; it's a celebration
                of literature, a space where readers from around the world come together to exchange ideas,
                recommendations, and, of course, books. We pride ourselves on being more than just a marketplace –
                we're a vibrant community dedicated to making the world of books more accessible, affordable, and
                eco-friendly.</p>
            
        </div>

    </div>

    <div class="info">
        <div class="info-content">
            <h2>Our Mission</h2>
            <p>Our mission is multi-faceted: we aim to connect readers worldwide, fostering a sense of camaraderie and
                shared passion for literature. Simultaneously, we strive to promote sustainable reading practices by
                encouraging the reuse and resale of books, thereby contributing to environmental responsibility within
                the publishing industry. We are dedicated to enhancing accessibility to knowledge by providing an
                affordable and user-friendly platform that empowers individuals to buy, sell, and exchange books
                easily.</p>
          
        </div>
        <div class="info-image">
            <img src="images\mission.jpg">
        </div>
    </div>

    

    <div class="main">
    <div class="main-image">
        <img src="images\our_vision.jpg">
    </div>
    <div class="main-content">
        <h2>Our Vision</h2>
        <p>The vision of our online book reselling platform is to establish a global community where the joy of
            reading is celebrated, and access to a diverse array of knowledge is made effortlessly attainable
            through a seamless and sustainable online experience. "To create a global community where the love for
            reading is fostered, and access to diverse knowledge is made easy through a seamless and sustainable
            online book reselling platform."</p>
        
    </div>
    
</div>

<div class="services">

        <div class="services_box">

            <div class="services_card">
                <img src="images\fast_delivery.png">
                <h3>Fast Delivery</h3>
            </div>

            <div class="services_card">
                <img src="images\24x7.jpg">
                <h3>24 x 7 Services</h3>
            </div>

            <div class="services_card">
                <img src="images\discount.jpg">
                <h3>Big Discount</h3>
            </div>

            <div class="services_card">
              <img src="images\payy.jpg">
                <h3>Secure Payment</h3>
            </div>

        </div>

    </div>
<footer>
        <div class="foot-panel1">
           <a href="About_Us.php"> Back to top </a>
        </div>
</footer>
<?php include 'footer.php'; ?>
</body>

</html>
