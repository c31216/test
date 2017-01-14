@extends('main')

@section('stylesheets')

  {!! Html::style('css/parsley.css') !!}
  {!! Html::style('dist/datepicker.css') !!}

@endsection

@section('content')

    {{ Form::label('search', "Search: ") }}
    {{ Form:: text('search', null, ['id'=>'search'])}}
    <span id="found"></span>
   
    <hr>
        <h3>Records <a href="#" id="add-record"><img class="add-record-button" src="/img/add_record.png"></a></h3>
        <p>Sort by:</p>
        <form action="">
          <input type="radio" value="pat_lname" name="sort"> Last name
          <input type="radio" value="pat_fname" name="sort"> First name
          <input type="radio" value="registration_date" name="sort"> Date of Registration
          <input type="radio" value="pat_bdate" name="sort"> Date of Birth
        </form>      
        <br>

    <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select
      <span class="caret"></span></button>
      <ul class="dropdown-menu">
        @foreach($vaccines as $vaccine)
          <li><a href="#">{{$vaccine->name}}</a></li>
        @endforeach
        
      </ul>
    </div>

    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Date of registration</th>
            <th>Date of birth</th>
            <th>Last name</th>
            <th>First name</th> 
            <th>Weight lb(s)</th>
            <th>Height in</th>
            <th>Age</th>
            <th>Sex</th>
            <th>Name of mother</th>
            <th>Address</th>  
            <th id="hidden">Username</th>
            <th id="hidden">Password</th>  
          

          </tr>
        </thead>
          
          
        <tbody id="p_list">
          @foreach($posts as $post)
            <tr>
              <td class="date registration_date" id="{{$post->id}}">{{$post->registration_date}}</td>
              <td class="date pat_bdate" id="{{$post->id}}">{{$post->pat_bdate}}</td>
              <td class="edit pat_lname" id="{{$post->id}}">{{$post->pat_lname}}</td>
              <td class="edit pat_fname" id="{{$post->id}}">{{$post->pat_fname}}</td>
              <td class="edit weight" id="{{$post->id}}">{{$post->weight}}</td>
              <td class="edit height" id="{{$post->id}}">{{$post->height}}</td>
              <td class="edit age" id="{{$post->id}}">{{$post->age}}</td>
              <td class="sex" id="{{$post->id}}">{{$post->sex}}</td>
              <td class="edit mother_name" id="{{$post->id}}">{{$post->mother_name}}</td>
              <td class="edit address" id="{{$post->id}}">{{$post->address}}</td>
              {{-- <td><input type="hidden" name="_method" value="PUT" /></td> --}}

              <td>
                <a href="{{ route('posts.show', $post->id) }}">
                    <p>View Profile</p>
                </a>
              </td>

              <td>
                <a href="{{ route('checkup.show', $post->id) }}">
                    <p>Check Up</p>
                </a>
              </td>

              <td>
                <a href="{{ route('immunization.show', $post->id) }}">
                    <p>Immunize</p>
                </a>
              </td>
              <td>
                <a href="{{ route('posts.pdf', $post->id) }}" target="_blank" >
                    <p>Download PDF</p>
                </a>
              </td>

            </tr>
          @endforeach
        </tbody>
        <tbody id="search">
          
        </tbody>
      </table>
    </div>


    <div class="text-center">
      {!! $posts->links(); !!}
    </div>

  <script type="text/javascript">  
    var token = '{{ Session::token() }}';
    var url = '{{ route('posts.search') }}';
    var edit_submit = 'posts/update';
    var add = '{{ route('posts.store') }}';
    var index = "{{route('posts.index')}}";
    var csrf = '{{ csrf_field() }}';
  </script>


  @section('scripts')
    {!! Html::script('js/search.js') !!}
    {!! Html::script('js/addrecord.js') !!}
    {!! Html::script('js/inlineeditor.js') !!} 
    {!! Html::script('dist/datepicker.js') !!}
    {!! Html::script('js/jquery.jeditable.datepicker.js') !!}
    {!! Html::script('js/custom_inlineeditor.js') !!}
    

  @endsection

@endsection