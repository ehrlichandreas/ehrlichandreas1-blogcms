<?php 

/**
 * Library base exception
 * 
 * @author Ehrlich, Andreas <ehrlich.andreas@googlemail.com>
 */
class EhrlichAndreas_BlogCms_Module extends EhrlichAndreas_AbstractCms_Module
{
    /**
     *
     * @var string
     */
    private $tableBlog = 'blog_blog';

    /**
     *
     * @var string
     */
    private $tableComment = 'blog_comment';

    /**
     *
     * @var string
     */
    private $tablePost = 'blog_post';
    
    /**
     * Constructor
     * 
     * @param array $options
     *            Associative array of options
     * @throws EhrlichAndreas_BlogCms_Exception
     * @return void
     */
    public function __construct ($options = array())
    {
        $options = $this->_getCmsConfigFromAdapter($options);
        
        if (! isset($options['adapterNamespace']))
        {
            $options['adapterNamespace'] = 'EhrlichAndreas_BlogCms_Adapter';
        }
        
        if (! isset($options['exceptionclass']))
        {
            $options['exceptionclass'] = 'EhrlichAndreas_BlogCms_Exception';
        }
        
        parent::__construct($options);
    }
    
    /**
     * 
     * @return EhrlichAndreas_BlogCms_Module
     */
    public function install()
    {
        $this->adapter->install();
        
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getTableBlog ()
    {
        return $this->adapter->getTableName($this->tableBlog);
    }

    /**
     * 
     * @return string
     */
    public function getTableComment ()
    {
        return $this->adapter->getTableName($this->tableComment);
    }

    /**
     * 
     * @return string
     */
    public function getTablePost ()
    {
        return $this->adapter->getTableName($this->tablePost);
    }

    /**
     * 
     * @return array
     */
    public function getFieldsBlog ()
    {
        return array
        (
            'blog_id'               => 'blog_id',
            'published'             => 'published',
            'updated'               => 'updated',
            'enabled'               => 'enabled',
            'extern_id'             => 'extern_id',
            'extern_id_type'        => 'extern_id_type',
            'author_id'             => 'author_id',
            'blog_title'            => 'blog_title',
            'blog_content'          => 'blog_content',
            'blog_excerpt'          => 'blog_excerpt',
            'blog_status'           => 'blog_status',
            'comment_status'        => 'comment_status',
            'ping_status'           => 'ping_status',
            'blog_password'         => 'blog_password',
            'blog_name'             => 'blog_name',
            'to_ping'               => 'to_ping',
            'pinged'                => 'pinged',
            'blog_modified'         => 'blog_modified',
            'blog_content_filtered' => 'blog_content_filtered',
            'menu_order'            => 'menu_order',
            'guid'                  => 'guid',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsComment ()
    {
        return array
        (
            'comment_id'                => 'comment_id',
            'published'                 => 'published',
            'updated'                   => 'updated',
            'enabled'                   => 'enabled',
            'extern_id'                 => 'extern_id',
            'extern_id_type'            => 'extern_id_type',
            'blog_id'                   => 'blog_id',
            'author_id'                 => 'author_id',
            'post_id'                   => 'post_id',
            'comment_id_parent'         => 'comment_id_parent',
            'comment_date'              => 'comment_date',
            'comment_content'           => 'comment_content',
            'comment_content_filtered'  => 'comment_content',
            'comment_type'              => 'comment_type',
            'guid'                      => 'guid',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsPost ()
    {
        return array
        (
            'post_id'               => 'post_id',
            'published'             => 'published',
            'updated'               => 'updated',
            'enabled'               => 'enabled',
            'extern_id'             => 'extern_id',
            'extern_id_type'        => 'extern_id_type',
            'blog_id'               => 'blog_id',
            'author_id'             => 'author_id',
            'post_date'             => 'post_date',
            'post_title'            => 'post_title',
            'post_content'          => 'post_content',
            'post_excerpt'          => 'post_excerpt',
            'post_status'           => 'post_status',
            'comment_status'        => 'comment_status',
            'ping_status'           => 'ping_status',
            'post_password'         => 'post_password',
            'post_name'             => 'post_name',
            'to_ping'               => 'to_ping',
            'pinged'                => 'pinged',
            'post_modified'         => 'post_modified',
            'post_content_filtered' => 'post_content_filtered',
            'post_id_parent'        => 'post_id_parent',
            'menu_order'            => 'menu_order',
            'post_type'             => 'post_type',
            'post_mime_type'        => 'post_mime_type',
            'comment_count'         => 'comment_count',
            'guid'                  => 'guid',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsBlog ()
    {
        return array
        (
            'blog_id'   => 'blog_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsComment ()
    {
        return array
        (
            'comment_id'    => 'comment_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsPost ()
    {
        return array
        (
            'post_id'   => 'post_id',
        );
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
    public function addBlog ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        
        if (! isset($params['extern_id']))
        {
            $params['extern_id'] = '0';
        }
        
        if (! isset($params['author_id']))
        {
            $params['author_id'] = '0';
        }
        
        if (! isset($params['blog_title']))
        {
            $params['blog_title'] = '';
        }
        
        if (! isset($params['blog_content']))
        {
            $params['blog_content'] = '';
        }
        
        if (! isset($params['blog_excerpt']))
        {
            $params['blog_excerpt'] = '';
        }
        
        if (! isset($params['blog_status']))
        {
            $params['blog_status'] = '';
        }
        
        if (! isset($params['comment_status']))
        {
            $params['comment_status'] = '';
        }
        
        if (! isset($params['ping_status']))
        {
            $params['ping_status'] = '';
        }
        
        if (! isset($params['blog_password']))
        {
            $params['blog_password'] = '';
        }
        
        if (! isset($params['blog_name']))
        {
            $params['blog_name'] = '';
        }
        
        if (! isset($params['to_ping']))
        {
            $params['to_ping'] = '';
        }
        
        if (! isset($params['pinged']))
        {
            $params['pinged'] = '';
        }
        
        if (! isset($params['blog_modified']))
        {
            $params['blog_modified'] = '0001-01-01 00:00:00';
        }
        
        if (! isset($params['blog_content_filtered']))
        {
            $params['blog_content_filtered'] = '';
        }
        
        if (! isset($params['menu_order']))
        {
            $params['menu_order'] = '0';
        }
        
        if (! isset($params['guid']))
        {
            $params['guid'] = '';
        }
        
        $function = 'Blog';
        
        return $this->_add($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
    public function addComment ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        
        if (! isset($params['extern_id']))
        {
            $params['extern_id'] = '0';
        }
        
        if (! isset($params['blog_id']))
        {
            $params['blog_id'] = '0';
        }
        
        if (! isset($params['author_id']))
        {
            $params['author_id'] = '0';
        }
        
        if (! isset($params['post_id']))
        {
            $params['post_id'] = '0';
        }
        
        if (! isset($params['comment_id_parent']))
        {
            $params['comment_id_parent'] = '0';
        }
        
        if (! isset($params['comment_date']))
        {
            $params['comment_date'] = date('Y-m-d H:i:s', time());
        }
        
        if (! isset($params['comment_content']))
        {
            $params['comment_content'] = '';
        }
        
        if (! isset($params['comment_content_filtered']))
        {
            $params['comment_content_filtered'] = '';
        }
        
        if (! isset($params['comment_type']))
        {
            $params['comment_type'] = '';
        }
        
        if (! isset($params['guid']))
        {
            $params['guid'] = '';
        }
        
        $function = 'Comment';
        
        return $this->_add($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
    public function addPost ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        
        if (! isset($params['extern_id']))
        {
            $params['extern_id'] = '0';
        }
        
        if (! isset($params['blog_id']))
        {
            $params['blog_id'] = '0';
        }
        
        if (! isset($params['author_id']))
        {
            $params['author_id'] = '0';
        }
        
        if (! isset($params['post_date']))
        {
            $params['post_date'] = date('Y-m-d H:i:s', time());
        }
        
        if (! isset($params['post_title']))
        {
            $params['post_title'] = '';
        }
        
        if (! isset($params['post_content']))
        {
            $params['post_content'] = '';
        }
        
        if (! isset($params['post_excerpt']))
        {
            $params['post_excerpt'] = '';
        }
        
        if (! isset($params['post_status']))
        {
            $params['post_status'] = '';
        }
        
        if (! isset($params['comment_status']))
        {
            $params['comment_status'] = '';
        }
        
        if (! isset($params['ping_status']))
        {
            $params['ping_status'] = '';
        }
        
        if (! isset($params['post_password']))
        {
            $params['post_password'] = '';
        }
        
        if (! isset($params['post_name']))
        {
            $params['post_name'] = '';
        }
        
        if (! isset($params['to_ping']))
        {
            $params['to_ping'] = '';
        }
        
        if (! isset($params['pinged']))
        {
            $params['pinged'] = '';
        }
        
        if (! isset($params['post_modified']))
        {
            $params['post_modified'] = '0001-01-01 00:00:00';
        }
        
        if (! isset($params['post_content_filtered']))
        {
            $params['post_content_filtered'] = '';
        }
        
        if (! isset($params['post_id_parent']))
        {
            $params['post_id_parent'] = '0';
        }
        
        if (! isset($params['post_type']))
        {
            $params['post_type'] = '';
        }
        
        if (! isset($params['post_mime_type']))
        {
            $params['post_mime_type'] = '';
        }
        
        if (! isset($params['comment_count']))
        {
            $params['comment_count'] = '';
        }
        
        if (! isset($params['menu_order']))
        {
            $params['menu_order'] = '';
        }
        
        if (! isset($params['guid']))
        {
            $params['guid'] = '';
        }
        
        $function = 'Post';
        
        return $this->_add($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function deleteBlog ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $function = 'Blog';
        
        return $this->_delete($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function deleteComment ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $function = 'Comment';
        
        return $this->_delete($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function deletePost ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $function = 'Post';
        
        return $this->_delete($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function editBlog ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00' || $params['updated'] == '0001-01-01 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
        
        if (! isset($params['blog_modified']) || $params['blog_modified'] == '0000-00-00 00:00:00' || $params['blog_modified'] == '0001-01-01 00:00:00')
        {
            $params['blog_modified'] = date('Y-m-d H:i:s', time());
        }
        
        $function = 'Blog';
        
        return $this->_edit($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function editComment ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00' || $params['updated'] == '0001-01-01 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
        
        $function = 'Comment';
        
        return $this->_edit($function, $params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function editPost ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00' || $params['updated'] == '0001-01-01 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
        
        if (! isset($params['post_modified']) || $params['post_modified'] == '0000-00-00 00:00:00' || $params['post_modified'] == '0001-01-01 00:00:00')
        {
            $params['post_modified'] = date('Y-m-d H:i:s', time());
        }
        
        $function = 'Post';
        
        return $this->_edit($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getBlog ($params = array(), $returnAsString = false)
    {
        $function = 'Blog';
        
        return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getBlogList ($where = array())
    {
        $function = 'Blog';
        
        return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getComment ($params = array(), $returnAsString = false)
    {
        $function = 'Comment';
        
        return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getCommentList ($where = array())
    {
        $function = 'Comment';
        
        return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getPost ($params = array(), $returnAsString = false)
    {
        $function = 'Post';
        
        return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getPostList ($where = array())
    {
        $function = 'Post';
        
        return $this->_getList($function, $where);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function disableBlog ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '0';
        
        return $this->editBlog($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function disableComment ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '0';
        
        return $this->editComment($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function disablePost ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '0';
        
        return $this->editPost($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function enableBlog ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '1';
        
        return $this->editBlog($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function enableComment ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '1';
        
        return $this->editComment($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function enablePost ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
        
        $params['enabled'] = '1';
        
        return $this->editPost($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function softDeleteBlog ($params = array(), $returnAsString = false)
    {
        return $this->disableBlog($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function softDeleteComment ($params = array(), $returnAsString = false)
    {
        return $this->disableComment($params, $returnAsString);
    }
    
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function softDeletePost ($params = array(), $returnAsString = false)
    {
        return $this->disablePost($params, $returnAsString);
    }
}

