<?php 
namespace App\Models;
use CodeIgniter\Model;
class UserModel extends Model
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function isEmailExit($email)
    {
        $query = $this->db->query('SELECT * FROM tbl_user WHERE email="'.$email.'"');
        // echo $this->db->lastQuery;die();
        $result = $query->getFirstRow();
        return $result;
    }

    public function getUserDetails($id)
    {
        $sql = 'SELECT * FROM tbl_user WHERE id=$id';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }

    public function getGenderDetails()
    {
        $sql = 'SELECT * FROM tbl_gender';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }

    public function getClassDetails()
    {
        $sql = 'SELECT id,display_name FROM tbl_class ORDER BY priority ASC';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }

    public function getSectionDetails()
    {
        $sql = 'SELECT id,display_name FROM tbl_section ORDER BY priority ASC';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }

    public function getUserTypes()
    {
        $sql = 'SELECT id,name,display_name FROM tbl_user_type ORDER BY priority ASC';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }

    public function getUserPermissions($id)
    {
        $sql = 'SELECT tp.* FROM tbl_permissions_user as tpu 
        LEFT JOIN tbl_user as tu on tu.id=tpu.user_id 
        LEFT JOIN tbl_permissions as tp on tp.id=tpu.permission_id
        WHERE tpu.user_id='.$id.'';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }



    
}