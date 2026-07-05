<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">

    <!-- =====Fontawesome CDN Link===== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        /* ===== Google Font Import - Poppins ===== */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body{
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }
        .container {
            display: flex;
            flex-direction: column; /* Stack elements vertically */
            max-width: 1000px;
            width: 100%;
            margin: 40px auto; /* Adjust margin to add space from top and bottom */
        }
        .image-container {
            flex: 0;
            margin-left: 40px; /* Adjust left margin to create a gap */
            margin-right: 80px; /* Adjust right margin to create a gap */
        }
        .accordion {
            flex: 1;
            max-width: 850px;
            background: #FFF;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 4px rgba(0,0,0,0.2);
			margin-right: 20px; 
        }
        .accordion .accordion-content {
            margin: 5px 0; /* Reduce top and bottom margin */
            border-radius: 4px;
            background: #FFF;
            border: 1px solid #ddd;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .accordion-content.open {
            margin: 5px 0; /* Reduce top and bottom margin */
            border-radius: 4px;
            background: #FFF7F0;
            border: 1px solid #FFD6B3;
        }
        .accordion-content header {
            display: flex;
            min-height: 50px;
            padding: 0 15px;
            cursor: pointer;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s linear;
        }
        .accordion-content.open header {
            min-height: 35px;
        }
        .accordion-content header .title {
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }
        .accordion-content header i {
            font-size: 15px;
            color: #333;
        }
        .accordion-content .description {
            height: 0;
            font-size: 14px;
            color: #333;
            font-weight: 400;
            padding: 0 15px;
            transition: all 0.2s linear;
        }


        .header{
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: #002147;
        padding: 1rem 9%;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 1000;
		 font-family: 'Arial', sans-serif;
       
    }
    
    .header .images {
    display: flex;
    align-items: center;
    margin-left: -110px; 
}

.header .images a{
border: none;
    outline: none;
    background-color: transparent;
	color: white;
	font-size: 19px;
    }
    
    .header .icons .fas.fa-heart {
    margin-right: 15px; /* Adjust this value to increase or decrease the space */
}

.header .icons .fas.fa-shopping-cart {
    margin-left: 35px; /* Adjust this value to increase or decrease the space */
}
    
    
    .header .images a:hover {
    color: #fff; 
}
    

.text {
    color: #fff;
    margin-left: -1160px;
    font-size: 18px;
    top: 10px;
    margin-top: 4px; /* Add top margin */
}

.header .icons {
    display: flex;
    align-items: center;
    margin-right: -100px; 
    font-size: 21px;
	
}

.header .icons a {
    border: none;
    outline: none;
    margin-left: 15px;
    background-color: transparent;
   color: white;
     text-decoration: none;
}

.header .icons a:hover {
    color: #d3003f; 
}

.header .icons div.hover{
color: #ff1493;

}
    </style>
    <title>FAQ</title>
</head>
<body>
<br><br><br>

<div>




<script>
	function goBack() {
  window.history.back()
}
</script>
<header class="header">
<div class="images">
<a>
<i class="fas fa-arrow-left" onclick="goBack()"></i>
</a>
</div>
<div class="text">
        <h4 style="font-size: 22px;">Help Center</h4>
        </div>
    <div class="icons">
        <a href="login.php" class="fas fa-heart"></a>
        <a href="login.php" class="fas fa-shopping-cart"></a>
    </div>
