<main role="main" style="padding-top: 3.5rem!important;">

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron img-order color-white">
  <div class="container">
    <h1 class="display-3 font-weight-bold">Hola!</h1>
    <p>今天的菜色很誘人，多吃點吧！</p>
    <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p> -->
  </div>
</div>

<div class="container mt-3">
  <div class="pl-1">
    <h2>
      <?=$EventInfo['Rname']?>
      <span class="CaculateTime">
        <i class="fas fa-clock"></i>
        <span class="time"><?=(int)$EventInfo['end_time']-time()?></span>
      </span>
      <!-- <button type="button" class="btn btn-warning" id="OrderSubmit">
        送出訂單 <span class="badge badge-light">$ <span class="CaculateDollars">0</span></span>
        <span class="sr-only">unread messages</span>
      </button> -->
    </h2>
    <i class="fas fa-address-book"></i>&nbsp;<?=$EventInfo['name']?> &nbsp;
    <i class="fas fa-phone-square"></i>&nbsp;<?=$RestInfo['phone']?>&nbsp;
    <i class="fas fa-map-marker-alt"></i>&nbsp;<?=$RestInfo['address']?>
    <i class="far fa-comment"></i>&nbsp;<?=$RestInfo['description']?>&nbsp;
  </div>

  <form action="" method="POST" id="OrderForm">
    <div class="row no-gutters">
      <div class="col">
        <div class="form-group">
          <input type="text" name="description" id="inputDescription" class="form-control" placeholder="訂單備註, ex. 紅茶半糖少冰加珍珠" aria-describedby="helpId">
          <button type="button" class="form-control btn btn-success" id="OrderSubmit">
            <b>送出訂單</b> <span class="badge badge-light">$ <span class="CaculateDollars">0</span></span>
            <span class="sr-only">unread messages</span>
          </button>
        </div>
      </div>
    </div>
    <div class="row">
    <?php foreach($RestMenu['menu'][$EventInfo['restaurant_id']] as $type_id => $type) { ?>
      <div class="col-6 col-md-4 mb-3">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">
              <?=$RestMenu['type'][$type_id]['name']?>
            </h3>
          </div>

          <?php foreach($type as $item) { ?>
          <div class="card-body d-flex justify-content-between p-1 OrderItemBorder">
            <h5><?=$item['name']?></h5>
            <div class="OrderQtyBorder">
              $<?=number_format($item['price'])?>&nbsp;
              <a href="javascript:;" class="OrderQtyMinus p-1"><i class="fa fa-minus" aria-hidden="true" data-id="<?=$item['id']?>"></i></a>
              <input class="OrderQtyInput<?=$item['id']?> p-1" type="text" name="number[]" value="0" data-id="<?=$item['id']?>" maxlength="3" />
              <input type="hidden" name="item_id[]" value="<?=$item['id']?>">
              <input class="ItemPrice<?=$item['id']?>" type="hidden" name="item_price[]" value="<?=$item['price']?>">
              <a href="javascript:;" class="OrderQtyPlus p-1"><i class="fa fa-plus" aria-hidden="true" data-id="<?=$item['id']?>"></i></a>
            </div>
          </div>
          <?php } // end foreach ?>

        </div>
      </div>
    <?php } // end foreach ?>

    </div>
  </form>

  <hr>

  <div class="row">
      <div class="col-12">
          <?=$COPYRIGHTS?>
      </div>
  </div>

</div> <!-- /container -->

</main>