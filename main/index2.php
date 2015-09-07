<?php
    require_once('../core/init.php');
    require_once('../includes/mysqli_connect.php');

    // Create a query for the database
    $query = "SELECT class_id,year,term FROM classlog WHERE facebook_id=" . $_SESSION['user_id'] . " GROUP BY year,term ORDER BY year,term";

    // Get a response from the database by sending the connection
    // and the query
    $response = @mysqli_query($dbc, $query);

    // If the query executed properly proceed
    if($response){
    // mysqli_fetch_array will return a row of data from the query
    // until no further data is available

    while($row = mysqli_fetch_array($response)){

      echo '<h2 id="negros' . $row['year'] . $row['term'] . '">' . $row['year'] . ' ' . $row['term'] . '</h2>';
      //echo '<p>' . $row['year'] . '\'' . $row['term'] . ' ' . $row['year_numerical'] . '</p>';
      echo '<table id="' . $row['year'] . 'x' . $row['term'] . '" class="table table-striped table-hover classes"><tbody>';
      $query2 = "SELECT class_id FROM classlog WHERE facebook_id=" . $_SESSION['user_id'] . " AND year='" . $row['year'] . "' AND term='" . $row['term'] . "'";
      $response2 = @mysqli_query($dbc, $query2);
      while($row2 = mysqli_fetch_array($response2)){
       //echo '<p>' . $row2['class_id'] . ' ' . $row['year'] . ' ' . $row['term'] . ' ' . $row['year_numerical'] . '</p>';
      if($response2){
        $query3 = "SELECT department,class_number,class_name FROM classes WHERE class_id=" . $row2['class_id'];
        $response3 = @mysqli_query($dbc, $query3);
        if($response3){
          $row3 = mysqli_fetch_array($response3);
          echo '<tr>';
          echo '<td>' . $row3['department'] . ' ' . $row3['class_number'] . ': ' . $row3['class_name'] . '</td>';
          echo '<td class="deleterow" id=\'' . $row2['class_id'] . '\' style="cursor:pointer" align="right">
          <div class=\'glyphicon glyphicon-remove\'>
          </div>
          </td>';
          echo '</tr>';
        }
        else {
          echo "Couldn't issue database query<br />";
          echo mysqli_error($dbc);
        }
      }
      else{
          echo "Couldn't issue database query<br />";
          echo mysqli_error($dbc);
      }
    }
        echo '</tbody>';
        echo '</table>';
        echo '<script>
            $("#' . $row['year'] . 'x' . $row['term'] . '").on("click", ".deleterow", function(){
                var id = $(this).attr("id");
                $.post("deleteentry.php",
                {
                  dummy: id
                });
                var thisobj = $(\'#\' + id + \'.deleterow\');
                var $killrow = thisobj.parent(\'tr\');
                $killrow.addClass("danger");
                $killrow.fadeOut(1000, function(){
                  $killrow.remove();
                  var len = $("#' . $row['year'] . 'x' . $row['term'] . ' tr").length;
                  if(len == 0){
                    var $table = $("#negros' . $row['year'] . $row['term'] . '");
                    $table.fadeOut(1000, function(){
                      $table.remove();
                       $("#' . $row['year'] . 'x' . $row['term'] . '").remove();
                    });
                  }
                });
                
            });
        </script>';

    }
    } else {
      echo "Couldn't issue database query<br />";
      echo mysqli_error($dbc);
    }
    // Close connection to the database
    mysqli_close($dbc);

?>
