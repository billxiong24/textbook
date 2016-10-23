<?php

    $courses = array();
    $response = file_get_contents('https://streamer.oit.duke.edu/curriculum/list_of_values/fieldname/SUBJECT?access_token=dd446a05afe43933838100617bcdca04');
    $response = json_decode($response,true);
    $response = $response['scc_lov_resp']['lovs']['lov']['values']['value'];
    for($i=0; $i<count($response); $i++){
        $subjectSearch = $response[$i]['code'] . " - " . $response[$i]['desc'];
        $subjectSearch = str_replace(" ", "%20", $subjectSearch);
        $subjectSearch = str_replace("/", "%2F", $subjectSearch);
        $courseResponse = @file_get_contents("https://streamer.oit.duke.edu/curriculum/courses/subject/$subjectSearch?access_token=dd446a05afe43933838100617bcdca04"); // the @ supresses error message
        if ($courseResponse == false){
            continue; // if the file_get_contents does not work, then skip this loop
        }
        $courseResponse = json_decode($courseResponse,true);
        $entries = intval($courseResponse['ssr_get_courses_resp']['course_search_result']['ssr_crs_srch_count']);
        $courseResponse = $courseResponse['ssr_get_courses_resp']['course_search_result']['subjects']['subject']['course_summaries']['course_summary'];
        if ($entries>1) {
            for ($j=0; $j<$entries; $j++){
                $subject = $courseResponse[$j]['subject'];
                $class_nbr = $courseResponse[$j]['catalog_nbr'];
                $class_title = $courseResponse[$j]['course_title_long'];
                $class = $subject . $class_nbr . " - " . $class_title;
                array_push($courses, $class);  

            }
        }
        else if ($entries == 1) { // the course summary doesn not consist of arrays, but instead is the array of data if there is only one value
                $subject = $courseResponse['subject'];
                $class_nbr = $courseResponse['catalog_nbr'];
                $class_title = $courseResponse['course_title_long'];
                $class = $subject . " " . $class_nbr . " - " . $class_title;
                array_push($courses, $class);  
   
        }
        
        
    }
    
    $courses = array("courses"=>$courses);
     file_put_contents('courses.json', json_encode($courses));



?>