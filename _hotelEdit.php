<style type="text/css">
/*    #ext-gen8 {
        padding-left: 250px;
    }*/
.x-combo-list {
    width: 180px !important;
}
.x-combo-list-inner {
     width: 180px !important;
}
.x-form-field-wrap {
    width: 180px !important;
}
</style>
<h2 style="margin: 18px 0 0 10px;">宿泊ホテル選択</h2>

<?php
// ホテル
  $option_hotels = array();
  foreach ($hotels as $hotel) {
    $option_hotels[$hotel->getId()] = $hotel->getId().':'.$hotel->getName();
  }
?>

<table class="form">
    <tr>
        <th>順番<input type="hidden" name="order_sort_hotel" id="order_sort_hotel" value=""/></th>
        <td id="order_sort_hotel_append"></td>
    </tr>
  <tr>
    <th>施設種類</th>
    <td>
      <span class="radio_edit_stype_td" style="display: inline;">
        <input type="radio" name="StayTypeCode" value="" checked="checked" id="StayTypeCode"/>変更なし
      </span>
      <?php foreach(sfConfig::get('app_tour_schedule_stay_type_code') as $code => $str): ?>
      <label>
        <?php echo radiobutton_tag('StayTypeCode', $code, isset($tour_schedule['stay_type_code']) && $tour_schedule['stay_type_code'] == $code) ?>
        <?php echo $str ?>
      </label>
      <?php endforeach; ?>
      <div id="stay-place">アパートメント、ロッジ、ホームステイ、その他の場合の宿泊先
        <?php echo input_tag('OtherStayType', !empty($tour_schedule['stay_type_code']) ? $tour_schedule['stay_type_code'] : null, 'style="width:150px"') ?>
      </div>
    </td>
  </tr>
</table>

<table class="form">
  <tr>
    <th>ホテル</th>
    <td>
      <table>
        <tr>
            <td>
            </td>
            <td>
                <span class="radio_edit_stype_td" style="display: inline;">
                  <label><input type="radio" name="hotel_ids_type" value="" checked="checked" onclick="show_hotel_ids('');"/>変更なし</label>
                  <label><input type="radio" name="hotel_ids_type" value="update" onclick="show_hotel_ids('update');" />新規登録・全変更</label>
                  <label><input type="radio" name="hotel_ids_type" value="add" onclick="show_hotel_ids('add');" />追加</label>
                  <label><input type="radio" name="hotel_ids_type" value="remove" onclick="show_hotel_ids('remove');" />削除</label>
                </span>
                <div>登録ホテル一覧</div>
            </td>
            <td></td>
            <td>未登録ホテル一覧</td>
        </tr>
        <tr>
          <td rowspan="2">
            <input id="btn-up-hotel" type="button" value="↑" /><br />
            <input id="btn-down-hotel" type="button" value="↓" />
          </td>
          <td rowspan="2">
            <?php
            $temp_hotels = array();
            if (isset($schedule_hotels)) {
              foreach ($schedule_hotels as $hotel) {
                $temp_hotels[$hotel->getId()] = ($hotel->getTravelcoHotelId() ? '' : 'T× ').$hotel->getId().':'.$hotel->getName();
              }
            }
            echo select_tag(
              'hotel_ids[]',
              options_for_select($temp_hotels),
              array('id' => 'hotel_ids', 'disabled' => 'disabled', 'data-select'=>'rm_disabled', 'multiple' => true, 'size' => 5, 'style'=>'width:250px; height:150px;')
            ) ?>
          </td>
          <td rowspan="2">
            <input id="btn-add-hotel" type="button" value="←追加" /><br/>
            <input id="btn-remove-hotel" type="button" value="→削除" />
          </td>
        </tr>
        <tr>
          <td class="SelectHotelMid">
            <?php echo select_tag('region_id', options_for_select($option_regions, $_SESSION['multiScheduleUpdate']['region_id'], array('include_custom' => '(地域を選択してください)')), array('id' => 'region_ht', 'disabled' => 'disabled', 'data-select'=>'rm_disabled')) ?>
            </br>
            <?php echo select_tag('country_id', options_for_select($option_countrys, $sf_params->get('country_id'), array('include_custom' => '(国を選択してください)')), array('id' => "country_ht", 'disabled' => 'disabled', 'data-select'=>'rm_disabled')) ?>
            </br>
            <?php echo select_tag('city_id', options_for_select($option_citys, $sf_params->get('city_id'), array('include_custom' => '(都市を選択してください)')), array('id'=>'city_ht', 'disabled' => 'disabled', 'data-select'=>'rm_disabled') ) ?>
            </br>
            <?php echo select_tag('district_id', options_for_select($option_districts, $sf_params->get('district_id', null), array('include_custom' => '(小エリアを選択してください)')), array('id' => "district_ht", 'disabled' => 'disabled', 'data-select'=>'rm_disabled')) ?>
            </br>

            <?php
