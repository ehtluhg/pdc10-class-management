<?php

namespace App;
use \PDO;

class Student
{
	protected $id;
	protected $firstName;
    protected $lastName;
    protected $studentNumber;
	protected $email;
    protected $phoneNumber;
    protected $program;

	// Database Connection Object
	protected $connection;

	public function __construct($firstName, $lastName, $studentNumber, $email, $phoneNumber, $program)
	{
		$this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->studentNumber = $studentNumber;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->program = $program;
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

    public function getStudent()
	{
		return $this->studentNumber;
	}

    public function getEmail()
	{
		return $this->email;
	}

    public function getPhone()
	{
		return $this->phoneNumber;
	}

    public function getProgram()
	{
		return $this->program;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function save()
	{
		try {
			$sql = "INSERT INTO teachers SET firstName=:firstName, lastName=:lastName, studentNumber=:studentNumber, email=:email, phoneNumber=:phoneNumber, program=:program";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':firstName' => $this->getFirstName(),
                ':lastName' => $this->getLastName(),
                ':studentNumber' => $this->getStudent(),
                ':email' => $this->getEmail(),
                ':phoneNumber' => $this->getPhone(),
                ':program' => $this->getProgram()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM students WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->firstName = $row['firstName'];
            $this->lastName = $row['lastName'];
            $this->studentNumber = $row['studentNumber'];
            $this->email = $row['email'];
            $this->phoneNumber = $row['phoneNumber'];
            $this->program = $row['program'];

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($firstName, $lastName, $studentNumber, $email, $phoneNumber, $program)
	{
		try {
			$sql = 'UPDATE teachers SET firstName=?, lastName=?, email=?, phoneNumber=?, program=? WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$firstName,
                $lastName,
                $studentNumber,
                $email,
                $phoneNumber,
                $program,
				$this->getId()
			]);
			$this->firstName = $firstName;
			$this->lastName = $lastName;
            $this->studentNumber = $studentNumber;
            $this->email = $email;
            $this->phoneNumber = $phoneNumber;
            $this->program = $program;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM students WHERE id=?';
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
			$sql = 'SELECT * FROM students';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}