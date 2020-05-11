<main role="main" style="padding-top: 3.5rem!important;">

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron img-list">
  <div class="container">
    <h1 class="display-3 font-weight-bold">Lohas!</h1>
    <p>每60秒就有一分鐘經過，您是否認同呢？</p>
    <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p> -->
  </div>
</div>

<div class="container mt-3">

  <ul class="list-group">
    <?php if(isset($EventItem['data'])):
          foreach( $EventItem['data'] as $Eid => $rows ): 
            foreach($rows['orders'] as $row): break;?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>
            <span class="badge badge-primary p-2"><?=$RestInfo[$row['restaurant_id']]['name']?></span>
             - 由 <span class="UserName"><i class="fa fa-user" aria-hidden="true"></i> <?=$UserInfo[$rows['starter_id']]['name']?></span> 發起的非常召集於 <span class="DateTime"><?=date('m/d H:m',$row['end_time'])?></span> 截止 
            <span class="CaculateTime">
              <i class="fas fa-clock"></i>
              <span class="time" option-redirect="false"><?=(int)$row['end_time']-time()?></span>
            </span>
          </span>
          <span>
            <span class="badge badge-secondary badge-pill p-3"><?=$OrderCount[$row['Eid']]?></span>
          </span>
      </li>
    <?php
      endforeach;
    endforeach;
  endif;?>
  </ul>

  <ul class="list-group">
    <?php if(isset($EventItem['data'])):
    foreach( $EventItem['data'] as $Eid => $event ): ?>
    <!-- Event -->
    <li class="list-group-item d-flex justify-content-between align-items-center list-event cursor-pointer" data-id="<?=$Eid?>">
        <span>
          <span class="badge badge-primary p-2"><?=$RestInfo[$event['restaurant_id']]['name']?></span>
           - 由 <span class="UserName"><i class="fa fa-user" aria-hidden="true"></i> <?=$UserInfo[$event['starter_id']]['name']?></span> 發起的非常召集於 <span class="DateTime"><?=date('m/d H:m',$event['end_time'])?></span> 截止 
          <span class="CaculateTime">
            <i class="fas fa-clock"></i>
            <span class="time" option-redirect="false"><?=(int)$event['end_time']-time()?></span>
          </span>
        </span>
        <span>
          <span class="badge badge-secondary badge-pill p-3"><?=count($event['orders'])?></span>
        </span>
    </li>
    <?php foreach( $event['orders'] as $Aid => $member ): ?>
    <!-- Member -->
    <li class="list-group-item d-flex justify-content-between align-items-center list-member list-member-<?=$Eid?>">
        <span>
          <span class="badge badge-warning p-2"><i class="fa fa-user" aria-hidden="true"></i> <?=$UserInfo[$Aid]['name'];?></span>
            &nbsp;-&nbsp;
          <button class="btn btn-success cursor-pointer showitemlist" type="button" data-id="<?=$Eid?>"><i class="fas fa-shopping-basket"></i>&nbsp;<span class="badge badge-light">$ <?=$event['TotalPrice'][$Aid]?></span></button>&nbsp;訂單備註
        </span>
    </li>
    <!-- Order -->
    <!-- TODO: 尚缺刪除訂單物件 -->
    <li class="list-group-item d-flex justify-content-between align-items-center list-order list-order-<?=$Eid?>">
      <div>
      <?php foreach( $member as $order ): ?>
        <button type="button m-1" class="btn btn-dark">
          <?=$order['Iname']?>&nbsp;x&nbsp;<?=$order['number']?>&nbsp;<span class="badge badge-light">$ <?=$order['UnitPrice']?></span>&nbsp;
        </button>
      <?php endforeach; // order ?>
      </div>
    </li>

    <!-- TODO: 顯示訂單統計商品，方便訂餐 -->
    
    <?php endforeach; // member
    endforeach; // event
    else :?>

    <li class="list-group-item d-flex justify-content-between align-items-center">
      <span>您還沒有訂單唷～</span>
    </li>
    <?php endif; ?>
  </ul>

  <hr>

  <div class="row">
      <div class="col-12">
          <?=$COPYRIGHTS?>
      </div>
  </div>

</div> <!-- /container -->

</main>