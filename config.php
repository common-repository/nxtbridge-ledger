<?php

// frontend
add_action('wp_enqueue_scripts',  'nxtbridge_ledger_styles');
add_action('wp_enqueue_scripts',  'nxtbridge_ledger_scripts');
add_action('wp_footer',           'nxtbridge_ledger_footer');

function nxtbridge_ledger_scripts() {
  global $app_version; 
  // PRODACTION STAGE

  wp_register_script('nxtbridge-min', plugins_url('nxtbridge.min.js', __FILE__), array('jquery'), $app_version, true); // in footer
  wp_enqueue_script('nxtbridge-min');


  // for test purpose only. For prodaction use nxtbridge.min.js
  /*
  wp_register_script('nxtbridge-ledger', plugins_url('js/nxtbridge.js', __FILE__), array('jquery'), $app_version, true); // in footer
  wp_enqueue_script('nxtbridge-ledger');

  wp_register_script('bootstrap-modal', plugins_url('js/modal.js', __FILE__), array('jquery'), $app_version, true); // in footer
  wp_enqueue_script('bootstrap-modal');

  wp_register_script('bootstrap-dropdown', plugins_url('js/dropdown.js', __FILE__), array('jquery'), $app_version, true); 
  wp_enqueue_script('bootstrap-dropdown');

  wp_register_script('clipboard', plugins_url('js/clipboard.min.js', __FILE__), array('jquery'), $app_version, true); 
  wp_enqueue_script('clipboard');
  */

}


function nxtbridge_ledger_styles() {
  global $app_version; 

  wp_register_style('nxtbridge-bootstrap', plugins_url('css/nxtbridge-bootstrap.min.css', __FILE__), '', $app_version, 'all');
  wp_enqueue_style('nxtbridge-bootstrap');

  wp_register_style('awesome', plugins_url('css/font-awesome.min.css', __FILE__), '', $app_version, 'all');
  wp_enqueue_style('awesome');

  wp_register_style('nxtbridge-ledger', plugins_url('css/style.min.css', __FILE__), '', $app_version, 'all');
  wp_enqueue_style('nxtbridge-ledger');

}

function nxtbridge_ledger_footer() {
  global $api;
?>
  <input type='hidden' id='ajax-url' value="<?php echo admin_url('admin-ajax.php'); ?>" />
  <!-- modal -->
	<div class="nb modal fade" id="nxtbridgeLedgerModal" tabindex="-1" role="dialog" data-modal-overflow="true" style="display:none; ">
		<div class="nb modal-dialog" role="document" id="nxtbridgeLedger" style="z-index: 1000;min-width: 800px;">
			<div class="nb modal-content">
				<div class="nb modal-header">
					<button type="button" class="nb close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span class="nb modal-title">NXTBridge Ledger</span>
				</div>
				<div class="nb modal-body" id="nxtbridgeLedgerBody">
					<p>Select an action, please.</p>
				</div>
				
				<div class="nb modal-footer">
				
				  <div class="nb row">
				  
					<div class="nb col-xs-12 col-sm-12 col-md-6">
					  <div class="nb input-group">
						<span class="nb input-group-addon" id="nbxtridge-address">Your Nxt Address</span>
            <?php 
              $my_acc = isset($_COOKIE['NXTBridgeLedger']) ?  $_COOKIE['NXTBridgeLedger'] : '';
            ?>
						<input type="text" class="nb form-control" placeholder="NXT-..." aria-describedby="nxtbridge-address" id="nxtbridgeLedgerAddress" value="<?php echo $my_acc;  ?>">
						<span class="nb input-group-btn"><button class="nb btn btn-default" type="button" id="nxtbridgeSaveAddress">Save</button></span>
					  </div>
					</div>
					
					<div class="nb col-xs-12 col-sm-12 col-md-6">
					  <div class="nb btn-group">
						<button type="button" class="nb btn btn-warning" id="nxtbridgeSendButton"><i class="fa fa-money" aria-hidden="true"></i> Send NXT</button> 
						<button type="button" class="nb btn btn-warning" id="nxtbridgeBroadcastButton"><i class="fa fa-paper-plane" aria-hidden="true"></i> Broadcast</button>
						<button type="button" class="nb btn btn-warning" id="nxtbridgeLedgerButton"><i class="fa fa-list" aria-hidden="true"></i> Transactions</button> 
					  </div>

					  <div class="nb btn-group">
						<div class="dropup">
						  <button type="button" class="nb btn btn-primary"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-bullhorn" aria-hidden="true"></i> News<span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu">
							<li><a href="https://www.nxter.org/" target=_blank>News</a></li>
							<li><a href="https://www.nxter.org/assethub/" target=_blank>Assethub</a></li>
							<li><a href="https://www.nxter.org/nxtbridge/" target=_blank>NXTBridge</a></li>
						  </ul>
						</div>
					  </div>

					  <!-- 

					  <div class="nb btn-group">
						<div class="dropup">
						  <button type="button" class="nb btn btn-info"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-google-wallet" aria-hidden="true"></i> Fund Account<span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu">
							<li><a href="https://changelly.com/developers" target=_blank>DEPOSIT</a></li>
							<li><a href="https://bitbucket.org/scor2k/nxtbridge-offline/downloads/index.min.html" target=_blank>New Account</a></li>
						  </ul>
						</div>
					  </div>

					  -->

					</div> <!-- /div col-xs-12 col-sm-7 -->
					
				  </div> <!-- /div row -->

				</div> <!-- /div modal-footer -->
				
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->  

  <!-- button -->
  <a href="" class="nb btn btn-default nxtbridge-icon" id="nxtbridge-open-ledger" aria-label="NXTBridge">
    <img src="<?php echo plugins_url('nxtbridge-ledger/img/nxt-icon-64x64.png'); ?>" />
  </a>

<?php
}
?>
