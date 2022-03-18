@extends('template.main_template')

@section('content')
{{-- <style>
    .btn{
        color: #fff!important;
    background-color: #4472C4!important;    
    border: 1px solid #000!important;
    border: none;
    display: inline-block;
    padding: 8px 16px;
    vertical-align: middle;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    background-color: inherit;
    text-align: center;
    cursor: pointer;
    white-space: nowrap;
    }
   
    .header
    {
        align-content: center;
    }
    .table
    {
        border:1px solid#fff! important;
    }
    .thead
    {
        color: #fff!important;    
        background-color: #4472C4!important; 

    }
    .thead td{
        padding:20px
    }
</style> --}}
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
          <div class="col-md-12">
            <a href="{{ route('student_add')}}" class="btn btn-primary">Add Student</a>

            <table class="table table-striped">
                <thead class="table-primary ">
                    <tr>
                        <td>Student ID</td>
                        <td>Student Name</td>
                        <td>Student Gender</td>
                        <td>IC</td>
                        <td>Average</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Students as $student)                   
                        @php
                        $totalmark=0;
                        $average=0;
                        if(sizeof($student->my_course)>=1)
                        {
                            foreach($student->my_course as $key => $course )
                            {
                                $totalmark=$course->mark+$totalmark; 
                            }
                            $average=( $totalmark/(sizeof($student->my_course)*100) ) * 100;   
                        }
                      @endphp
                    <tr>
                        <td>{{ $student->ref}}</td>
                        <td>{{ $student->name}}</td>
                        <td>{{ ($student->gender==1 ?"MALE":"FEMALE") }}</td>
                        <td>{{ $student->nric}}</td>
                        <td>{{ $average}}</td>
                        <td>
                            <a href="{{ route('student_edit',$student->ref) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('student_delete',$student->ref) }}" id="delete" class="btn btn-primary">Delete</a>
                            <a href="{{ route('result.course_view',$student->ref) }}" class="btn btn-primary">Result</a>
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