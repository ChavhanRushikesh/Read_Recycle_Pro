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
    </style>
    <title>FAQ</title>
</head>
<body>
<br><br><br>

<div class="image-container">
        <img src="images/faq2.jpg" alt="Your Image">
    </div>
    <div class="accordion">
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
</body>
</html>
