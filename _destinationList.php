<?php //Hang test test test test test
$stay_code      = sfConfig::get('app_tour_schedule_stay_code');
include_component('multiScheduleUpdate', 'pagerschedule', array('pager' => $pager_tours));
?>
<script type="text/javascript">
  $(document).ready(function(){
    $(".double-scroll").doubleScroll();
    $("div[id='tab_1']").hide();
    $("div[id='tab_3']").hide();
    $("div[id='tab_4']").hide();
  });
</script>
<div  class="double-scroll">
  <table class="list" id="very-wide-element2" style="table-layout:fixed;">
    <tr>
      <th style="width: 60px;">お客様用<br />コースコード</th>
      <th style="width: 160px;">コースコード</th>
      <?php for($i=1; $i <= $maxSortOrder; $i++): ?>
      <th style="width:20px">朝食<?php echo $i ?></th>
      <th style="width:20px">変更後朝食<?php echo $i ?></th>
      <th style="width:20px">昼食<?php echo $i ?></th>
      <th style="width:20px">変更後昼食<?php echo $i ?></th>
      <th style="width:20px">夕食<?php echo $i ?></th>
      <th style="width:20px">変更後夕食<?php echo $i ?></th>
      <th style="width:100px">目的地<?php echo $i ?></th>
      <th style="width:100px">変更後目的地<?php echo $i ?></th>
      <th style="width:80px;">その他宿泊地<?php echo $i ?></th>
      <th style="width:80px;">変更後その他宿泊地<?php echo $i ?></th>
      <?php endfor ?>
    </tr>
    <?php foreach($arrTour as $tour_id => $value):
        $destination_citys = $value['destination_citys'];
    ?>
    <tr data="tr_<?php echo $value['id'] ?>">
      <td style="width: 100px;"><a href="/admin/tourSchedule/edit/id/<?php echo $value['id'] ?>" target="_blank"><?php echo $value['visitor_code'] ?></a></td>
      <td style="width: 100px;"><a href="/admin/tourSchedule/edit/id/<?php echo $value['id'] ?>" target="_blank"><?php echo $value['code'] ?></a></td>
      <?php for($h = 1; $h <= $maxSortOrder; $h++){
      if(isset($value["list"][$h]))
        $schedule = $value["list"][$h];
      else
        unset($schedule);

      if (isset($arrTour_new[$tour_id]["list"][$h]))
        $schedule_new = $arrTour_new[$tour_id]["list"][$h];
      else
        unset($schedule_new);
     ?>
      <td style="width:20px">
        <?php
        if(isset($schedule))
          echo $schedule["breakfast"] ;
        ?>
      </td>
      <td style="width:20px">
        <?php
        if(isset($schedule_new))
          echo $schedule_new["breakfast"] ;
        ?>
      </td>
      <td style="width:20px">
        <?php
        if(isset($schedule))
          echo $schedule["lunch"];
        ?>
      </td>
      <td style="width:20px">
        <?php
        if(isset($schedule_new))
          echo $schedule_new["lunch"];
        ?>
      </td>
      <td style="width:20px">
        <?php
        if(isset($schedule))
          echo $schedule["dinner"] ;
        ?>
      </td>
      <td style="width:20px">
        <?php
        if(isset($schedule_new))
          echo $schedule_new["dinner"] ;
        ?>
      </td>
      <td style="width:100px">
          <?php
          if(isset($schedule["other_stay_place"])){
            if(is_numeric($schedule['city_id']) && isset($destination_citys[$schedule['city_id']]))
              echo $destination_citys[$schedule['city_id']];
            else
              if(isset($stay_code[$schedule['stay_code']])) echo $stay_code[$schedule['stay_code']];
          }
          ?>
      </td>
      <td style="width:100px">
        <?php
        if(isset($schedule_new)){
          if(is_numeric($schedule_new['city_id']) && isset($destination_citys[$schedule_new['city_id']]))
            echo $destination_citys[$schedule_new['city_id']];
          else
            if(isset($stay_code[$schedule_new['stay_code']])) echo $stay_code[$schedule_new['stay_code']];
        }
        ?>
      </td>
      <td style="width:80px;">
        <?php
        if(isset($schedule))
            echo $schedule["other_stay_place"] ;
        ?>
      </td>
      <td style="width:80px;">
        <?php
        if(isset($schedule_new))
            echo $schedule_new["other_stay_place"] ;
        ?>
      </td>
      <?php } // endforeach ?>
    </tr>
  <?php endforeach ?>
  </table>
</div>
<?php include_component('multiScheduleUpdate', 'pagerschedule', array('pager' => $pager_tours)) ?>