//            $temp_hotels = array();
//            if (isset($hotels)) {
//              foreach ($hotels as $hotel) {
//                $temp_hotels[$hotel->getId()] = $hotel->getTravelcoHotelId() ? $hotel->getId().':'.$hotel->getName() : 'T×' . $hotel->getId().':'.$hotel->getName();
//              }
//            }
           // echo select_tag('hotel_id', $option_hotels, array('id="hotel"', 'size' => 5, 'style'=>'width:250px; height:120px;' )) ;

             echo select_tag('hotel_id', options_for_select($option_hotels, $sf_params->get('hotel_id', null), array()),  array('multiple' => true, 'size' => 5, 'id' => 'hotel_id' ,'disabled' => 'disabled', 'data-select'=>'rm_disabled', 'style'=>'width:250px; height:120px;', 'id'=>'sel-hotels'));
                    ?>

          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<table class="form">
  <tr>
    <th>宿泊条件</th>
    <td>
        <span class="radio_edit_stype_td" style="display: inline;">
            <input type="radio" name="StayCondCode" value="" id="StayCondCode" checked="checked" />変更なし
        </span>

      <?php foreach(sfConfig::get('app_tour_schedule_stay_cond_code') as $code => $str): ?>
      <label>
        <?php echo radiobutton_tag('StayCondCode', $code, isset($tour_schedule['stay_cond_code']) && $tour_schedule['stay_cond_code'] == $code) ?>
        <?php echo $str ?>
      </label>
      <?php endforeach; ?>
    </td>
  </tr>
</table>

<table class="form">
  <tr>
    <th>部屋種類</th>
    <td class="SelectHotelLast">
      <?php echo select_tag('RoomTypeCode', options_for_select(
        sfConfig::get('app_tour_schedule_room_type_code'),
        isset($tour_schedule['room_type_code']) ? $tour_schedule['room_type_code'] : null,
        array('include_custom' => '変更なし')
      )); ?>
    </td>
  </tr>
  <tr>
    <th>部屋形態</th>
    <td>
      <?php
        //echo $tour_schedule['room_size'].'hanghanglehang';
        echo input_tag('RoomSize', isset($tour_schedule['room_size']) ? $tour_schedule['room_size'] : null, array('style' => 'width:250px' ), array('include_custom' => '変更なし') );

      ?>
    </td>
  </tr>
  <tr>
    <th>部屋カテゴリ</th>
    <td>
      <?php echo input_tag('RoomCategory', isset($tour_schedule['room_category']) ? $tour_schedule['room_category'] : null, 'style="width:250px"') ?>
    </td>
  </tr>
  <tr>
    <th>備考</th>
    <td>
      <span class="radio_edit_stype_td" style="display: inline;">
        <label><input type="radio" name="stay_memo_type" value="" checked="checked" onclick="show_replace_append_data_post('', '#stay_memo_replace_ht');" />変更なし</label>
        <label><input type="radio" name="stay_memo_type" value="change" onclick="show_replace_append_data_post('change', '#stay_memo_replace_ht');" />変更する</label>
        <label><input type="radio" name="stay_memo_type" value="preset" onclick="show_replace_append_data_post('preset', '#stay_memo_replace_ht');" />先頭に追加する</label>
        <label><input type="radio" name="stay_memo_type" value="append" onclick="show_replace_append_data_post('append', '#stay_memo_replace_ht');" />最後に追加する</label>
        <label><input type="radio" name="stay_memo_type" value="remove" onclick="show_replace_append_data_post('remove', '#stay_memo_replace_ht');" />削除する</label>
        <label><input type="radio" name="stay_memo_type" value="replace" onclick="show_replace_append_data_post('replace', '#stay_memo_replace_ht');" />★から▲に変更する</label>
      </span>
      <br />
      <?php echo textarea_tag('stay_memo_ht', $tour_schedule['stay_memo'], array('disabled' => 'disabled', 'required' => 'required', 'data-text'=>'rm_disabled', 'style'=>"width:500px;height:100px;" )) ?>
      <?php // echo textarea_tag('StayMemo_replace_ht', null, 'style="width:500px;height:100px; display: none;') ?>
      <textarea id="stay_memo_replace_ht" name="stay_memo_replace_ht" style="width:500px; height:100px; display: none;"></textarea>
    </td>
  </tr>
