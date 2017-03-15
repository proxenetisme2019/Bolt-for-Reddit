<!--
    ____  ____  __  ______
   / __ )/ __ \/ / /_  __/
  / __  / / / / /   / /
 / /_/ / /_/ / /___/ /
/_____/\____/_____/_/
BY SYS
 -->

<html lang="en">
  <head>
      <title>Bolt - Results</title>
      @include('layouts.header')
  </head>
  <body>
    <div id="wrap">
        <div class="navigation">
            @include('layouts.nav')
        </div>
            <div class="container">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div id="result-col-6" class="col-md-6">
                <center><img src="images/bolt2.svg" class="navlogo"></center>
                <hr>
                @if(isset($Winners))
                <ul class="demo-list-three mdl-list">
                  @for($a = 0; $a < sizeof($Winners); $a++)
                  <li class="mdl-list__item mdl-list__item--three-line">
                    <span class="mdl-list__item-primary-content">
                      <i class="material-icons mdl-list__item-avatar">person</i>
                      <span>{{$Winners[$a]}}</span>
                      <span class="mdl-list__item-text-body">
                        <?php echo substr($BodyWinners[$a], 0, 150) ?>
                      </span>
                    </span>
                    <span class="mdl-list__item-secondary-content">
                      <?php echo '<a class="mdl-list__item-secondary-action" target="_blank" href="https://www.reddit.com/user/'.$Winners[$a].'">' ?><i class="material-icons">chevron_right</i></a>
                    </span>
                  </li>
                  @endfor
                </ul>
                @elseif(isset($status))
                <center>
                  <p class="error-status">{{$status}}</p>
                  <p class="error-status">This is likely to be caused by a very specific keyword.</p>
                  <p class="error-status">Try refreshing below, this may fix the issue. If not please try a different keyword</p>
                  <button onclick="window.location.reload();"class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
                    <i class="material-icons">autorenew</i>
                  </button>
                </center>
                @else
                <p class="error-fatal">FATAL!</p>
                @endif
                </div>
            </div>
            </div>
    </div>
  </body>
</html>
