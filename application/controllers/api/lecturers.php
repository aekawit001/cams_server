<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class lecturers extends BD_Controller{
        
        function __construct()
        {
            parent::__construct();
            $this->load->model('lecturers_model');
            
        }

        function get_all_get(){         // all_get || all_post || all_delete
            $result = $this->lecturers_model->get_all();
            $this->response($result); 

        }
        function getsearch_get(){         // all_get || all_post || all_delete
            $keyword = $this->get('keyword');
            $result = $this->lecturers_model->getsearch_all($keyword);
            $this->response($result); 

        }

        function getteachcourses_get(){
            // $datetime = date('Y-m-d H:i:s');
            $teaching = $this->get('teachingID');
            // $startdate = $this->get("startdate");
            // if($startdate >= $datetime){
            // }
            $result = $this->lecturers_model->getteachcoursesmodel($teaching);

            $this->response($result);
        }

        function create_post(){
            // $user_id = $this->post('user_id');
            $firstName = $this->post('firstName');
            $lastName = $this->post('lastName');
            $email = $this->post('email');
            $phoneNumber = $this->post('phoneNumber');
            $data = [
                'lecturerID' => null,
                'roleID' => 2,
                'userID' => 1,
                'firstName' => $firstName,
                // 'user_id' => $user_id,
                'lastName' => $lastName,
                'phoneNumber' => $phoneNumber,
                'email' => $email
            ];
            $result = $this->lecturers_model->insert($data);
            $this->response($result);
        }
        
        function update_post(){
            $firstName = $this->post('firstName');
            $lastName = $this->post('lastName');
            $email = $this->post('email');
            $phoneNumber = $this->post('phoneNumber');
            $data = [
                'lecturerID' => null,
                'roleID' => 2,
                'userID' => null,
                'firstName' => $firstName,
                // 'user_id' => $user_id,
                'lastName' => $lastName,
                'phoneNumber' => $phoneNumber,
                'email' => $email
            ];
            $result = $this->lecturers_model->update($data);
            // $this->response([
            //     'status' => true,
            //     'response' => $result
            // ],REST_Controller::HTTP_OK);
            $this->response($result);

        }
        function historystudentabycourses_get(){
            $courseID = $this->get('courseID');
            $result = $this->lecturers_model->historystudentabycoursesmodel($courseID);
            $this->response($result); 
        }



        ///เริ่ม 
        function getlecturersbyCourse_get(){
            $courseID  = $this->get('courseID');
            $result = $this->lecturers_model->getlecturersbyCoursemodel($courseID);
            $this->response($result); 
        }

        function getCourseByteaching_get(){
            $lecturerID = $this->get('lecturerID');
            $result = $this->lecturers_model->getCourseByteachingmodel($lecturerID);
            $this->response($result);      
        }


        //วิชาทั้งหมดมาแสดง
        function getAllourse_get(){
            $result = $this->lecturers_model->getAlloursemodel();
            $this->response($result); 
        }

        // insert กำหนดการเรียนการสอน
        function createcouresbylecturer_post(){
            $teachingID = $this->post('teachingID');
            $courseID = $this->post('courseID');
            $lecturerID = $this->post('lecturerID');
            // $roleID = $this->post('roleID');
            $data = array(
                "teachingID" => $teachingID,
                "courseID"=> $courseID,
                "lecturerID" => $lecturerID,
                // "roleID" => $roleID,
            );
            $result = $this->lecturers_model->insertdatacreatecouresbylecturer($data);
            $this->response($result); 
            
        }

        // แสดงนักศึกษาทั้งหมด
        function getallstudentbycoures_get(){
            $students = $this->get('students');
            $result = $this->lecturers_model->getstudentbycouresmodel();
            $this->response($result);
        }
        // insert กำหนดการเรียนการสอน Teachs
        function createclassbyTeachs_post(){
            $classID = $this->post('classID');
            $courseID = $this->post('courseID');
            $roomID = $this->post('roomID');
            $starttime = $this->post('starttime');
            $endtime = $this->post('endtime');
            $startdate = $this->post('startdate');
            $startcheck = $this->post('startcheck');
            $endcheck = $this->post('endcheck');

            $resultchackdate = $this->lecturers_model->chackdatacreateclassbyTeachs($courseID,$startdate,$roomID);
            if(!$resultchackdate == $courseID && !$resultchackdate == $startdate && !$resultchackdate == $roomID){
                $data = array(
                    "courseID"=> $courseID,
                    'classID' => $this->post('classID'),
                    'roomID' => $this->post('roomID'),
                    'starttime' => $this->post('starttime'),
                    'endtime' => $this->post('endtime'),
                    'startdate' => $this->post('startdate'),
                    'startcheck' => $this->post('startcheck'),
                    'endcheck' => $this->post('endcheck'),
                );
                $result = $this->lecturers_model->insertdatacreateclassbyTeachs($data);
                $this->response($resultchackdate); 
                
            }else{
                $this->response([
                    'status' => false,
                    'message' => ''
                ], REST_Controller::HTTP_CONFLICT);
            }

            
        }

        // update courses
        function post_updatecourses_post(){
            $teachingID = $this->post('teachingID');
            $courseID = $this->post('courseID');
            $lecturerID = $this->post('lecturerID');
            $data = [
                'teachingID' => $teachingID,
                'courseID' => $courseID,
                'lecturerID' => $lecturerID,
            ];
            $result = $this->lecturers_model->update_courses($data);
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }

        //delete Course
        function get_delete_get(){
            $teachingID = $this->get('teachingID');
            $result = $this->lecturers_model->delete($teachingID);
            // $this->response($result); 

            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }

        // get BeforeCourse
        function getBeforeCourse_get(){
            $teachingID = $this->get('teachingID');
            $result = $this->lecturers_model->getBeforeCourse($teachingID);
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }

        // git history by Timetreatment
        function gethistorytimetreatment_get(){
            $courseID = $this->get('courseID');
            $lecturerID = $this->get('lecturerID');
            $result = $this->lecturers_model->historystudentabycoursesmodel($courseID);
            $this->response($result); 
        }

        // get room
        function getroom_get(){
            $result = $this->lecturers_model->getAllroom();
            $this->response($result); 
        }
        function get_delete_classid_get(){
            $classID = $this->get('classID');
            $result = $this->lecturers_model->delete_classid($classID);
            // $this->response($result); 
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }


        // function create_get(){
        //     $roomID = $this->get('roomID');
        //     $location = $this->get('location');
        //     $buildingID = $this->get('buildingID');
        //     $buildingName = $this->get('buildingName');
        //     $data = array(
        //         "roomID" => $roomID,
        //         "location" => $location,
        //         "buildingID" => $buildingID,
        //         "buildingName" => $buildingName
        //     );
    
        //     $data["room"] = array(
        //         'roomID' => $this->get("roomID"),
        //         'location' => $this->get("location"),
        //         'buildingID' => $this->get("buildingID") 
        //     );
        //     $data["building"] = array(
        //         'buildingName' => $this->get("buildingName"),
        //         'buildingID' => $this->get("buildingID")
        //     );
    
        //     $result = $this->insertlocation_model->insertdata($data);
    
        //     if ($result != null)
        //         {
        //             $this->response([
        //                 'status' => true,
        //                 'response' => $result
        //             ], REST_Controller::HTTP_OK); 
        //         }else{
        //         //error
        //             $this->response([
        //                 'status' => false,
        //                 'message' => ''
        //             ], REST_Controller::HTTP_CONFLICT);
        //         }
            
        //     /*error
        //     $this->response([
        //         'stetus' => false,
        //         'massage' => $result
        //     ], REST_Controller::HTTP_CONFLICT);*/
        // }

        // get studentby courses
        function get_studentByCourses_get(){
            $lecturerID = $this->get('lecturerID');
            $courseID = $this->get('courseID');
            $result = $this->lecturers_model->getsutdentByCourses_model($lecturerID,$courseID);
            $this->response($result);   
        }

        function get_all_sutdentByCourses_get(){
            $result = $this->lecturers_model->get_all_sutdentByCourses_model();
            $this->response($result); 
        }

        function insert_studentByCourses_post(){
            $courseID = $this->post('courseID');
            $studentID = $this->post('studentID');
            $resulcourseIDbystudent = $this->lecturers_model->get_all_studentsregeter_sutdentByCourses_model($courseID,$studentID);

            if(!$resulcourseIDbystudent == $courseID && !$resulcourseIDbystudent == $studentID){
                $data = array(
                    "courseID"=> $courseID,
                    "studentID" => $studentID
    
                );
                $result = $this->lecturers_model->insert_studentByCourses_model($data);
                $this->response($resulcourseIDbystudent); 
            }else{
                // $output['status'] = false;
                // $output['message'] = 'รายชื่อนักศึกษาซ้ำ';
                // $this->response($output, REST_Controller::HTTP_OK);
                $this->response([
                    'status' => false,
                    'message' => ''
                ], REST_Controller::HTTP_CONFLICT);
            }
        }

        function get_delete_studentByCourses_get(){
            $studentsregeterID = $this->get('studentsregeterID');
            $result = $this->lecturers_model->delete_studentByCourses_model($studentsregeterID);
            if ($result != null)
            {
                $this->response([
                    'status' => true,
                    'response' => $result
                ], REST_Controller::HTTP_OK); 
            }else{
                $this->response([
                    'status' => false,
                    'message' => ''
                ], REST_Controller::HTTP_CONFLICT);
            }
        }

        function get_id_history_student_get(){
            $courseID = $this->get('courseID');
            $studentID = $this->get('studentID');
            $result = $this->lecturers_model->get_id_history_student_get_model($studentID,$courseID);
            $this->response($result);   
        }
            
    }
?>