<?php foreach( $value as $row_val) : ?>
  <a href="#" class="kt-notification__item" onclick="getMenu('master_data/Mst_info/show/<?php echo $row_val->info_id; ?>')">
      <div class="kt-notification__item-details">
          <div class="kt-notification__item-title">
              <b>Judul Pengumuman : </b><br><?php echo $row_val->info_title; ?><br>
              <b>Tanggal : </b><br><?php echo $this->tanggal->formatDateFormDmy($row_val->info_start_date); ?><br>
              <b>Isi Pengumuman : </b><br><?php echo $row_val->info_content; ?>
          </div>
      </div>
  </a>
<?php endforeach; ?>