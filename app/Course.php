<?php

namespace App;
use \PDO;

class Classes
{
	protected $id;
	protected $name;
	protected $description;
    protected $classCode;
    protected $teacherID;

	// Database Connection Object
	protected $connection;

	public function __construct($name, $description, $classCode, $teacherID)
	{
		$this->name = $name;
        $this->description = $description;
        $this->classCode = $classCode;
        $this->teacherID = $teacherID;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

    public function getDescription()
	{
		return $this->description;
	}

    public function getCode()
	{
		return $this->classCode;
	}

    public function getTeacherID()
	{
		return $this->teacherID;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function save()
	{
		try {
			$sql = "INSERT INTO classes SET name=:name, description=:description, classCode=:classCode, teacherID=:teacherID";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':name' => $this->getName(),
                ':description' => $this->getDescription(),
                ':classCode' => $this->getCode(),
                ':teacherID' => $this->getTeacherID()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM classes WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->name = $row['name'];
            $this->description = $row['description'];
            $this->classCode = $row['classCode'];
            $this->teacherID = $row['teacherID'];

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($name, $description)
	{
		try {
			$sql = 'UPDATE todos SET task=?, is_completed=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$name,
				$description,
				$this->getId()
			]);
			$this->name = $name;
			$this->description = $description;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM todos WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAll()
	{
		try {
			$sql = 'SELECT * FROM classes';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}