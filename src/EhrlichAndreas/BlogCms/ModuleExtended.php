<?php

/**
 * 
 * @author Ehrlich, Andreas <ehrlich.andreas@googlemail.com>
 */
class EhrlichAndreas_BlogCms_ModuleExtended extends EhrlichAndreas_BlogCms_Module
{
    /**
     * 
     * @param string $author_id
     * @return mixed
     */
    protected function _getAuthorId($author_id)
    {
        if (is_array($author_id))
        {
            if (isset($author_id['author_id']))
            {
                $author_id = $author_id['author_id'];
            }
            else
            {
                return false;
            }
        }
        
        return $author_id;
    }
    
    /**
     * 
     * @param string $blog_id
     * @return mixed
     */
    protected function _getBlogId($blog_id)
    {
        if (is_array($blog_id))
        {
            if (isset($blog_id['blog_id']))
            {
                $blog_id = $blog_id['blog_id'];
            }
            else
            {
                return false;
            }
        }
        
        return $blog_id;
    }
    
    /**
     * 
     * @param string $comment_id
     * @return mixed
     */
    protected function _getCommentId($comment_id)
    {
        if (is_array($comment_id))
        {
            if (isset($comment_id['comment_id']))
            {
                $comment_id = $comment_id['comment_id'];
            }
            else
            {
                return false;
            }
        }
        
        return $comment_id;
    }
    
    /**
     * 
     * @param string $extern_id
     * @return mixed
     */
    protected function _getExternId($extern_id)
    {
        if (is_array($extern_id))
        {
            if (isset($extern_id['extern_id']))
            {
                $extern_id = $extern_id['extern_id'];
            }
            else
            {
                return false;
            }
        }
        
        return $extern_id;
    }
    
    /**
     * 
     * @param string $post_id
     * @return mixed
     */
    protected function _getPostId($post_id)
    {
        if (is_array($post_id))
        {
            if (isset($post_id['post_id']))
            {
                $post_id = $post_id['post_id'];
            }
            else
            {
                return false;
            }
        }
        
        return $post_id;
    }
    
    /**
     * 
     * @param string $guid
     * @return mixed
     */
    protected function _getGuid($guid)
    {
        if (is_array($guid))
        {
            if (isset($guid['guid']))
            {
                $guid = $guid['guid'];
            }
            else
            {
                return false;
            }
        }
        
        return $guid;
    }
    
    public function addPostToBlog($post, $checkExtern = false)
    {
        $extern_id_tmp = $this->_getExternId($post);
        
        $blog_id_tmp = $this->_getBlogId($post);
        
        $author_id_tmp = $this->_getAuthorId($post);
        
        $post_id_tmp = $this->_getPostId($post);
        
        $guid_tmp = $this->_getGuid($post);
        
        if ($checkExtern && $extern_id_tmp === false)
        {
            return false;
        }
        
        if ($post_id_tmp !== false)
        {
            $param = array
            (
                'cols'  => array
                (
                    'post_id'   => 'post_id',
                ),
                'where' => array
                (
                    'post_id'   => $post_id_tmp,
                ),
            );
            
            $rowset = $this->getPostList($param);
            
            if (count($rowset) == 0)
            {
                $post_id_tmp = false;
            }
        }
        
        if ($post_id_tmp === false && $blog_id_tmp !== false)
        {
            $param = array
            (
                'cols'  => array
                (
                    'blog_id'   => 'blog_id',
                ),
                'where' => array
                (
                    'blog_id'   => $blog_id_tmp,
                ),
            );
            
            $rowset = $this->getBlogList($param);
            
            if (count($rowset) == 0)
            {
                $blog_id_tmp = false;
            }
        }
        
        if ($post_id_tmp === false && $blog_id_tmp === false)
        {
            $param = array
            (
                'cols'  => array
                (
                    'blog_id'   => 'blog_id',
                ),
                'where' => array
                (
                    'extern_id' => $extern_id_tmp,
                ),
            );
            
            $rowset = $this->getBlogList($param);
            
            if (count($rowset) == 0)
            {
                $param = array
                (
                    'extern_id' => $extern_id_tmp,
                );
                
                $blog_id_tmp = $this->addBlog($param);
            }
            else
            {
                $blog_id_tmp = $rowset[0]['blog_id'];
            }
        }
        
        if ($post_id_tmp !== false)
        {
            $param = $post;
            
            if ($blog_id_tmp !== false)
            {
                $param['blog_id'] = $blog_id_tmp;
            }
            
            if ($extern_id_tmp !== false)
            {
                $param['extern_id'] = $extern_id_tmp;
            }
            
            if ($author_id_tmp !== false)
            {
                $param['author_id'] = $author_id_tmp;
            }
            
            if ($guid_tmp !== false)
            {
                $param['guid'] = $guid_tmp;
            }
            
            $param['where'] = array
            (
                'post_id'   => $post_id_tmp,
            );
            
            $this->editPost($param);
            
            return $post_id_tmp;
        }
        
        if ($extern_id_tmp === false)
        {
            $extern_id_tmp = '0';
        }
        
        if ($author_id_tmp === false)
        {
            $author_id_tmp = '0';
        }
        
        if ($post_id_tmp === false)
        {
            $param = $post;
            
            $param['blog_id'] = $blog_id_tmp;
            
            $param['extern_id'] = $extern_id_tmp;
            
            $param['author_id'] = $author_id_tmp;
            
            $param['guid'] = $guid_tmp;
            
            return $this->addPost($param);
        }
    }
}