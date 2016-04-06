<?php

class Fas7nyController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function listpostsAction() {
        // action body
        $post_model = new Application_Model_Post();
        $this->view->posts = $post_model->listPosts();
    }

    public function addpostAction() {

        $this->_helper->layout()->disableLayout();
        //when some one wirte /index/te7aajax they won't be rendered to the view script
        $this->_helper->viewRenderer->setNoRender(true);
        $post_model = new Application_Model_Post();
        echo $post_model->addPost($_POST);
    }

    public function editpostAction() {

        $post_model = new Application_Model_Post();
        $post_model->editPost($_POST);
    }

    public function deletepostAction() {
        $post_model = new Application_Model_Post();
        $post_id = $_POST['id'];
        $post_model->deletePost($post_id);
    }

    public function listcommentsAction() {
        $comment_id = $this->_request->getParam("postid");
        //get comment_id from view->edit
        $comment_model = new Application_Model_Comment();
        $this->view->comments = $comment_model->listComments($comment_id);
    }

    public function addcommentAction() {

        //stop the layout from rendring in case you have enabled it
        $this->_helper->layout()->disableLayout();
        //when some one wirte /index/te7aajax they won't be rendered to the view script
        $this->_helper->viewRenderer->setNoRender(true);
        $comment_model = new Application_Model_Comment();
        echo $comment_model->addComment($_POST);
    }

    public function editcommentAction() {

        $comment_model = new Application_Model_Comment();
        $comment_model->editcomment($_POST);
    }

    public function deletecommentAction() {

        $comment_model = new Application_Model_Comment();
        $comment_id = $_POST['id'];
        $comment_model->deleteComment($comment_id);
    }

}