</table>

<script type="text/javascript">
  YAHOO.util.Event.addListener('region_ht', 'change', function(){
      console.log('in here!!!');
    var sel_region_ht = YAHOO.util.Dom.get('region_ht');
    YAHOO.util.Connect.asyncRequest(
    'get',
    '<?php echo url_for('country/json') ?>'+'/region_id/'+sel_region_ht.options[sel_region_ht.selectedIndex].value,
    {
      success:function(obj){
        try{
          Tabikobo.util.obj2options(YAHOO.util.Dom.get('country_ht'), YAHOO.lang.JSON.parse(obj.responseText), false);
          Tabikobo.util.obj2options(YAHOO.util.Dom.get('city_ht'),{}, false);
          Tabikobo.util.obj2options(YAHOO.util.Dom.get('district_ht'), {}, false);
          Tabikobo.util.obj2options(YAHOO.util.Dom.get('sel-hotels'), {}, false);
        }
        catch(ex){
        }
      },
      failure:function(obj){}
    },
    null
  );
  });

  YAHOO.util.Event.addListener('country_ht', 'change', function(){
    var sel_country = YAHOO.util.Dom.get('country_ht');
    YAHOO.util.Connect.asyncRequest(
    'get',
    '<?php echo url_for('city/json') ?>'+'/country_id/'+sel_country.options[sel_country.selectedIndex].value,
    {
      success:function(obj){
        try{
          Tabikobo.util.obj2options(YAHOO.util.Dom.get('city_ht'), YAHOO.lang.JSON.parse(obj.responseText), false);
          Tabikobo.util.obj2options(YAHOO.util.Dom.get('district_ht'), {}, false);
        }
        catch(ex){
        }
      },
      failure:function(obj){}
    },
    null
  );
    YAHOO.util.Connect.asyncRequest(
    'get',
    '<?php echo url_for('hotel/json') ?>'+'/country_id/'+sel_country.options[sel_country.selectedIndex].value,
    {
      success:function(obj){
        try{
          Tabikobo.util.obj2options(YAHOO.util.Dom.get('sel-hotels'), YAHOO.lang.JSON.parse(obj.responseText), false);
        }
        catch(ex){
        }
      },
      failure:function(obj){}
    },
    null
  );
  });

  YAHOO.util.Event.addListener('city_ht', 'change', function(){
    var sel_city = YAHOO.util.Dom.get('city_ht');
    YAHOO.util.Connect.asyncRequest(
    'get',
    '<?php echo url_for('district/json') ?>'+'/city_id/'+sel_city.options[sel_city.selectedIndex].value,
    {
      success:function(obj){
        try{
          Tabikobo.util.obj2options(YAHOO.util.Dom.get('district_ht'), YAHOO.lang.JSON.parse(obj.responseText), false);
        }
        catch(ex){
        }
      },
      failure:function(obj){}
    },
    null
  );
    YAHOO.util.Connect.asyncRequest(
    'get',
    '<?php echo url_for('hotel/json') ?>'+'/city_id/'+sel_city.options[sel_city.selectedIndex].value,
    {
      success:function(obj){
        try{
          Tabikobo.util.obj2options(YAHOO.util.Dom.get('sel-hotels'), YAHOO.lang.JSON.parse(obj.responseText), false);
        }
        catch(ex){
        }
      },
      failure:function(obj){}
    },
    null
  );
  });

    function show_hotel_ids ( hotel_ids_type) {
        if (hotel_ids_type == '') {
            $('#hotel_ids').attr('disabled', 'disabled');
            $('#hotel_ids').val('');
            $('#region_ht').attr('disabled', 'disabled');
            $('#country_ht').attr('disabled', 'disabled');
            $('#city_ht').attr('disabled', 'disabled');
            $('#district_ht').attr('disabled', 'disabled');
            $('#sel-hotels').attr('disabled', 'disabled');
        } else {
            $('#hotel_ids').removeAttr('disabled');
            $('#region_ht').removeAttr('disabled');
            $('#country_ht').removeAttr('disabled');
            $('#city_ht').removeAttr('disabled');
            $('#district_ht').removeAttr('disabled');
            $('#sel-hotels').removeAttr('disabled');
        }
    }
</script>
