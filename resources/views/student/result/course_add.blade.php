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
      
            <form method="POST" action="{{ route('result.course_store', $studentinfo[0]->ref)}}">
                @csrf

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"> Student Name:</label>
                    <div class="col-sm-10">
                      <input type="hidden" name="student_id"  value="{{ $studentinfo[0]->id}}" class="form-control" >
                   
                      <input type="text" name="name" disabled value="{{ $studentinfo[0]->name}}" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"> Course :</label>
                    <div class="col-sm-10">
                      <input type="text" name="course" class="form-control"  >
                    </div>
                  </div>
                
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"> Mark :</label>
                    <div class="col-sm-10">
                      <input type="number" name="mark" class="form-control"  min="0" max="100" >
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

