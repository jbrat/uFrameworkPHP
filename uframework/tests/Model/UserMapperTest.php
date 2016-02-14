<?php

namespace ModelTest\DataMapperTest;

use Persistance\UserMapper;
use DataBase\DataBase;
use Model\User;
use TestCase;
use PDO;

class UserMapperTest extends TestCase
{
    private $connection;
    private $userMapper;
   
    public function setUp()
    {
        $this->connection = new DataBase('sqlite::memory:');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->exec(<<<SQL
CREATE TABLE IF NOT EXISTS USER (
      id INT PRIMARY KEY NOT NULL,
      name VARCHAR(100) NOT NULL,
      password VARCHAR(100) NOT NULL
);
SQL
        );
        $this->userMapper = new UserMapper($this->connection);
    }

    public function testPersist()
    {
        $rows = $this->connection->query('SELECT COUNT(*) FROM USER')->fetch(PDO::FETCH_NUM);
        $this->assertEquals(0, $rows[0]);
        $this->userMapper->persist(new User(null, 'julien','test'));
        $rows = $this->connection->query('SELECT COUNT(*) FROM USER')->fetch(PDO::FETCH_NUM);
        $this->assertEquals(1, $rows[0]);
    }

    public function testRemove()
    {
        $user = new User('1', 'julien', 'test');
                
        $rows = $this->connection->query('SELECT COUNT(*) FROM USER')->fetch(PDO::FETCH_NUM);
        $this->assertEquals(0, $rows[0]);
        $this->userMapper->persist($user);
        $rows = $this->connection->query('SELECT COUNT(*) FROM USER')->fetch(PDO::FETCH_NUM);
        $this->assertEquals(1, $rows[0]);
        $this->userMapper->remove($user->getUserId());
        $rows = $this->connection->query('SELECT COUNT(*) FROM USER')->fetch(PDO::FETCH_NUM);
        $this->assertEquals(0, $rows[0]);
    }
}
