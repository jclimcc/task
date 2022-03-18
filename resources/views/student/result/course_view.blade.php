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
        <div class="col-6">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"> Student Name: </label>
                <div class="col-sm-10">
                  <input type="text" name="sname" value="{{ $studentinfo[0]->name}}" disabled class="form-control" >
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"> Average Result:</label>
                <div class="col-sm-10">
                  <input type="text" disabled value="{{ $average}}" name="average" disabled class="form-control" >
                </div>
              </div>
        </div>
     </div> 
        <div class="row">
          <div class="col-md-6">
            <a href="{{ route('result.course_add',$studentinfo[0]->ref)}}" class="btn btn-primary">Add</a>

            <table class="table table-striped">
                <thead class="table-primary ">
                    <tr>
                        <td>Course</td>
                        <td>Mark</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                  
                    @foreach ($studentinfo[0]->my_course as $course)                   
                   
                    <tr>
                        <td>{{ $course->course_name}}</td>
                        <td>{{ $course->mark}}</td>                      
                        <td>
                            <a href="{{ route('result.course_edit',['id' => $studentinfo[0]->ref, 'course' => $course->id]) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('result.course_delete',['id' => $studentinfo[0]->ref, 'course' => $course->id]) }}" id="delete" class="btn btn-primary">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


          </div>
         
        </div>
      </div>


    
</section>
@endsection


@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
 $(function(){
   $(document).on('click','#delete',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
          
          Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href=link;
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      });

   });
 });
</script>
@endSection