<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php 
    function curl(){ 
        $curl = curl_init(); 
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost:8080/api",
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_CUSTOMREQUEST => "GET", 
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: random123678abcghi",
            ),
        ));
            
        $output = curl_exec($curl); 	
        curl_close($curl);      
        
        $data = json_decode($output);   
        
        return $data;
    } 
    ?>
    <div class="p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal text-body-emphasis">Dashboard - TOKO</h1>
        <p class="fs-5 text-body-secondary"><?= date("l, d-m-Y") ?> <span id="jam"></span>:<span id="menit"></span>:<span id="detik"></span></p>
    </div> 
    <hr>
    <div class="table-responsive card m-5 p-5">
    <h3 class="text-center mb-4">Transaksi Pembelian</h3>
    <table class="table table-striped">
        <thead>
            <tr>
            <th class="text-center" style="width: 5%;">No</th>
            <th class="text-start" style="width: 15%;">Username</th>
            <th class="text-start" style="width: 25%;">Alamat</th>
            <th class="text-end" style="width: 15%;">Total Harga</th>
            <th class="text-end" style="width: 10%;">Ongkir</th>
            <th class="text-center" style="width: 10%;">Status</th>
            <th class="text-center" style="width: 20%;">Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $send1 = curl();

                if(!empty($send1) && $send1->status->code == 200){
                    $hasil1 = $send1->results;
                    $i = 1; 

                    if(!empty($hasil1)){
                        foreach($hasil1 as $item1){ 
                            ?>
                            <tr>
                                <td scope="row" class="text-center align-middle"><?= $i++ ?></td>
                                <td class="text-start align-middle"><?= $item1->username; ?></td>
                                <td class="text-start align-middle"><?= $item1->alamat; ?></td>
                                <td class="text-end align-middle">
                                    <?= number_format($item1->total_harga, 0, ',', '.'); ?> <br>
                                    <small>(<?= $item1->jumlah_item; ?> Item)</small>
                                </td>
                                <td class="text-end align-middle"><?= number_format($item1->ongkir, 0, ',', '.'); ?></td>
                                <td class="text-center align-middle"><?= ($item1->status == 1) ? 'Sudah Selesai' : 'Belum Selesai'; ?></td>
                                <td class="text-center align-middle"><?= $item1->created_at; ?></td>
                            </tr> 
                            <?php
                        } 
                    }
                }
                ?> 
        </tbody>
    </table>
</div> 

    <script>
        window.setTimeout("waktu()", 1000);

        function waktu() {
            var waktu = new Date();
            var jam = waktu.getHours();
            var menit = waktu.getMinutes();
            var detik = waktu.getSeconds();
            
            // Menambahkan nol di depan jika angka < 10
            jam = jam < 10 ? "0" + jam : jam;
            menit = menit < 10 ? "0" + menit : menit;
            detik = detik < 10 ? "0" + detik : detik;

            setTimeout("waktu()", 1000);
            document.getElementById("jam").innerHTML = jam;
            document.getElementById("menit").innerHTML = menit;
            document.getElementById("detik").innerHTML = detik;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
