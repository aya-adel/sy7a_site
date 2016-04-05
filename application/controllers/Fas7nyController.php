<?php

class Fas7nyController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listpostsAction()
    {
        // action body
        $post_model = new Application_Model_Post();
        $this->view->posts = $post_model->listPosts();
    }

    public function addpostAction()
    {
        // action body
        $form = new Application_Form_Post();
        $request = $this->getRequest();
        if($request->isPost()){
            if($form->isValid($request->getPost())){
                $post_model = new Application_Model_Post();
                $post_model-> addPost($request->getParams());
                $this->redirect('/fas7ny/listposts');
            }
        }
        $this->view->addPost_form= $form;
    }

    public function editpostAction()
    {
        // action body
        $post_id = $this->_request->getParam("postid"); 
                    //get post_id from view->edit
        $post_model = new Application_Model_Post();
        $old_post = $post_model->getPost($post_id);
                    //send post_id to model->get & get old post
        $form = new Application_Form_Post();
        $form->populate($old_post[0]);
        $this->view->editPost_form = $form;
	            //send old_post to form 
        $request = $this->getRequest();
        if($request-> isPost()){
            if($form-> isValid($request-> getPost())){
                    $post_model-> editPost($_POST);
                        //send new_post to model->edit 
                    $this->redirect('/fas7ny/listposts');
            }
        }
    }

    public function deletepostAction()
    {
        // action body
        $post_model = new Application_Model_Post();
        $post_id = $this->_request->getParam("postid");
        $city_id=$post_model->getPost($post_id)[0]["city_id"];
        $country_id = $this->_request->getParam("country_id");
        $post_model->deletePost($post_id);
        $this->redirect("/city/details/id/$city_id/country_id/$country_id");//http://fas7ny.iti.com/city/details/id/1/country_id/3
    }

    public function listcommentsAction()
    {
        // action body
        //id content post_id
        $comment_id = $this->_request->getParam("postid"); 
                    //get comment_id from view->edit
        $comment_model = new Application_Model_Comment();
        $this->view->comments = $comment_model->listComments($comment_id);
    }

    public function addcommentAction()
    {
        // action body
//        $form = new Application_Form_Comment();
//        $request = $this->getRequest();
//        if($request->isPost()){
//            if($form->isValid($request->getPost())){
//                $comment_model = new Application_Model_Comment();
//                $comment_model-> addComment($request->getParams());
//                $this->redirect('/fas7ny/listcomments/postid/'.$request->getParams()["post_id"]);
//               
//            }
//        }
//        $this->view->addComment_form= $form;
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $req=$this->getRequest();
        if($req->isPost()){
            $com_obj=new Application_Model_Comment();
            $com_obj->addComment($req->getParams());
            }
    }

    public function editcommentAction()
    {
        // action body
        $comment_id = $this->_request->getParam("commentid"); 
                    //get post_id from view->edit
        $comment_model = new Application_Model_Comment();
        $old_comment = $comment_model->getComment($comment_id);
                    //send comment_id to model->get & get old comment
        $form = new Application_Form_Comment ();
        $form->populate($old_comment);
        $this->view->editComment_form = $form;
	            //send old_Comment to form 
        $request = $this->getRequest();
        if($request-> isPost()){
            if($form-> isValid($request-> getPost())){
                    $comment_model->editcomment($_POST);
                        //send new_post to model->edit 
                    $post_id=$comment_model->getComment($comment_id)["post_id"];
                    $this->redirect('/fas7ny/listcomments/postid/'.$post_id);
                    //$this->redirect('/post/listposts');
            }
        }
    }

    public function deletecommentAction()
    {
        // action body
        $comment_model = new Application_Model_Comment();
        $comment_id = $this->_request->getParam("commentid");
        $post_id=$comment_model->deleteComment($comment_id);
        $this->redirect('/fas7ny/listcomments/postid/'.$post_id);
    }


}

