</header>
    <br><br><br><br>

    <div class="accordion">

    <h2 style="color: #000; text-decoration: underline;">Privacy Policy</h2><br>

    <section>
        <h3>Introduction</h3>
        <p>This Privacy Policy outlines how Read Cycle Book reselling platform collects, uses, and protects the personal information
            you provide on our website.</p>

        <h3>Information We Collect</h3>
        <p>We may collect personal information such as your name, email address, shipping address, and payment details
            when you make a purchase on our website. We also collect non-personal information, including browser
            details and IP addresses for analytical purposes.</p>

        <h3>How We Use Your Information</h3>
        <p>We use your personal information to process orders, provide customer support, and improve our services. We
            may also send you promotional emails about new products or special offers if you have opted in to receive
            them.</p>

        <h3>Sharing Your Information</h3>
        <p>We do not sell, trade, or rent your personal information to third parties. We may share your information
            with trusted service providers who assist us in operating our website, conducting our business, or
            servicing you.</p>

        <h3>Security</h3>
        <p>We take appropriate measures to protect your personal information from unauthorized access, alteration, or
            disclosure. However, no data transmission over the internet can be guaranteed as 100% secure, so we cannot
            ensure or warrant the security of any information you transmit to us.</p>

        <h3>Cookies</h3>
        <p>We use cookies to enhance your browsing experience on our website. You can control and/or delete cookies as
            you wish. For more information, refer to our <a href="#">Cookie Policy</a>.</p>

        <h3>Changes to This Privacy Policy</h3>
        <p>We may update our Privacy Policy from time to time. Any changes will be posted on this page with an updated
            date.</p>

        <h3>Contact Us</h3>
        <p>If you have any questions or concerns regarding our Privacy Policy, please contact us at
            privacy <a href="#">readcycle43@gmail.com</a>.</p>
    </section>



    <br><hr><br>
    <h2 style="color: #000; text-decoration: underline;">Terms and Conditions</h2><br>

    <section>
        <h3>1. Acceptance of Terms</h3>
        <p>By accessing or using our website, you agree to be bound by these Terms and Conditions. If you disagree
            with any part of these terms, you may not access the website.</p>

        <h3>2. Use of Our Website</h3>
        <p>You agree to use our website for lawful purposes only and not to violate any applicable laws, regulations,
            or the rights of others.</p>

        <h3>3. Intellectual Property</h3>
        <p>The content on this website, including text, graphics, logos, and images, is the property of [Your
            Bookstore Name] and is protected by copyright and other intellectual property laws.</p>

        <h3>4. User Accounts</h3>
        <p>If you create an account on our website, you are responsible for maintaining the confidentiality of your
            account and password and for restricting access to your computer.</p>

        <h3>5. Product Information</h3>
        <p>We strive to provide accurate product information, but we do not guarantee the accuracy, completeness, or
            reliability of any product descriptions or other content on the website.</p>

        <!-- Add more sections as needed -->

        <h3>6.Contact Us</h3>
        <p>If you have any questions or concerns regarding our Terms and Conditions, please contact us at
            info <a href="#">readcycle43@gmail.com</a>.</p>
    </section>


