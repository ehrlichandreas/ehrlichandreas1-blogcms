<?php 

/**
 *
 * @author Ehrlich, Andreas <ehrlich.andreas@googlemail.com>
 */
class EhrlichAndreas_BlogCms_Adapter_Pdo_Mysql extends EhrlichAndreas_AbstractCms_Adapter_Pdo_Mysql
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
     *
     * @var string 
     */
    protected $tableVersion = 'blog_version';
    
    /**
     * 
     * @return EhrlichAndreas_BlogCms_Adapter_Pdo_Mysql
     */
    public function install ()
    {
        $this->_install_version_10000();
        
        return $this;
    }
    
    /**
     * 
     * @return EhrlichAndreas_StockCms_Adapter_Pdo_Mysql
     */
    protected function _install_version_10000 ()
    {
        $version = '10000';
        
        $dbAdapter = $this->getConnection();
        
        $tableVersion = $this->getTableName($this->tableVersion);
        
        $versionDb = $this->_getVersion($dbAdapter, $tableVersion);
        
        if ($versionDb >= $version)
        {
            return $this;
        }
        
        $tableBlog = $this->getTableName($this->tableBlog);
        
        $tableComment = $this->getTableName($this->tableComment);
        
        $tablePost = $this->getTableName($this->tablePost);
        
        $tableVersion = $this->getTableName($this->tableVersion);
        
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`num` BIGINT(19) NOT NULL AUTO_INCREMENT, ';
        $query[] = '`count` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = 'PRIMARY KEY (`num`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
        
        $queryVersion = $query;
        
        $queryVersion = str_replace('%table%', $tableVersion, $queryVersion);

        
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`blog_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`extern_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`author_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`blog_title` LONGTEXT NOT NULL, ';
        $query[] = '`blog_content` LONGTEXT NOT NULL, ';
        $query[] = '`blog_excerpt` LONGTEXT NOT NULL, ';
        $query[] = '`blog_status` VARCHAR(20) NOT NULL DEFAULT \'\', ';
        $query[] = '`comment_status` VARCHAR(20) NOT NULL DEFAULT \'\', ';
        $query[] = '`ping_status` VARCHAR(20) NOT NULL DEFAULT \'\', ';
        $query[] = '`blog_password` VARCHAR(20) NOT NULL DEFAULT \'\', ';
        $query[] = '`blog_name` VARCHAR(200) NOT NULL DEFAULT \'\', ';
        $query[] = '`to_ping` LONGTEXT NOT NULL, ';
        $query[] = '`pinged` LONGTEXT NOT NULL, ';
        $query[] = '`blog_modified` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`blog_content_filtered` LONGTEXT NOT NULL, ';
        $query[] = '`menu_order` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`guid` VARCHAR(255) NOT NULL DEFAULT \'\', ';
        $query[] = 'PRIMARY KEY (`blog_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
        
        $queryBlog = $query;
        
        $queryBlog = str_replace('%table%', $tableBlog, $queryBlog);

        
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`comment_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`extern_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`blog_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`author_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`post_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`comment_id_parent` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`comment_date` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`comment_content` LONGTEXT NOT NULL, ';
        $query[] = '`comment_content_filtered` LONGTEXT NOT NULL, ';
        $query[] = '`comment_type` VARCHAR(20) NOT NULL DEFAULT \'\', ';
        $query[] = '`guid` VARCHAR(255) NOT NULL DEFAULT \'\', ';
        $query[] = 'PRIMARY KEY (`comment_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
        
        $queryComment = $query;
        
        $queryComment = str_replace('%table%', $tableComment, $queryComment);

        
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`post_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`extern_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`blog_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`author_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`post_date` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`post_title` LONGTEXT NOT NULL, ';
        $query[] = '`post_content` LONGTEXT NOT NULL, ';
        $query[] = '`post_excerpt` LONGTEXT NOT NULL, ';
        $query[] = '`post_status` VARCHAR(20) NOT NULL DEFAULT \'\', ';
        $query[] = '`comment_status` VARCHAR(20) NOT NULL DEFAULT \'\', ';
        $query[] = '`ping_status` VARCHAR(20) NOT NULL DEFAULT \'\', ';
        $query[] = '`post_password` VARCHAR(20) NOT NULL DEFAULT \'\', ';
        $query[] = '`post_name` VARCHAR(200) NOT NULL DEFAULT \'\', ';
        $query[] = '`to_ping` LONGTEXT NOT NULL, ';
        $query[] = '`pinged` LONGTEXT NOT NULL, ';
        $query[] = '`post_modified` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`post_content_filtered` LONGTEXT NOT NULL, ';
        $query[] = '`post_id_parent` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`post_type` VARCHAR(20) NOT NULL DEFAULT \'\', ';
        $query[] = '`post_mime_type` VARCHAR(100) NOT NULL DEFAULT \'\', ';
        $query[] = '`comment_count` VARCHAR(20) NOT NULL DEFAULT \'\', ';
        $query[] = '`menu_order` VARCHAR(20) NOT NULL DEFAULT \'\', ';
        $query[] = '`guid` VARCHAR(255) NOT NULL DEFAULT \'\', ';
        $query[] = 'PRIMARY KEY (`post_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
        
        $queryPost = $query;
        
        $queryPost = str_replace('%table%', $tablePost, $queryPost);
        
        
        if ($versionDb < $version)
        {
            $query = $queryVersion;
            
            $stmt = $dbAdapter->query($query);
            
            $stmt->closeCursor();
            
            
            $query = $queryBlog;
            
            $stmt = $dbAdapter->query($query);
            
            $stmt->closeCursor();
            
            
            $query = $queryComment;
            
            $stmt = $dbAdapter->query($query);
            
            $stmt->closeCursor();
            
            
            $query = $queryPost;
            
            $stmt = $dbAdapter->query($query);
            
            $stmt->closeCursor();
            
            
            $this->_setVersion($dbAdapter, $tableVersion, $version);
        }
        
        return $this;
    }
}