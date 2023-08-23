<?

namespace Classes\Models;

use mysqli;
use Exception;
use Classes\Foundation\Request;

class Model
{
    protected $connection = null;
    public $table = null;
    public $orderBy = "DESC";
    public $orderByColumn = "id";
    public $limit = null;
    public $where = [];

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

    /** 
    * Get result from query 
    */
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

    /** 
    * Execute query statement
    */
    private function executeStatement($query = "" , $params = [])
    {
        try {
            $stmt = $this->connection->prepare( $query );
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
            $stmt->execute();
            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }	
    }

    /** 
    * Build the query statement
    */
    public function get() {

        // Get request arguments
        $request = Request::request();

        if (isset($request['limit']) && $request['limit']) {
            $this->limit($request['limit']);
        }

        if (isset($request['order-by']) && $request['order-by']) {
            $this->orderBy($request['order-by']);
        }

        if (isset($request['order-by-column']) && $request['order-by-column']) {
            $this->orderByColumn($request['order-by-column']);
        }

        $query = "SELECT * FROM {$this->table}";

        // Add WHERE queries if any
        foreach ($this->where as $item) {
            $query .= " WHERE {$item[0]} {$item[1]} {$item[2]}";
        }

        // Add order by query
        $query .= " ORDER BY {$this->orderByColumn} {$this->orderBy}";

        // Add limit query
        if (isset($this->limit)) {
            $query .= " LIMIT {$this->limit}";
        }

        return Model::select($query);
    }

    /** 
    * Add WHERE query
    */
    public function where($column, $operator, $value) {
        array_push($this->where, [$column, $operator,$value]);
    }

    /** 
    * Add limit query
    */
    public function limit($limit) {
        $this->limit = $limit;
    }

    /** 
    * Add orderBy query
    */
    public function orderBy($orderBy = "DESC") {
        $this->orderBy = $orderBy;
    }

    /** 
    * Add orderByColumn query
    */
    public function orderByColumn($orderByColumn = "id") {
        $this->orderByColumn = $orderByColumn;
    }
}