@extends('main')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/date-picker.css') !!}

@endsection

@section('content')
	    <div class="row">	
	    
	    	<div class="col-md-6">
	    	<h1>Edit Record</h1>

	    		{!! Form::model($post, ['route' => ['posts.update', $post->id ], 'method'=> 'PUT']) !!}

			    <div class="row">
				  <div class="form-group col-xs-5 col-lg-7">

				    {{ Form::label('pat_uname', "Username:") }}
				    {{ Form:: text('pat_uname', $post->pat_uname, ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])}}

				  </div>
			    </div>

			    <div class="row">
				  <div class="form-group col-xs-5 col-lg-7 ">

				    {{ Form::label('pat_pass', "Password:") }}
				    {{ Form::text('pat_pass', $post->pat_pass, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

				  </div>
			    </div>

			     <div class="row">
				  <div class="form-group col-xs-5 col-lg-7">

				    {{ Form::label('pat_fname', "First Name:") }}
				    {{ Form::text('pat_fname', $post->pat_fname, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

				  </div>
			    </div>

			     <div class="row">
				  <div class="form-group col-xs-5 col-lg-7">

				    {{ Form::label('pat_lname', "Last Name:") }}
				    {{ Form::text('pat_lname', $post->pat_lname, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

				  </div>
			    </div>

			     <div class="row">
				  <div class="form-group col-xs-5 col-lg-7">

				    <label for="pat_bdate">Date Of Birth</label>
				    {{ Form::date('pat_bdate', $post->pat_bdate, ['class' => 'form-control', 'required' => '', 'maxlength' => '255','id' => 'dateofbirth']) }}

				  </div>
			    </div>
			    	{{ Form::submit('Save Changes', ['class' => 'btn btn-success']) }}
			    	<a href="{{ route('posts.index') }}"> Cancel</a>

			{!! Form::close() !!}

	    	</div>
	    </div>
@endsection


@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@endsection