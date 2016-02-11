<?php
	ini_set('display_errors', 'on');

/*
---

An example of how to use the PHP kit
---
*/
$views = array(
  'all', //: Show all invoices (default)
  'recent_open_or_overdue', //: Show only recent, open, or overdue invoices.
  'open_or_overdue', //: Show only open or overdue invoices.
  'draft', //: Show only draft invoices.
  'scheduled_to_email', //: Show only invoices scheduled to email.
  'thank_you_emails', //: Show only invoices with active thank you emails.
  'reminder_emails', //: Show only invoices with active reminders.
  'last_N_months', //: Show only invoices from the last N months.
);

$params = array(
  'sort' => '-created_at',
);

if(isset($_GET['view'])) {
  if(in_array($_GET['view'], $views)) {
    $params['view'] = $_GET['view'];
  }
  if(preg_match('/^last_([0-9]+)_months$/', $_GET['view'])) {
    $params['view'] = $_GET['view'];
  }
  if($params['view'] == 'last_N_months') { 
    if(isset($_GET['last_n_months']) && $_GET['last_n_months']) {
      $params['view'] = 'last_'.intval($_GET['last_n_months']).'_months';
    }
  }
}


	// include class
	include('./lib/thoughtco/Freeagent-PHP/Freeagent.php');
	
  $this_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/invoices.php?";
  $this_url .= http_build_query($params);

	// enter your app's config details here
  $app = array(
    'id' => getenv('FREEAGENT_APP_ID'),
    'secret' => getenv('FREEAGENT_APP_SECRET'),
  );
	$sandbox=false;
	$client = new Freeagent($app['id'], $app['secret'], $sandbox);
	
	// no OAuth code set
	if (!isset($_GET['code'])){
	
		// get the authorisation url we need to pass customer to, passing the url you want them returned to (This url)
		$authoriseURL = $client->getAuthoriseURL($this_url);
		
		header('Location: '.$authoriseURL);
		exit();
	
	
	// we have a code
	} else {
	
		// now exchange the code for an access token - you should save this for future usage
		$accessToken = $client->getAccessToken($_GET['code'], $this_url);
	
		// set authentication token
		$client->setAccessToken($accessToken->access_token);

	    $company = $client->get('company');
      $company_url = sprintf('https://%s.freeagent.com', $company->company->subdomain);
      if($sandbox) $company_url = sprintf('https://%s.sandbox.freeagent.com', $company->company->subdomain); 


    ?>
    <?php include 'inc/header.php'; ?>
    <?php

	    echo '<p>Here are your invoices:</p>';
	    
      $page=1;
      while(true) {
        $params['page'] = $page;

        $invoices = $client->get('invoices', $params);

        if(is_array($invoices->invoices) && count($invoices->invoices) > 0) {
          echo '<ul>';
          foreach($invoices->invoices as $inv) {
            $inv_ref = '';
            if(preg_match('/(\d+)$/', $inv->url, $matches)) {
              $inv_ref = $matches[1];
            }
            printf('<li><a href="%s/invoices/%s.pdf">%s - %s (%s)</a></li>', $company_url, $inv_ref, $inv->reference, $inv->dated_on, $inv->status); 
          }
          echo '</ul>';
          $page += 1;
        }
        else {
          break;
        }
      }
    
	}
	    
?>
<?php include 'inc/footer.php'; ?>
