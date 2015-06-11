<?php include 'inc/header.php'; ?>
    <p>This tool will provide you with a list of all your FreeAgent invoices with links to download them all individually.</p>
    <p> <a class="redbutton" title="Get your FreeAgent invoices" href="/invoices.php">Get your FreeAgent invoices</a> </p>
    <p> When you click the above link you will be prompted to log in and approve the &quot;Invoice Downloader&quot; app to acccess your FreeAgent account. All access is performed using FreeAgent's API.</p>
    <p> Once approved the FreeAgent will return you to this site where you will see a list of all your invoices and links to their PDFs. </p>
    <hr/>
    <p><strong>For the wary:</strong> there are no dragons here. This tool just uses the FreeAgent API to get a list of your invoices then lists them with links for you to download. The source for the site is <a href="https://github.com/enru/fa-invoices">here</a> on <a href="https://github.com/enru/fa-invoices">github</a> if you don't believe me ;)</p>
<?php include 'inc/footer.php'; ?>
