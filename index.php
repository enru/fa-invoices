<?php include 'inc/header.php'; ?>
    <p>This tool will provide you with a list of all your FreeAgent invoices with links to download them all individually.</p>
    <form action="/invoices.php" method="get">
    <div id="adv">
      <select name="view" onchange="var display = (this.selectedIndex == 7) ? 'block' : 'none';  document.getElementById('n').style.display=display">
        <option value="all" selected="selected">Show all invoices (default)</option>
        <option value="recent_open_or_overdue">Show only recent, open, or overdue invoices.</option>
        <option value="open_or_overdue">Show only open or overdue invoices.</option>
        <option value="draft">Show only draft invoices.</option>
        <option value="scheduled_to_email">Show only invoices scheduled to email.</option>
        <option value="thank_you_emails">Show only invoices with active thank you emails.</option>
        <option value="reminder_emails">Show only invoices with active reminders.</option>
        <option value="last_N_months">Show only invoices from the last N months.</option>
      </select>
      <div id="n" style="display:none">
        <label for="last_n_months">How many months worth of invoices:</label>
        <input type="text" name="last_n_months" value="" id="last_n_months"/>
      </div>
    </div>
    <input type="submit" class="redbutton" value="Get your FreeAgent invoices"/>
    </form>
    <p> When you click the above link you will be prompted to log in and approve the &quot;Invoice Downloader&quot; app to acccess your FreeAgent account. All access is performed using FreeAgent's API.</p>
    <p> Once approved the FreeAgent will return you to this site where you will see a list of all your invoices and links to their PDFs. </p>
    <hr/>
    <p><strong>For the wary:</strong> there are no dragons here. This tool just uses the FreeAgent API to get a list of your invoices then lists them with links for you to download. The source for the site is <a href="https://github.com/enru/fa-invoices">here</a> on <a href="https://github.com/enru/fa-invoices">github</a> if you don't believe me ;)</p>
<?php include 'inc/footer.php'; ?>
