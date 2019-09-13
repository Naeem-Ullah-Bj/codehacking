@extends("layouts.admin")
@section('content')
    <div class="modal fade" id="inputmodal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    {!! Form::button('&times;',['class'=>'close','data-dismiss'=>'modal']) !!}
                    <h4 class="text-success" style="text-decoration: underline" id="modal-title">Add New Post !</h4>
                </div>

                <div class="modal-body">
                    {!! Form::open(['method'=>'Post','files'=>true,'id'=>'modal-form']) !!}

                    <div class="form-group">
                        {!! Form::label('title','Title:') !!}
                        {!! Form::text('title',null,['class'=>'form-control']) !!}

                        <div><strong class="text-danger error" id="idtitle"></strong></div>

                        {!! Form::label('category','Category:') !!}
                        {!! Form::select('category_id',array(''=>'Choose')+$cat,null,['class'=>'form-control category_id']) !!}

                        <div><strong class="text-danger error" id="idcategory"></strong></div>
                        <br>
                        <div>
                            <div id="image_id"></div>
                        </div>


                        {!! Form::label('photo','Photo:') !!}
                        {!! Form::file('photo_id',['id'=>'read','oninput'=>'readUrl(this);']) !!}

                        <div><strong class="text-danger error" id="idphoto"></strong></div>

                        {!! Form::label('body','Content:') !!}
                        {!! Form::textarea('body',null,['class'=>'form-control','rows'=>3]) !!}

                        <div><strong class="text-danger error" id="idbody"></strong></div>

                        {!! Form::hidden('id',null,['id'=>'id']) !!}
                        {!! Form::hidden('hidden',null,['id'=>'action']) !!}

                    </div>
                </div>

                <div class="modal-footer">
                    {!! Form::button('&nbsp;Cancel',['class'=>'btn btn-danger fa fa-times-circle','data-dismiss'=>'modal']) !!}
                    {!! Form::button('&nbsp;&nbsp;&nbsp;Post&nbsp;&nbsp;&nbsp;',['class'=>'btn btn-success fa fa-plus-square-o','type'=>'submit','value'=>'submit','name'=>'submit','id'=>'submit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="deletemodal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content col-sm-8 col-sm-offset-2">
                <div class="modal-header">
                    {!! Form::button('&times;',['class'=>'close','data-dismiss'=>'modal']) !!}
                    <h4 class="text-success" style="text-decoration: underline">Information !</h4>
                    <h5 class="text-primary">Are you sure you want to delete ?</h5>

                </div>

                <div class="modal-footer">
                    {!! Form::button('&nbsp;Cancel',['class'=>'btn btn-primary fa fa-times-circle','data-dismiss'=>'modal']) !!}
                    {!! Form::button('&nbsp;&nbsp;Delete',['class'=>'btn btn-danger fa fa-trash-o','type'=>'submit','value'=>'submit','name'=>'submit','id'=>'dsubmit']) !!}

                </div>
            </div>
        </div>
    </div>




    <script>
        var ne ='';
    </script>
    <script>
        function readUrl(input) {

            if (ne =='')
            {
                $('#image_id').html('');
            }
            else
            {
                $('#image_id').html(ne);
            }
            if (input.files && input.files[0])
            {

                $('#image_id').html('');
                var reader = new FileReader();


                reader.onload = function (event) {

                    $('#image_id').html('<img src="'+event.target.result+'" alt="" class="img-thumbnail" width="90px">');
                };
                reader.readAsDataURL(input.files[0]);
            }

        }
    </script>


    <div class="">
        {!! Form::button('',['class'=>'btn btn-success pull-right fa fa-plus-circle fa-2x','id'=>'createPost']) !!}
        <h3 class="text-center text-info" style="text-decoration: underline">Posts</h3>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-hover table-bordered" id="post-table">
            <thead class="text-primary" style="font-size: 15px">
                <tr>
                    <td>Id:</td>
                    <td>Owner:</td>
                    <td>Category:</td>
                    <td>Photo:</td>
                    <td>Title:</td>
                    <td>Body:</td>
                    <td>Created_at:</td>
                    <td>Updated_at:</td>
                    <td>Actions:</td>
                </tr>
            </thead>
        </table>
    </div>

@endsection
@section('footer')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {

            $('#post-table').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url:"{{route('posts.index')}}",
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data:'category_id',
                        name:'category_id',
                    },
                    {
                        data: 'photo_id',
                        name:'photo_id',

                        render: function (data,type,full,mata) {
                            return "<img src="+data+" alt='' class='img-thumbnail' width='70px'>"
                        },
                        orderable: false

                    },
                    {
                        data: 'title',
                        name:'title'
                    },
                    {
                        data: 'body',
                        name: 'body',
                        orderable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        orderable: false
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        orderable: false
                    },
                    {
                        data:'action',
                        name:'action',
                        orderable: false
                    }
                ]
            })
        });




        $('#createPost').click(function () {
            $('#action').val('Add');
            $('#modal-title').html('Add New Post !');
            $('#submit').html('&nbsp;&nbsp;&nbsp;Post&nbsp;&nbsp;&nbsp;');
            $('#modal-form')[0].reset();
            $('#image_id').html('');
            $('.error').html('');
            $('#inputmodal').modal('show');
        });

        $(document).on('click','.edit',function () {
            var id = $(this).attr('id');
            $('#hello').html('');
            $('#action').val('Edit');
            $('#modal-form')[0].reset();
            $('.error').html('');
            $.ajax({
                url : "posts/"+id+"/edit",
                dataType: "json",
                success: function (data) {
                    $('#modal-title').html('Edit Post !');
                    $('#title').val(data.post.title);
                    $('.category_id').val(data.category);
                    ne +="<img src="+data.photo+" alt='' width='90px' class='img-thumbnail'>";
                    $('#image_id').html("<img src="+data.photo+" alt='' width='90px' class='img-thumbnail'>");
                    $('#body').val(data.post.body);
                    $('#id').val(data.post.id);
                    $('#submit').html(' &nbsp;Edit&nbsp;&nbsp;&nbsp;');
                    $('#inputmodal').modal('show');
                }
            })
        });

        $('#modal-form').on('submit',function (event) {
            event.preventDefault();
            if ($('#action').val()=='Edit')
            {
                $.ajax({
                    url:"{{url('post')}}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: "json",
                    success: function (data) {
                        if(data.formerror !='')
                        {
                            if (data.formerror.category_id)
                            {
                                $('#idcategory').html(data.formerror.category_id);
                            }
                            if (data.formerror.photo_id)
                            {
                                $('#idphoto').html(data.formerror.photo_id);
                            }
                            if (data.formerror.title)
                            {
                                $('#idtitle').html(data.formerror.title);
                            }

                            if (data.formerror.body)
                            {
                                $('#idbody').html(data.formerror.body);
                            }
                        }


                        if(data.formsuccess)
                        {
                            $('#modal-form')[0].reset();
                            $('#post-table').DataTable().ajax.reload();
                            $('#inputmodal').modal('hide');
                            $.toast({
                                heading: 'Success !',
                                icon: 'success',
                                text: 'Post Updated Successfully !',
                                showHideTransition: 'fade',
                                position: 'top-right'
                            });
                        }
                    }
                });
            }
            if($('#action').val()=='Add')
            {
                $.ajax({
                    url: "{{route('posts.store')}}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache:false,
                    processData: false,
                    dataType:"json",
                    success:function (data) {


                        if(data.formerror !='')
                        {
                            if (data.formerror.category_id)
                            {
                                $('#idcategory').html(data.formerror.category_id);
                            }
                            if (data.formerror.photo_id)
                            {
                                $('#idphoto').html(data.formerror.photo_id);
                            }
                            if (data.formerror.title)
                            {
                                $('#idtitle').html(data.formerror.title);
                            }

                            if (data.formerror.body)
                            {
                                $('#idbody').html(data.formerror.body);
                            }
                        }



                        if(data.formsuccess)
                        {
                            $('#modal-form')[0].reset();
                            $('#post-table').DataTable().ajax.reload();
                            $('#inputmodal').modal('hide');
                            $(document).ready(function () {
                                $.toast({
                                    heading: "Success !",
                                    icon: "success",
                                    text:"Post Added Successfully !",
                                    showHideTransition: "plain",
                                    position: "top-right"
                                });
                            });
                        }
                    }

                });
            }

        });
        var id;
        $(document).on('click','.delete',function (event) {
            id = $(this).attr('id');
            $('#dsubmit').html('&nbsp;&nbsp;Delete');
            $('#deletemodal').modal('show');
        });


        $('#dsubmit').click(function () {
            alert(id);
            $.ajax({
                url: "{{url('destroy')}}"+"/"+id,
                beforeSend : function () {
                    $('#dsubmit').html('&nbsp;Deleting..');
                },
                success: function (data) {
                    setTimeout(function () {
                        $('#deletemodal').modal('hide');
                        $('#post-table').DataTable().ajax.reload();
                    },1000);


                    $.toast({
                        heading:'Success !',
                        icon:'success',
                        text:'Post deleted successfully !',
                        showHideTransition: 'slide',
                        position:'top-right',

                    });

                }
            })
        })

    </script>


@endsection
