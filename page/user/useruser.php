

<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Data User
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>id_user</th>
                                            <th>Nama</th>
                                            <th>Level</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $no = 1;

                                            $sql = $koneksi -> query("select * from tb_user");
                                            while ($data = $sql->fetch_assoc()) {

                                        ?>


                                        <tr>
                                            <td><?php echo @$no++;?></td>
                                            <td><?php echo $data['id_user'];?></td>
                                            <td><?php echo @$data['nama'];?></td>
                                            <td><?php echo @$data['level'];?></td>
                                          
                                      
                                            
                                        </tr>

                                       <?php } ?>

                                    </tbody>   
                                    </table>
                            </div>

                    </div>
                </div>
        </div>
    </div>
