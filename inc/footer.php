            <hr/>
            <?php if($paypal_button_id = getenv('PAYPAL_BUTTON_ID')): ?>
            <p>If you've found this service useful please consider buying me a beer :)</p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="<?php echo htmlentities($paypal_button_id); ?>">
            <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
            </form>
            <?php endif; ?>
            <p>If you'd like to fund further development or would like additional features added please <a href="mailto:n@enru.co.uk">get in touch</a></p>
      </div>
    </section>
    <footer id="sitemeta">
      <hr/>
      <div class="clearfix">
         <div class="thefooter">
            <p>Created by <a href="http://enru.co.uk">Enru Technology</a></p>
         </div>
      </div>
    </footer>
  </body>
</html>

