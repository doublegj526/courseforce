<?php
    
    require_once('../includes/mysqli_connect.php');

    $result = @mysqli_query($dbc,'SHOW COLUMNS FROM classes WHERE FIELD=\'department\'');
        if($result){
              echo '<div class="row"> 
                    <div class="form-group col-lg-3">
                    <select class="form-control" id="department" name="department">';
              echo '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Concentration
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                echo "<option selected>" . "---Department---" . "</option>";
                while ($row=mysqli_fetch_row($result))
                  {
                     foreach(explode("','",substr($row[1],6,-2)) as $v)
                     {
                       echo "<option>$v</option>";
                     }
                  }
                echo '</ul></select></div>';
                echo '<div class="form-group col-lg-3">
                      <label>' . ' ' . '</label>
                      <input class="btn btn-primary" id="search" type="submit" name="submit" value="Search" />
                      <script>
                        $("#search").on("click", function(){
                            var ajax_load = "<img src=\'js/loading_spinner.gif\' alt=\'loading...\' />";
                            var page = $(this).attr(\'href\');
                            var e = document.getElementById("department");
                            var strUser = e.options[e.selectedIndex].text;
                            $(\'#rightbottom\').html(ajax_load).load(\'index4.php\',{
                              department: strUser
                            });
                            return false;
                        });
                      </script>
                      </div>
                      </div>';
        }
        else{
          echo "Couldn't issue database query<br />";
          echo mysqli_error($dbc);
        }

    // Close connection to the database
    mysqli_close($dbc);

?>
