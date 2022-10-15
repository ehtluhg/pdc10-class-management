<?php

namespace App;
use \PDO;

class Teacher
{
	protected $id;
	protected $firstName;
    protected $lastName;
	protected $email;
    protected $phoneNumber;
    protected $teacherCode;

	// Database Connection Object
	protected $connection;

	public function __construct($firstName, $lastName, $email, $phoneNumber, $teacherCode)
	{
		$this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->teacherCode = $teacherCode;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getFirstName()
	{
		return $this->firstName;
	}

    public function getLastName()
	{
		return $this->lastName;
	}

    public function getEmail()
	{
		return $this->email;
	}

    public function getPhone()
	{
		return $this->phoneNumber;
	}

    public function getCode()
	{
		return $this->teacherCode;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function save()
	{
		try {
			$sql = "INSERT INTO teachers SET firstName=:firstName, lastName=:lastName, email=:email, phoneNumber=:phoneNumber, teacherCode=:teacherCode";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':firstName' => $this->getFirstName(),
                ':lastName' => $this->getLastName(),
                ':email' => $this->getEmail(),
                ':phoneNumber' => $this->getPhone(),
                ':teacherCode' => $this->getCode()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM teachers WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->firstName = $row['firstName'];
            $this->lastName = $row['lastName'];
            $this->email = $row['email'];
            $this->phoneNumber = $row['phoneNumber'];
            $this->teacherCode = $row['teacherCode'];

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($firstName, $lastName, $email, $phoneNumber, $teacherCode)
	{
		try {
			$sql = 'UPDATE teachers SET firstName=?, lastName=?, email=?, phoneNumber=?, teacherCode=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$firstName,
                $lastName,
                $email,
                $phoneNumber,
                $teacherCode,
				$this->getId()
			]);
			$this->firstName = $firstName;
			$this->lastName = $lastName;
            $this->email = $email;
            $this->phoneNumber = $phoneNumber;
            $this->teacherCode = $teacherCode;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM teachers WHERE id=?';
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
			$sql = 'SELECT * FROM teachers';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}