<?

/*
---

An example of how to use the PHP kit
---
*/

	ini_set('display_errors', 'on');

	// include class
	include('./lib/Freeagent-PHP/Freeagent.php');
	
  $this_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/invoices.php";
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

	    echo '<p>here are your invoices:</p>';
	    
      $page=1;
      while(true) {
        $invoices = $client->get('invoices', array('view'=>'all', 'page'=> $page));

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
