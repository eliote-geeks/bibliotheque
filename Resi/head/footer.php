  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Recents sujets</h4>
            <?php $recent_topic = $bdd->query("SELECT * FROM f_cathegories ORDER BY id DESC"); ?>
            <ul>
            <?php while($rt = $recent_topic->fetch()){  ?>
              <li><i class="bx bx-chevron-right"></i> <a href="liste.php?categorie=<?=url_custom_encode($rt['nom']);?>"><?= $rt['nom']?></a></li>
          <?php } ?>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>FATHE.</h3>
            <p>
              Ekoumdoum <br>
              Yaounde, Yde 535022<br>
              Cameroun <br><br>
              <strong>Phone:</strong> +237 659 271 025<br>
              <strong>Email:</strong>mashashie@yahoo.com<br>
            </p>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Dreniers topics </h4>
            <?php $recent_message = $bdd->query("SELECT * FROM f_topics ORDER BY id DESC LIMIT 0,2"); ?>
             <?php while($rm = $recent_message->fetch()){  ?>
            <p><?= $rm['contenu']?></p>
        <?php } ?>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>FATHE.</span></strong>. All Rights Reserved
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/sequence.jquery.js"></script>
  <script src="js/jquery-hover-effect.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>
</body>
</html>