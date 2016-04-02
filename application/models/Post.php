<?php

class Application_Model_Post extends Zend_Db_Table_Abstract
{
    protected $_name = 'post';
    function listPosts()
    {
        return $this->fetchAll()->toArray();
    }
    function deletePost($id)
    {
        $this->delete("id=$id");
    }
    function addPost($postData)
    {
//        $id,$city_id,$user_id,$content
        $row = $this->createRow();
        $row->city_id = $postData['city_id'];
        $row->user_id = $postData['user_id'];
        $row->content = $postData['content'];
        $row->save();
    }
    function getPost ($id){
        return $this->find($id)->toArray();//get old data
    }
    function editPost ($postData){
        $newData['city_id'] = $postData['city_id'];
        $newData['user_id'] = $postData['user_id'];
        $newData['content'] = $postData['content'];
        $id= $postData['id'];
        $this->update($newData,"id=".$id);
    }


}

