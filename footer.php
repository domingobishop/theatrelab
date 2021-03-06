</main>
<footer id="footer" class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center footer-info">
                <h4>Theatre Lab Company</h4>
                <p>
                    <a href="https://www.facebook.com/Theatre-Lab-Company-167759046592031/" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/facebook.png"></a>
                    <a href="https://twitter.com/theatrelabuk" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/twitter.png"></a>
                </p>
                <p>
                    Registered UK Charity, No. 1102544 and a registered UK Company, No. 3473003. <br>
                    For donations, please get in touch for details.
                </p>
                <div class="col-md-6">
                    <p>
                        Anastasia Revi <br>
                        <strong>Director</strong><br>
                        <a href="mailto:a.revi@hotmail.com">a.revi@hotmail.com</a>
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        Martina Reynolds <br>
                        <strong>Producer</strong><br>
                        <a href="mailto:martina@theatrelab.co.uk">martina@theatrelab.co.uk</a>
                    </p>
                </div>
                <p>
                    <small>Copyright © <?php echo date("Y"); ?> <br>
                        Website by <a href="http://chrisbishop.me.uk/" target="_blank">Chris Bishop</a></small>
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- #foot -->

<?php wp_footer(); ?>

<script type="text/javascript">
    $( document ).ready(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    });
</script>

</body>
</html>