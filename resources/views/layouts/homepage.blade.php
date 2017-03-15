<!--
    ____  ____  __  ______
   / __ )/ __ \/ / /_  __/
  / __  / / / / /   / /
 / /_/ / /_/ / /___/ /
/_____/\____/_____/_/
BY FMWK aka. Sys
 -->

<html lang="en">
  <head>
      <title>Bolt - Home</title>
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
            <div id="entry" class="col-md-6" style="display:none;">
            <center><img src="images/bolt2.svg" class="navlogo"></center>
                <form action="/result" method="POST">
                  {{ csrf_field() }}
                    <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" type="text" name="code" id="code" pattern="[A-Z,a-z,0-9]*" required>
                    <label class="mdl-textfield__label" for="user">Post code</label>
                    <span class="mdl-textfield__error">Alphanumeric only!</span>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" type="text" name="number" id="number" pattern="[0-9]*" required>
                    <label class="mdl-textfield__label" for="user">How many lucky souls?</label>
                    <span class="mdl-textfield__error">Numeric only!</span>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" type="text" name="keyword" id="keyword">
                    <label class="mdl-textfield__label" for="user">Keyword</label>
                    </div>
                    <button style="float:right" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Go</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div id="entry-thankyou" class="col-md-6" style="display:none;">
              <center><p>Thank you for visiting Bolt. If you have a bug/suggestion feel free to contact me on Reddit. Link top-right<p></center>
            </div>
        </div>
        </div>
    </div>
  </body>
</html>
