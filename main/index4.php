<?php
	$department = $_POST['department'];
    require_once('../includes/mysqli_connect.php');
    require_once('../core/init.php');
	// Create a query for the database
    $query2 = "SELECT class_number, class_name, class_id FROM classes WHERE department='" . $department ."'";
    // Get a response from the database by sending the connection and the query
    $response = @mysqli_query($dbc, $query2);
    echo '<script>
	function compare(grade1,term1,grade2,term2){
		if((grade1 == grade2) & (term1 == term2)){
			return 0;
		}
		else if(grade1 == grade2){
			if(term1 == \'Fall\'){
				return -1;
			}
			else{
				return 1;
			}
		}
		else{
			if(grade1 == \'Freshman\'){
				return -1;
			}
			else if(grade1 == \'Senior\'){
				return 1;
			}
			else if(grade1 == \'Sophomore\'){
				if(grade2 == \'Freshman\'){
					return 1;
				}
				else{
					return -1;
				}
			}
			else{
				if(grade2 == \'Senior\'){
					return -1;
				}
				else{
					return 1;
				}
			}
		}
	}</script>';
    // If the query executed properly proceed
    if($response){
    // mysqli_fetch_array will return a row of data from the query
    // until no further data is available
        echo '<div class="container col-lg-12">
           <table id="browse" class="table table-striped">
          <tbody>';
    while($row = mysqli_fetch_array($response)){
          echo '<tr>';
          echo '<td>' . $department . ' ' . $row['class_number'] . ': ' . $row['class_name'] . '</td>';
          echo '<td id="' . $row['class_id'] . '" class="browsing" style="cursor:pointer">
          <input type="hidden" class="classnumber" id="' . $row['class_id'] . '" value="' . $row['class_number'] . '">
          <input type="hidden" class="classname" id="' . $row['class_id'] . '" value="' . $row['class_name'] . '">
          <div class="glyphicon glyphicon-plus">		
	      </div>
          </td>
          </tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<script>
	          	$("#browse").on("click",".browsing",function(){
	          		var classid = $(this).attr("id");
	          		if($("#" + classid + ".deleterow").length == 0){
		          		var grade1 = document.getElementById("grade");
		                var grade = grade1.options[grade1.selectedIndex].text;
		          		var term1 = document.getElementById("term");
		                var term = term1.options[term1.selectedIndex].text;
		          		$.post("addentry.php",
		                {
		                  grade: grade,
		                  term: term,
		                  class_id: classid
		                });
						var classnumba = $("#" + classid + ".classnumber").attr("value");
						var mystring = $("#" + classid + ".classname").attr("value");
						var mystring2 = mystring.replace(/\'/g , "\\\'");
						var rows = $(\'<tr><td>' . $department . '\' + classnumba + \'' . ': ' . '\' + mystring2 + \'</td><td class="deleterow" id="\' + classid + \'" style="cursor:pointer" align="right"><div class="glyphicon glyphicon-remove">\' + \'</div></td></tr>\');
						rows.hide();
						if($("#"+grade + "x" + term).length > 0){
							$("#"+grade + "x" + term).append(rows);
							rows.fadeIn(1000);
						}
						else if(!(grade == "---Grade---") & !(term =="---Term---")){
							$tables = $(".classes");
							$changed = 0;
							var rows2 = $(\'<h2 id="bang\' + grade + term + \'">\' + grade + " " + term + \'</h2><table id="\' + grade + "x" + term + \'" class="table table-striped table-hover classes"><tbody></tbody></table>\');
							for(i = 0; i < $tables.length; i++){
								$arr = ($tables[i].id).split("x");
								$grade1 = $arr[0];
								$term1 = $arr[1];
								if(compare(grade,term,$grade1,$term1) == -1){
									$("#bang" + $grade1 + $term1).before(rows2);
									$changed = 1;
									break;
								}
							}
							if($tables.length == 0){
								document.getElementById("left").appendChild(rows2[0]);
								document.getElementById("left").appendChild(rows2[1]);
							}
							else if($changed == 0){
								$("#" + ($tables[$tables.length - 1].id)).after(rows2);
							}
							rows2.fadeIn(1000);
							$("#"+grade + "x" + term).append(rows);
							rows.fadeIn(1000);
							$("#" + grade + "x" + term).on("click", ".deleterow", function(){
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
					                  var len = $("#" + grade + "x" + term + " tr").length;
					                  if(len == 0){
					                    var $table = $("#bang" + grade + term);
					                    $table.fadeOut(1000, function(){
					                      $table.remove();
					                      $("#" + grade + "x" + term).remove();
					                    });
					                  }
					                });
				                
				            });
						}
					}
	          	});
	          </script>';
        echo '</div>';
    }
    else {
      echo "Couldn't issue database query<br />";
      echo mysqli_error($dbc);
    }
    mysqli_close($dbc);
?>