<?

namespace Classes\Models;

use mysqli;
use Exception;

class Model
{
    protected $connection = null;
    public $table = null;
    public $orderBy = ["id", "DESC"];
    public $limit = null;

    public function __construct()
    {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
    	
            if ( mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");   
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());   
        }			
    }

    public function select($query = "" , $params = [])
    {
        try {
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
            $stmt->close();
            return $result;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

    private function executeStatement($query = "" , $params = [])
    {
        try {
            $stmt = $this->connection->prepare( $query );
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
            // if( $params ) {
            //     $stmt->bind_param($params[0], $params[1]);
            // }
            $stmt->execute();
            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }	
    }

    public function all($orderBy = "DESC") {
        return Model::select(
            "SELECT * FROM {$this->table} ORDER BY {$this->orderBy[0]} {$this->orderBy[1]} LIMIT {$this->limit}"
        );
    }

    public function get($id, $column = 'id') {
        return Model::select("SELECT * FROM {$this->table} WHERE {$column} = '$id'");
    }

    public function where($where = null) {
        if (!isset($where) || count($where) != 3) {
            throw new Exception("Invalid WHERE argument");
        }

        $query = "SELECT * FROM {$this->table}";
        $query .= " WHERE {$where[0]} {$where[1]} '{$where[2]}'";

        isset($this->limit)
            ? $query .= " ORDER BY {$this->orderBy[0]} {$this->orderBy[1]} LIMIT {$this->limit}"
            : $query .= " ORDER BY {$this->orderBy[0]} {$this->orderBy[1]}";

        return Model::select($query);
    }

    public function limit($limit) {
        $this->limit = $limit;
    }

    public function orderBy($orderBy = "id", $order = 'DESC') {
        $this->orderBy[0] = $orderBy;
        $this->orderBy[1] = $order;
    }
}