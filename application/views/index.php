    <main role="main" style="padding-top: 3.5rem!important;">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container color-white">
          <h1 class="display-3 font-weight-bold">Hello, world!</h1>
          <p>辛苦工作之後，吃一頓好吃的午飯吧！</p>
          <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p> -->
        </div>
      </div>

      <div class="container mt-3">

        <ul class="list-group">
            <?php if( $events ) {
              foreach($events as $event) { ?>
              <li class="list-group-item d-flex justify-content-between align-items-center OrderLink" data-id='<?=$event['id']?>'>
                <span>
                <span class="badge badge-primary p-2"><?=$event['Rname']?></span>
                   - 由 <span class="UserName"><?=$event['name']?></span> 發起的非常召集將於 <span class="DateTime"><?=date('m/d H:m',$event['end_time'])?></span> 截止
                  &nbsp; 
                  <span class="CaculateTime">
                    <i class="fas fa-clock"></i>
                    <span class="time"><?=$event['end_time']-time()?></span>
                  </span>
                </span>
                <span class="badge badge-secondary badge-pill p-3">
                  <i class="fa fa-smile"></i>&nbsp;<?=(isset($GetOrderCount[$event['id']])) ? $GetOrderCount[$event['id']] : 0;?>
                </span>
                <!-- <span class="badge badge-secondary badge-pill p-3">10</span> -->
            </li>
            <?php } // end foreach
            } else { ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                現在沒有非常召集，您要不要當第一位小天使呢？！
              </li>
            <?php } // end if ?>
        </ul>

        <hr>

        <div class="row">
            <div class="col-12">
                <?=$COPYRIGHTS?>
            </div>
        </div>

      </div> <!-- /container -->

    </main>