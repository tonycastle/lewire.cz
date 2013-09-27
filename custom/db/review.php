<?php
/**
 * The review object acts as a service layer separating database access from the application. Means that we can replace the db
 * access with an orm later etc as long as we keep the interface the same.
 *
 * @author tony
 */
namespace custom\db;

class review extends \custom\db\baseClass{
    //put your code here
    private $_table = "reviews";

    /**
     * Returns all the records from the review table as an associative array.
     * @return array
     */
    public function getAllReviews(){
        $sql = "SELECT * FROM {$this->_table}";
        return $this->_db->queryFetchAllAssoc($sql);
    }

    /**
     * The function accepts an array of data to store in the reviews table. The array should be an associative array
     * the key will be the name of the column and the data the data to be stored in that column.
     *
     * @param array $data
     */
    public function addReview($data){
        if(!is_array($data)) throw new \Exception("data must be an array");
        $stmt = $this->_db->prepare("INSERT INTO {$this->_table} (`name`,`review`,`date`) VALUES (:name, :review, :date)");
        $stmt->execute($data);
    }
}
?>
