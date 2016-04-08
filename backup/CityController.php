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
        $city_id = $this->_request->getParam("id");
        $county_id = $this->_request->getParam("country_id");
        $city = $city_model->getAllCities($county_id)[0];
        
        $this->view->city = $city;
        
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
                   
                   
        
        $post_model = new Application_Model_Post();
        $comment=new Application_Model_Comment();
        //$exp=new Application_Model_Post();
        $allPost=$post_model->getAllPosts($city_id);
        //var_dump($allPost);die();
        $allcomment =[];
          for($i=0;$i<count($allPost);$i++)
        {
            $postid=$allPost[$i]["id"];
            //$pscom[$postid] = array();
            $allcomment[$postid]=$comment->listComments($postid);
        }
        //var_dump($allcomment);die();
        $this->view->posts = $allPost;
        $this->view->comments= $allcomment;

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

    public function postAction()
    {
        // action body
        
    }

    public function getrateAction()
    {
		 $this->_helper->layout()->disableLayout();
		 $this->_helper->viewRenderer->setNoRender(true);
                 $city_id=$_POST['id']; 
                 $user_id=$_POST['user_id']; 
                 $city_rate=new Application_Model_CityRate();
                 $prevRatingRow=$city_rate->check($user_id, $city_id);
                 if($prevRatingRow == null)
                 {
                     echo 0 ;
                 
                 }else{
                     echo $prevRatingRow['rate'];
                 }
    }

    public function addrateAction()
    {
            $this->_helper->layout()->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);
            $city_rate=new Application_Model_CityRate();
            $user_id=$_POST['user_id']; 
            $city_id=$_POST['id']; 
             if(!empty($_POST['ratingPoints'])){
              $ratingPoints =  $_POST['ratingPoints']; 
              $prevRatingRow=$city_rate->check($user_id, $city_id);
               if($prevRatingRow !=null): 
                    $rate_id = $prevRatingRow->toArray()['id'];
                    $city_rate->updaterate($rate_id,$ratingPoints);
                else:
                    $city_rate->addrate($user_id, $city_id,$ratingPoints);
            endif;
                }
      
        
    }


}




