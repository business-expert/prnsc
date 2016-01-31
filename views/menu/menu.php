<a class="brand" style="display:none;" href="#">Project name</a>
          <div class="nav-collapse collapse" id="sTabs">
            <ul class="nav">
              <li class="active"><a id="mainMenu_rules" href="#rules">RULES</a></li>
              <li><a id="mainMenu_picks" href="#picks">MY PICKS</a></li>
              <li><a id="mainMenu_feed" href="#feed">LIVE FEED</a></li>
              <li><a id="mainMenu_standing" href="#standing">STANDING</a></li>
              <li><a id="mainMenu_shop" href="#shop">SHOP</a></li>
              <li><a id="mainMenu_news" href="#news">NEWS</a></li>
              <li><a id="mainMenu_nsc" href="#nsc">NSC TV</a></li>
			  <!-- Condition to check visited user is athletic and give his/her account management functionality -->
			  <?php if($DB->totRecord("SELECT facebook_id FROM athlete WHERE athlete.facebook_id='".$FBPanel->panelGetUser()."'") > 0) { ?>
			   <li><a id="mainMenu_account" href="#account">ACCOUNT</a></li>
			  <?php } ?>		
			  
              <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>-->
            </ul>
            <form class="navbar-form pull-right" style="display:none;">
              <input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">
              <button type="submit" class="btn">Sign in</button>
            </form>
          </div><!--/.nav-collapse -->
		  
		  
		  

 

		  