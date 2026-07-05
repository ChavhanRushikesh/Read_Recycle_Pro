<?php
    session_start();
    $user_id = null;  // Initialize user_id to null

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Categories</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-...your-sha512-hash-here..." crossorigin="anonymous" />
    <style>
        body {
            background-color: #d3d3d3;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 35px;
}

.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 290px; /* Adjust card width as needed */
    cursor: pointer;
    transition: box-shadow 0.3s ease, transform 0.3s ease; /* Added transition for smoother animation */
    display: flex;
    flex-direction: column;
    align-items: center;
	 margin: 0 2px; /* Horizontal gap between cards */
}

.card:hover {
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px); /* Move the card up slightly on hover */
}

.card img {
    max-width: 70%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 15px;
}

.card p {
    font-size: 16px;
    color: #000;
    line-height: 1.5;
    margin-bottom: 10px;
}
.card h2 {
    color: #191970; /* Change the color */
    font-size: 20px; /* Change the font size */
    margin-bottom: 0px; /* Adjust the bottom margin */
}
   
    </style>
</head>
<body>
<?php include 'usernotlogin_header.php'; ?>

    <br><br> <br>
    <div class="card-container">
        <div class="card" onclick="window.location.href='fiction_new1.php';">
            <img src="https://m.media-amazon.com/images/I/51seH-SzjuL.jpg" alt="Fiction">
            <h2>Fiction</h2>
            <p>Imaginative narrative created from the author's imagination.</p>
            <p>Genres: Novel, Short Story, Mystery/Thriller, Fantasy, Science Fiction, Historical Fiction</p>
        </div>

        <div class="card" onclick="window.location.href='non_fiction1.php';">
            <img src="https://i.thenile.io/r1000/9789353171216.jpg?r=5fccb09661c60" alt="Non-Fiction">
            <h2>Non-Fiction</h2>
            <p>Factual and informative literature based on real events, people, or ideas.</p>
            <p>Genres: Biography/Autobiography, Essay, Memoir, Self-Help, Science, History</p>
        </div>

       <div class="card" onclick="window.location.href='reference1.php';">
            <img src="https://m.media-amazon.com/images/I/71-SE2ld56L._AC_UF1000,1000_QL80_.jpg" alt="Fiction">
            <h2>Reference</h2>
            <p>Informational books providing facts, definitions, and data on various subjects.</p>
            <p>Genres: Dictionary, Encyclopedia, Atlas, Almanac</p>
        </div>

        <div class="card" onclick="window.location.href='poetry1.php';">
            <img src="http://www.tulsibooks.com/wp-content/uploads/2018/11/MARATHI.jpg" alt="Non-Fiction">
            <h2>Poetry</h2>
            <p>Expressive literary form using rhythmic and metaphorical language.</p>
            <p>Genres: Verse, Epic, Haiku</p>
        </div><div class="card" onclick="window.location.href='drama1.php';">
            <img src="https://www.bookganga.com/eBooks/Content/images/books/0f7da22ceb55469cb0c5d5ef0bd7e246.jpg" alt="Fiction">
            <h2>Drama</h2>
            <p>Written work designed for performance, often involving dialogue and stage directions.</p>
            <p>Genres: Play, Script</p>
        </div>

        <div class="card" onclick="window.location.href='childrens-literature1.php';">
            <img src="https://tmm.chicagodistributioncenter.com/IsbnImages/9780226473017.jpg" alt="Non-Fiction">
            <h2>Childrens Literature</h2>
            <p>Books tailored for young readers, encompassing picture books, chapter books, and young adult fiction.</p>
            <p>Genres: Picture Books, Chapter Book, Young Adult(YA)</p>
        </div>
		<div class="card" onclick="window.location.href='religious-spiritual1.php';">
            <img src="https://cdn.shopclues.com/images/detailed/3758/4BGAsItIsMarathi_1396371994.jpg" alt="Fiction">
            <h2>Religious-Spiritual</h2>
            <p>Texts exploring faith, beliefs, and spirituality, such as the Bible, Bhagwad Gita, or sacred scriptures.</p>
            <p>Genres: Bhagavad Gita, Bible, Quaran</p>
        </div>

        <div class="card" onclick="window.location.href='academic-textbook1.php';">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtkCsVJDFSPEsscJN1l_S2URExWPby0aJr7dCA8AST5ivEGAQeIOACvsnmuS-34ab5PAs&usqp=CAU" alt="Non-Fiction">
            <h2>Academic/Textbook</h2>
            <p>Educational materials designed for academic study, often used in formal courses.</p>
            <p>Genres: Textbook, Research Papers</p>
        </div>
		<div class="card" onclick="window.location.href='graphic-novels-comic1.php';">
            <img src="http://majorspoilers.com/wp-content/uploads/2012/12/SMBND_V1_TPB_cover.jpg.jpg.jpg" alt="Fiction">
            <h2>Graphic Novels and Comics</h2>
            <p>Narrative storytelling through a combination of images and text.</p>
            <p>Genres: Graphics Novels, Comic Book</p>
        </div>

        <div class="card" onclick="window.location.href='diy-and-hobby1.php';">
            <img src="http://www.francescaghidini.com/images/HB45_3880040k.jpg" alt="Non-Fiction">
            <h2>DIY and Hobby</h2>
            <p>Books guiding readers in do-it-yourself projects or hobbies, offering practical instructions and creative ideas.</p>
            <p>Genres: Crafting, Hobby Guides</p>
        </div>
    </div>
<br><br><br>
</body>
</html>
