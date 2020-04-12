<?php
// memanggil file config.php

    include('../db/config.php');
    include('../db/function.php'); /// berisi fungsi-fungsi input/output formatting
    session_start();
    // cekAksesUser($database, 'mitra_utama');
    // $_SESSION;
    // Alternative SQL join in Datatables
    $id_table = 'kode_barang';
    
    // var_dump($_SESSION);die;
    $columns = array(
        'kode_barang_masuk',
        'nama_barang',
         'jenis_barang',
         'nama_rak',
        'tanggal_masuk',
        'nama_satuan',
        'jumlah_masuk',
        // 'nama_user',
    );

    $columnsFront = array(
        'kode_barang_masuk',
        // 'nama_barang',
        // 'id_satuan',
    );

    $columns_hide = array(
        // 'foto2'
    );

    $from = '`tb_barang_masuk` tbm inner join tb_barang tb on tbm. kode_barang=tb.kode_barang 
        inner join tb_satuan ts on tb.satuan=ts.id_satuan
        INNER join tb_rak tr on tb.no_rak=tr.no_rak';
// var_dump($sql);die;
    $id_table_edited = $id_table != '' ? $id_table . ',' : '';
    // custom SQL
    $sql = "SELECT ".implode(',', $columns)." FROM {$from} ";

    // search
    if (isset($_POST['search']['value']) && $_POST['search']['value'] != '') {
        $search = $_POST['search']['value'];
        $where  = " WHERE ";
        // create parameter pencarian kesemua kolom yang tertulis
        // di $columns
        for ($i=0; $i < count($columns); $i++) {
            $where .= $columns[$i] . ' LIKE "%'.$search.'%"';

            // agar tidak menambahkan 'OR' diakhir Looping
            if ($i < count($columns)-1) {
                $where .= ' OR ';
            }
        }

        $sql .= ' ' . $where;
    }

    // $sql .= " GROUP BY {$id_table} ";

    //SORT Kolom
    $sortColumn = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 1;
    $sortDir    = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc';

    $sortColumn = $columnsFront[$sortColumn-1];

    $sql .= " ORDER BY {$sortColumn} {$sortDir}";

    // var_dump($sql);
    // echo $sql;
    $count = $database->query($sql);
    // hitung semua data
    $totaldata = $count->num_rows;

    $count->close();

    // memberi Limit
    $start  = isset($_POST['start']) ? $_POST['start'] : 0;
    $length = isset($_POST['length']) ? $_POST['length'] : 10;


    $sql .= " LIMIT {$start}, {$length}";

    $data  = $database->query($sql);

    // create json format
    $datatable['draw']            = isset($_POST['draw']) ? $_POST['draw'] : 1;
    $datatable['recordsTotal']    = $totaldata;
    $datatable['recordsFiltered'] = $totaldata;
    $datatable['data']            = array();

    $no = $start+1;
    while ($row = $data->fetch_array()) {

        $fields = array($no++);
        // $fields = $row['nama_barang'];
        // var_dump($fields);die;
        $fields[] = $row['kode_barang_masuk'];
        $fields[] = $row['nama_barang'];
        $fields[] = $row['jenis_barang'];
        $fields[] = $row['nama_rak'];
        $fields[] = $row['tanggal_masuk'];
        $fields[] = $row['nama_satuan'];
        $fields[] = $row['jumlah_masuk'];

        for ($i=0; $i < count($columns); $i++) {



            // $fields[] = $row["{$columns[$i]}"];
                // var_dump($row);die;
    // echo $sql;
        }
        $aksi = '
        <button href="#" class="btn btn-warning btn-sm mb-1 tombolEdit" 
        data-nama_barang="'.$row['nama_barang'].'" 
        data-kode_barang_masuk="'.$row['kode_barang_masuk']. '" data-jenis_barang="' . $row['jenis_barang'] . '" data-jumlah_masuk="' . $row['jumlah_masuk'] . '" 
        data-satuan="' . $row['nama_satuan'] . '"
        data-rak="' . $row['nama_rak'] . '"">

            <i class="glyphicon glyphicon-pencil"></i> EDIT
        </button>
        <button href="#" class="btn btn-danger btn-sm mb-1 tombolHapus" data-nama_barang="'.$row['nama_barang'].'" data-kode_barang_masuk="'.$row['kode_barang_masuk']. '" ">
        <i class="glyphicon glyphicon-trash"></i> HAPUS
        </button>
        ';
        $fields[] = $aksi;


        $datatable['data'][] = $fields;
    }

    $data->close();
    echo json_encode($datatable);
