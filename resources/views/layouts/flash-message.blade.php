
        	@if ($message = Session::get('success'))
        		<div class="d-flex justify-content-center mt-3">
						<div class="alert alert-success alert-block col-md-4">
							<button type="button" class="close" data-dismiss="alert">×</button>	
						        <strong>{{ $message }}</strong>
						</div>
        		</div>
			@endif
			
			@if ($message = Session::get('error'))
        		<div class="d-flex justify-content-center mt-3">
						<div class="alert alert-danger alert-block col-md-4">
							<button type="button" class="close" data-dismiss="alert">×</button>	
						        <strong>{{ $message }}</strong>
						</div>
        		</div>
			@endif
			
			@if ($message = Session::get('warning'))
        		<div class="d-flex justify-content-center mt-3">
						<div class="alert alert-warning alert-block col-md-4">
							<button type="button" class="close" data-dismiss="alert">×</button>	
						        <strong>{{ $message }}</strong>
						</div>
        		</div>
			@endif
			
			@if ($message = Session::get('info'))
        		<div class="d-flex justify-content-center mt-3">
						<div class="alert alert-info alert-block col-md-4">
							<button type="button" class="close" data-dismiss="alert">×</button>	
						        <strong>{{ $message }}</strong>
						</div>
        		</div>
			@endif

			@if ($errors->any())
				<div class="d-flex justify-content-center mt-3">
					    <div class="alert alert-danger col-md-4" align="center">
					    	@foreach ($errors->all() as $error)
						         <div>{{$error}}</div>
						     @endforeach
							<button type="button" class="close" data-dismiss="alert">×</button>	
								Please check the form below for errors		
					    </div>
				</div>
			@endif
        </div>
    </div>
</div>
