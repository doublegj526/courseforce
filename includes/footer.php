<?php

echo '<div class = "navbar navbar-default navbar-fixed-bottom">
      <div class = "container">
        <p class = "navbar-text pull-left">Site built by John Gee</p>
        <div
          class="navbar-btn fb-like btn pull-center"
          data-share="true"
          data-width="450"
          data-show-faces="true">
        </div>
      </div>
    </div>
    <div class="col-xs-12" style="height:50px;"></div>
    <div class = "modal fade" id = "contact" role = "dialog">
      <div class = "modal-dialog">
        <div class = "modal-content">
          <form class = "form-horizontal" action="../includes/sendemail.php" method="post">
            <div class = "modal-header">
              <h4>Contact Us</h4>
            </div>
            <div class = "modal-body">
              <div class = "form-group">
                <label for = "name" class = "col-lg-3 control-label">Name:</label>
                <div class = "col-lg-9">
                  <input type = "text" class = "form-control" name = "name" placeholder = "John Smith">
                </div> 
              </div>
              <div class = "form-group">
                <label for = "email" class = "col-lg-3 control-label">Email:</label>
                <div class = "col-lg-9">
                  <input type = "text" class = "form-control" name = "email" placeholder = "johnsmith@example.com">
                </div> 
              </div>
              <div class = "form-group">
                <label for = "message" class = "col-lg-3 control-label">Message:</label>
                <div class = "col-lg-9">
                  <textarea class = "form-control" rows = "8" name = "content" placeholder = "Blah blah blah."></textarea>
                </div> 
              </div>
            </div>
            <div class = "modal-footer">
              <a class = "btn btn-default" data-dismiss = "modal">Close</a>
              <input class="btn btn-success" type="submit" name="submit" value="Send" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>';

?>