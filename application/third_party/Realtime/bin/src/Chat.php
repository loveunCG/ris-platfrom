<?php

/**
 * Author : Kishor Mali
 * Filename : Chat.php
 * 
 * Class : Chat
 * This class is used for accepting and broadcasting the socket request
 */


namespace Chat;
use Chat\Repository\ChatRepository;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
require_once('MysqliDb.php');
// use MysqliDb as MysqliDbInstance;


class Chat implements MessageComponentInterface
{
	  protected $repository;	  
	  public $db;
	  /**
	 * Default constructor of the class
	 */
  	public function __construct()
  	{
		$this->repository = new ChatRepository;
		$this->db = new \MysqliDbInstance('localhost', 'root', '', 'ris');		
		
  	}
	
	/**
	 * This function is used to add the connected machine to queue
	 * @param {object} $conn : Connection interface object
	 */
  	public function onOpen(ConnectionInterface $conn)
  	{
    	$this->repository->addClient($conn);
  	}

  	public function onClose(ConnectionInterface $conn)
  	{
		echo "this client is colsed\n";
		$client = $this->repository->getClientByConnection($conn);
		$client_data = $client->getClientInfo();
		$data = Array (
			'device_doc_name' => $client_data->device_doc_name,
			'room_status' => 0,		
		);
		$this->db->where ('id', $client_data->device_id);
		if ($this->db->update ('tbl_device', $data))
			echo $this->db->count . ' records were updated';
		else
			echo 'update failed: ' . $this->db->getLastError();
    	$this->repository->removeClient($conn);
  	}

  	public function onError(ConnectionInterface $conn, \Exception $e)
  	{
    	echo "The following error occured : ". $e->getMessage();
		$client = $this->repository->getClientByConnection($conn);
		$client_data = $client->getClientInfo();
		$data = Array (
			'device_doc_name' => $client_data->device_doc_name,
			'room_status' => 0,		
		);
		$this->db->where ('id', $client_data->device_id);
		if ($this->db->update ('tbl_device', $data))
			echo $this->db->count . ' records were updated';
		else
			echo 'update failed: ' . $this->db->getLastError();
    	if($client !== null)
    	{
      		$client->getConnection()->close();
      		$this->repository->removeClient($conn);
		}
  	}

  	public function onMessage(ConnectionInterface $conn , $msg)
  	{
    	$data = $this->parseMessage($msg);
		$currClient = $this->repository->getClientByConnection($conn);
		$currClient->setClientInfo($data);	
		$udata = Array (
			'device_doc_name' => $data->device_doc_name,
			'room_status' => 1,		
		);
		$this->db->where ('id', $data->device_id);
		if ($this->db->update ('tbl_device', $udata))
			echo $this->db->count . ' records were updated';
		else
			echo 'update failed: ' . $this->db->getLastError();

		echo 'this is message info'.json_encode($data);   
    	
  	}

  	private function parseMessage($msg)
  	{
    	return json_decode($msg);
  	}
}

