

<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Data Barang Keluar
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>                                            
                                            <th>Nama Rak</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $no = 1;

                                            $sql = $koneksi -> query("select * from tb_rak");


                                            while ($data = $sql->fetch_assoc()) {

                                        ?>


                                        <tr>
                                            <td><?php echo @$no++;?></td>
                                            <td><?php echo @$data['nama_rak'];?></td>
                                            <td class="text-center" style="vertical-align:middle;">
                                           
                                            <a onclick="return confirm('Anda Yakin Akan Menghapus Data Ini ... ???')" href="?page=barangkeluar&aksi=hapus&id=<?php echo $data['kode_barang_keluar'];?>&kode=<?php echo $data['kode_barang'];?>&jumlah=<?php echo $data['jumlah_masuk'];?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                        </td>
                                      
                                            
                                        </tr>

                                       <?php } ?>

                                    </tbody>   
                                    </table>
                            </div>

                            <a href="?page=barangkeluar&aksi=tambah" class="btn btn-success" style="margin-top: 8px;"><i class="fa fa-plus"></i>Tambah Barang Keluar</a>

                    </div>
                </div>
        </div>
    </div>
