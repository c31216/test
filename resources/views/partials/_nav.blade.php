
<nav class="navbar navbar-default">
		<div class="container-fluid custom-container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">

	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>

	      </button>
	    </div>
	    <div class="collapse navbar-collapse custom-collapse" id="bs-example-navbar-collapse-1">
		    <ul class="nav navbar-nav">

		      	<li class="logo-container">
		      		<div class="col-xs-4">
		      			<img src="/img/vaccine-logo-whiteborder.png">
		      		</div>
		      		<div class="col-xs-8">
			      		<p class="title"><span>Baby Vaccine Tracker</span><br>your baby's health companion</p>
					</div>
		      	</li>

		        <li>
		        	<a href="{{ route('posts.index') }}">
		        		<div class="row nav-icon">
			        		<img src="/img/document-icon.png">
			        	</div>
			        	<div class="row">
		        			View all records
		        		</div>
		        	</a>
		        </li>

		    </ul>

		    <div class="col-md-3 active-user">
		     	<img src="/img/user-icon.png">
		     	<h1>Welcome,  {{ Auth::user()->name }}
		     	<a href="{{ url('/logout') }}" 
		     	onclick="event.preventDefault();
		     	document.getElementById('logout-form').submit();">
                Logout
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
		     	</h1>
		    </div>
	    </div>
  	</div><!--end of container-fluid-->
</nav>