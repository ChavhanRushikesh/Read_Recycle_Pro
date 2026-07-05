<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sell on Readcycle</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>

     body {
	 
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
        font-family: "Poppins", times new roman;
        background-color: #fff;
    }


.section-1-container {
width: 1500px;
margin: 0 auto;
margin-top: 10px;
height : 100%;
position: relative; /* Add relative positioning */
}

.section-1-container img {
  width: 100%; /* Adjust the width as needed */
  height: 380px;
  margin-top: 5px;
}

.overlay {
  position: absolute;
  top: 50%;
  left: 15%;
  transform: translate(-50%, -50%);
  text-align: center;
}

.overlay-text {
  font-family: Inter, sans-serif;
  font-style: normal;
  font-weight: 700;
  font-size: 40px;
  display: inline;
  line-height: 58px;
  margin-bottom: 50px; /* Adjusted margin */
  color: black; /* Moved color property from span to here */
}

 .overlay-text span{
        color:  blue;
        font-family: Inter, sans-serif;
    font-style: normal;
    font-weight: 700;
    font-size: 40px;
    display: inline;
    line-height: 58px;
	 margin-bottom: 50px;
    }
.overlay-button {
  position: absolute;
  bottom: -55px; /* Adjust the distance from the bottom as needed */
  left: 50%;
  transform: translateX(-50%);
  background-color: #1d2951;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  text-transform: uppercase;
  font-size: 16px;
  cursor: pointer;
  text-decoration: none;
}

.overlay-button:hover {
        background-color: #01796f;
    }

.section-2 {
width: 100%;
height: 122px;
background-color: white;
box-shadow: 0 1px 1px 0 rgb(0 0 0 / 16%);
}

.section-2-container {
width: 1280px;
margin: 0 auto;
height : 100%;
display: flex;
align-items: center;
justify-content: space-between;
}

.row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Horizontally center the columns */
}

.column {
    flex: 0 0 calc(33.33% - 2em); /* Adjust the width of each column */
    max-width: calc(33.33% - 2em); /* Adjust the maximum width of each column */
    margin: 1em; /* Adjust the margin between columns */
}

/* Additional styles for smaller screens */
@media screen and (max-width: 768px) {
    .column {
        flex: 0 0 calc(50% - 2em); /* Adjust the width of each column for smaller screens */
        max-width: calc(50% - 2em); /* Adjust the maximum width of each column for smaller screens */
    }
}

.card {
  padding: 3.1em 1.25em;
  text-align: center;
  background: linear-gradient(0deg, #397ef6 10px, transparent 10px);
  background-repeat: no-repeat;
  background-position: 0 0.62em;
  box-shadow: 0 0 2.5em rgba(0, 0, 0, 0.15);
  border-radius: 0.5em;
  transition: 0.5s;
  cursor: pointer;
   width: 90%; /* Adjust the width as needed */
  max-width: 5000px; /* Adjust the maximum width as needed */
  border: 1px solid #ccc;
  height: 470px;
}

.card .icon {
  font-size: 2.5em;
  height: 170px;
  width: 170px;
  margin: auto;
  display: grid;
  place-items: center;
  border-radius: 50%;
  color: #ffffff;
}

.card .icon:hover {
  transform: scale(1.1);
}


.card h3 {
  font-size: 1.3em;
  margin: 1em 0 1.4em 0;
  font-weight: 600;
  letter-spacing: 0.3px;
  color: #070024;
}
.card p {
  line-height: 1.8em;
  color: #000;
  text-align: justify;
}



.section-2 h2 {
  color: black;
  font-family: Inter, sans-serif;
  font-style: normal;
  font-weight: 700;
  font-size: 40px;
  margin-left: 360px;
}

.section-2 h2 span {
  color: blue;
  font-family: Inter, sans-serif;
  font-style: normal;
  font-weight: 700;
  font-size: 40px;
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
</head>
<body>
<?php include 'user_header.php'; ?>

<section class="section-1">
<div class="section-1-container">
  <img src="images/seller.jpg">
  <div class="overlay">
    <div class="overlay-text"><span>Sell Books</span> Online<br>
On ReadCycle</div><br>
   <a href="user_panel.php" class="overlay-button">Start Selling</a>
  </div>
</div>
</section>

<section class="section-2">
  <h2><span>Types of Books</span> you can sell at ReadCycle</h2> 
   <div class="row">
        <!-- Column One -->
        <div class="column">
          <div class="card">
            <div class="icon">
              <img src="images/novels.svg">
            </div>
            <h3>Novels</h3>
            <p>
             It is true that books are man’s best friend. If you aspire to sell books online and target a broader audience of readers, you could opt for novels. You can provide a mix of fictional and non-fictional novels, taking various genres and writers into consideration. From gripping mysteries to heartwarming romance novels, you are sure to find an eager audience via Flipkart. So, curate a diverse collection and reach millions of readers in India.
            </p>
          </div>
        </div>
        <!-- Column Two -->
        <div class="column">
          <div class="card">
            <div class="icon">
             <img src="images/image2.svg">
            </div>
            <h3>Education and Professional Books</h3>
            <p>
             The world of learning is vast and varied. Whether it is a guide for competitive exams that lights up dreams, a manual that becomes the go-to for mastering a skill, or a textbook that forms the backbone of a course, the education category is brimming with opportunities. You can dive into this segment and sell books online that cater to the different needs of learners and build a massive customer base.
            </p>
          </div>
        </div>
        <!-- Column Three -->
        <div class="column">
          <div class="card">
            <div class="icon">
               <img src="images/image3.svg">
            </div>
            <h3>Business and Economics Books</h3>
            <p>
              Being the most dynamic subjects, keeping up with new theories, strategies, and insights regularly is quite essential. This is where you can step in and sell books online that buyers are looking for. By listing such publications, you can become a trusted resource for many. Be it entrepreneurs, students or professionals, your collection can be the guiding light they turn to, helping them gain knowledge about business and economics.
            </p>
          </div>
        </div>
		 <!-- Column Four -->
        <div class="row"> <!-- New row for the last two cards -->
          <div class="column">
            <div class="card">
              <div class="icon">
                 <img src="images/image4.svg">
              </div>
              <h3>School Books</h3>
              <p>
    Every academic year, students across grades search for textbooks, guides, and reference materials. So, add all subject books from various boards and become a part of a student’s educational journey. Furthermore, Flipkart is the best place to sell books online, as it is the go-to platform for many parents and students. From primary education to higher secondary, offer a broad selection to ensure every student finds the right resources to excel in their studies.            </p>
            </div>
          </div>
           <!-- Column Five -->
          <div class="column">
            <div class="card">
              <div class="icon">
                 <img src="images/image5.svg">
              </div>
              <h3>Vernacular Language Books</h3>
              <p>
    India is a land of many languages, fuelling the demand for regional books on Flipkart too. List and sell books online in different languages, and buyers will surely come across your collection. It is a fantastic opportunity to cater to a diverse audience. By offering books in various regional languages, you not only fulfil a significant demand but also widen your customer base, reaching readers from every corner of the country.            </p>
            </div>
          </div>
        </div> <!-- End of new row -->
      </div>

<footer>
        <div class="foot-panel1">
           <a href="become a reseller.php"> Back to top </a>
        </div>
</footer>
<?php include 'footer.php'; ?>
</body>
</html>
