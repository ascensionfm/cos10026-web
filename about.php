<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Next_Gen Corporation</title>
  <link rel="icon" href="./images/logo1.ico">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/style-about.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <?php require("header.inc"); ?>
  <main>
    <div class="hero">
      <img alt="Background image" src="images/bgrab.jpg">
      <div class="content">
        <h1>A Future of Innovators & Achievers.</h1>
        <p>Next-Gen Corp was established with a singular vision: to transform the way people connect with opportunities.
          In a world where the job market evolves rapidly, we strive to bridge the gap between talent and employers,
          creating meaningful connections that propel careers and businesses forward.</p>
        <p>At Next-Gen Corp, we are more than just a platform. We are a community of innovators and achievers who
          believe that every career journey deserves a personal touch. We don't simply provide job listings - we craft
          tailored strategies for job seekers and employers alike, leveraging data-driven insights and cutting-edge
          technology to create meaningful connections. Our services extend across industries and are designed for the
          modern professional. Whether it's online tools, personalized career consultations, or insights into future
          trends, we ensure that your next step is a confident one.</p>
        <p>Next-Gen Corp is where ambition meets opportunity. Together, we redefine success.</p><a
          href="index.php">Learn more about what we do</a>
      </div>
    </div>
    <div class="section">
      <h2>DLT2 (GROUP ID: 4)</h2>
      <div class="cards">
        <div class="card">
          <a href = "#Huyen"><img alt="H" src="images/H.jpg"></a>
          <h3>Nguyen Khanh Huyen</h3>
          <p>Main Front-end, Back-end dev</p>
          <p>Creating the user interface and enhancing their experience.</p>
        </div>
        <div class="card">
          <a href = "#Doanh"><img alt="D" src="images/D.jpg"></a>
          <h3>Nguyen Xuan Doanh</h3>
          <p>Leader, QA tester</p>
          <p>Do minor adjustment on all files to ensure quality</p>
        </div>
        <div class="card">
          <a href = "#VuongVuong"><img alt="V" src="images/V.jpg"></a>
          <h3>Nguyen Quy Vuong</h3>
          <p>Back-end dev</p>
          <p>Handles logic, manages databases and ensures data flow to the frontend.</p>
        </div>
      </div>
    </div>
    <section class="tutor-section">
      <div class="tutor-container">
        <div class="tutor-role">
          Project Tutor
        </div>
        <h2 class="tutor-title">Mr. Vu Ngoc Binh</h2>
      </div>
    </section>
    <div class="about-timeline">
      <div class="timeline-item">
        <h3>Week 1:</h3>
        <p>First meeting, laid out plans and tasks assign. We spent the week to learn Github as well as foreground
          knowledge to make the website.</p>
      </div>
      <div class="timeline-item">
        <h3>Week 2 - 4:</h3>
        <p>Working on HTML and Basic CSS. By the end of Week 4, the Website was fully functionable and looked nicely.
        </p>
      </div>
      <div class="timeline-item">
        <h3>Week 5-6:</h3>
        <p>We spent 2 weeks to refine the website, working on responsive design, fix some bugs and make the website look
          cleaner.</p>
      </div>
    </div>

    <section id="Huyen" class="personal-section">
			<h2>Personal Information</h2>
			<dl>
				<dt>Name:</dt>
				<dd>Khanh Huyen</dd>
				<dt>Student ID:</dt>
				<dd>104988508</dd>
				<dt>Course:</dt>
				<dd><a href="https://swinburne.instructure.com/courses/48290" target="_blank">COS10026</a></dd>
				<dt>Email:</dt>
				<dd><a href="mailto:104988508@student.swin.edu.au" target="_blank">104988508@student.swin.edu.au</a></dd>
			</dl>

			<h2>Favorite Things</h2>

			<h3>Books</h3>
			<ul class="Favorite">
				<li>Little Princess by Antoine De Saint-Exupéry</li>
				<li>Old Path, White Clouds by zen master Thich Nhat Hanh</li>
				<li>Sherlock Holmes by Conan Doyle</li>
			</ul>

			<h3>Music</h3>
			<ul class="Favorite">
				<li>Like my father by Jax</li>
				<li>Đi theo bóng mặt trời by Đen Vâu</li>
				<li>nhạc Trịnh không lời</li>
			</ul>

			<h3>Films</h3>
			<ul class="Favorite">
				<li>Avengers: Endgame</li>
				<li>Conan series</li>
				<li>Spiderman 4: No Way Home</li>
			</ul>

      <h2>Contribution</h2>
      <p>The prototype and last modified UI of index page, jobs page, about page, apply page, contact page, enhancements page, login/signup page</p>
		</section>

    <section id="Doanh" class="personal-section">
			<h2>Personal Information</h2>
			<dl>
				<dt>Name:</dt>
				<dd>Xuan Doanh</dd>
				<dt>Student ID:</dt>
				<dd>105505827</dd>
				<dt>Course:</dt>
				<dd><a href="https://swinburne.instructure.com/courses/48290" target="_blank">COS10026</a></dd>
				<dt>Email:</dt>
				<dd><a href="mailto:105505827@student.swin.edu.au" target="_blank">105505827@student.swin.edu.au</a></dd>
			</dl>

			<h2>Favorite Things</h2>

      <h3>Books</h3>
			<ul class="Favorite">
				<li>Garden of words</li>
				<li>Ink and Stars</li>
				<li>Sherlock Holmes</li>
			</ul>

			<h3>Music</h3>
			<ul class="Favorite">
				<li>Cậu Bé by Thịnh Suy</li>
				<li>Ticking Away by VALORANT</li>
				<li>blue by yung kai</li>
			</ul>

			<h3>Films</h3>
			<ul class="Favorite">
				<li>Breaking Bad</li>
				<li>Garden of Words</li>
				<li>Frieren: Beyond the journey end</li>
			</ul>

      <h2>Contribution</h2>
      <p> Make the timeline of about page, reformat code</p>

		</section>

    <section id="Vuong" class="personal-section">
			<h2>Personal Information</h2>
			<dl>
				<dt>Name:</dt>
				<dd>Quy Vuong</dd>
				<dt>Student ID:</dt>
				<dd>105551228</dd>
				<dt>Course:</dt>
				<dd><a href="https://swinburne.instructure.com/courses/48290" target="_blank">COS10026</a></dd>
				<dt>Email:</dt>
				<dd><a href="mailto:105551228@student.swin.edu.au" target="_blank">105551228@student.swin.edu.au</a></dd>
			</dl>

			<h2>Favorite Things</h2>

			<h3>Books</h3>
			<ul class="Favorite">
				<li>Sakamoto Days by Yuto Suzuki</li>
				<li>Frieren: Beyond Journey's End by Kanehito Yamada</li>
				<li>86 -Eighty Six- by Asato Asato</li>
			</ul>

			<h3>Music</h3>
			<ul class="Favorite">
				<li>A Left Foot Trapped in a Sensual Seduction - Hellsing OST</li>
				<li>4rtXIV - Nonaqua</li>
				<li>Flying Out Of The Sky - Camellia</li>
			</ul>

			<h3>Films</h3>
			<ul class="Favorite">
				<li>Full Metal Alchemist</li>
				<li>Kusuriya no Hitorigoto</li>
				<li>Mushishi</li>
			</ul>

      <h2>Contribution</h2>
      <p>give feedback, focus more on backend</p>
		</section>

  </main>
  <?php require("footer.inc"); ?>
</body>

</html>
