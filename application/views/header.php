    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-lunch">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-utensils index-icon">
                <?=$MEMBER['name']?>
                </i>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                <!--<li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link color-custom" href="/release">發起非常召集</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link color-custom" href="/list">我的訂單</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link color-custom" href="/restaraunt">我有好點子</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link color-custom" href="/member/login" data-toggle="tooltip" title="登出">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link color-custom disabled" href="#">Help</a>
                </li> -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li> -->
                </ul>
                <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> -->
            </div>
      </div>
    </nav>