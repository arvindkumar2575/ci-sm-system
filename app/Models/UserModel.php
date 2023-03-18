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

    public function getUsers()
    {
        $sql = 'SELECT * FROM tbl_user';
        $query = $this->db->query($sql);
        $result = $query->getResultArray();
        return $result;
    }

    public function getUserDetails($id)
    {
        $result=array();
        try {
            $sql = 'SELECT id,user_type,email,verified,first_name,last_name,gender_id,status,created_at,modified_at,deleted FROM tbl_user WHERE id='.$id.'';
            $query = $this->db->query($sql);
            $result = $query->getRowArray();
            return $result;
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $result;
    }

    public function deleteUser($id)
    {
        $query=false;
        try {
            $sql = 'UPDATE tbl_user SET deleted = "1" WHERE id = '.$id.'';
            $query = $this->db->query($sql);
            return $query;
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $query;
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

    public function getRoleDetails($id)
    {
        $result=array();
        try {
            $sql = 'SELECT id,name,display_name FROM tbl_roles WHERE id='.$id.'';
            $query = $this->db->query($sql);
            $result = $query->getRowArray();
            return $result;
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $result;
    }
        
}