<br><hr><br>
    <h2 style="color: #000; text-decoration: underline;">ReadCycle FAQ</h2><br>

        <div class="accordion-content">
            <header>
                <span class="title">Q1. How can I place an order?</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
                You can place an order by browsing our collection, selecting the desired books, and proceeding to checkout.
            </p>
        </div>
        <!-- Repeat the structure for other accordion items -->
		  <div class="accordion-content">
            <header>
                <span class="title">Q2. What payment methods do you accept?</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
                We accept credit/debit cards (Visa, UPI) and Cash on Delivery(COD) also. </p>
        </div>
		  <div class="accordion-content">
            <header>
                <span class="title">Q3. Can I modify or cancel my order after placing it?</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
               Once an order is placed, it cannot be modified or canceled. Please double-check your order before
                confirming the purchase. </p>
        </div>
		  <div class="accordion-content">
            <header>
                <span class="title">Q4. Do you offer international shipping?</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
                Yes, we offer international shipping. Shipping fees and delivery times may vary based on the destination.</p>
        
        </div>
		  <div class="accordion-content">
            <header>
                <span class="title">Q5. What is your return policy?</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
                Our return policy allows you to return books within 30 days of purchase. Please refer to our
                <a href="#">return policy</a> for more details.  </p>
        </div>
		  <div class="accordion-content">
            <header>
                <span class="title">Q6. How do I contact customer support?</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
                You can contact our customer support team through our <a href="#">contact page</a> or by emailing
                support@example.com. </p>
        </div>
		  <div class="accordion-content">
            <header>
                <span class="title">Q7. How long will it take for my order to arrive?</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
               The Delivery Time Will Vary Depending On Your Location And The Availability Of The Book You Have Ordered. We Will Provide You With A Delivery Estimate At The Time Of Checkout.
            </p>
        </div>
		  <div class="accordion-content">
            <header>
                <span class="title">Q8. How can I confirm if the quality of the book is listed or if they are original books?</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
               At readcycle.Com Customer Satisfaction Is Paramount To Us, As Such You Can Request A Video Of Your Ordered Books Before Dispatch To Make Sure Of Their Quality And Authenticity.
             </p>
        </div>
		  <div class="accordion-content">
            <header>
                <span class="title">Q9. What is your Privacy Policy?</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
              At readCycle.Com, We Take The Privacy Of Our Customers Very Seriously. Our Privacy Policy Outlines How We Collect, Use, And Protect Our Customers’ Personal Information. You Can View Our Privacy Policy On Our Website.
             </p>
        </div>
		  <div class="accordion-content">
            <header>
                <span class="title">Q10. How do I know if Book in stock?</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
               All Of The Books On Our Website Are Displayed With Their Current Availability Status. A Book In Stock Will Be Noted As "In Stock" On The Product Page. If A Book Is Out Of Stock, It Will Be Noted As "Out Of Stock" And You Can Sign Up To Be Notified When It Becomes Available Again.
            </p>
        </div>
		  <div class="accordion-content">
            <header>
                <span class="title">Q11. WHAT iF I receive a Book in a Condition that I didn't purchase?</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
               If You Receive A Book That Is “Not As Per The Conditions Mentioned”, Please Contact Our Customer Service Team Immediately To Report The Issue. We Will Work With You To Resolve The Issue And Provide A Replacement Or A Refund, As Appropriate.
             </p>
        </div>
		  <div class="accordion-content">
            <header>
                <span class="title">Q12. Do you send personalized notes with every order?</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
               No</p>
        </div>
		  <div class="accordion-content">
            <header>
                <span class="title">Q13. What are your standard Delivery charges?</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
                We do not charge for DeliveryWe're pleased to offer free standard delivery on all orders. You won't incur any additional charges for the delivery of your books. Enjoy the convenience of free shipping when you shop with us!
             </p>
        </div>
		<div class="accordion-content">
            <header>
                <span class="title">Q14.How do i Change or UPdate my shipping Information?</span>
                <i class="fa-solid fa-plus"></i>
            </header>
            <p class="description">
                You Can Change Or Update Your Shipping Information By Logging Into Your Account On Our Website And Editing Your Account Details. If You Need Further Assistance, Please Contact Our Customer Service Team.
         </p>
        </div>
        <center>
        <div class="image-container">
        <img src="images/faq2.jpg" alt="Your Image">
    </center>
    </div>
    </div>
    
    
    <script>
        const accordionContent = document.querySelectorAll(".accordion-content");

        accordionContent.forEach((item, index) => {
            let header = item.querySelector("header");
            header.addEventListener("click", () =>{
                item.classList.toggle("open");

                let description = item.querySelector(".description");
                if(item.classList.contains("open")){
                    description.style.height = `${description.scrollHeight}px`;
                    item.querySelector("i").classList.replace("fa-plus", "fa-minus");
                }else{
                    description.style.height = "0px";
                    item.querySelector("i").classList.replace("fa-minus", "fa-plus");
                }
                removeOpen(index);
            })
        })

        function removeOpen(index1){
            accordionContent.forEach((item2, index2) => {
                if(index1 != index2){
                    item2.classList.remove("open");

                    let des = item2.querySelector(".description");
                    des.style.height = "0px";
                    item2.querySelector("i").classList.replace("fa-minus", "fa-plus");
                }
            })
        }
    </script>

    </div>
</body>
</html>
