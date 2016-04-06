<?php

class CityController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
         $city_model = new Application_Model_City();
        $this->view->city = $city_model->listCity();

    }

    public function listAction()
    {
        // action body
        $city_model = new Application_Model_City();
        $this->view->city = $city_model->listCity();
    }

    public function deleteAction()
    {
        // action body
        $city_obj = new Application_Model_City();
        $city_id = $this->_request->getParam("id");
        //$country_id = $this->_request->getParam("country_id");
        $city_obj->deleteCity($city_id);
        $this->redirect("/city/list");
    }

    public function detailsAction()
    {
        // action body
        $city_model = new Application_Model_City();
        $exp=new Application_Model_Post();
        $form = new Application_Form_Post();
        $comment=new Application_Model_Comment();
        
        
        $city_id = $this->_request->getParam("id");
        $county_id = $this->_request->getParam("country_id");
        $city = $city_model->getAllCities($county_id)[0];
        
        $allPost=$exp->getAllPosts($city_id);
        //$allcomment =[];
        for($i=0;$i<count($allPost);$i++)
        {
            $postid=$allPost[$i]["id"];
            //$pscom[$postid] = array();
            $allcomment[$postid]=$comment->listComments($postid);
        }
        //addPostForm
        $request = $this->getRequest();
        if(null !== $this->_request->getParam("postiddel"))
        {//for delete
            $post_model = new Application_Model_Post();
            $post_id = $this->_request->getParam("postiddel");
            $post_model->deletePost($post_id);
            $this->redirect("/city/details/id/$city_id/country_id/$county_id");
        }
        elseif (null !== $this->_request->getParam("postidedit"))
        {//for edit
            $post_model = new Application_Model_Post();
            $post_id = $this->_request->getParam("postidedit");
            $old_post = $post_model->getPost($post_id);
            $form->populate($old_post[0]);
            $request = $this->getRequest();
            if($request-> isPost()){
                if($form-> isValid($request-> getPost())){
                        $post_model-> editPost($_POST);
                            //send new_post to model->edit 
                        $this->redirect("/city/details/id/$city_id/country_id/$county_id");
                }
            }            
        }  else {//for add
            if($request->isPost()){
                if($form->isValid($request->getPost())){
                    $post_model = new Application_Model_Post();
                    $post = array('city_id' => $city_id,
                                  'user_id' => 1,
                                  'content' => $request->getParam("content")
                            );
                    $post_model-> addPost($post);
                    $this->redirect("/city/details/id/$city_id/country_id/$county_id");
                }
            }            
        }//end elseif  
        $this->view->city = $city;
        $this->view->posts= $allPost;
        $this->view->comments= $allcomment;
        $this->view->Post_form= $form;
        
        $location=new Application_Model_Location();
          $paginator = Zend_Paginator::factory( $location-> listLocation()); 
       $paginator->setDefaultItemCountPerPage(2);
       $allItems = $paginator->getTotalItemCount(); 
       $countPages = $paginator->count();
       $p = $this->getRequest()->getParam('p'); 
       if(isset($p)) 
           { $paginator->setCurrentPageNumber($p); } 
           else
               $paginator->setCurrentPageNumber(1); 
           $currentPage = $paginator->getCurrentPageNumber(); 
           $this->view->locations = $paginator; 
           $this->view->countItems = $allItems; 
           $this->view->countPages = $countPages; 
           $this->view->currentPage = $currentPage; 
           if($currentPage == $countPages)
               { $this->view->nextPage = $countPages;
               $this->view->previousPage = $currentPage-1; }
               else if($currentPage == 1)
                   { $this->view->nextPage = $currentPage+1; $this->view->previousPage = 1; } 
                   else { $this->view->nextPage = $currentPage+1; $this->view->previousPage = $currentPage-1; }
        
    }
    
    public function addAction()
    {
        // this funtion  that use to add form to the view 
        $form = new Application_Form_City();
        $this->view->city_form = $form;
        $city_obj = new Application_Model_City();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                    $upload= new Zend_File_Transfer_Adapter_Http();
                $upload->addFilter('Rename',"/var/www/html/fas7ny/public/images/".$_POST['name'].".jpg");
                $upload->receive(); 
                $_POST['image']="/images/".$_POST['name'].".jpg";
                $city_obj->addNewcity($_POST);
                $this->redirect('/city/list');
            }
        }
    }

    public function editAction()
    {
        // action body
        // action body
        // 1- get client form to edit view
        $form = new Application_Form_City(); // hgyb object mn el form w deh elly hmleha b data elly htg3ly mn database 3shan 2sht8l 3leh
        $city_obj = new Application_Model_City(); // deh el object elly hyrg3 data mn database
        $id = $this->_request->getParam('id'); // deh ana b2os el ide mn ellly htb3tlly lma 2dos 3la button el update 
        $city_got = $city_obj->cityDetail($id); // deh hgyb el details bt3t el user dah b id bt3o 
        // var_dump($client_got);exit();

        $form->populate($city_got[0]); // deh function wzftha 2nha tmlly el form elly 3ndy b data elly htglly bt3t el one user
        $this->view->form_c = $form; // mfrod hb3t l view el form el gdeda elly htb2a mmlya b data 


        $request = $this->getRequest(); // h3dal el data w hdos submit w btally lzm 2ml function wzftha 2nha bt3ml insert l data gdeda fe database
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                        $upload= new Zend_File_Transfer_Adapter_Http();
                $upload->addFilter('Rename',"/var/www/html/fas7ny/public/images/".$_POST['name'].".jepg");
                $upload->receive(); 
                $_POST['image']="/images/".$_POST['name'].".jepg";
                $city_obj->updataCity($id, $_POST); // deh function wzftha 2nha bt3ml update lzm 23mlha hindel 
                $this->redirect('/city/list'); // deh 3shan yrg3 l nfs sf7t el list 3shan y3rd el data b3d el update 
            }
        }
    }

//    public function addpostAction()
//    {
//        // action body
//    }
//
//    public function deletepostAction()
//    {
//        // action body
//        $post_model = new Application_Model_Post();
//        $city_id = $this->_request->getParam("id");
//        $country_id = $this->_request->getParam("country_id");
//        $post_id = $this->_request->getParam("postid");//postiddel
//        $post_model->deletePost($post_id);
//        $this->redirect("/city/details/id/$city_id/country_id/$country_id");
//    }

    public function postAction()
    {
        // action body
        
    }


}






