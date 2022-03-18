@extends('template.main_template')

@section('content')
<section>
    <div class="container">
     
      <div class="row">
        <div class="col-12">
       @if ($errors->any())
       <div class="alert alert-danger">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
       @endif
     </div>
   </div> 
        <div class="row">
          <div class="col-md-6">
      
            <form method="POST" action="{{ route('student_store')}}">
                @csrf

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"> Student ID</label>
                    <div class="col-sm-10">
                      <input type="text" name="ref" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"> Student Name</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control"  >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"> Student Gender</label>
                    <div class="col-sm-10">
                    <div class=" form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineCheckbox1" value="1">
                        <label class="form-check-label" for="inlineCheckbox1">Male</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender"   id="inlineCheckbox2" value="0">
                        <label class="form-check-label" for="inlineCheckbox2">Female</label>
                      </div> 
                    </div>                 
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"> Student IC</label>
                    <div class="col-sm-10">
                      <input type="text" name="nric" class="form-control" >
                    </div>
                  </div>


                 

                  <div class="form-group row text-center">
               
                    <div class="row justify-content-center">

                        <input class="btn btn-primary" type="submit" value="Submit" style="width:150px;margin-right: 10px;">
                        <input class="btn btn-primary" type="button"  onclick="history.back()" value="Cancel" style="width:150px">
                   
                  </div>
            </form>


          </div>
         
        </div>
      </div>


    
</section>
@endsection

