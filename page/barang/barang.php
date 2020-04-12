

<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Data Barang
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                             <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Spesifikasi</th>
                                            <th>Satuan</th>
                                            <th>Stok</th>
                                            <th>No. Rak</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $no = 1;

                                            $sql = $koneksi -> query("select * from tb_barang");
                                            while ($data = $sql->fetch_assoc()) {

                                        ?>


                                        <tr>
                                            <td><?php echo @$no++;?></td>
                                            <td><?php echo $data['kode_barang'];?></td>
                                            <td><?php echo @$data['nama_barang'];?></td>
                                            <td><?php echo @$data['jenis_barang'];?></td>
                                            <td><?php echo @$data['spesifikasi'];?></td>
                                            <td><?php echo @$data['satuan'];?></td>
                                            <td><?php echo @$data['stok'];?></td>
                                            <td><?php echo @$data['no_rak'];?></td>
                                            <td class="text-center" style="vertical-align:middle;">
                                            <a href="?page=barang&aksi=ubah&id=<?php echo $data['kode_barang'];?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                            <a onclick="return confirm('Anda Yakin Akan Menghapus Data Ini ... ???')" href="?page=barang&aksi=hapus&id=<?php echo $data['kode_barang'];?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                        </td>
                                      
                                            
                                        </tr>

                                       <?php } ?>

                                    </tbody>   
                                    </table>
                            </div>

                            <a href="?page=barang&aksi=tambah" class="btn btn-success" style="margin-top: 8px;"><i class="fa fa-plus"></i>Tambah Barang</a>

                    </div>
                </div>
        </div>
    </div>
