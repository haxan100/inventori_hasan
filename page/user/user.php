

<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Data Usser
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode User</th>
                                            <th>Nama</th>
                                            <th>Level</th>

                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $no = 1;

                                            $sql = $koneksi -> query("select * from tb_user");
                                            while ($data = $sql->fetch_assoc()) {

                                                    // $year = $data['updated_at'];
                                                    // echo "Year: " . date("Y", strtotime($year));
                                                // var_dump($year('y'));die;
                                        ?>


                                        <tr>
                                            <td><?php echo @$no++;?></td>
                                            <td><?php echo $data['kode_user'];?></td>
                                            <td><?php echo @$data['nama_user'];?></td>
                                            <td><?php echo @$data['level'];?></td>
                                            <td class="text-center" style="vertical-align:middle;">
                                            <a href="?page=user&aksi=ubah&id=<?php echo $data['kode_user'];?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                            <a onclick="return confirm('Anda Yakin Akan Menghapus Data Ini ... ???')" href="?page=user&aksi=hapus&id=<?php echo $data['kode_user'];?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                        </td>
                                      
                                            
                                        </tr>

                                       <?php } ?>

                                    </tbody>   
                                    </table>
                            </div>

                            <a href="?page=user&aksi=tambah" class="btn btn-success" style="margin-top: 8px;"><i class="fa fa-plus"></i>Tambah User</a>

                    </div>
                </div>
        </div>
    </div>
