
<?php
	  require_once('../core/init.php');
      require_once('../includes/header.php');
      echo '<div class="col-xs-12" style="height:75px;"></div>
      <div class="row">   
        <div class="container col-lg-6">
            <h3 class="page-header">Requirements</h3>
        </div>
      </div>';
    	require_once('../includes/mysqli_connect.php');
    	$result = @mysqli_query($dbc,'SELECT concentration FROM students WHERE facebook_id = ' . $_SESSION['user_id']);
    	if($result){
		    $row = @mysqli_fetch_array($result);
		    $conc = $row['concentration'];
		    if($conc == 'Computer Science'){
		    	#basic mathematics
		    	#math first semester
				$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (department=\'MATH\' AND class_number IN (\'1a\',\'21a\',\'23a\',\'25a\',\'55a\'))
																																				   OR (department=\'APMTH\' AND class_number=\'21a\'))');
		    	$row = @mysqli_fetch_array($result);
		    	#math second semester
		    	$result2 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (department=\'MATH\' AND class_number IN (\'1b\',\'21b\',\'23b\',\'25b\',\'55b\',\'121\'))
																																				   OR (department=\'APMTH\' AND class_number=\'21b\'))');
		    	$row2 = @mysqli_fetch_array($result2);
		    	$count = min(1,$row[0]) + min(1,$row2[0]);
		    	if($count == 2){
		    		echo '<p>Basic math requirement met</p>';
		    	}
		    	else{
		    		echo '<p>Basic math requirement not met</p>';
		    	}

		    	#theory
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'COMPSCI\' AND class_number=\'121\')');
		    	$row = @mysqli_fetch_array($result);
		    	$result2 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (department=\'COMPSCI\' AND class_number IN (\'124\',\'125\',\'127\',\'221\', \'222\', \'223\', \'224\', \'225\', \'226r\', \'227r\', \'228\', \'229r\')))');
		    	$row2 = @mysqli_fetch_array($result2);
		    	$count1 = $row[0] + $row2[0];
		    	$result3 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (department=\'APMTH\' AND class_number IN (\'106\',\'107\'))');
		    	$row3 = @mysqli_fetch_array($result3);
		    	$countstar = $row3[0];
		    	$countprime = $count1 + $countstar;
		    	echo '<p>' . $countprime . ' out of 2 Theory courses taken' . '</p>';

		    	#systems
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'COMPSCI\' AND class_number=\'50\')');
		    	$row = @mysqli_fetch_array($result);
		    	$result2 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'COMPSCI\' AND class_number=\'51\')');
		    	$row2 = @mysqli_fetch_array($result2);
		    	$count2 = $row[0] + $row2[0];
		    	echo '<p>' . $count2 . ' out of 2 Systems courses taken' . '</p>';

		    	#technical electives
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'COMPSCI\')');
		    	$row = @mysqli_fetch_array($result);
		    	$count = $row[0];
		    	$result2 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (class_id IN (\'7152\',\'483\',\'484\',\'488\'))');
		    	$row2 = @mysqli_fetch_array($result2);
		    	$extr = $row2[0];
		    	$count = $count - $count1 - $count2 + $extr;
		    	echo '<p>' . $count . ' out of 4 additional Computer Science courses taken' . '</p>';

		    	#breadth requirement
		    	$result1 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'COMPSCI\' AND ((class_id >= 1348) AND (class_id <= 1352)) )');
		    	$row1 = @mysqli_fetch_array($result1);
		    	$result2 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'COMPSCI\' AND ((class_id >= 1353) AND (class_id <= 1354)) )');
		    	$row2 = @mysqli_fetch_array($result2);
		    	$result3 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'COMPSCI\' AND (((class_id >= 1355) AND (class_id <= 1357)) OR (class_id = 1338)))');
		    	$row3 = @mysqli_fetch_array($result3);
		    	$result4 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'COMPSCI\' AND ((class_id >= 1358) AND (class_id <= 1360)) )');
		    	$row4 = @mysqli_fetch_array($result4);
		    	$result5 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'COMPSCI\' AND ((class_id >= 1361) AND (class_id <= 1365)) )');
		    	$row5 = @mysqli_fetch_array($result5);
		    	$count = min($row1[0],1) + min($row2[0],1) + min($row3[0],1) + min($row4[0],1) + min($row5[0],1);
		    	echo '<p>' . $count . ' out of 2 Breadth requirements met' . '</p>';
		    }
			else if($conc == 'Earth and Planetary Sciences'){
				# three intro classes
				$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'E-PSCI\' AND (class_number=\'5\' OR class_number=\'131\' OR class_number=\'132\' OR class_number=\'133\'))');
		    	$row = @mysqli_fetch_array($result);
		    	$result2 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'E-PSCI\' AND class_number=\'7\')');
		    	$row2 = @mysqli_fetch_array($result2);
		    	$result3 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'E-PSCI\' AND class_number=\'8\')');
		    	$row3 = @mysqli_fetch_array($result3);
		    	$count = $row[0] + $row2[0] + $row3[0];
		    	echo '<p>' . $count . ' out of 3 Introductory EPS half-courses taken' . '</p>';

				# physics
		    	# physics 11
		    	$result1 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'PHYSICS\' AND (class_number=\'11a\' OR class_number=\'11b\'))');
		    	$row1 = @mysqli_fetch_array($result1);
		    	$count1 = $row1[0];

		    	# physics 15
		    	# just do a physics requirement met
		    	$result2 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'PHYSICS\' AND (class_number=\'15a\' OR class_number=\'15b\' OR class_number=\'15c\'))');
		    	$row2 = @mysqli_fetch_array($result2);
		    	$count2 = $row2[0];

		    	if($count1 == 2 || $count2 == 3){
		    		echo '<p>Physics 11a and 11b, or 15a, 15b, and 15c requirement met</p>';
		    	}
		    	else{
		    		echo '<p>Physics 11a and 11b, or 15a, 15b, and 15c requirement not met</p>';
		    	}

				# chemistry
		    	$result11 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (class_id=\'5849\'))');
		    	$row11 = @mysqli_fetch_array($result11);
		    	$count11 = $row11[0];
		    	$result12 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (department=\'CHEM\'))');
		    	$row12 = @mysqli_fetch_array($result12);
		    	$count12 = $row12[0];
		    	$count1 = $count11 + min(1,$count12);

		    	$result2 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (class_id=\'2003\' OR department=\'CHEM\'))');
		    	$row2 = @mysqli_fetch_array($result2);
		    	$count2 = $row2[0];

		    	if($count1 == 2 || $count2 >= 1){
		    		echo '<p>Chemistry requirement met</p>';
		    	}
		    	else{
		    		echo '<p>Chemistry requirement not met</p>';
		    	}

				# math
				$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (department=\'MATH\' AND class_number IN (\'21a\',\'23a\',\'25a\',\'55a\'))
																																				   OR (department=\'APMTH\' AND class_number=\'21a\'))');
		    	$row = @mysqli_fetch_array($result);
		    	#math second semester
		    	$result2 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (department=\'MATH\' AND class_number IN (\'21b\',\'23b\',\'25b\',\'55b\'))
																																				   OR (department=\'APMTH\' AND class_number=\'21b\'))');
		    	$row2 = @mysqli_fetch_array($result2);
		    	$count = min(1,$row[0]) + min(1,$row2[0]);
		    	if($count == 2){
		    		echo '<p>Basic math requirement met</p>';
		    	}
		    	else{
		    		echo '<p>Basic math requirement not met</p>';
		    	}

				# three additional eps half courses
				$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'E-PSCI\' AND class_number NOT IN (\'5\',\'7\',\'8\'))');
		    	$row = @mysqli_fetch_array($result);
		    	$count = $row[0];
		    	echo '<p>' . $count . 'out of 3 additional EPS half-courses taken</p>';

				# additional courses in eps or related fields
			}
			else if($conc == 'Economics'){
				# math prep
				$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MATH\' AND class_number NOT IN (\'Ma\',\'Mb\'))');
		    	$row = @mysqli_fetch_array($result);
		    	if($row[0] >= 1){
		    		echo '<p>Basic math requirement met</p>';
		    	}
		    	else{
		    		echo '<p>Basic math requirement not met</p>';
		    	}

				# social analysis 10
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'ECON\' AND class_number IN (\'10a\',\'10b\'))');
		    	$row = @mysqli_fetch_array($result);
		    	echo '<p>' . $row[0] . ' out of 2 Social Analysis 10 courses taken' . '</p>';

				# econ 970
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'ECON\' AND class_number = \'970\')');
		    	$row = @mysqli_fetch_array($result);
		    	if($row[0] >= 1){
		    		echo '<p>Economics 970 requirement met</p>';
		    	}
		    	else{
		    		echo '<p>Economics 970 requirement not met</p>';
		    	}

				# stat 100, 104, 110, or math 191
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (department=\'STAT\' AND class_number IN (\'100\',\'104\',\'110\'))
		    																																	   OR (department=\'MATH\' AND class_number = \'191\'))');
		    	$row = @mysqli_fetch_array($result);
		    	if($row[0] >= 1){
		    		echo '<p>Stat 100/104/110 or Math 191 requirement met</p>';
		    	}
		    	else{
		    		echo '<p>Stat 100/104/110 or Math 191 requirement not met</p>';
		    	}

				# econ 1010a/1011a
				$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'ECON\' AND class_number IN (\'1010a\',\'1011a\'))');
		    	$row = @mysqli_fetch_array($result);
		    	if($row[0] >= 1){
		    		echo '<p>Economics 1010a/1011a requirement met</p>';
		    	}
		    	else{
		    		echo '<p>Economics 1010a/1011a requirement not met</p>';
		    	}

				# econ 1010b/1011b
				$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'ECON\' AND class_number IN (\'1010b\',\'1011b\'))');
		    	$row = @mysqli_fetch_array($result);
		    	if($row[0] >= 1){
		    		echo '<p>Economics 1010b/1011b requirement met</p>';
		    	}
		    	else{
		    		echo '<p>Economics 1010b/1011b requirement not met</p>';
		    	}

				# econ 1123/1126
				$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'ECON\' AND class_number IN (\'1123\',\'1126\'))');
		    	$row = @mysqli_fetch_array($result);
		    	if($row[0] >= 1){
		    		echo '<p>Economics 1123/1126 requirement met</p>';
		    	}
		    	else{
		    		echo '<p>Economics 1123/1126 requirement not met</p>';
		    	}
			}
			else if($conc == 'Mathematics'){
		    	# 8 math courses
		    	$resulttot = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MATH\')');
		    	$rowtot = @mysqli_fetch_array($resulttot);
		    	$resultMaMb = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MATH\' AND (class_number = \'Ma\' OR class_number == \'Mb\'))');
		    	$rowMaMb = @mysqli_fetch_array($resultMaMb);
		    	$result60r = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MATH\' AND (class_number = \'60r\'))');
		    	$row60r = @mysqli_fetch_array($result60r);
		    	$count60r = $row60r[0];
		    	$countMaMb = $rowMaMb[0];
		    	$tot = $rowtot[0];
		    	# if you took both Ma and Mb then it only counts once
		    	# if you took only one of Ma and Mb then it doesn't count at all
		    	if($countMaMb > 0){
		    		$tot = $tot - 1;
		    	}
		    	if($count60r > 0){
		    		$tot = $tot - 1;
		    	}
		    	echo '<p>' . $tot . ' out of 8 Mathematics courses taken' . '</p>';

		    	# 4 math courses over 100 level
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MATH\' AND class_id >= 4912)');
		    	$row = @mysqli_fetch_array($result);
		    	echo '<p>' . $row[0] . ' out of 4 Mathematics courses over the 100 level taken' . '</p>';

		    	# analysis, algebra, geometry
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MATH\' AND class_id >= 4914 AND class_id <= 4921)');
		    	$row = @mysqli_fetch_array($result);
		    	echo '<p>' . $row[0] . ' out of 1 Analysis courses taken' . '</p>';
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MATH\' AND class_id >= 4922 AND class_id <= 4926)');
		    	$row = @mysqli_fetch_array($result);
		    	echo '<p>' . $row[0] . ' out of 1 Algebra courses taken' . '</p>';
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MATH\' AND class_id >= 4927 AND class_id <= 4931)');
		    	$row = @mysqli_fetch_array($result);
		    	echo '<p>' . $row[0] . ' out of 1 Geometry courses taken' . '</p>';

		    	# four related subjects

		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN 
		    								 (SELECT class_id FROM classes WHERE 
		    								 	(department=\'APMTH\' AND (class_number IN (\'21a\',\'21b\',\'50hf\',\'101\',\'105a\',\'105b\',\'106\',\'107\',\'111\',\'115\',\'120\',\'147\',\'201\',\'202\',\'203\',\'205\',\'210\',\'211\',\'212\',\'213\')))
		    								 OR (department=\'ASTRON\' AND (class_number IN (\'145\',\'150\',\'193\')))
		    								 OR (department=\'OEB\' AND (class_number IN (\'152\',\'181\',\'252\')))
		    								 OR (department=\'MCB\' AND (class_number=\'140\'))
		    								 OR (department=\'CHEM\' AND (class_number IN (\'160\',\'161\',\'242\')))
		    								 OR (department=\'COMPSCI\' AND (class_number IN (\'51\',\'121\',\'124\',\'187\',\'220r\',\'221\',\'222\',\'223\',\'224r\',\'225\',\'226r\',\'228\',\'277\')))
		    								 OR (department=\'ECON\' AND (class_number IN (\'1052\',\'2010a\',\'2010b\',\'2010c\',\'2052\',\'2120\')))
		    								 OR (department=\'ENG-SCI\' AND (class_number IN (\'102\',\'123\',\'125\',\'145\',\'148\',\'156\',\'181\',\'201\',\'202\',\'203\',\'209\',\'210\',\'220\',\'241\',\'255\')))
		    								 OR (department=\'MATH\')
		    								 OR (department=\'PHIL\' AND class_number=\'144\')
		    								 OR (department=\'APPPHY\')
		    								 OR (department=\'PHYSICS\' AND (class_number NOT IN (\'90r\',\'91r\',\'95\',\'120\',\'123\',\'191r\')))
		    								 OR (department=\'STAT\' AND (class_number IN (\'110\',\'111\',\'139\',\'140\',\'170\',\'171\',\'210\',\'211\',\'214\',\'215\',\'220\',\'221\'))))');
		    	$row = @mysqli_fetch_array($result);
		    	if($tot > 8){
		    		$count = $tot - 8 + $row[0];
		    	}
		    	else{
		    		$count = $row[0];
		    	}

		    	# applied math



		    	echo '<p>' . $count . ' out of 4 Mathematics or Related Subjects courses taken' . '</p>';
		    }
			else if($conc == 'Music'){
				# Theory 1
				$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MUSIC\' AND class_number=\'51a\')');
		    	$row = @mysqli_fetch_array($result);
		    	$result2 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MUSIC\' AND class_number=\'51b\')');
		    	$row2 = @mysqli_fetch_array($result2);
		    	$count = $row[0] + $row2[0];
		    	echo '<p>' . $count . ' out of 2 Theory I courses taken' . '</p>';

		    	# Theory 2
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MUSIC\' AND class_number=\'150a\')');
		    	$row = @mysqli_fetch_array($result);
		    	$result2 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MUSIC\' AND class_number=\'150b\')');
		    	$row2 = @mysqli_fetch_array($result2);
		    	$count = $row[0] + $row2[0];
		    	echo '<p>' . $count . ' out of 2 Theory II courses taken' . '</p>';

		    	# Western Music History and Repertory
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MUSIC\' AND class_number=\'97a\')');
		    	$row = @mysqli_fetch_array($result);
		    	$result2 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MUSIC\' AND class_number=\'97b\')');
		    	$row2 = @mysqli_fetch_array($result2);
		    	$result3 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MUSIC\' AND class_number=\'97c\')');
		    	$row3 = @mysqli_fetch_array($result3);
		    	$count = $row[0] + $row2[0] + $row3[0];
		    	echo '<p>' . $count . ' out of 3 Western Music History and Repertory courses taken' . '</p>';

		    	# topics in musicology
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MUSIC\' AND ((class_id >= 5339 AND class_id <= 5350) OR class_id = 5329 OR class_id = 5330))');
		    	$row = @mysqli_fetch_array($result);
		    	$count1 = $row[0];
		    	echo '<p>' . $count1 . ' out of 2 Topics in Musicology courses taken' . '</p>';

		    	# advanced theory
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MUSIC\' AND (class_id >= 5313 AND class_id <= 5321))');
		    	$row = @mysqli_fetch_array($result);
		    	$count2 = $row[0];
		    	echo '<p>' . $count2 . ' out of 2 Advanced Theory courses taken' . '</p>';

		    	# electives
		    	$count3 = 0;
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'MUSIC\' AND (class_id = 5322 OR class_id = 5323 OR class_id = 5324 OR class_id = 5327 OR class_id = 5297 OR class_id = 5306 OR class_id = 5307 OR class_id = 5308))');
		    	$row = @mysqli_fetch_array($result);
		    	if($count1 > 2){
		    		$count3 = $count3 + ($count1 - 2);
		    	}
		    	if($count2 > 2){
		    		$count3 = $count3 + ($count2 - 2);
		    	}
		    	echo '<p>' . $count3 . ' out of 2 elective courses taken' . '</p>';
			}
			else if($conc == 'Physics'){
		    	# 15a, 15b, 15c, 143a
		    	$result = @mysqli_query($dbc,'SELECT * FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'PHYSICS\' AND class_number IN (\'15a\',\'16\'))');
		    	echo '<p>Physics 15a (or 16) requirement ';
		    	if(@mysqli_fetch_array($result))
		    	{
		    		echo 'satisfied</p>';
		    	}
		    	else{
		    		echo 'not satisfied</p>';
		    	}

		    	$result = @mysqli_query($dbc,'SELECT * FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'PHYSICS\' AND class_number=\'15b\')');
		    	echo '<p>Physics 15b requirement ';
		    	if(@mysqli_fetch_array($result))
		    	{
		    		echo 'satisfied</p>';
		    	}
		    	else{
		    		echo 'not satisfied</p>';
		    	}

		    	$result = @mysqli_query($dbc,'SELECT * FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'PHYSICS\' AND class_number=\'15c\')');
		    	echo '<p>Physics 15c requirement ';
		    	if(@mysqli_fetch_array($result))
		    	{
		    		echo 'satisfied</p>';
		    	}
		    	else{
		    		echo 'not satisfied</p>';
		    	}

		    	$result = @mysqli_query($dbc,'SELECT * FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'PHYSICS\' AND class_number=\'143a\')');
		    	echo '<p>Physics 143a requirement ';
		    	if(@mysqli_fetch_array($result))
		    	{
		    		echo 'satisfied</p>';
		    	}
		    	else{
		    		echo 'not satisfied</p>';
		    	}

		    	#basic mathematics
		    	#math first semester
				$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (department=\'MATH\' AND class_number IN (\'21a\',\'23a\',\'25a\',\'55a\'))
																																				   OR (department=\'APMTH\' AND class_number=\'21a\'))');
		    	$row = @mysqli_fetch_array($result);
		    	#math second semester
		    	$result2 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (department=\'MATH\' AND class_number IN (\'21b\',\'23b\',\'25b\',\'55b\'))
																																				   OR (department=\'APMTH\' AND class_number=\'21b\'))');
		    	$row2 = @mysqli_fetch_array($result2);
		    	$count = min(1,$row[0]) + min(1,$row2[0]);
		    	if($count == 2){
		    		echo '<p>Basic math requirement met</p>';
		    	}
		    	else{
		    		echo '<p>Basic math requirement not met</p>';
		    	}

		    	# two additional half courses in physics
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN 
		    								 (SELECT class_id FROM classes WHERE 
		    									(department=\'PHYSICS\' AND (class_number NOT IN (\'15a\',\'15b\',\'15c\',\'16\',\'143a\',\'11a\',\'11b\')))
		    								 OR (department=\'APMTH\' AND (class_number IN (\'201\',\'202\')))
		    								 OR	(department=\'APPHY\')
		    								 OR (department=\'ASTRON\' AND (class_number IN (\'145\',\'150\',\'151\',\'191\')))
		    								 OR (department=\'CHEM\' AND (class_number IN (\'160\',\'161\',\'242\')))
		    								 OR (department=\'ENG-SCI\' AND (class_number IN (\'120\',\'123\',\'125\',\'128\',\'151\',\'154\',\'173\',\'174\',\'181\',\'190\'))))');
		    	$row = @mysqli_fetch_array($result);
		    	$count = $row[0];
		    	echo '<p>' . $count . ' out of 2 additional Physics courses taken' . '</p>';

		    	# related courses
		    	# unedited and copied so far
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN 
		    								 (SELECT class_id FROM classes WHERE 
		    									(department=\'APMTH\')
		    								 OR (department=\'APPHY\')
		    								 OR	(department=\'ASTRON\' AND (class_number NOT IN (\'1\',\'2\')))
		    								 OR (department=\'BIOPHYS\' AND (class_number = \'164r\'))
		    								 OR (department=\'CHEM\')
		    								 OR (department=\'COMPSCI\')
		    								 OR (department=\'E-PSCI\' AND ((class_number IN (\'108\',\'121\',\'131\',\'132\',\'133\',\'140\',\'161\',\'166\',\'167\')) OR (class_id >= 1584 AND class_id <= 1624)))
		    								 OR (department=\'ENG-SCI\')
		    								 OR (class_id >= 4912 AND class_id <= 5025)
		    								 OR (department=\'STAT\' AND class_number NOT IN (\'100\',\'101\',\'102\',\'104\')))');
		    								 
		    	$row = @mysqli_fetch_array($result);
		    	$count2 = $row[0];
		    	if($count > 2){
		    		$count2 = $count2 + ($count - 2);
		    	}
		    	echo '<p>' . $count2 . ' out of 4 additional Physics courses or related fields courses taken' . '</p>';
		    }
			else if($conc == 'Statistics'){
				# Stat 110/111
				$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'STAT\' AND class_number = \'110\')');
		    	$row = @mysqli_fetch_array($result);
		    	if($row[0] >= 1){
		    		echo '<p>Stat 110 requirement met</p>';
		    	}
		    	else{
		    		echo '<p>Stat 110 requirement not met</p>';
		    	}
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE department=\'STAT\' AND class_number = \'111\')');
		    	$row = @mysqli_fetch_array($result);
		    	if($row[0] >= 1){
		    		echo '<p>Stat 111 requirement met</p>';
		    	}
		    	else{
		    		echo '<p>Stat 111 requirement not met</p>';
		    	}
				# seven stats half-courses
				$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN 
		    								 (SELECT class_id FROM classes WHERE 
		    								 (department=\'STAT\' AND (class_number IN (\'100\',\'101\',\'102\',\'104\',\'105\',\'110\',\'111\',\'120\',\'123\',\'131\',\'135\',\'139\',\'140\',\'155\',\'149\',\'160\',\'170\',\'171\',\'91r\',\'99hf\')))
		    								 OR (class_id >= 7168 AND class_id <= 7188)
											 )');
				$row = @mysqli_fetch_array($result);
				$count11 = $row[0];
				$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN 
		    								 (SELECT class_id FROM classes WHERE 
		    								 (department=\'STAT\' AND (class_number = \'91r\' OR class_number = \'99hf\')))
											 )');
				$row = @mysqli_fetch_array($result);
				$count1 = $row[0];
				$count1 = $count1 + $count11;
				echo '<p>' . $count1 . 'out of 7 Statitics courses taken</p>';
				# five additional half-courses in stats/related courses
		    	$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN 
		    								 (SELECT class_id FROM classes WHERE 
		    								 (department=\'APMTH\' AND (class_number IN (\'21a\', \'21b\', \'105a\', \'105b\', \'106\', \'107\', \'111\', \'115\', \'120\', \'121\')))
		    								 OR	(department=\'ASTRON\' AND class_number = \'193\')
		    								 OR (department=\'BIOPHYS\' AND (class_number IN (\'101\')))
		    								 OR (department=\'COMPSCI\' AND (class_number IN (\'50\',\'51\')))
		    								 OR (department=\'ECON\' AND (class_number IN (\'1123\', \'1126\', \'1127\', \'2110\', \'2120\', \'2130\', \'2140\', \'2142\', \'2144\', \'2146\')))
		    								 OR (department=\'ENG-SCI\' AND (class_number IN (\'201\', \'202\', \'203\')))
		    								 OR (department=\'GOV\' AND (class_number IN (\'1010\', \'2000\', \'2001\', \'2002\', \'2003\')))
		    								 OR (department=\'MATH\' AND (class_number IN (\'19a\', \'19b\', \'21a\', \'21b\', \'23a\', \'23b\', \'25a\', \'25b\', \'106\', \'112\', \'113\', \'115\', \'116\', \'121\', \'122\', \'123\')))
		    								 OR (department=\'MCB\' AND class_number = \'111\')
		    								 OR (department=\'OEB\' AND class_number = \'152\')
		    								 OR (department=\'PHYSICS\' AND class_number IN (\'181\',\'262\')))
											 OR (department=\'PSY\' AND (class_number IN (\'1950\', \'1951\', \'1952\')))
											 OR (class_id >= 7147 AND class_id <= 7188)
											 )');
		    	$row = @mysqli_fetch_array($result);
		    	$count2 = $row[0];
		    	$count2 = $count2 - $count11;
		    	if($count1 > 7){
		    		$count2 = $count2 + ($count1 - 7);
		    	}
		    	echo '<p>' . $count2 . 'out of 5 additional Statistics or related courses taken</p>';

				#basic mathematics
		    	#math first semester
				$result = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (department=\'MATH\' AND class_number IN (\'19a\',\'21a\',\'23a\',\'25a\',\'55a\'))
																																				   OR (department=\'APMTH\' AND class_number=\'21a\'))');
		    	$row = @mysqli_fetch_array($result);
		    	#math second semester
		    	$result2 = @mysqli_query($dbc,'SELECT COUNT(*) FROM classlog WHERE facebook_id = ' . $_SESSION['user_id'] . ' AND class_id IN (SELECT class_id FROM classes WHERE (department=\'MATH\' AND class_number IN (\'19b\',\'21b\',\'23b\',\'25b\',\'55b\'))
																																				   OR (department=\'APMTH\' AND class_number=\'21b\'))');
		    	$row2 = @mysqli_fetch_array($result2);
		    	$count = min(1,$row[0]) + min(1,$row2[0]);
		    	if($count == 2){
		    		echo '<p>Basic math requirement met</p>';
		    	}
		    	else{
		    		echo '<p>Basic math requirement not met</p>';
		    	}
			}
			else{
				echo '<p>Requirements not made for this concentration yet =(</p>';
			}
		}
	    else{
	      echo "Couldn't issue database query<br />";
	      echo mysqli_error($dbc);
	    }	
      require_once('../includes/footer.php');
?>