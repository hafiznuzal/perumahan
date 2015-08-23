        <div id="page_container">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                   <h1 class="page-header">Status Management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class ="row">
                <div class ="col-lg-11">

                    <div id="addSuccess" class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> Data has been succesfully Added
                    </div>
                     <div id="delSuccess" class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> Data has been succesfully Deleted
                    </div>
                     <div id="editSuccess" class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> Data has been succesfully Edited
                    </div>
                    <!-- /.success notification-->

                    <div class ="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-list"></i>Type List
                        </div>
                        <div class="panel-body">
                            <div class ="table">
                                <table id="dataTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($type as $i) {?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $i['ID_TYPE']?></td>
                                            <td><?php echo $i['TYPE_NAME']?></td>    
                                            <td>
                                                    <a class ="edit_btn" href="#" id="<?php echo $i['ID_TYPE']?>"><i class="fa fa-edit fa-2x"></i></a>
                                                    <a class ="del_btn" href="#" id="<?php echo $i['ID_TYPE']?>"><i class="fa fa-trash fa-2x"></i></a>
                                            </td>                                        
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot> 
                                        <tr>
                                            <td colspan="3"><label>Add new Type</label></td>
                                        </tr>
                                        <tr>
                                            <td>*</td>
                                            <td><input type="text" id="inputType" class="form-control"></input></td>
                                            <td><a href="#" class="add_btn"><i class="fa fa-plus-circle fa-2x"></i></a></input>    
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.table -->

                        </div>
                        <!-- /.panel-body -->

                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade " id="EditModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                    <h4 class="modal-title" id="EditModalLabel">Edit Data</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label >Type ID :</label>
                        <p id="typeID"></p>
                        <label >Type Name :</label>
                        <input type="text" class="form-control" id="editType">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="saveEdit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
         </div>
    </div>


        <script>


            $(document).ready(function () 
            {
                    $("#delSuccess").hide();
                    $("#addSuccess").hide();
                    $("#editSuccess").hide();


                    $('#dataTable').DataTable();
                    $('.del_btn').click(function(e)
                               {
                                   e.preventDefault();
                                   $.ajax
                                   ({
                                    url: '<?php echo site_url()?>/type/delete/'+$(this)[0].id,
                                    type:'GET',
                                    dataType: 'html',
                                    success: function(results)
                                        {
                                          console.log(JSON.stringify(results));
                                          $("#page_container").html(results);
                                          $("#delSuccess").show();
                                            
                                         } 
                                        

                                   });
                              
                                                             
                              
                               });

                    $('.add_btn').click(function(e)
                               {
                                   e.preventDefault();
                                   $.ajax
                                   ({
                                    url: '<?php echo site_url()?>/type/add/'+$("#inputType").val(),
                                    type:'GET',
                                    dataType: 'html',
                                    success: function(results)
                                        {
                                           $("#page_container").html(results);
                                           $("#addSuccess").show();
                                        } 
                                        

                                   });

                                                             
                              
                               });

                    $('.edit_btn').click(function(e)
                                {
                                    e.preventDefault();
                                    var id = $(this).parent().prev().prev().html();
                                    var name = $(this).parent().prev().html();
                                    $('#editType').val(name);
                                    $('#typeID').html(id);
                                    $('#EditModal').modal('show');


                                });
                    
                 $('#saveEdit').click(function(e)
                            {
                                e.preventDefault();
                                $.ajax
                                   ({
                                    url: '<?php echo site_url()?>/type/edit/'+$('#typeID').html()+'/'+$("#editType").val(),
                                    type:'GET',
                                    dataType: 'html',
                                    success: function(results)
                                        {
                                          console.log(JSON.stringify(results));
                                          $('#EditModal').modal('hide');
                                          $("#page_container").html(results);
                                          $("#editSuccess").show();
                                            
                                         } 
                                        

                                   });

                            });
            });
        </script>

        
