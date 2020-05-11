<main role="main" style="padding-top: 3.5rem!important;">

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron img-release color-white">
  <div class="container">
    <h1 class="display-3 font-weight-bold">ありがとう！</h1>
    <p>感謝你，願意當個小天使</p>
    <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p> -->
  </div>
</div>

<div class="container mt-3">

  <div class="form-group">
    <div class="input-group">
      <div class="input-group-addon"><i class="fas fa-calendar"></i></div>
      <input type="datetime-local" name="start_time" id="start_time" class="form-control d-none" placeholder="" aria-describedby="helpId" value="<?=date('Y-m-d\TH:i')?>">
      <!-- <div class="input-group-addon">～</div> -->
      <input type="datetime-local" name="end_time" id="end_time" class="form-control" placeholder="" aria-describedby="helpId" value="<?=date('Y-m-d\TH:i',strtotime('+1 hours'));?>">
    </div>
    <small id="helpId" class="text-muted">結束時間</small>
  </div>

  <ul class="list-group">
    <?php foreach($RestList as $rid => $row) { ?>
      <li class="list-group-item d-flex justify-content-between align-items-center position-relative">
        <span>
          <?=$row['name']?>&nbsp;
          <i class="fas fa-phone-square"></i>&nbsp;<?=$row['phone']?>&nbsp;
          <i class="far fa-comment"></i>&nbsp;<?=$row['description']?>&nbsp;
          <i class="fas fa-map-marker-alt"></i>&nbsp;<?=$row['address']?>
        </span>
        <span>
          <label class="badge badge-warning badge-pill p-3 cursor-pointer">
            發起非常召集
            <input class="d-none" type="checkbox" name="release" data-id="<?=$rid?>" />
          </label>
          <label class="badge badge-success badge-pill p-3 cursor-pointer">
            點擊查看菜單
            <input class="d-none" type="checkbox" name="showmenu" data-id="<?=$rid?>" />
          </label>
        </span>
        
      </li>

      <div class="row r-menu r-menu-<?=$rid?>">
        <?php foreach($RestMenuList['menu'][$rid] as $type_id => $type) { ?>
          <div class="col-4 pd-1">
            <div class="pt-1 pd-1">
              <h3><?=$RestMenuList['type'][$type_id]['name']?></h3>
            </div>
            <?php foreach($type as $item) { ?>
            <div class="r-menu-item d-flex justify-content-between p-1">
              <span><?=$item['name']?></span>
              <span>$<?=number_format($item['price'])?></span>
            </div>
            <?php } // end item foreach ?>
          </div>
        <?php } // end item type foreach ?>
      </div>

    <?php } // end Restaurant foreach ?>
  </ul>

  <hr>

  <div class="row">
      <div class="col-12">
          <?=$COPYRIGHTS?>
      </div>
  </div>

</div> <!-- /container -->

</main>

