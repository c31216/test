

@extends('main')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('dist/datepicker.css') !!}



@endsection

@section('content')
<style>
	.empty{
		color: #B94A48;
		background-color: #F2DEDE;
		border: 1px solid #EED3D7;
	}
	.custom_success{
		color: #468847;
		background-color: #DFF0D8;
		border: 1px solid #D6E9C6;
	}
</style>
<div class="container">
	<h1 class="title-page">{{$posts->pat_lname.', '.$posts->pat_fname}}</h1>
	<!-- Trigger the modal with a button -->
	<br>

	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#add">Add</button>
	
	<div id="add" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add</h4>
	      </div>
	      <div class="modal-body">
	        {!! Form::open(['route' => 'immunization.store','data-parsley-validate' => '']) !!}

				<div class="row">
				  <div class="form-group col-xs-5 col-lg-6">

				    {{ Form::label('vaccination_received', "Date") }}
				    {{ Form::date('vaccination_received', null, ['class' => 'form-control', 'data-toggle'=> 'datepicker','required' => '', 'data-parsley-date','maxlength' => '10']) }}

				  </div>
			    </div>

			    <div class="row">
				  <div class="form-group col-xs-5 col-lg-6">

				    {{ Form::label('description', "Description") }}
				    {{ Form::text('description', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

				  </div>
			    </div>

			    <div class="row">
				  <div class="form-group col-xs-5 col-lg-3">

				    {{ Form::label('weight', "Weight") }}
				    {{ Form::number('weight', 0, ['class' => 'form-control', 'required' => '', 'maxlength' => '255','data-parsley-type' => 'number']) }}
				  </div>
				  <div class="form-group col-xs-5 col-lg-3">

				    {{ Form::label('height', "Height") }}
				    {{ Form::number('height', 0, ['class' => 'form-control', 'required' => '', 'maxlength' => '255','data-parsley-type' => 'number']) }}
				  </div>
			    </div>

			    <div class="row">
				  <div class="form-group col-xs-5 col-lg-6">

				    {{ Form::label('midwife', "Midwife's Name") }}
				    {{ Form::text('midwife', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
				    {{ Form::hidden('p_id', $posts->id) }}

				  </div>
			    </div>
			    

			    <div class="row" id="vaccines">
			    	<div class="form-group col-xs-5 col-lg-6">
			    		@if(!$tookvaccines->isEmpty())
			    			<label for="">Vaccine</label>
							<select class="form-control" id="a" name="vaccine_id">
		
							   	@foreach ($tookvaccines as $tookvaccine)
									<option value="{{ $tookvaccine->id }}">{{ $tookvaccine->name }}</option>
								@endforeach

								{{ Form::hidden('expected_vaccine', null) }}
							{{-- 	@if($tookvaccines)
								<option value="{{ $tookvaccines->id }}">{{ $tookvaccines->name }}</option>
								@else
								<option value="empty">All Vaccines Has Been Taken Already</option>
								@endif --}}
							</select>
							@else
								<p>This child has already taken all the vaccines.</p>
						@endif
					</div>
			    </div>
			    <ul class="parsley-errors-list filled">
			    	<li id="empty_msg"></li>
			    </ul>
			    <br>

			    {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
			{!! Form::close() !!}
			
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	
	  </div>
	</div>
      

<hr>
<div class="row">
    <div class="table-responsive">
        <table class="table table-hover">

	      <thead>
	        <tr>
	          <th>Check-Up Date</th>
	          <th>Doctor</th>
	          <th>Vaccine Taken</th>
	          <th>Description</th>
	          <th>Weight</th>
	          <th>Height</th>
	        </tr>
	      </thead>

	      <tbody>

			@foreach($immunizationstatuses as $immunizationstatus)

	          <tr>
	            <td><p>{{$immunizationstatus->vaccination_received}}</p></td>
	            <td><p>{{$immunizationstatus->midwife}}</p></td>
	            <td><p>{{$immunizationstatus->name}}</p></td>
	            <td><p>{{$immunizationstatus->description}}</p></td>
	            <td><p>{{$immunizationstatus->weight}}</p></td>
	            <td><p>{{$immunizationstatus->height}}</p></td>
	            {{-- <td><button type="button" class="btn btn-success" id="edit" data-id="{{$immunizationstatus->id}}" data-toggle="modal" data-target="#edit_{{$immunizationstatus->id}}">Edit</button></td>
 --}}
	           </tr>


	           <!-- Edit Modal -->
				<div id="edit_{{$immunizationstatus->id}}" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Edit</h4>
				      </div>
				      <div class="modal-body">
				        {!! Form::model($immunizationstatus, ['route' => ['immunization.update', $immunizationstatus->id ], 'method'=> 'PUT']) !!}

				        	<div class="row">
							  <div class="form-group col-xs-5 col-lg-6">

							    {{ Form::label('vaccination_received', "Vaccination Received") }}
							    {{ Form::date('vaccination_received', $immunizationstatus->vaccination_received, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

							  </div>
						    </div>

						    <div class="row">
							  <div class="form-group col-xs-5 col-lg-6">

							    {{ Form::label('midwife', "Midwife") }}
							    {{ Form::text('midwife', $immunizationstatus->midwife, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

							  </div>
						    </div>

						    <div class="row">
						    	<div class="form-group col-xs-5 col-lg-6">
						    		<label for="">Vaccine</label>
									<select class="form-control" name="vaccine_id">
									  	@foreach ($vaccines as $vaccine)
											<option value="{{ $vaccine->id }}">{{ $vaccine->name }}</option>
										@endforeach
									</select>
								</div>
						    </div>

						    <div class="row">
							  <div class="form-group col-xs-5 col-lg-6">

							    {{ Form::label('description', "Description") }}
							    {{ Form::text('description', $immunizationstatus->description, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

							  </div>
						    </div>

						    <div class="row">
							  <div class="form-group col-xs-5 col-lg-3">

							    {{ Form::label('weight', "Weight") }}
							    {{ Form::number('weight', $immunizationstatus->weight, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
							    {{ Form::hidden('p_id', $immunizationstatus->p_id) }}

							  </div>
							  <div class="form-group col-xs-5 col-lg-3">

							    {{ Form::label('height', "Height") }}
							    {{ Form::text('height', $immunizationstatus->height, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

							  </div>
						    </div>

							{{ Form::submit('Save Changes', ['class' => 'btn btn-success']) }}

						{!! Form::close() !!}
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>
				<!-- END Modal -->

			@endforeach

	      </tbody>
	    </table>
	</div>
  </div>
</div>	
@endsection


@section('scripts')
	<script>
	    var token = '{{ Session::token() }}';
	    var url = '{{ route('posts.search') }}';
	    var add = '{{ route('posts.store') }}'
	    var index = "{{route('posts.index')}}";
	    var csrf = '{{ csrf_field() }}';
	</script>
	{!! Html::script('js/parsley.min.js') !!}
    {!! Html::script('dist/datepicker.js') !!}
    {!! Html::script('js/checkup.js') !!}
    {!! Html::script('js/immunize.validation.js') !!}

@endsection
