<?php

namespace ModelTest\DataMapperTest;

use DataBase\DataBase;
use Persistance\StatusMapper;
use Model\Status;
use TestCase;
use PDO;

class StatusMapperTest extends TestCase
{
    private $connection;
    private $statusMapper;
    
    public function setUp()
    {
        $this->connection = new DataBase('sqlite::memory:');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->exec(<<<SQL
CREATE TABLE IF NOT EXISTS STATUSES (
  id        INT PRIMARY KEY NOT NULL,
  message   VARCHAR(140) NOT NULL,
  user      VARCHAR(100),
  date      DATE
);
SQL
        );
        
        $this->statusMapper = new StatusMapper($this->connection);
    }

    public function testPersist()
    {
        $rows = $this->connection->query('SELECT COUNT(*) FROM STATUSES')->fetch(PDO::FETCH_NUM);
        $this->assertEquals(0, $rows[0]);
        $status = new Status(null, 'jubrat', 'Test message', date('Y-m-d H:i:s'));
        $this->statusMapper->persist($status);
        $rows = $this->connection->query('SELECT COUNT(*) FROM STATUSES')->fetch(PDO::FETCH_NUM);
        $this->assertEquals(1, $rows[0]);
    }

    public function testRemove()
    {
        $status = new Status('10', 'jubrat', 'Test message', date('Y-m-d H:i:s'));
        
        $rows = $this->connection->query('SELECT COUNT(*) FROM STATUSES')->fetch(PDO::FETCH_NUM);
        $this->assertEquals(0, $rows[0]);
        $this->statusMapper->persist($status);
        $rows = $this->connection->query('SELECT COUNT(*) FROM STATUSES')->fetch(PDO::FETCH_NUM);
        $this->assertEquals(1, $rows[0]);
        $this->statusMapper->remove($status->getId());
        $rows = $this->connection->query('SELECT COUNT(*) FROM STATUSES')->fetch(PDO::FETCH_NUM);
        $this->assertEquals(0, $rows[0]);
    }
}
