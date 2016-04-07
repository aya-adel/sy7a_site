<?php

class Application_Model_Comment extends Zend_Db_Table_Abstract
{
    protected $_name = 'comment';
    //id content post_id
    function listComments($id)
    {
        return $this->fetchAll("post_id=$id")->toArray();
    }
    function getComment ($id){
        return $this->find($id)->toArray()[0];//["post_id"];//get old data
    }
    function deleteComment($id)
    {
        //return var_dump($this->fetchAll("id=$id")->toArray());
        //array(1) { [0]=> array(3) { ["id"]=> string(2) "11" 
        //["content"]=> string(23) "second comment for exp1" 
        //["post_id"]=> string(1) "2" } }
        $row= $this->getComment($id)["post_id"];
        $this->delete("id=$id");
        return $row;
    }
    function addComment($commentData)
    {
        $row = $this->createRow();
        $row->content = $commentData['content'];
        $row->post_id = $commentData['post_id'];
        $row->user_id = $commentData['user_id'];

        $row->save();
        return $row['id'];
    }
    function editcomment ($commentData){
//        $newData['content'] = $commentData['content'];
//        $newData['post_id'] = $commentData['post_id'];
        $id= $commentData['id'];
        $newData['content'] = $commentData['content'];
        $this->update($newData,"id=".$id);
    }
 

}

